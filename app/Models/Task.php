<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks'; // benar, tabel harus 'tasks'

    protected $fillable = [
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
