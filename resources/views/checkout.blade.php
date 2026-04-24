<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: #050505; color: #fff; padding-top: 100px; font-family: 'Segoe UI', sans-serif; }

        header { position: fixed; top: 0; left: 0; width: 100%; height: 80px; background: rgba(0, 0, 0, 0.95); border-bottom: 1px solid #0ff; z-index: 1000; display: flex; align-items: center; justify-content: space-between; padding: 0 50px; }
        .header-center { display: flex; gap: 30px; }
        .header-center a { color: #fff; text-decoration: none; font-size: 0.9rem; }

        .checkout-container { max-width: 800px; margin: 0 auto; padding: 40px; background: #111; border: 1px solid #0ff; border-radius: 15px; text-align: center; }

        .payment-methods { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 40px 0; }

        .payment-card {
            border: 1px solid #333; padding: 30px; border-radius: 12px; cursor: pointer; transition: 0.3s;
            display: flex; flex-direction: column; align-items: center; gap: 15px;
        }
        .payment-card:hover { border-color: #0ff; box-shadow: 0 0 15px rgba(0, 255, 255, 0.2); }

        input[type="radio"] { display: none; }
        input[type="radio"]:checked + .payment-card { border-color: #0ff; background: rgba(0, 255, 255, 0.05); }

        .btn-finalizar { background: #0ff; color: #000; border: none; padding: 15px 40px; border-radius: 5px; font-weight: bold; cursor: pointer; text-transform: uppercase; width: 100%; margin-top: 20px; transition: 0.3s; }
        .btn-finalizar:hover { box-shadow: 0 0 20px #0ff; transform: scale(1.02); }
    </style>
</head>
<body>
    <header>
        <div class="header-left"><img src="{{ asset('images/logo.png') }}?v=2" style="height: 50px;"></div>
        <nav class="header-center">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('products.index') }}">Produtos</a>
            <a href="{{ route('carrinho') }}">Carrinho</a>
        </nav>
        <div class="header-right"><span>Olá, <strong>{{ Auth::user()->name }}</strong></span></div>
    </header>

    <div class="checkout-container">
        <h1 style="color: #0ff;">Como deseja pagar?</h1>
        <p style="color: #888;">Selecione uma opção para concluir seu pedido (Demonstrativo TCC)</p>

        {{-- AQUI ESTÁ A CORREÇÃO: Action aponta para o controller e usamos POST --}}
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="payment-methods">
                <label>
                    <input type="radio" name="pay" value="pix" checked>
                    <div class="payment-card">
                        <span style="font-size: 2rem;">⚡</span>
                        <strong>PIX</strong>
                        <small>Aprovação imediata</small>
                    </div>
                </label>
                <label>
                    <input type="radio" name="pay" value="card">
                    <div class="payment-card">
                        <span style="font-size: 2rem;">💳</span>
                        <strong>Cartão de Crédito</strong>
                        <small>Até 12x sem juros</small>
                    </div>
                </label>
            </div>
            <button type="submit" class="btn-finalizar">Confirmar e Finalizar Compra</button>
        </form>
    </div>
</body>
</html>
