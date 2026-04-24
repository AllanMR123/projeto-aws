<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Realizado - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: #050505; color: #fff; font-family: 'Segoe UI', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; flex-direction: column; }

        .success-container { text-align: center; max-width: 900px; width: 95%; }

        .title-neon { font-size: 2.5rem; color: #0ff; text-shadow: 0 0 20px #0ff; margin-bottom: 10px; font-weight: 800; }
        .order-number { color: #888; font-size: 1.1rem; margin-bottom: 40px; }

        /* Barra de Progresso Neon */
        .progress-track { display: flex; justify-content: space-between; position: relative; margin-bottom: 60px; padding: 0 20px; }
        .progress-track::before { content: ''; position: absolute; top: 15px; left: 50px; right: 50px; height: 2px; background: #222; z-index: 1; }

        .step { position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; gap: 10px; }
        .circle { width: 30px; height: 30px; border-radius: 50%; background: #111; border: 2px solid #222; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; transition: 0.4s; }
        .step.active .circle { background: #0ff; border-color: #0ff; box-shadow: 0 0 15px #0ff; color: #000; }
        .step.active span { color: #0ff; font-weight: bold; }
        .step span { font-size: 0.8rem; color: #555; text-transform: uppercase; letter-spacing: 1px; }

        /* Resumo da Build */
        .build-summary { background: #111; border: 1px solid #0ff; border-radius: 15px; padding: 30px; text-align: left; box-shadow: 0 0 30px rgba(0, 255, 255, 0.05); position: relative; overflow: hidden; }
        .build-summary::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 5px; background: #0ff; }

        .summary-title { color: #0ff; font-size: 1.2rem; font-weight: bold; margin-bottom: 20px; text-transform: uppercase; }

        .item-row { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #222; font-size: 0.95rem; }
        .item-row:last-of-type { border-bottom: none; }
        .item-name { color: #ccc; }
        .item-price { color: #888; }

        .total-row { display: flex; justify-content: flex-end; align-items: center; margin-top: 25px; padding-top: 20px; border-top: 2px solid #222; gap: 20px; }
        .total-label { font-size: 1.1rem; color: #fff; font-weight: bold; text-transform: uppercase; }
        .total-value { font-size: 1.8rem; color: #0ff; font-weight: 800; text-shadow: 0 0 10px #0ff; }

        .btn-home { margin-top: 40px; display: inline-block; padding: 15px 40px; border: 1px solid #0ff; color: #0ff; text-decoration: none; border-radius: 5px; font-weight: bold; text-transform: uppercase; transition: 0.3s; }
        .btn-home:hover { background: #0ff; color: #000; box-shadow: 0 0 30px #0ff; }
    </style>
</head>
<body>

    <div class="success-container">
        <h1 class="title-neon">Pedido Realizado! 🚀</h1>
        <p class="order-number">Número do pedido: #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>

        <div class="progress-track">
            <div class="step active">
                <div class="circle">✓</div>
                <span>Recebido</span>
            </div>
            <div class="step active">
                <div class="circle">⌛</div>
                <span>Separação</span>
            </div>
            <div class="step">
                <div class="circle">🚛</div>
                <span>Transporte</span>
            </div>
            <div class="step">
                <div class="circle">🏠</div>
                <span>Entregue</span>
            </div>
        </div>

        <div class="build-summary">
            <p class="summary-title">Resumo da sua Build:</p>

            {{-- LOOP PARA EXIBIR ITENS REAIS DO PEDIDO --}}
            @foreach($order->items as $item)
                <div class="item-row">
                    <span class="item-name">
                        • {{ $item->product->name ?? 'Componente' }}
                        <strong style="color: #0ff; margin-left: 10px;">x{{ $item->quantity }}</strong>
                    </span>
                    <span class="item-price">R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</span>
                </div>
            @endforeach

            <div class="total-row">
                <span class="total-label">Total:</span>
                <span class="total-value">R$ {{ number_format($order->total_price, 2, ',', '.') }}</span>
            </div>
        </div>

        <a href="{{ url('/') }}" class="btn-home">Voltar para a Home</a>
    </div>

</body>
</html>
