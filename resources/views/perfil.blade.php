<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        /* 1. Reset e Estilos Globais Padronizados */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background-color: #050505;
            color: #fff;
            padding-top: 100px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Barra de Rolagem Neon */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb {
            background: #0ff;
            border-radius: 10px;
            box-shadow: 0 0 10px #0ff;
        }

        /* 2. Header Fixo Padronizado */
        header {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 80px;
            background: rgba(0, 0, 0, 0.95);
            border-bottom: 1px solid #0ff;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
        }

        .header-center { display: flex; gap: 30px; }
        .header-center a { color: #fff; text-decoration: none; font-size: 0.9rem; transition: 0.3s; }
        .header-center a:hover, .header-center a.active { color: #0ff; text-shadow: 0 0 8px #0ff; }

        .btn-perfil {
            background: #0ff;
            color: #000;
            padding: 8px 20px;
            border-radius: 4px;
            font-weight: bold;
            text-decoration: none;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        /* 3. Layout do Perfil */
        .profile-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
            padding: 20px;
        }

        /* Card Lateral de Usuário */
        .user-info-card {
            background: #111;
            border: 1px solid #0ff;
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            height: fit-content;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
        }

        .avatar-placeholder {
            width: 120px;
            height: 120px;
            background: #050505;
            border: 3px solid #0ff;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #0ff;
            text-shadow: 0 0 10px #0ff;
        }

        .user-info-card h2 { color: #fff; margin-bottom: 5px; }
        .user-info-card p { color: #888; font-size: 0.9rem; margin-bottom: 30px; }

        /* Dashboard de Conteúdo */
        .profile-content {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .dashboard-section {
            background: #111;
            border: 1px solid #222;
            border-radius: 15px;
            padding: 30px;
        }

        .dashboard-section h3 {
            color: #0ff;
            text-transform: uppercase;
            font-size: 1rem;
            margin-bottom: 20px;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
            letter-spacing: 2px;
        }

        /* Lista de Pedidos Atualizada */
        .data-item {
            display: flex;
            flex-direction: column; /* Agora em coluna para caber os itens embaixo */
            gap: 15px;
            padding: 20px;
            border-bottom: 1px solid #1a1a1a;
            transition: 0.3s;
        }
        .data-item:hover { background: #151515; }
        .data-item:last-child { border-bottom: none; }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .items-list {
            background: rgba(255, 255, 255, 0.03);
            border-left: 2px solid #0ff;
            padding: 12px;
            border-radius: 4px;
        }

        .items-list p {
            font-size: 0.7rem;
            color: #555;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .product-line {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: #ccc;
            margin-bottom: 5px;
        }

        .product-line:last-child { margin-bottom: 0; }

        .status-badge {
            background: #0ff;
            color: #000;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: bold;
        }

        .btn-logout {
            display: inline-block;
            margin-top: 20px;
            background: transparent;
            color: #ff4444;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: bold;
            border: 1px solid #ff4444;
            padding: 10px 25px;
            border-radius: 5px;
            transition: 0.3s;
            cursor: pointer;
        }
        .btn-logout:hover { background: #ff4444; color: #fff; box-shadow: 0 0 15px #ff4444; }
    </style>
</head>
<body>

    <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}?v=2" alt="Logo" style="height: 50px;">
        </div>
        <nav class="header-center">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('montepc') }}">Monte seu PC</a>
            <a href="{{ route('products.index') }}">Produtos</a>
            <a href="{{ route('carrinho') }}">Carrinho</a>
        </nav>
        <div class="header-right">
            <a href="{{ route('perfil') }}" class="btn-perfil active">Perfil</a>
        </div>
    </header>

    <div class="profile-wrapper">
        <aside class="user-info-card">
            <div class="avatar-placeholder">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <h2>{{ Auth::user()->name }}</h2>
            <p>{{ Auth::user()->email }}</p>

            <div style="border-top: 1px solid #222; padding-top: 20px; margin-top: 20px;">
                <p style="color: #0ff; font-weight: bold; margin-bottom: 10px;">Status da Conta</p>
                <span class="status-badge">Membro Elite</span>
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
                                <small style="color: #555;">Realizado em {{ $order->created_at->format('d/m/Y') }}</small>
                            </div>
                            <div style="text-align: right;">
                                <p style="color: #0ff; font-weight: bold;">R$ {{ number_format($order->total_price, 2, ',', '.') }}</p>

                                @php
                                    $statusMap = [
                                        'pendente' => ['color' => '#ffcc00', 'label' => 'Pendente'],
                                        'separacao' => ['color' => '#00f2ff', 'label' => 'Em Separação'],
                                        'enviado' => ['color' => '#00ff00', 'label' => 'Enviado'],
                                        'entregue' => ['color' => '#00ff00', 'label' => 'Entregue'],
                                        'cancelado' => ['color' => '#ff4444', 'label' => 'Cancelado'],
                                    ];
                                    $currentStatus = $statusMap[$order->status] ?? ['color' => '#fff', 'label' => ucfirst($order->status)];
                                @endphp

                                <span style="font-size: 0.7rem; color: {{ $currentStatus['color'] }}; font-weight: bold; text-transform: uppercase;">
                                    {{ $currentStatus['label'] }}
                                </span>
                            </div>
                        </div>

                        <div class="items-list">
                            <p>Conteúdo do Pedido:</p>
                            @foreach($order->items as $item)
                                <div class="product-line">
                                    <span>• {{ $item->product->name ?? 'Produto não identificado' }}
                                          <strong style="color: #0ff;">x{{ $item->quantity }}</strong>
                                    </span>
                                    <span style="color: #444;">R$ {{ number_format($item->price, 2, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 20px; color: #555;">
                        <p>Você ainda não realizou nenhum pedido.</p>
                        <a href="{{ route('montepc') }}" style="color: #0ff; text-decoration: none; font-size: 0.8rem; margin-top: 10px; display: block;">Monte seu PC agora →</a>
                    </div>
                @endforelse
            </section>

            <section class="dashboard-section">
                <h3>🖥 Meus Setups Salvos (Builds)</h3>
                <p style="color: #555; font-size: 0.8rem; text-align: center;">Funcionalidade em desenvolvimento para a próxima versão.</p>
            </section>

        </main>
    </div>

    <footer style="text-align: center; padding: 50px; color: #222; font-size: 0.8rem;">
        &copy; 2026 TechBuild. Painel do Usuário v1.2
    </footer>

</body>
</html>
