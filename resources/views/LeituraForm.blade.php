</html>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <link
      rel="shortcut icon"
      href="./public/icons/LogoPronta.svg"
      type="image/x-icon"
    />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bom Look</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap"
      rel="stylesheet"
    />
    <script src="./src/js/slider.js" defer></script>
    <script src="./src/js/snackbar.js" defer></script>

    <script
      src="https://kit.fontawesome.com/b5ad8d5d3f.js"
      crossorigin="anonymous"
      defer
    ></script>
    <link rel="stylesheet" href="{{ asset('css/globalStyle.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/exprodutoedit.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/snackbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/indexadm.css') }}" />
  </head>

  @php
    if (!empty($leitura->id)) {
        $route = route('leitura.update', $leitura->id);
    } else {
        $route = route('leitura.store');
    }
@endphp

  <style>
    input[type=text], select {
      width: 60rem;
      padding: 10px 10px;
      margin: 10px 0;
      display: flex;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type=submit] {
      width: 100%;
      background-color: #515153;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: transform 0.3s;
    }

    input[type=submit]:hover {
      transform: scale(1.1);
    }
    input[type=submit]:active {
      transform: scale(1);
    }
    div {
      border-radius: 5px;
    }
    .content {
      align-items: center;
      justify-content: center;
      display: flex;
      flex-direction: column;
      padding-top: 7rem;
    }
    h3 {
      color: var(--text);
      font-size: 3rem;
      font-weight: 500;
      padding-bottom: 6rem;

    }
</style>

<body class="layout">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <header>
      <div class="header_adm">
        <a href="{{ url('/fornecedor') }}">Fornecedores</a><br>
        <a href="{{ url('/usuario') }}">Usuarios</a><br>
        <a href="{{ url('/produto') }}">Produtos</a><br>
        <a href="{{ url('/leitura') }}">Leitura</a><br>
      </div>
      <div>
        <nav>
          <div class="dropdown3">
        <a href="{{ url('/dashboard') }}"><img src="./public/icons/adm.svg"><img> </a>

      <div class="dropdown-content3">
          <a href="UsuarioForm.php">Cadastrar</a>
        </div>
      </div>
        </nav>  <a href="index.php">
          <img src="./public/icons/LogoPronta.svg"/></a>
      </div>
    </header>
    <div class="content">
      <h3>Formulário de leitura</h3>
      <form action="{{ $route}}" method="POST">
        @csrf
            @if (!empty($leitura->id))
                @method('PUT')
            @endif
        <input type="hidden" name="id"
        value="@if (!empty(old('id'))) {{ old('id') }} @elseif(!empty($leitura->id)) {{ $leitura->id }} @else {{ '' }} @endif" /><br>

        <label>Data da Leitura</label><br>
        <input type="date" class="form-control" name="DataLeitura"
        value="@if (!empty(old('DataLeitura'))) {{ old('DataLeitura') }} @elseif(!empty($leitura->DataLeitura)) {{ $leitura->DataLeitura }} @else {{ '' }} @endif" /><br>

        <label>Hora da Leitura</label><br>
        <input type="text" class="form-control" name="HoraLeitura"
        value="@if (!empty(old('HoraLeitura'))) {{ old('HoraLeitura') }} @elseif(!empty($leitura->HoraLeitura)) {{ $leitura->HoraLeitura }} @else {{ '' }} @endif" /><br>


        <label class="form-label">ID Mac</label><br>
                <select name="Nome" class="form-select">
                    @foreach ($_macs_bejo as $item)
                        <option value="{{ $item->id }}">{{ $item->Nome }}</option>
                    @endforeach
                </select>

        <label class="form-label">ID Sensor</label><br>
                <select name="Nome" class="form-select">
                    @foreach ($_sensors_bejo as $item)
                        <option value="{{ $item->id }}">{{ $item->Nome}}</option>
                    @endforeach
                </select>

        <button class="btn btn-success" type="submit">
            <i class="fa-solid fa-save"></i> Salvar
        </button>
    </form>

  </div>
  <footer>
      <div>
        <i></i>
        <i></i>
        <i></i>
      </div>
      <div>
        <p>Alunos: Bernardo Augusto Picoli e João Vitor de Carvalho</p>
      </div>
      <div></div>
    </footer>
    <div id="snackbar"></div>
  </body>
</html>
