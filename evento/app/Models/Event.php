<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Informando que os dados são um array e não uma string
    protected $casts = [
        'itens' => 'array'
    ];

    protected $dates = ['date'];
}