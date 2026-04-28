<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        /* 1. Reset e Estilos Globais */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background-color: #050505;
            color: #fff;
            padding-top: 100px; /* Desktop */
            font-family: 'Segoe UI', Tahoma, sans-serif;
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

        /* 2. Header Fixo e Blindado (Padrão Interno sem Botão) */
        header {
            position: fixed; top: 0; left: 0; width: 100%; height: auto;
            background: rgba(0, 0, 0, 0.98); border-bottom: 1px solid #0ff;
            z-index: 1000; display: flex; flex-direction: column; transition: 0.3s;
        }

        .header-top {
            display: flex; justify-content: center; align-items: center;
            padding: 10px 50px; height: 80px; width: 100%;
        }

        .header-logo { height: 45px; width: auto; display: block; }

        .header-nav {
            display: flex; gap: 30px; justify-content: center; padding-bottom: 15px;
        }
        .header-nav a {
            color: #fff; text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: 0.3s;
        }
        .header-nav a:hover, .header-nav a.active { color: #0ff; text-shadow: 0 0 8px #0ff; }

        /* 3. Layout do Perfil */
        .profile-wrapper {
            max-width: 1200px; margin: 40px auto; display: grid;
            grid-template-columns: 320px 1fr; gap: 30px; padding: 0 20px;
        }

        /* Card Lateral */
        .user-info-card {
            background: #111; border: 1px solid #222; border-radius: 15px;
            padding: 40px 20px; text-align: center; height: fit-content;
        }

        .avatar-placeholder {
            width: 100px; height: 100px; background: #050505; border: 2px solid #0ff;
            border-radius: 50%; margin: 0 auto 20px; display: flex;
            align-items: center; justify-content: center; font-size: 2.5rem;
            color: #0ff; text-shadow: 0 0 10px #0ff;
        }

        .user-info-card h2 { font-size: 1.2rem; margin-bottom: 5px; }
        .user-info-card p { color: #666; font-size: 0.85rem; margin-bottom: 25px; }

        .status-badge {
            background: rgba(0, 255, 255, 0.1); color: #0ff; border: 1px solid #0ff;
            padding: 5px 15px; border-radius: 20px; font-size: 0.75rem; font-weight: bold;
        }

        /* Conteúdo Principal */
        .dashboard-section {
            background: #111; border: 1px solid #222; border-radius: 15px;
            padding: 30px; margin-bottom: 30px;
        }

        .dashboard-section h3 {
            color: #0ff; text-transform: uppercase; font-size: 0.9rem;
            margin-bottom: 25px; border-bottom: 1px solid #222;
            padding-bottom: 15px; letter-spacing: 1px;
        }

        /* Lista de Pedidos */
        .data-item {
            background: #0a0a0a; border: 1px solid #1a1a1a; border-radius: 10px;
            margin-bottom: 20px; padding: 20px; transition: 0.3s;
        }
        .data-item:hover { border-color: #0ff; }

        .order-header {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #1a1a1a;
        }

        .items-list { background: #111; padding: 15px; border-radius: 8px; }
        .product-line {
            display: flex; justify-content: space-between; font-size: 0.85rem;
            color: #aaa; margin-bottom: 8px;
        }

        .btn-logout {
            width: 100%; margin-top: 25px; background: transparent;
            color: #ff4444; border: 1px solid #ff4444; padding: 12px;
            border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s;
        }
        .btn-logout:hover { background: #ff4444; color: #fff; box-shadow: 0 0 15px rgba(255, 68, 68, 0.4); }

        /* ==========================================
           REGRAS MOBILE
           ========================================== */
        @media (max-width: 768px) {
            body { padding-top: 150px; }

            .header-top { height: 65px; }
            .header-logo { height: 30px; }
            .header-nav { gap: 12px; padding-bottom: 12px; border-top: 1px solid #111; padding-top: 12px; }
            .header-nav a { font-size: 0.75rem; }

            .profile-wrapper { grid-template-columns: 1fr; margin: 20px auto; }
            .user-info-card { padding: 30px 15px; }
            .dashboard-section { padding: 20px 15px; }

            .order-header { flex-direction: column; gap: 10px; }
            .order-header div:last-child { text-align: left !important; }

            .product-line { flex-direction: column; gap: 5px; margin-bottom: 12px; }
            .product-line span:last-child { color: #0ff; font-weight: bold; }
        }
    </style>
</head>
<body>

    <header>
        <div class="header-top">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}?v=2" alt="Logo" class="header-logo">
            </a>
        </div>

        <nav class="header-nav">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('montepc') }}">Monte seu PC</a>
            <a href="{{ route('products.index') }}">Produtos</a>
            <a href="{{ route('carrinho') }}">Carrinho</a>
        </nav>
    </header>

    <div class="profile-wrapper">
        <aside class="user-info-card">
            <div class="avatar-placeholder">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <h2>{{ Auth::user()->name }}</h2>
            <p>{{ Auth::user()->email }}</p>

            <div style="margin: 20px 0;">
                <span class="status-badge">Membro Elite 2026</span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Encerrar Sessão</button>
            </form>
        </aside>

        <main class="profile-content">
            <section class="dashboard-section">
                <h3>📦 Meus Últimos Pedidos</h3>

                @forelse($orders as $order)
                    <div class="data-item">
                        <div class="order-header">
                            <div>
                                <p style="font-weight: bold; color: #fff;">Pedido #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                                <small style="color: #444;">{{ $order->created_at->format('d/m/Y') }}</small>
                            </div>
                            <div style="text-align: right;">
                                <p style="color: #0ff; font-weight: bold; font-size: 1.1rem;">R$ {{ number_format($order->total_price, 2, ',', '.') }}</p>
                                @php
                                    $statusLabels = [
                                        'pendente' => ['color' => '#ffcc00', 'txt' => 'Pendente'],
                                        'enviado' => ['color' => '#00ff00', 'txt' => 'Enviado'],
                                        'entregue' => ['color' => '#00ff00', 'txt' => 'Entregue'],
                                        'cancelado' => ['color' => '#ff4444', 'txt' => 'Cancelado'],
                                    ];
                                    $st = $statusLabels[$order->status] ?? ['color' => '#fff', 'txt' => $order->status];
                                @endphp
                                <span style="font-size: 0.65rem; color: {{ $st['color'] }}; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                                    {{ $st['txt'] }}
                                </span>
                            </div>
                        </div>

                        <div class="items-list">
                            @foreach($order->items as $item)
                                <div class="product-line">
                                    <span>• {{ $item->product->name ?? 'Produto' }} <strong>x{{ $item->quantity }}</strong></span>
                                    <span>R$ {{ number_format($item->price, 2, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 40px 0;">
                        <p style="color: #444; font-size: 0.9rem;">Você ainda não realizou pedidos.</p>
                        <a href="{{ route('montepc') }}" style="color: #0ff; text-decoration: none; font-size: 0.8rem; margin-top: 15px; display: block;">Montar meu primeiro setup →</a>
                    </div>
                @endforelse
            </section>

            <section class="dashboard-section">
                <h3>🖥 Builds e Favoritos</h3>
                <p style="color: #444; font-size: 0.8rem; text-align: center;">Módulos de builds personalizadas em desenvolvimento.</p>
            </section>
        </main>
    </div>

    <footer style="text-align: center; padding: 40px; color: #222; font-size: 0.75rem;">
        &copy; 2026 TechBuild. Dashboard do Cliente v1.5
    </footer>

</body>
</html>
