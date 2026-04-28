<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Realizado - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        /* 1. Reset e Estilos Globais */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: #050505;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            flex-direction: column;
            padding: 20px;
        }

        .success-container { text-align: center; max-width: 700px; width: 100%; }

        /* Ícone de Sucesso GIGANTE */
        .success-icon {
            font-size: 5rem;
            color: #0ff;
            text-shadow: 0 0 30px #0ff;
            margin-bottom: 20px;
            animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes bounceIn {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .title-neon {
            font-size: 2.2rem;
            color: #0ff;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
            margin-bottom: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .order-status-tag {
            display: inline-block;
            background: rgba(0, 255, 255, 0.1);
            color: #0ff;
            border: 1px solid #0ff;
            padding: 5px 20px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        /* Resumo da Build Estilo "Recibo" */
        .build-summary {
            background: #111;
            border: 1px solid #222;
            border-radius: 15px;
            padding: 30px;
            text-align: left;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .summary-title {
            color: #888;
            font-size: 0.8rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 1px solid #222;
            padding-bottom: 10px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 0.9rem;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }
        .item-name { color: #eee; }
        .item-price { color: #0ff; font-family: monospace; }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px dashed #333;
        }
        .total-label { font-size: 1rem; color: #fff; font-weight: bold; }
        .total-value { font-size: 1.8rem; color: #0ff; font-weight: 800; text-shadow: 0 0 10px #0ff; }

        .actions {
            margin-top: 40px;
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn-base {
            padding: 15px 30px;
            border-radius: 5px;
            font-weight: bold;
            text-transform: uppercase;
            transition: 0.3s;
            text-decoration: none;
            font-size: 0.8rem;
        }

        .btn-home {
            background: #0ff;
            color: #000;
            border: none;
        }
        .btn-home:hover { box-shadow: 0 0 30px #0ff; transform: scale(1.05); }

        .btn-perfil {
            background: transparent;
            color: #0ff;
            border: 1px solid #0ff;
        }
        .btn-perfil:hover { background: rgba(0, 255, 255, 0.05); }

        /* Responsividade */
        @media (max-width: 768px) {
            .title-neon { font-size: 1.6rem; }
            .build-summary { padding: 20px; }
            .actions { flex-direction: column; }
            .btn-base { text-align: center; }
            .total-value { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

    <div class="success-container">
        <div class="success-icon">✓</div>

        <h1 class="title-neon">Setup Confirmado!</h1>
        <div class="order-status-tag">PEDIDO #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} • PROCESSADO</div>

        <p style="color: #888; margin-bottom: 30px; line-height: 1.6;">
            Sua build foi enviada para o nosso sistema. <br>
        </p>

        <div class="build-summary">
            <p class="summary-title">Resumo da Build</p>

            @foreach($order->items as $item)
                <div class="item-row">
                    <span class="item-name">
                        {{ $item->product->name ?? 'Componente' }}
                        <strong style="color: #555; margin-left: 5px;">x{{ $item->quantity }}</strong>
                    </span>
                    <span class="item-price">R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</span>
                </div>
            @endforeach

            <div class="total-row">
                <span class="total-label">VALOR TOTAL:</span>
                <span class="total-value">R$ {{ number_format($order->total_price, 2, ',', '.') }}</span>
            </div>
        </div>

        <div class="actions">
            <a href="{{ url('/') }}" class="btn-base btn-home">Voltar para a Loja</a>
            <a href="{{ route('perfil') }}" class="btn-base btn-perfil">Ver meus pedidos</a>
        </div>
    </div>

</body>
</html>
