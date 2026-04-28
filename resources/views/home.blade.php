<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        /* 1. Reset e Estilos Globais */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background-color: #050505;
            color: #fff;
            padding-top: 100px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Barra de Rolagem Neon */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb {
            background: #0ff;
            border-radius: 10px;
            box-shadow: 0 0 10px #0ff;
        }

        /* 2. Header Fixo e Blindado */
        header {
            position: fixed; top: 0; left: 0; width: 100%; height: 80px;
            background: rgba(0, 0, 0, 0.98); border-bottom: 1px solid #0ff;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
        }

        /* Estrutura de Pesos para Centralização Real do Menu */
        .header-left, .header-right {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .header-left { justify-content: flex-start; }
        .header-right { justify-content: flex-end; } /* Joga o Nome/Perfil lá no Canto Direito */

        .header-logo { height: 45px; width: auto; display: block; }

        .header-center {
            display: flex;
            gap: 25px;
            flex: 2;
            justify-content: center;
        }

        .header-center a {
            color: #fff; text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: 0.3s;
        }
        .header-center a:hover, .header-center a.active { color: #0ff; text-shadow: 0 0 8px #0ff; }

        /* Botão com Nome do Usuário: Azul, Quadradinho, Texto Normal */
        .btn-perfil {
            background: #0ff;
            color: #000;
            padding: 8px 18px;
            border-radius: 4px;
            font-weight: bold;
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.3s;
            text-transform: none; /* Mantém nome em caixa baixa normal */
            white-space: nowrap;
            border: none;
            cursor: pointer;
        }
        .btn-perfil:hover { box-shadow: 0 0 15px #0ff; transform: scale(1.05); color: #000; }

        /* 3. Hero Section */
        .hero {
            height: 75vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: radial-gradient(circle at center, #102020 0%, #050505 70%);
            padding: 20px;
        }

        .hero-logo-large {
            height: 180px; width: auto;
            filter: drop-shadow(0 0 25px rgba(0, 255, 255, 0.5));
            margin-bottom: 30px;
            animation: pulse-glow 3s infinite ease-in-out;
        }

        @keyframes pulse-glow {
            0%, 100% { filter: drop-shadow(0 0 20px rgba(0, 255, 255, 0.4)); transform: scale(1); }
            50% { filter: drop-shadow(0 0 40px rgba(0, 255, 255, 0.7)); transform: scale(1.02); }
        }

        .hero p {
            font-size: 1.3rem; color: #0ff; max-width: 800px;
            margin-bottom: 40px; letter-spacing: 2px; font-weight: 600;
            text-shadow: 0 0 5px #0ff, 0 0 15px rgba(0, 255, 255, 0.6);
            text-transform: uppercase;
        }

        .btn-action-hero {
            background: #0ff; color: #000; padding: 16px 50px; border-radius: 50px;
            font-weight: bold; text-decoration: none; font-size: 1rem;
            transition: 0.3s; text-transform: uppercase; border: none; cursor: pointer;
        }
        .btn-action-hero:hover { box-shadow: 0 0 30px #0ff; transform: scale(1.05); }

        /* 4. Grid de Destaques */
        .section { padding: 80px 50px; max-width: 1600px; margin: 0 auto; }
        .section h2 { color: #0ff; text-align: center; margin-bottom: 50px; text-transform: uppercase; letter-spacing: 3px; font-size: 1.5rem; }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: #0f0f0f; border: 1px solid #222; padding: 25px;
            border-radius: 15px; text-align: center; transition: 0.4s;
            display: flex; flex-direction: column; justify-content: space-between;
        }
        .product-card:hover { border-color: #0ff; transform: translateY(-10px); box-shadow: 0 0 25px rgba(0, 255, 255, 0.15); }
        .product-card img { width: 100%; height: 180px; object-fit: contain; margin-bottom: 20px; }
        .price { color: #0ff; font-size: 1.5rem; font-weight: bold; margin: 15px 0; }

        /* ==========================================
           RESPONSIVIDADE (MOBILE)
           ========================================== */
        @media (max-width: 768px) {
            body { padding-top: 170px; }

            header {
                padding: 10px 15px;
                height: auto;
                flex-wrap: wrap;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .header-left {
                order: 1;
                flex: 0 0 50%;
                display: flex;
                justify-content: flex-start;
            }

            .header-right {
                order: 2;
                flex: 0 0 50%;
                display: flex;
                justify-content: flex-end;
            }

            .header-center {
                order: 3;
                width: 100%;
                flex: 0 0 100%;
                margin-top: 15px;
                padding-top: 10px;
                border-top: 1px solid #1a1a1a;
                gap: 10px;
            }

            .header-logo { height: 28px; }
            .header-center a { font-size: 0.8rem; padding: 5px; }
            .btn-perfil { font-size: 0.75rem; padding: 6px 15px; }

            .hero { height: 60vh; padding: 40px 20px; }
            .hero-logo-large { height: 90px; margin-bottom: 20px; }
            .hero p { font-size: 0.85rem; margin-bottom: 30px; }

            .section { padding: 40px 15px; }
            .products-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <header>
        <div class="header-left">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}?v=2" alt="Logo" class="header-logo">
            </a>
        </div>

        <nav class="header-center">
            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ route('montepc') }}" class="{{ Request::is('monte-seu-pc') ? 'active' : '' }}">Monte seu PC</a>
            <a href="{{ route('products.index') }}" class="{{ Request::is('produtos') ? 'active' : '' }}">Produtos</a>
            <a href="{{ route('carrinho') }}" class="{{ Request::is('carrinho') ? 'active' : '' }}">
                Carrinho <span style="background: #000; color: #0ff; padding: 1px 5px; border-radius: 50%; font-size: 10px; border: 1px solid #0ff;">{{ count(session('cart', [])) }}</span>
            </a>
        </nav>

        <div class="header-right">
            @auth
                {{-- Exibe apenas o primeiro nome para não quebrar o layout --}}
                <a href="{{ route('perfil') }}" class="btn-perfil">
                    {{ explode(' ', Auth::user()->name)[0] }}
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-perfil">Login</a>
            @endauth
        </div>
    </header>

    <main>
        <section class="hero">
            <img src="{{ asset('images/logo.png') }}?v=2" alt="Logo" class="hero-logo-large">
            <p>A inteligência artificial que monta o seu setup de 2026.</p>
            <button class="btn-action-hero" onclick="location.href='{{ route('montepc') }}'">
                Começar Montagem
            </button>
        </section>

        <section class="section">
            <h2>🔥 Componentes em Destaque</h2>
            <div class="products-grid">
                @foreach($featuredProducts as $product)
                    @php $catSlug = strtolower(str_replace(' ', '-', $product->category)); @endphp
                    <div class="product-card">
                        <div>
                            <img src="{{ asset('images/categorias/' . $catSlug . '.png') }}"
                                 onerror="this.src='https://placehold.jp/24/00f2ff/000000/200x200.png?text={{ $product->category }}'">
                            <h3 style="font-size: 1rem; color: #eee; margin-top: 10px;">{{ $product->name }}</h3>
                        </div>
                        <div>
                            <div class="price">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-action-hero" style="width: 100%; padding: 12px; font-size: 0.8rem; border-radius: 5px;">Adicionar</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <footer style="text-align: center; padding: 40px; border-top: 1px solid #111; color: #444; font-size: 0.7rem;">
        &copy; 2026 TechBuild. Todos os direitos reservados.
    </footer>

</body>
</html>
