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

    // Permitir o update
    protected $guarded = [];

    // Relation: one to many
    public function user()
    {
        // Referencia o Model User, pertence a um usuário
        return $this->belongsTo('App\Models\User');
    }

    // Relation: many to many
    public function users()
    {
        // Referencia o Model User, pertence a muitos usuários
        return $this->belongsToMany('App\Models\User');
    }
}