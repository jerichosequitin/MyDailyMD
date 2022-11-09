<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Symfony\Component\HttpKernel\Profiler\Profile;

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'name' => 'encrypted',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            if($user->type == 'patient')
            {
                $user->patient_profile()->create();
            }
            elseif($user->type == 'doctor' )
            {
                $user->doctor_profile()->create();
            }
        });
    }

    public function patient_profile()
    {
        return $this->hasOne(PatientProfile::class);
    }

    public function medical_histories()
    {
        return $this->hasMany(MedicalHistory::class);
    }

    public function medications()
    {
        return $this->hasMany(Medication::class);
    }

    public function allergies()
    {
        return $this->hasMany(Allergy::class);
    }

    public function progress_notes()
    {
        return $this->hasMany(ProgressNote::class);
    }

    public function immunizations()
    {
        return $this->hasMany(Immunization::class);
    }

    public function doctor_profile()
    {
        return $this->hasOne(DoctorProfile::class);
    }
}
