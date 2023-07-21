<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event; // Model próprio para acesso ao banco de dados

class EventController extends Controller
{

    // Convenção do Laravel
    public function index()
    {
        $dbEvents = Event::all(); // Todos os eventos do banco

        return view('welcome', ['events' => $dbEvents]); // Enviando para a home do site todos os eventos do banco
    }

    public function create()
    {
        return view('events.create');
    }

    /* Método responsável por receber e armazenar os dados no banco de dados */
    public function store(Request $request)
    {
        $dbEvent = new Event; // instância do banco de dados (Model)

        $dbEvent->title = $request->title;
        $dbEvent->city = $request->city;
        $dbEvent->description = $request->description;
        $dbEvent->private = $request->private;

        $dbEvent->save(); // método save para salvar no banco de dados

        // redireciona para uma página (home) após salvar / método 'with' usado para enviar uma Flash Message 
        return redirect('/')->with('msg', 'Evento criado com sucesso'); 
    }
}