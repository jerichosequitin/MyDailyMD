<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $guarded = [];

    protected $casts = [
        'name' => 'encrypted',
        'dosage' => 'encrypted',
        'frequency' => 'encrypted',
        'physician' => 'encrypted',
        'purpose' => 'encrypted',
        'createdBy' => 'encrypted',
        'modifiedBy' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
