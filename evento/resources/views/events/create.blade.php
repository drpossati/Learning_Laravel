<!-- Define a página de layout-->
@extends('layouts.main')

<!-- Define o conteúdo da seção title-->
@section('title', 'Criar Evento')

<!-- Define o conteúdo da seção content -->
@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">

    <h1>Crie o seu Evento</h1>

    <!-- /events rota do controller, enctype para envio de imagens-->
    <form action="/events" method="POST" enctype="multipart/form-data">

        @csrf <!-- Diretiva do Blade para permitir o envio do formulário -->

        <div class="form-group">

            <label for="image">Imagem do Evento:</label>
            <input type="file" id="image" name="image" class="from-control-file">

        </div>

        <div class="form-group">

            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Evento">   

        </div>

        <div class="form-group">

            <label for="date">Data do Evento:</label>
            <input type="date" class="form-control" id="date" name="date">   

        </div>

        <div class="form-group">

            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do Evento">   

        </div>

        <div class="form-group">

            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Descrição do Evento"></textarea>  

        </div>

        <div class="form-group">

            <label for="itens">Itens de Infraestrutura:</label>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="Cadeiras">Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="Palco">Palco
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
                <option value="1">Sim</option>
            </select>

        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Criar Evento">
        </div>

    </form>

</div>

<!-- Fim da seção content -->
@endsection