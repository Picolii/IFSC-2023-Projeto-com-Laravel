<header>
    <div class="header_adm">
        <a href="{{ url('/fornecedor') }}">Fornecedores</a><br>
        <a href="{{ url('/usuario') }}">Usuarios</a><br>
        <a href="{{ url('/produto') }}">Produtos</a><br>
        <a href="{{ url('/leitura') }}">Leituras</a><br>
    </div>
    <div>
        <nav>
            <div class="dropdown3">
                <a href="adm.html"><img src="./storage/icons/adm.svg"><img> </a>

                <div class="dropdown-content3">
                    <a href="UsuarioForm.php">Cadastrar</a>
                </div>
            </div>
        </nav> <a href="index.php">
            <img src="./storage/icons/LogoPronta.svg"  class="logo-adm" /></a>
    </div>
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Logar') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar-se') }}</a>
            </li>
        @endif
    @else
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class='fas fa-user'></i> {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#"> <i class='fas fa-user-cog'></i> Perfil</a>
                <a class="dropdown-item" href="#"><i class='fas fa-cog'></i> Configurações</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='fas fa-sign-out-alt'></i> {{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </div>
    @endguest
</header>
