<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event; // Model próprio para acesso ao banco de dados

class EventController extends Controller
{

    // Convenção do Laravel
    public function index()
    {
        $events = Event::all(); // Todos os eventos do banco

        return view('welcome', ['events' => $events]); // Enviando para a home do site todos os eventos do banco
    }

    public function create()
    {
        return view('events.create');
    }
}