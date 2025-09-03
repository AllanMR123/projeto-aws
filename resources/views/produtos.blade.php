<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo TechBuild">
        </div>
        <nav class="header-center">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/monte-seu-pc') }}">Monte seu PC</a>
            <a href="{{ url('/produtos') }}" class="active">Produtos</a>
            <a href="{{ url('/carrinho') }}">Carrinho</a>
        </nav>
        <div class="header-right">
            @auth
                <span>Olá, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn">Login</a>
                <a href="{{ route('register') }}" class="btn">Registrar</a>
            @endauth
        </div>
    </header>

    <!-- Conteúdo -->
    <main class="section products-section">
        <h2>Nossos Produtos</h2>
        <div class="products">
            <!-- Produto 1 -->
            <div class="product-card">
                <img src="{{ asset('images/ryzen5.png') }}" alt="Processador Ryzen 5">
                <h3>Processador Ryzen 5</h3>
                <p>Ótimo desempenho para games e produtividade.</p>
                <div class="price">R$ 999,00</div>
                <button class="btn">Adicionar ao Carrinho</button>
            </div>

            <!-- Produto 2 -->
            <div class="product-card">
                <img src="{{ asset('images/ram16.png') }}" alt="Memória RAM 16GB">
                <h3>Memória RAM 16GB</h3>
                <p>Alta velocidade para multitarefas.</p>
                <div class="price">R$ 350,00</div>
                <button class="btn">Adicionar ao Carrinho</button>
            </div>

            <!-- Produto 3 -->
            <div class="product-card">
                <img src="{{ asset('images/rtx3060.png') }}" alt="Placa de Vídeo RTX 3060">
                <h3>Placa de Vídeo RTX 3060</h3>
                <p>Desempenho avançado em jogos e edição.</p>
                <div class="price">R$ 2.499,00</div>
                <button class="btn">Adicionar ao Carrinho</button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 TechBuild. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
