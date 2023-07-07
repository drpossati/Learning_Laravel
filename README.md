# Learning_Laravel

Estudando Laravel

[Vídeos Aulas](https://www.youtube.com/watch?v=qH7rsZBENJo&list=PLnDvRpP8BnewYKI1n2chQrrR4EYiJKbUG&index=1&t=7s)

## O que é Laravel

-   _Framework_ construído na linguagem PHP

*   Utiliza a arquitetura MVC (_Model View Controller_)

-   Possui recursos muito interessantes que auxiliam o desenvolvimento de aplicações:
    -   `artisan`
    -   `migrations`
    -   `blade`
    -   etc

*   Fácil de criar código e flexível no desenvolvimento de aplicações

-   Estrutura de pastas simples, deixando o projeto organizado

## Instalando o Laravel

-   [PHP](https://www.php.net/)

    -   Linux: `sudo apt install php(version)`

    -   Testando a instalação: `php -v`

*   Gerenciador de Banco de Dados

    -   [MariaDB](https://mariadb.org/)

    -   [PostgreSQL](https://www.postgresql.org/)

    -   etc

-   [Composer](https://getcomposer.org/)

    -   Gerenciador de dependência para PHP

    -   Testando a instalação: `composer --version`

*   [Laravel](https://laravel.com/docs/)

    -   `composer create-project --prefer-dist laravel/laravel 'name'`

        -   _name:_ Nome do projeto onde o Laravel será utilizado/instalado

    -   Iniciar um servidor utilizando o Laravel
        -   `php artisan serve`

## Rotas e Views

-   Vamos acessar as páginas do nosso projeto por meio de **rotas**

    -   `/routes/`

    -   Define as URLS de acesso as páginas

    -   Define os métodos utilizados no _controller_

    -   Controlam o fluxo da aplicação

*   As rotas chamam as **views**, que são as representações gráficas da páginas

    -   `/resources/views/`

-   Nas **views** teremos os **templates**, onde há a estruturação da página por meio do HTML

*   Os **templates** também renderizam **dados dinâmicos** por meio do PHP

    -   **templates** no Laravel são os **blades**

-   Os arquivos de **view** sempre são momeados com o final _.blade.php_

    -   Ex: `file_name.blade.php`

## Conhecendo o Blade

-   **Blade** é o template _engine_ do Laravel

*   Como ele, vamos deixar as nossas **views** dinâmica

-   Recebe _tags_ HTML e também dados que são fornecidos pelo banco

    -   Permite a adição de diretivas com comandos PHP

        ```PHP
        <html>
        @if(true)
            result
        @endif
        <p>{{ $name }}</p>
        </html>
        ```

*   Pode-se dizer que as **views** serão responsabilidade do **Blade**

-   Pode-se criar **estruturas de repetição**

    ```PHP
    @for($i = 0; $i < count($array); $i++)
        <p>{{ $array[$i] }}</p>
        <p>{{ $i }}</p>
    @endfor

    @foreach($stringArray as $text)
        <p>{{ $text }}</p>
        <p>{{ $loop->index }}</p>
    @endforeach
    ```

*   Executar **PHP puro**

    ```PHP
    @php
        $name = "teste";
        echo $name;

        if(true) {
            result;
        }

        for ($i = 0; $i < 10; $i++) {
            echo $i;
        }
    @endphp
    ```

-   Escrever **comentários** ocultos nos arquivos de **view**

    ```
    {{-- Comentários do Blade que não são renderizados na view --}}
    ```

*   **Blade** é versátil e nos permite chegar em um resultado excelente de renderização de **views**

## Adicionando arquivos estáticos

-   Uma aplicação _web_ normalmente tem arquivos de CSS, JS e imagens

*   O Laravel proporciona um maneira muito fácil de inserir estes arquivos no projeto

-   Todos os recursos ficam na pasta **_public_** e tem acesso direito nas _tags_ que trabalham com arquivos estáticos

## Criando _layout_ com blade

-   A funcionalidade de criar _layout_ permite o reaproveitamento de código

*   Pode-se utilizar os mesmo _header_ e _footer_ em todas as páginas sem repetir código

-   Pode-se criar seções do site por meio do _layout_ e também mudar o _title_ da página

    -   A diretiva `@yield('')` como `@yield('content')` ou `@yield('title')` definem seções de conteúdos que se alteram dinamicamente no _layout_

    -   A diretiva `@section('')` como `@section('content')` define o conteúdo da seção que será apresentado na **view**

## Resgatando parâmetros de URL - Parâmetros nas Rotas

-   Pode-se mudar as respostas de uma **view** adicionando parâmetros a uma **rota**

-   Ao definir a rota devemos colocar o parâmetro desta maneira: `{id}`

    ```PHP
    Route::get('/rota_teste/{id?}', function ($id = null) {
        return view('teste', ['id' => $id]);
    });
    ```

-   Pode-se ter parâmetros opcionais também, adicionando uma `?`

-   O Laravel aceita também _query parameters_, utilizando a seguinte sintaxe: `?name=Fulano&ages=30`

    ```PHP
    Route::get('/rota_teste/', function () {

        $nome = request('name');
        $ida = request('ages');

        return view('teste', ['nome' => $nome, 'idade' => $ida ]);
    });
    ```

## Controllers

-   Os **Controllers** são parte fundamental de toda aplicação em Laravel

*   Geralmente condensam a maior parte da lógica (código PHP)

    -   Possui os métodos denominados `actions` que possuem o código de trabalho

-   Tem o papel de enviar e esperar repostas do banco de dados

    -   Ele recebe as URLs do arquivo de **rotas** e executar a lógica correta

*   Também receber e enviar alguma reposta para as **views**

    -   O controller integrado com o arquivo de **rota**, devolve a resposta para a **view**

-   É comum retornar uma **view** ou redirecionar para uma URL pelo **Controller**

*   Os **controllers** podem ser criados via **artisan**

    -   `/app/Http/Controllers/`

    -   `php artisan make:controller EventController`

## Fluxo de trabalho

-   Criar uma nova **rota**

    -   `/routes/web.php`

    ```PHP
        Route::get('/events/create', [EventController::class, 'create']);
    ```

    -   `/events/create` define a URL de acesso

    -   `create` direciona para o método (_function_) na classe `EventController`

*   Criar o método a ser executado na classe de controller, também chamado de **action** no Laravel

    -   `/app/Http/Controllers/EventController`

    ```PHP
        public function create()
        {
            return view('events.create');
        }
    ```

    -   Retornar a **view** `create` que se encontra dentro da pasta `events`

-   Criar as pastas e os arquivos de **view** e/ou **controller** necessários

    -   Ex: a **view** `create` e o diretório de organização `events`

## Conexão com Banco de Dados

-   MySQL