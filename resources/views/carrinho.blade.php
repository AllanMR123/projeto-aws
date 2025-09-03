<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Carrinho</title>
    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
</head>
<body>

<!-- Header -->
<header>
    <div class="header-left">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>
    <div class="header-center">
        <a href="{{ route('home') }}">Início</a>
        <a href="{{ url('/monte-seu-pc') }}">Monte seu PC</a>
        <a href="{{ url('/produtos') }}">Produtos</a>
        <a href="{{ url('/carrinho') }}">Carrinho</a>
    </div>
    <div class="header-right">
            @auth
                <span>Olá, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn">Login</a>
                <a href="{{ route('register') }}" class="btn">Registrar</a>
            @endauth
        </div>
</header>

<!-- Conteúdo do Carrinho -->
<div class="cart-container">
    <div class="cart-title">🛒 Seu Carrinho</div>

    <div class="cart-header">
        <div>Produto</div>
        <div>Preço</div>
        <div>Quantidade</div>
        <div>Total</div>
        <div>Ação</div>
    </div>

    <div class="cart-item">
        <div>
            <img src="{{ asset('images/placavideo.jpg') }}" alt="Placa de Vídeo">
            <p>Placa de Vídeo RTX 4060</p>
        </div>
        <div>R$ 2.499,00</div>
        <div><input type="number" value="1" min="1"></div>
        <div>R$ 2.499,00</div>
        <div><button>Remover</button></div>
    </div>

    <div class="cart-item">
        <div>
            <img src="{{ asset('images/ssd1tb.jpg') }}" alt="SSD 1TB">
            <p>SSD 1TB NVMe</p>
        </div>
        <div>R$ 499,00</div>
        <div><input type="number" value="2" min="1"></div>
        <div>R$ 998,00</div>
        <div><button>Remover</button></div>
    </div>

    <div class="cart-total">Total da Compra: R$ 3.497,00</div>
    <a href="#" class="checkout-btn">Finalizar Compra</a>
</div>

<!-- Footer -->
<footer>
    &copy; 2025 TechBuild. Todos os direitos reservados.
</footer>

</body>
</html>
