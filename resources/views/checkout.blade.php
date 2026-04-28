<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - TechBuild</title>
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

        /* 2. Header Fixo e Blindado (Sem Perfil) */
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

        /* 3. Container de Checkout */
        .checkout-container {
            max-width: 800px; margin: 40px auto; padding: 40px;
            background: #111; border: 1px solid #222; border-radius: 15px;
            text-align: center;
        }

        .payment-methods {
            display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 40px 0;
        }

        .payment-card {
            border: 1px solid #333; padding: 30px; border-radius: 12px;
            cursor: pointer; transition: 0.3s; display: flex;
            flex-direction: column; align-items: center; gap: 15px;
            background: #0a0a0a;
        }
        .payment-card:hover { border-color: #0ff; box-shadow: 0 0 15px rgba(0, 255, 255, 0.1); }
        .payment-card strong { font-size: 1.1rem; color: #fff; }
        .payment-card small { color: #888; }

        input[type="radio"] { display: none; }
        input[type="radio"]:checked + .payment-card {
            border-color: #0ff; background: rgba(0, 255, 255, 0.05);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);
        }

        .btn-finalizar {
            background: #0ff; color: #000; border: none; padding: 18px;
            border-radius: 50px; font-weight: bold; cursor: pointer;
            text-transform: uppercase; width: 100%; font-size: 1rem;
            transition: 0.3s; margin-top: 20px;
        }
        .btn-finalizar:hover { box-shadow: 0 0 30px #0ff; transform: scale(1.02); }

        /* ==========================================
           REGRAS MOBILE
           ========================================== */
        @media (max-width: 768px) {
            body { padding-top: 150px; }

            .header-top { height: 65px; }
            .header-logo { height: 30px; }

            .header-nav {
                gap: 15px; padding-bottom: 12px; border-top: 1px solid #111; padding-top: 12px;
            }
            .header-nav a { font-size: 0.75rem; }

            .checkout-container {
                margin: 20px 15px; padding: 25px 20px; border: none; background: transparent;
            }

            h1 { font-size: 1.5rem; }

            /* Opções de pagamento empilhadas no mobile */
            .payment-methods { grid-template-columns: 1fr; gap: 15px; }
            .payment-card { padding: 20px; }
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
            <a href="{{ route('products.index') }}">Produtos</a>
            <a href="{{ route('carrinho') }}">Carrinho</a>
        </nav>
    </header>

    <main class="checkout-container">
        <h1 style="color: #0ff; text-shadow: 0 0 10px rgba(0,255,255,0.3);">Como deseja pagar?</h1>
        <p style="color: #888; margin-top: 5px;">Selecione uma opção para concluir seu pedido</p>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="payment-methods">
                <label>
                    <input type="radio" name="pay" value="pix" checked>
                    <div class="payment-card">
                        <span style="font-size: 2.5rem;">⚡</span>
                        <strong>PIX</strong>
                        <small>Aprovação imediata</small>
                    </div>
                </label>

                <label>
                    <input type="radio" name="pay" value="card">
                    <div class="payment-card">
                        <span style="font-size: 2.5rem;">💳</span>
                        <strong>Cartão de Crédito</strong>
                        <small>Até 12x sem juros</small>
                    </div>
                </label>
            </div>

            <button type="submit" class="btn-finalizar">Confirmar e Finalizar Compra 🚀</button>
        </form>
    </main>

    <footer style="text-align: center; padding: 40px; color: #444; font-size: 0.75rem;">
        &copy; 2026 TechBuild. Transação protegida e criptografada.
    </footer>

</body>
</html>
