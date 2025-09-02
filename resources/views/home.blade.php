<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CustomPlay</title>
    <link rel="stylesheet" href="{{ asset('css/customplay.css') }}">
</head>
<body>

<header>
    <div class="header-left">
        <img src="{{ asset('images/logo.png') }}" alt="CustomPlay Logo">
    </div>

    <div class="header-center">
        <a href="#">Monte seu PC</a>
        <a href="#">Produtos</a>
        <a href="#">Carrinho</a>
    </div>

    <div class="header-right">
        @if(Auth::check())
            <span>Olá, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn logout-btn">Sair</button>
            </form>
        @else
            <a href="{{ url('/register') }}" class="btn">Criar Conta / Login</a>
        @endif
    </div>
</header>

<section class="hero">
    <h1>Bem-vindo ao CustomPlay</h1>
    <p>Monte seu PC gamer com sugestões personalizadas de acordo com os jogos que deseja jogar.</p>
    @if(!Auth::check())
        <a href="{{ url('/register') }}" class="btn-hero">Criar Conta / Login</a>
    @endif
</section>

<section class="section">
    <h2>Produtos em Destaque</h2>
    <div class="products">
        <div class="product-card">
            <img src="{{ asset('images/tecladogamer.jpg') }}" alt="Produto 1">
            <h3>Teclado Gamer RGB</h3>
            <p>Teclado mecânico com iluminação RGB e alta performance.</p>
            <div class="price">R$ 399,90</div>
        </div>
        <div class="product-card">
            <img src="{{ asset('images/mousegamer.jpg') }}" alt="Produto 2">
            <h3>Mouse Gamer</h3>
            <p>Mouse com alta precisão e sensor profissional.</p>
            <div class="price">R$ 249,90</div>
        </div>
        <div class="product-card">
            <img src="{{ asset('images/headsetgamer.jpg') }}" alt="Produto 3">
            <h3>Headset Gamer</h3>
            <p>Som surround 7.1 e microfone removível.</p>
            <div class="price">R$ 349,90</div>
        </div>
    </div>
</section>

<footer>
    &copy; 2025 CustomPlay. Todos os direitos reservados.
</footer>

</body>
</html>
