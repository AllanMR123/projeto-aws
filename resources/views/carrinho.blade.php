<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        /* 1. Reset e Estilos Globais Padronizados */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background-color: #050505;
            color: #fff;
            padding-top: 100px; /* Espaço para o Header Fixo */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        .header-center {
            display: flex; gap: 30px;
        }

        .header-center a {
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.3s;
            font-weight: 500;
        }

        .header-center a:hover, .header-center a.active {
            color: #0ff;
            text-shadow: 0 0 8px #0ff;
        }

        .header-right {
            display: flex; align-items: center; gap: 20px;
        }

        /* Botão de Perfil Padronizado */
        .btn-perfil {
            background: #0ff;
            color: #000;
            padding: 8px 20px;
            border-radius: 4px;
            font-weight: bold;
            text-decoration: none;
            font-size: 0.8rem;
            transition: 0.3s;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
        }

        .btn-perfil:hover {
            box-shadow: 0 0 15px #0ff;
            transform: scale(1.05);
        }

        /* 3. Container do Carrinho */
        .cart-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 30px;
            background: #111;
            border: 1px solid #0ff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
        }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { text-align: left; color: #0ff; border-bottom: 1px solid #333; padding: 10px; text-transform: uppercase; font-size: 0.8rem; }
        td { padding: 15px 10px; border-bottom: 1px solid #222; }

        .qty-input {
            width: 50px; background: #000; color: #0ff; border: 1px solid #333; border-radius: 4px; padding: 5px; text-align: center; outline: none;
        }

        .total-value { color: #0ff; font-size: 2.5rem; font-weight: bold; text-shadow: 0 0 15px rgba(0, 255, 255, 0.5); }

        .btn-action {
            padding: 12px 25px; border-radius: 6px; font-weight: bold; text-transform: uppercase; font-size: 0.85rem; cursor: pointer; transition: 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
        }

        .btn-checkout { background: #0ff; color: #000; border: none; }
        .btn-checkout:hover { box-shadow: 0 0 25px #0ff; transform: translateY(-2px); }
    </style>
</head>
<body>

    <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}?v=2" alt="Logo">
        </div>
        <nav class="header-center">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('montepc') }}">Monte seu PC</a>
            <a href="{{ route('products.index') }}">Produtos</a>
            <a href="{{ route('carrinho') }}" class="active">Carrinho</a>
        </nav>
        <div class="header-right">
            @auth
                <span style="font-size: 0.85rem;">Olá, <strong>{{ Auth::user()->name }}</strong></span>
                <a href="{{ route('perfil') }}" class="btn-perfil">Perfil</a>
            @else
                <a href="{{ route('login') }}" class="btn-perfil">Login</a>
            @endauth
        </div>
    </header>

    <div class="cart-container">
        <h1 style="margin-bottom: 10px;">🛒 Meu Carrinho</h1>

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
                            <td style="color: #eee; font-weight: bold;">{{ $details['name'] }}</td>
                            <td style="color: #aaa;">R$ {{ number_format($details['price'], 2, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                    @csrf @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="qty-input">
                                    <button type="submit" style="background:none; border:none; color:#0ff; cursor:pointer;">🔄</button>
                                </form>
                            </td>
                            <td style="color: #0ff; font-weight: bold;">R$ {{ number_format($details['price'] * $details['quantity'], 2, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background:none; border:none; color:#ff4444; cursor:pointer; font-size:0.8rem;">Remover</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 40px; text-align: right; border-top: 1px solid #333; padding-top: 20px;">
                <span style="color: #888; font-size: 1rem;">Total do pedido:</span>
                <div class="total-value">R$ {{ number_format($total, 2, ',', '.') }}</div>
            </div>

            <div style="margin-top: 30px; display: flex; justify-content: space-between;">
                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Esvaziar o carrinho?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="background:transparent; border:1px solid #ff4444; color:#ff4444; padding:10px 20px; border-radius:6px; cursor:pointer;">🗑 Limpar Tudo</button>
                </form>
                <a href="{{ route('checkout') }}" class="btn-main-action" style="text-decoration: none;">Finalizar Pedido 🚀</a>
            </div>
        @else
            <div style="text-align: center; padding: 60px 0;">
                <p style="color: #666; margin-bottom: 25px;">Seu carrinho está vazio.</p>
                <a href="{{ route('products.index') }}" class="btn-perfil" style="text-decoration: none;">Escolher Peças</a>
            </div>
        @endif
    </div>

</body>
</html>
