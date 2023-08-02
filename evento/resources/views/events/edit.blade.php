<!-- Define a página de layout -->
@extends('layouts.main')

<!-- Define o conteúdo da seção title-->
@section('title', 'Editando: ' . $eventsEdit->title )

<!-- Define o conteúdo da seção content -->
@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">

    <h1>Editando o {{ $eventsEdit->title }}</h1>

    <!-- /events rota do controller, enctype para envio de imagens-->
    <form action="/events/update/{{ $eventsEdit->id }}" method="POST" enctype="multipart/form-data">

        @csrf <!-- Diretiva do Blade para permitir o envio do formulário -->
        @method('PUT') <!-- Diretiva do Blade indicando que é um formulário de atualização -->

        <div class="form-group">

            <label for="image">Imagem do Evento:</label>
            <input type="file" id="image" name="image" class="from-control-file">

            @if($eventsEdit->image == NULL )
                <img src="/img/no-image-placeholder.webp" alt=" {{ $eventsEdit->title }}" class="img-preview">
            @else
                <img src="/img/events/{{ $eventsEdit->image }}" alt="{{ $eventsEdit->title }}" class="img-preview">
            @endif
            <!-- Enviar o nome da imagem atual em um campo escondido -->
            <input type="hidden" name="imgOld" value="{{ $eventsEdit->image }}">
            
        </div>

        <div class="form-group">

            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Evento" value="{{ $eventsEdit->title }}">   

        </div>

        <div class="form-group">

            <label for="date">Data do Evento:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $eventsEdit->date->format('Y-m-d') }}">

        </div>

        <div class="form-group">

            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do Evento" value="{{ $eventsEdit->city }}">   

        </div>

        <div class="form-group">

            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Descrição do Evento"> {{ $eventsEdit->description }}  </textarea>  

        </div>

        <div class="form-group">

            <label for="itens">Itens de Infraestrutura:</label>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="Cadeiras">Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="Palco" checked>Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="Projetor">Projetor
            </div>  
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="Som">Som
            </div>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="Cerveja Grátis">Cerveja Grátis
            </div>    

        </div>

        <div class="form-group">

            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <!-- Um if ternário dentro da diretiva Blade para preencher o campo selected - condição ? true : false -->
                <option value="1" {{ $eventsEdit->private == 1 ? "selected='selected'" : "" }}>Sim</option>
            </select>

        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Editar Evento">
        </div>

    </form>

</div>

@endsection