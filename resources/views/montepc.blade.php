<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monte seu PC - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        /* 1. Estilos Globais TechBuild */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: #050505;
            color: #fff;
            padding-top: 100px;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        /* Barra de Rolagem Neon */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #0ff; border-radius: 10px; box-shadow: 0 0 10px #0ff; }

        /* 2. Header Fixo */
        header {
            position: fixed; top: 0; left: 0; width: 100%; height: 80px;
            background: rgba(0, 0, 0, 0.95); border-bottom: 1px solid #0ff;
            z-index: 1000; display: flex; align-items: center; justify-content: space-between; padding: 0 50px;
        }
        .header-logo { height: 50px; width: auto; }
        .header-center { display: flex; gap: 30px; }
        .header-center a { color: #fff; text-decoration: none; font-size: 0.9rem; transition: 0.3s; font-weight: 500; }
        .header-center a:hover, .header-center a.active { color: #0ff; text-shadow: 0 0 8px #0ff; }

        .btn-perfil {
            background: #0ff; color: #000; padding: 8px 20px; border-radius: 4px;
            font-weight: bold; text-decoration: none; font-size: 0.8rem; text-transform: uppercase;
        }

        /* 3. Container do Builder */
        .builder-container { max-width: 1200px; margin: 0 auto; padding: 20px; }

        .filter-box {
            max-width: 500px; margin: 0 auto 50px; background: #0a0a0a;
            padding: 25px; border: 1px solid #0ff; border-radius: 12px;
        }

        .pc-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px; margin-bottom: 50px;
        }

        .category-card {
            background: #111; border: 1px solid #333; padding: 30px 20px;
            border-radius: 15px; text-align: center; transition: 0.3s;
        }
        .category-card:hover { border-color: #0ff; box-shadow: 0 0 20px rgba(0, 255, 255, 0.2); }
        .category-card h3 { color: #0ff; margin-bottom: 20px; text-transform: uppercase; font-size: 1rem; }

        select {
            width: 100%; padding: 12px; background: #000; color: #fff;
            border: 1px solid #444; border-radius: 6px; outline: none; cursor: pointer;
        }

        .btn-add-pc {
            background: #0ff; color: #000; border: none; padding: 20px 60px;
            border-radius: 50px; font-weight: bold; font-size: 1.1rem;
            cursor: pointer; transition: 0.4s; box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            text-transform: uppercase;
        }
        .btn-add-pc:hover { box-shadow: 0 0 40px #0ff; transform: scale(1.05); }
    </style>
</head>
<body>

    <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}?v=2" alt="Logo" class="header-logo">
        </div>
        <nav class="header-center">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('montepc') }}" class="active">Monte seu PC</a>
            <a href="{{ route('products.index') }}">Produtos</a>
            <a href="{{ route('carrinho') }}">Carrinho</a>
        </nav>
        <div class="header-right">
            @auth
                <span style="font-size: 0.85rem; margin-right: 10px;">Olá, <strong>{{ Auth::user()->name }}</strong></span>
                <a href="{{ route('perfil') }}" class="btn-perfil">Perfil</a>
            @else
                <a href="{{ route('login') }}" class="btn-perfil">Login</a>
            @endauth
        </div>
    </header>

    <main class="builder-container">
        <h1 style="text-align: center; font-size: 2.5rem; color: #0ff; text-shadow: 0 0 15px #0ff; margin-bottom: 10px;">🖥 Monte seu PC</h1>
        <p style="text-align: center; color: #888; margin-bottom: 40px;">Selecione as peças e monte a máquina dos seus sonhos.</p>

        <div class="filter-box">
            <form action="{{ route('montepc') }}" method="GET">
                <label style="display: block; margin-bottom: 10px; font-size: 0.85rem;">Orçamento Máximo por Peça:</label>
                <div style="display: flex; gap: 10px;">
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="R$"
                           style="flex: 1; padding: 12px; background: #000; border: 1px solid #333; color: #fff; border-radius: 6px;">
                    <button type="submit" class="btn-perfil">Filtrar</button>
                </div>
            </form>
        </div>

        <form action="{{ route('cart.addBulk') }}" method="POST">
            @csrf
            <div class="pc-grid">
                @php
                    $builderData = [
                        ['title' => 'Processador', 'data' => $cpus, 'placeholder' => 'Escolha a CPU'],
                        ['title' => 'Placa de Vídeo', 'data' => $gpus, 'placeholder' => 'Escolha a GPU'],
                        ['title' => 'Placa-Mãe', 'data' => $motherboards, 'placeholder' => 'Escolha a Placa-Mãe'],
                        ['title' => 'Memória RAM', 'data' => $rams, 'placeholder' => 'Escolha a RAM'],
                        ['title' => 'Armazenamento', 'data' => $discos, 'placeholder' => 'Escolha o Disco'],
                        ['title' => 'Fonte', 'data' => $psus, 'placeholder' => 'Escolha a Fonte'],
                        ['title' => 'Gabinete', 'data' => $cases, 'placeholder' => 'Escolha o Gabinete']
                    ];
                @endphp

                @foreach($builderData as $category)
                <div class="category-card">
                    <h3>{{ $category['title'] }}</h3>
                    <select name="products[]" required>
                        <option value="">{{ $category['placeholder'] }}</option>
                        @foreach($category['data'] as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }} - R$ {{ number_format($item->price, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endforeach
            </div>

            <div style="text-align: center; margin-bottom: 80px;">
                <button type="submit" class="btn-add-pc">🛒 Adicionar Setup ao Carrinho</button>
            </div>
        </form>
    </main>

</body>
</html>
