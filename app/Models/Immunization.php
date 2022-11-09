<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    protected $guarded = [];

    protected $casts = [
        'vaccines' => 'encrypted',
        'purpose' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
