<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Model próprio para acesso a tabela events no banco de dados
use App\Models\Event;
// Model próprio para acesso a tabela users no banco de dados
use App\Models\User;

class EventController extends Controller
{

    // Convenção do Laravel
    public function index()
    {
        // Recebe o formulário de busca da página home
        $search = request('search');

        if ($search) {

            /* 
            Método where do Eloquent para pesquisas
            Array com o 'campo de pesquisa', 'método like do SQL' e a informação que veio do formulário
            */
            $dbEvents = Event::where([
                ['title', 'like', '%' . $search . '%']
            ])->get();

        } else {

            // Retorna todos os dados da tabela (events)
            $dbEvents = Event::all();
        }

        /*
        Enviando para a home do site via instância 'events' todos os eventos do banco armazenados na variável '$dbEvents'
        e também retorna a informação de pesquisa 'search'
        */
        return view('welcome', ['events' => $dbEvents, 'search' => $search]);
    }

    public function create()
    {
        // página create dentro da pasta events
        return view('events.create');
    }

    /* Método responsável por receber e armazenar os dados no banco de dados */
    public function store(Request $request)
    {
        // instância do banco de dados (Model)
        $dbEvent = new Event;

        $dbEvent->title = $request->title;
        $dbEvent->date = $request->date;
        $dbEvent->city = $request->city;
        $dbEvent->description = $request->description;
        $dbEvent->private = $request->private;
        //JSON
        $dbEvent->itens = $request->itens;

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

        // Pegar o usuário logado
        $userLog = auth()->user();
        // Id do usuário adicionado no campo chave estrangeira de events
        $dbEvent->user_id = $userLog->id;

        $dbEvent->save(); // método save para salvar no banco de dados

        // redireciona para uma página (home) após salvar / método 'with' usado para enviar uma Flash Message 
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    // Resgatando um evento no banco de dados
    public function show($id)
    {
        /*
        Página (view) 'show.blade.php' dentro da pasta 'events'

        Variável '$uniqueEvent' busca no banco de dados todos os registro referentes ao '$id'
        */
        $uniqueEvent = Event::findOrFail($id);

        $userAuth = auth()->user();
        $hasUserJoinEvent = false;

        /*
        Validando o usuário logado
        */
        if ($userAuth) {

            // Todos os eventos que o usuário participa convertido em array
            $userInEvents = $userAuth->eventsAsParticipant->toArray();

            //Valida se algum ID dos eventos que o usuário participa equivale ao ID que veio no request
            foreach ($userInEvents as $events) {

                if ($events['id'] == $id) {

                    $hasUserJoinEvent = true;
                }
            }
        }

        /* 
        Método where busca na tabela users o primeiro id igual ao user_id da tabela events, e retornar o Objeto convertido em Array
        */
        $uniqueOwner = User::where('id', $uniqueEvent->user_id)->first()->toArray();

        /*
        Array enviado a view show com:  
        'event' variável enviada com os dados da '$uniqueEvent'
        'eventOwner' variável enviada com os dados da '$uniqueOwner'
        'userInEvents' variável com o valor da '$hasUserJoinEvent'
        */
        return view('events.show', ['event' => $uniqueEvent, 'eventOwner' => $uniqueOwner, 'userInEvents' => $hasUserJoinEvent]);
    }

    // Action (function) para o dashboard
    public function dashboard()
    {
        // captura o usuário autenticado (sessão)
        $authUser = auth()->user();

        /*
        Referência o método 'events' no Model User
        Busca todos os eventos do banco de propriedade do usuário 
        */
        $userEvents = $authUser->events;

        /*
        Referência o método 'eventsAsParticipant' no Model User
        Busca todos os eventos do banco que o usuário participa
        */
        $userAsParticipant = $authUser->eventsAsParticipant;

        return view('events.dashboard', ['eventsUser' => $userEvents, 'eventsAsParticipant' => $userAsParticipant]);
    }

    public function destroy($id)
    {
        // Criando o objeto com todos os dados referentes ao ID
        $event_delete = Event::findOrFail($id);

        /*
        Apagando a imagem do evento, caso ela exista
        */
        $image_path = public_path('img/events/' . $event_delete->image);

        if ($event_delete->image != "") {

            unlink($image_path);
        }

        //Excluindo o registro do banco de dados
        $event_delete->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    // action para buscar o evento a ser editado
    public function edit($id)
    {

        // usuário autenticado
        $userAuth = auth()->user();

        $event_edit = Event::findOrFail($id);

        // Não permite que um usuário logado edite eventos de terceiros
        if ($userAuth->id != $event_edit->user_id) {

            return redirect('/dashboard')->with('msg', 'Evento não pertence ao usuário logado');
        }

        // retornando os dados par a view de edição
        return view('events.edit', ['eventsEdit' => $event_edit]);
    }

    // action que persiste as alterações nos dados
    public function update(Request $request_form)
    {

        // Todos os dados do formulário, exceto o campo imgOld
        $data = $request_form->except('imgOld');

        // Validando e salvando a imagem enviada
        if ($request_form->hasFile('image') && $request_form->file('image')->isValid()) {

            // retorna do form somente o campo identificado como 'image'
            $objImage = $request_form->image;

            $extension = $objImage->extension();

            // Nome original da imagem concatenado com a hora do momento e convertido em hash com md5, depois concatenado com a extensão
            $imageName = md5($objImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            // Mover a imagem para a pasta de armazenamento e salva com o nome único gerado
            $objImage->move(public_path('img/events'), $imageName);

            // Apagando a imagem que será substituída, caso exista
            $image_path = public_path('img/events/' . $request_form->imgOld);

            if ($request_form->imgOld != "") {

                unlink($image_path);
            }

            // Acessando o índice image do array gerado pelo Request
            $data['image'] = $imageName;
        }

        /*
        Cria o objeto Event com base no ID que veio do formulário
        Executa o método update com todos os dados que vieram na requisição
        */
        Event::findOrFail($request_form->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    // action para relacionar usuário participante ao evento ID
    public function joinEvent($id_event)
    {
        // usuário autenticado
        $user = auth()->user();

        /* 
            Envia o ID do usuário e o ID do evento para o método no Model User
            E preenche a tabela de relacionamento com os dados corretos
        */
        $user->eventsAsParticipant()->attach($id_event);

        $event = Event::findOrFail($id_event);

        return redirect('/dashboard')->with('msg', 'Presença confirmada no evento ' . $event->title);
    }

    // action para o usuário deixar de participar de um evento
    public function leaveEvent($id_event)
    {

        // usuário autenticado
        $user = auth()->user();

        /* 
            Envia o ID do usuário e o ID do evento para o método no Model User
            Remove a relação entre o ID do usuário e o ID do evento que participava
        */
        $user->eventsAsParticipant()->detach($id_event);

        $event = Event::findOrFail($id_event);

        return redirect('/dashboard')->with('msg', 'Presença removida do evento ' . $event->title);
    }
}