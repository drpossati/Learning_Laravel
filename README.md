# Learning_Laravel

Estudando Laravel

[Vídeos Aulas](https://www.youtube.com/watch?v=qH7rsZBENJo&list=PLnDvRpP8BnewYKI1n2chQrrR4EYiJKbUG&index=1&t=7s)

## Projeto Laravel no git

-   git clone [nome_projeto].git

*   configurar o `.env`

-   composer install

*   php artisan key:generate

-   php artisan migrate

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

    *   [PostgreSQL](https://www.postgresql.org/)

    -   etc

    *   Lembre-se de instalar os drivers de conexão correspondentes ao banco utilizado

        -   MariaDB/MySQL: `sudo apt install php(version)-mysql`

        -   PostgreSQL: `sudo apt install php(version)-pgsql`

-   [Composer](https://getcomposer.org/)

    -   Gerenciador de dependência para PHP

    -   Testando a instalação: `composer --version`

*   [Laravel](https://laravel.com/docs/)

    -   `composer create-project --prefer-dist laravel/laravel 'name'`

        -   _name:_ Nome do projeto onde o Laravel será utilizado/instalado

    -   Iniciar um servidor web utilizando o Laravel
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
            result one
        @elseif (true)
            result two
        @else
            result three
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

-   Pode-se ter parâmetros opcionais também, adicionando um `?`

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

    -   Retorna a **view** `create` que se encontra dentro da pasta `events`

-   Criar as pastas e os arquivos de **view** e/ou **controller** necessários

    -   Ex: a **view** `create` e o diretório de organização `events`

## Conexão com Banco de Dados

-   A conexão do Laravel com o bando é configurado pelo arquivo **.env**

*   Isso nos proporciona maior liberdade e também segurança na aplicação

-   O Laravel utiliza um ORM (_Object-Relational Mapping_) chamada **Eloquent**

*   Criação de tabelas por meio das **migrations**

    -   `php artisan migrate` para criar e configurar as tabelas do banco de dados

## Introdução a migrations do Laravel

-   As **migrations** funcionam como um versionamento de banco de dados

*   Pode-se avançar e retroceder a qualquer momento

-   Adicionar e remover colunas de forma facilitada

*   Fazer o _setup_ de DB de uma instalação em apenas um comando

-   Verificar as **migrations**: `php artisan migrate:status`

*   Criar uma **migration** própria: `php artisan make:migration create_product_table`

    -   Local: `/database/migrations/`

    -   As **migrations** possuem uma estrutura padrão e podem ser alteradas para adicionar ou remover campos da tabela do banco de dados

    ```PHP
    Schema::create('product', function (Blueprint $table) {
        $table->id(); //bigint
        $table->string('name', 100); //varchar(100)
        $table->integer('qty'); //int
        $table->text('description'); //text
        $table->timestamps();
    });
    ```

-   Apaga todo o banco e recriar todas as **migrations** existentes: `php artisan migrate:fresh`

## Avançando em migrations

-   Quando precisa-se adicionar um novo **campo a uma tabela**, devemos criar uma **migration**

    -   `php artisan make:migration add_category_to_product_table`

*   O **fresh** deleta (_drop_) todas as tabelas e executa as **migrations** novamente

    -   `php artisan migration:fresh `

    -   Deve-se tomar cuidado para **não rodar** o comando **fresh** e apagar os dados já existentes

-   O comando **rollback** pode ser utilizado para voltar uma **migration**

    -   `php artisan migration:rollback `

    -   As alterações nas tabelas também precisam ser adicionadas ao método _down_ da **migration** criada

*   Para voltar (**rollback**) todas as **migrations** pode-se utilizar o **reset**

    -   `php artisan migration:reset `

-   Para voltar todas as **migrations** e rodar o **migrate** novamente utiliza-se o **refresh**

    -   `php artisan migration:refresh `

## Utilizando o Eloquent do Laravel

-   Eloquent é a **ORM** do Laravel

*   Cada tabela tem um **Model** que é responsável pela interação entre as requisições ao banco

-   A convenção para o Model é o nome da **entidade no singular** e da **tabela no plural**

    -   Ex: Event e events

*   O model possui poucas alterações nos arquivos, geralmente configurações específicas

-   Criar um novo Model para acesso ao banco de dados

    -   `php artisan make:model Event`

    ```PHP
    // Padrão Laravel
    class Event extends Model
    {
        use HasFactory;
    }
    ```

## Adicionando Registros ao Banco de Dados

-   No Laravel é comum ter um _action_ específica para o _POST_ chamada de **store**

    -   Nesta _action_ cria o objeto e compõe ele com base nos dados enviados pelo _POST_

        -   Com objeto formado, utiliza-se o método **save** para persistir os dados

*   A lógica da aplicação

    -   Criar o formulário de captura dos dados e direciona para uma **rota** _(/events)_ de _POST_

    ```HTML
    <form action="/events" method="POST"> ... </form>
    ```

    -   Criar a **rota** responsável por redirecionar o formulário para a _action_ _(store)_ de tratamento

    ```PHP
    Route::post('/events', [EventController:class, 'store']);
    ```

    -   Criar a _function_ (_action_) **store** no controller (_EventController_) que recebe e trata os dados

    ```PHP
    public function store(Request $request) //Recebe POST do formulário
    {
        $dbObject = new YourModel; // instância do banco de dados

        $dbObject->colTable1 = $request->fieldForm;
        $dbObject->colTable2 = $request->fieldForm;

        $dbObject->save();

        return redirect('/paginaQualquer');
    }
    ```

## Flash Messages (Mensagens por sessão)

-   Pode-se adicionar mensagens ao usuário por **session**

    -   Estas mensagens são conhecidas por **flash messages**

*   Elas podem ser adicionadas com o método **with** nos _Controllers_

-   Utilizadas para apresentar _feedback_ ao usuário

*   No **blade** pode-se verificar a presença de mensagens pela diretiva **@session**

-   Método _store_ no _EventController_ com o método **with**

    ```PHP
    public function store(Request $request)
    {
        $dbEvent = new Event; // instância do banco de dados (Model)
        ...
        $dbEvent->save(); // método save para salvar no banco de dados

        // redireciona para uma página (home, neste caso) após salvar
        // método 'with' usado para enviar uma Flash Message
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }
    ```

*   Recepção das **Flash Messages** no _layout (template)_ do **blade**

    ```HTML
    <!-- Diretivas de blade para validar Flash Message -->
    <main>
        @if(session('msg'))
            <p class="msg">{{ session('msg') }}</p>
        @endif
    </main>
    ```

## Upload de Imagens com Laravel

-   Para fazer _upload_ de imagem é preciso mudar o _enctype_ do _form_ e criar um _input_ de envio da mesma

    ```HTML
    <form action="/events" method="POST" enctype="multipart/form-data">
        <label for="image">Imagem do Evento:</label>
        <input type="file" id="image" name="image" class="from-control-file">
        ...
    </form>
    ```

*   Fazer um tratamento de verificação da imagem enviada no _Controller_

-   Salvar a imagem com um nome único em um diretório do projeto

*   Salvar o caminho (_path_) para a imagem no banco de dados

    &nbsp;

    ```PHP
    // Validando e salvando a imagem enviada
    if ($request->hasFile('image') && $request->file('image')->isValid()) {

        $objImage = $request->image;

        $extension = $objImage->extension();

        // Nome original da imagem concatenado com a hora do momento e convertido em hash com md5, depois concatenado com a extensão
        $imageName = md5($objImage->getClientOriginalNane() . strtotime("now")) . "." . $extension;

        // Mover a imagem para a pasta de armazenamento e salva com o nome único gerado
        $objImage->move(public_path('img/events'), $imageName);

        // Enviando o nome da imagem para o banco
        $dbEvent->image = $imageName;
    }
    ```

## Resgatando um Registro do Banco de Dados

-   Criar uma nova **view** para apresentar o evento

    -   `/events/show.blade.php`

    -   Esta tela tem a função de exibir todas as informações do evento e também o botão para participar

*   Criar uma nova **rota** para **view** de eventos e uma nova _action_ no **Controller**

    ```PHP
    // Rota que recebe um parâmetro de ID
    Route::get('/events/{id}', [EventController::class, 'show']);
    ```

    ```PHP
    // action de destino da rota
    public function show($id)
    { ... }
    ```

-   Aprender a resgatar **apenas um registro** pelo _Eloquent_

    -   Utilizar o método **findOrFail** na _action_ do Controller

    ```PHP
    $uniqueEvent = Event::findOrFail($id);
    /*
        Página (view) 'show.blade.php' dentro da pasta 'events'

        Variável '$uniqueEvent' instância do banco de dados com os registro referentes ao '$id'

        'event' variável enviada a view show com os dados da '$uniqueEvent'
    */
    return view('events.show', ['event' => $uniqueEvent]);
    ```

*   Botão "Saber mais" -> acessa a rota -> instância a _action_ (método) no Controller -> retorna para view de apresentação do evento as informações do banco de dados

## Salvando JSON no Banco de Dados

-   Pode-se salvar um conjunto de dados no banco para itens de múltipla escolha

*   Criar um campo determinado de **json** via _migrations_

    -   Semelhantemente como se cria uma _migrate_ de banco

        -   `php artisan make:migration add_itens_to_events`

    -   Existe o tipo de dado 'json' para adicionar o campo

        ```PHP
        Schema::table('events', function (Blueprint $table) {
            //JSON no Banco
            $table->json('itens');
        });
        ```

-   No _front-end_ pode-se utilizar _inputs_ com _checkbox_

*   Após envio para o **Controller**, somente se recebe os itens via _request_ e o restante do processo ocorre normalmente por meio do Model do banco de dados

    -   `$dbEvent->itens = $request->itens;`

-   É preciso definir um _cast_, pois os itens do _checkbox_ são um _array_ e não uma _string_

    -   Esta definição ocorre dentro do **Model**

    ```PHP
    class Event extends Model
    {
        use HasFactory;

        // Informando que os dados são um array e não uma string
        protected $casts = [
            'itens' => 'array'
        ];
    }
    ```
