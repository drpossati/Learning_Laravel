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

        /*
        Enviando para a home do site via instância 'events' todos os eventos do banco armazenados na variável '$dbEvents'
        */
        return view('welcome', ['events' => $dbEvents]);
    }

    public function create()
    {
        // página create dentro da pasta events
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

        // Validando e salvando a imagem enviada
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $objImage = $request->image;

            $extension = $objImage->extension();

            // Nome original da imagem concatenado com a hora do momento e convertido em hash com md5, depois concatenado com a extensão
            $imageName = md5($objImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            // Mover a imagem para a pasta de armazenamento e salva com o nome único gerado
            $objImage->move(public_path('img/events'), $imageName);

            // Enviando o nome da imagem para o banco
            $dbEvent->image = $imageName;
        } else {

            // Caso nenhuma imagem seja envida, vazio para usar a imagem padrão
            $dbEvent->image = "";
        }

        $dbEvent->save(); // método save para salvar no banco de dados

        // redireciona para uma página (home) após salvar / método 'with' usado para enviar uma Flash Message 
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    // Resgatando um evento no banco de dados
    public function show($id)
    {
        $uniqueEvent = Event::findOrFail($id);

        /*
          Página (view) 'show.blade.php' dentro da pasta 'events'

          Variável '$uniqueEvent' instância do banco de dados com os registro referentes ao '$id'

          'event' variável enviada a view show com os dados da '$uniqueEvent'
        */
        return view('events.show', ['event' => $uniqueEvent]);
    }

}