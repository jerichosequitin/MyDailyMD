<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressNote extends Model
{
    protected $guarded = [];

    protected $casts = [
        'primaryDiagnosis' => 'encrypted',
        'findings' => 'encrypted',
        'treatmentPlan' => 'encrypted',
        'createdBy' => 'encrypted',
        'modifiedBy' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
