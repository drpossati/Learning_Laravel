<!-- Define a página de layout-->
@extends('layouts.main')

<!-- Define o conteúdo da seção title-->
@section('title', 'Dashboard')

<!-- Define o con teúdo da seção content -->
@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventsUser) > 0)

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
   
        <tbody>
            @foreach($eventsUser as $event)
                <tr>
                    <td scope="row"> {{ $loop->index + 1 }}</td> 
                    <td><a href="/events/{{ $event->id }}"> {{ $event->title }}</a></td>
                    <td> {{ count($event->users) }}</td>
                    <td>                        
                        <a href="/events/edit/{{ $event->id }}" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon>
                            Editar
                        </a>
                        
                        <form action="/events/{{ $event->id }}" method="POST">
                            @csrf
                            <!-- Diretiva Blade para informar ao Controller que é um formulário de deletar -->
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn">
                                <ion-icon name="trash-outline"></ion-icon>
                                Excluir
                            </button>
                        </form>
                    </td>       
                </tr>
            @endforeach
        </tbody>
    </table>
    
    @else
        <p>Você ainda não cadastrou nenhum evento, <a href="/events/create">Criar um Evento</a></p>
    @endif
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Participação em Eventos</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">

    @if(count($eventsAsParticipant) > 0)

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($eventsAsParticipant as $event)
                <tr>
                    <td scope="row"> {{ $loop->index + 1 }}</td> 
                    <td><a href="/events/{{ $event->id }}"> {{ $event->title }}</a></td>
                    <td> {{ count($event->users) }}</td>
                    <td>                        
                        <form action="/event/leave/{{ $event->id }}" method="POST">
                            @csrf
                            <!-- Diretiva Blade para informar ao Controller que é um formulário de deletar -->
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn">
                                <ion-icon name="trash-outline"></ion-icon>
                                Sair do Evento
                            </button>
                        </form>
                    </td>       
                </tr>
            @endforeach
        </tbody>
    </table>

    @else
        <p>Você não está participando de nenhum evento, <a href="/">Veja todos os Eventos</a></p>
    @endif
</div>

<!-- Fim da seção content -->
@endsection