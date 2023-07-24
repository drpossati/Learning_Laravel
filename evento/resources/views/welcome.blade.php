<!-- Define a página de layout-->
@extends('layouts.main')

<!-- Define o conteúdo da seção title-->
@section('title', 'Eventos')

<!-- Define o conteúdo da seção content -->
@section('content')

<div id="search-container" class="col-md-12">

    <h1> Busque um evento </h1>

    <form action="">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar">
    </form>

</div>

<div id="events-container" class="col-md-12">

    <h2> Próximos eventos </h2>
    <p class="subtitle"> Veja os eventos dos próximos dias </p>

    <div id="cards-container" class="row">
        <!-- Diretiva Blade para executar um foreach -->
        @foreach($events as $event)
            <div class="card col-md-3">

                <!-- Diretiva Blade para executar um if...else...-->
                @if($event->image == NULL )
                    <!-- Imagem padrão -->                   
                    <img src="/img/no-image-placeholder.webp" alt="{{ $event->title }}">                
                @else
                    <!-- Buscando a imagem no banco de dados -->
                    <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                @endif

                <div class="card-body">
                    
                    <p class="card-date"> 10/09/2020 </p>
                    
                    <h5 class="card-title">{{ $event->title }}</h5>

                    <p class="card-participants"> X Participantes </p>

                    <a href="/events/{{ $event->id }}" class="btn btn-primary"> Saber Mais </a>

                </div>

            </div>
        @endforeach

    </div>

</div>

<!-- Fim da seção content -->
@endsection