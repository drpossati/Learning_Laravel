<!-- Define a página de layout -->
@extends('layouts.main')

<!-- Define o conteúdo da seção title-->
@section('title', $event->title )

<!-- Define o conteúdo da seção content -->
@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">

            <div id="image-container" class="col-md-6">
                @if($event->image == NULL )
                    <img src="/img/no-image-placeholder.webp" alt=" {{ $event->title }}" class="img-fluid">
                @else
                    <img src="/img/events/{{ $event->image }}" alt=" {{ $event->title }}" class="img-fluid">
                @endif
            </div>

            <div id="info-container" class="col-md-6">
                <h1>{{ $event->title }}</h1>
                
                <p class="event-city">
                    <ion-icon name="location-outline"></ion-icon>
                    {{ $event->city }}
                </p>

                <p class="event-participants">
                    <ion-icon name="people-outline"></ion-icon>
                    X Participantes
                </p>

                <p class="event-owner">
                    <ion-icon name="star-outline"></ion-icon>
                    Dono do Event
                </p>

                <a href="#" class="btn btn-primary" id="event-submit">Confirmar Presença</a>                
            </div>

            <div id="description-container" class="col-md-12">
                <h3>Sobre o Evento:</h3>
                <p class="event-description"> {{ $event->description }}</p>
            </div>

        </div>
    </div>

@endsection