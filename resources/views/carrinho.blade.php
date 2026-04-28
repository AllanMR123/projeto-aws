<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho - TechBuild</title>
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

        /* 2. Header Fixo e Blindado (Sem Botão de Perfil) */
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

        .header-center {
            display: flex; gap: 30px; justify-content: center; padding-bottom: 15px;
        }
        .header-center a {
            color: #fff; text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: 0.3s;
        }
        .header-center a:hover, .header-center a.active { color: #0ff; text-shadow: 0 0 8px #0ff; }

        /* 3. Container do Carrinho */
        .cart-container {
            max-width: 1000px; margin: 40px auto; padding: 30px;
            background: #111; border: 1px solid #222; border-radius: 12px;
        }

        h1 { color: #0ff; margin-bottom: 25px; font-size: 2rem; }

        /* Estilo da Tabela Desktop */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { text-align: left; color: #0ff; border-bottom: 1px solid #333; padding: 15px 10px; text-transform: uppercase; font-size: 0.8rem; }
        td { padding: 20px 10px; border-bottom: 1px solid #222; }

        .qty-input {
            width: 50px; background: #000; color: #0ff; border: 1px solid #333;
            border-radius: 4px; padding: 5px; text-align: center; outline: none;
        }

        .total-section { margin-top: 40px; text-align: right; border-top: 1px solid #333; padding-top: 25px; }
        .total-value { color: #0ff; font-size: 2.5rem; font-weight: bold; text-shadow: 0 0 15px rgba(0, 255, 255, 0.4); }

        .btn-checkout {
            background: #0ff; color: #000; padding: 15px 40px; border-radius: 50px;
            font-weight: bold; text-transform: uppercase; font-size: 1rem;
            text-decoration: none; transition: 0.3s; display: inline-block;
        }
        .btn-checkout:hover { box-shadow: 0 0 25px #0ff; transform: scale(1.05); }

        /* ==========================================
           RESPONSIVIDADE (MOBILE)
           ========================================== */
        @media (max-width: 768px) {
            body { padding-top: 150px; }

            .header-top { height: 65px; }
            .header-logo { height: 30px; }
            .header-center { gap: 15px; padding-bottom: 12px; border-top: 1px solid #111; padding-top: 12px; }
            .header-center a { font-size: 0.75rem; }

            .cart-container { padding: 20px 15px; border: none; background: transparent; }
            h1 { font-size: 1.5rem; text-align: center; }

            /* TRANSFORMANDO TABELA EM CARDS PARA NÃO CORTAR */
            thead { display: none; }

            table, tbody, tr, td { display: block; width: 100%; }

            tr {
                background: #111; border: 1px solid #333; border-radius: 12px;
                margin-bottom: 20px; padding: 15px;
            }

            td {
                border: none; padding: 8px 0; text-align: right;
                display: flex; justify-content: space-between; align-items: center;
                font-size: 0.9rem;
            }

            /* Rótulos dinâmicos via CSS */
            td::before {
                content: attr(data-label);
                color: #888; font-weight: bold; text-transform: uppercase; font-size: 0.7rem;
            }

            .total-section { text-align: center; }
            .total-value { font-size: 2rem; }

            .cart-actions {
                flex-direction: column-reverse; gap: 20px; align-items: center;
                display: flex;
            }
            .btn-checkout { width: 100%; text-align: center; }
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

        <nav class="header-center">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('montepc') }}">Monte seu PC</a>
            <a href="{{ route('products.index') }}">Produtos</a>
            <a href="{{ route('carrinho') }}" class="active">Carrinho</a>
        </nav>
    </header>

    <main class="cart-container">
        <h1>🛒 Meu Carrinho</h1>

        @if(count($cart) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th style="text-align: center;">Qtd</th>
                        <th>Subtotal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $details)
                        <tr>
                            <td data-label="Produto" style="color: #0ff; font-weight: bold;">{{ $details['name'] }}</td>
                            <td data-label="Preço" style="color: #aaa;">R$ {{ number_format($details['price'], 2, ',', '.') }}</td>
                            <td data-label="Quantidade">
                                <form action="{{ route('cart.update', $id) }}" method="POST" style="display: flex; align-items: center; gap: 8px;">
                                    @csrf @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="qty-input">
                                    <button type="submit" style="background:none; border:none; color:#0ff; cursor:pointer;">🔄</button>
                                </form>
                            </td>
                            <td data-label="Subtotal" style="color: #fff; font-weight: bold;">R$ {{ number_format($details['price'] * $details['quantity'], 2, ',', '.') }}</td>
                            <td data-label="Ações">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background:none; border:none; color:#ff4444; cursor:pointer; font-size:0.8rem;">Remover Item</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-section">
                <span style="color: #888; font-size: 1rem;">Total do pedido:</span>
                <div class="total-value">R$ {{ number_format($total, 2, ',', '.') }}</div>
            </div>

            <div class="cart-actions" style="margin-top: 30px; display: flex; justify-content: space-between; align-items: center;">
                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Esvaziar o carrinho?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="background:transparent; border:1px solid #ff4444; color:#ff4444; padding:10px 20px; border-radius:6px; cursor:pointer; font-size: 0.8rem;">🗑 Limpar Tudo</button>
                </form>
                <a href="{{ route('checkout') }}" class="btn-checkout">Finalizar Pedido 🚀</a>
            </div>
        @else
            <div style="text-align: center; padding: 60px 0;">
                <p style="color: #666; margin-bottom: 25px;">Seu carrinho está vazio.</p>
                <a href="{{ route('products.index') }}" class="btn-checkout" style="padding: 12px 30px; font-size: 0.85rem;">Escolher Peças</a>
            </div>
        @endif
    </main>

</body>
</html>
