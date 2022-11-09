<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    protected $guarded = [];

    protected $casts = [
        'surgicalProcedure' => 'encrypted',
        'hospital' => 'encrypted',
        'surgeryNotes' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
