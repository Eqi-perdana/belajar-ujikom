<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taks extends Model
{
    protected $fiiillable = [
        'name',
        'status',
        'priority',
        'due_date',
    ];

    protected $casts = [
        'status' => 'boolean',
        'due_date' => 'date',
    ];

    protected $attributes = [
        'status' => false,
        'priority' => 3,
    ];

}
