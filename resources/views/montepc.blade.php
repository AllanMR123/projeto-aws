<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monte seu PC</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <div class="header-center">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ url('/monte-seu-pc') }}" class="active">Monte seu PC</a>
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

    <!-- Conteúdo Principal -->
    <main class="pc-builder-section">
        <h1 class="title">🖥 Monte seu PC</h1>
        <p class="subtitle">As peças abaixo são ideal para você ter alto desempenho em jogos Atuais.</p>

        <div class="pc-builder-grid">

            <!-- Processador -->
            <div class="pc-card">
                <h3>Processador</h3>
                <select>
                    <option>Intel Core i7</option>
                    <option>Intel Core i9</option>
                    <option>AMD Ryzen 7</option>
                    <option>AMD Ryzen 9</option>
                </select>
            </div>

            <!-- Placa de Vídeo -->
            <div class="pc-card">
                <h3>Placa de Vídeo</h3>
                <select>
                    <option>NVIDIA RTX 4060</option>
                    <option>NVIDIA RTX 4070</option>
                    <option>AMD RX 7900</option>
                </select>
            </div>

            <!-- Memória RAM -->
            <div class="pc-card">
                <h3>Memória RAM</h3>
                <select>
                    <option>16GB</option>
                    <option>32GB</option>
                    <option>64GB</option>
                </select>
            </div>

            <!-- Armazenamento -->
            <div class="pc-card">
                <h3>Armazenamento</h3>
                <select>
                    <option>SSD 512GB</option>
                    <option>SSD 1TB</option>
                    <option>SSD 2TB</option>
                </select>
            </div>

        </div>

        <button class="btn-hero">Adicionar ao Carrinho</button>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 TechBuild. Todos os direitos reservados.</p>
    </footer>

</body>
</html>
