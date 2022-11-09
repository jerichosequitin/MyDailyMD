<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    protected $guarded = [];

    protected $casts = [
        'type' => 'encrypted',
        'trigger' => 'encrypted',
        'reaction' => 'encrypted',
        'treatment' => 'encrypted',
        'createdBy' => 'encrypted',
        'modifiedBy' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
