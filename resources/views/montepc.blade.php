<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monte seu PC - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: #050505; color: #fff; padding-top: 100px;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        /* HEADER RESPONSIVO */
        header {
            position: fixed; top: 0; left: 0; width: 100%; height: auto;
            min-height: 80px; background: rgba(0, 0, 0, 0.98);
            border-bottom: 1px solid #0ff; z-index: 1000;
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 50px; flex-wrap: wrap;
        }
        .header-logo { height: 45px; width: auto; }
        .header-center { display: flex; gap: 30px; }
        .header-center a { color: #fff; text-decoration: none; font-size: 0.9rem; transition: 0.3s; }
        .header-center a:hover, .header-center a.active { color: #0ff; text-shadow: 0 0 8px #0ff; }

        .builder-container { max-width: 1200px; margin: 0 auto; padding: 20px; }

        /* SEÇÃO DE FILTRO RESPONSIVA */
        .filter-section {
            max-width: 600px; margin: 0 auto 30px; background: #111;
            padding: 15px; border-radius: 10px; border: 1px solid #222;
        }
        .filter-form { display: flex; gap: 10px; }
        .filter-input {
            flex: 1; padding: 10px; background: #000; border: 1px solid #333;
            color: #fff; border-radius: 6px; outline: none;
        }
        .filter-btn {
            background: transparent; color: #0ff; border: 1px solid #0ff;
            padding: 0 20px; border-radius: 6px; cursor: pointer; transition: 0.3s;
        }
        .filter-btn:hover { background: #0ff; color: #000; }

        /* GRID DE COMPONENTES */
        .pc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px; margin-bottom: 50px;
        }

        .category-card {
            background: #111; border: 1px solid #333; padding: 25px;
            border-radius: 12px; text-align: center; transition: 0.3s;
        }
        .category-card:hover { border-color: #0ff; box-shadow: 0 0 15px rgba(0, 255, 255, 0.1); }
        .category-card h3 { color: #0ff; margin-bottom: 5px; font-size: 1rem; text-transform: uppercase; }

        .item-count { font-size: 0.75rem; color: #666; margin-bottom: 15px; display: block; }

        select {
            width: 100%; padding: 12px; background: #000; color: #fff;
            border: 1px solid #444; border-radius: 6px; outline: none; cursor: pointer;
        }

        .btn-add-pc {
            background: #0ff; color: #000; border: none; padding: 15px 40px;
            border-radius: 50px; font-weight: bold; font-size: 1rem;
            cursor: pointer; transition: 0.4s; text-transform: uppercase;
            width: auto; max-width: 100%;
        }

        /* --- MEDIA QUERIES (REGRAS PARA CELULAR) --- */
        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
                justify-content: center;
                flex-direction: column;
                gap: 15px;
            }
            .header-center {
                gap: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }
            body { padding-top: 160px; } /* Aumenta o espaço por causa do header maior */

            .filter-form {
                flex-direction: column;
            }
            .filter-btn {
                padding: 12px;
            }
            .pc-grid {
                grid-template-columns: 1fr; /* Um card por linha no celular */
            }
            .btn-add-pc {
                width: 90%; /* Botão quase largura total no celular */
            }
        }
    </style>
</head>
<body>

    <header>
        <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" class="header-logo"></a>
        <nav class="header-center">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('montepc') }}" class="active">Monte seu PC</a>
            <a href="{{ route('products.index') }}">Produtos</a>
            <a href="{{ route('carrinho') }}">Carrinho</a>
        </nav>
    </header>

    <main class="builder-container">
        <h1 style="text-align: center; color: #0ff; margin-bottom: 20px;">🖥 Monte seu Setup</h1>

        <div class="filter-section">
            <form action="{{ route('montepc') }}" method="GET" class="filter-form">
                <input type="number" name="max_price" class="filter-input"
                       placeholder="Preço máximo (R$)"
                       value="{{ request('max_price') }}">
                <button type="submit" class="filter-btn">Filtrar</button>
                @if(request('max_price'))
                    <a href="{{ route('montepc') }}" style="color: #666; text-decoration: none; align-self: center; font-size: 0.8rem;">Limpar</a>
                @endif
            </form>
        </div>

        <form action="{{ route('cart.addBulk') }}" method="POST">
            @csrf
            <div class="pc-grid">
                @php
                    $builderData = [
                        ['title' => 'Processador',   'data' => $cpus,         'ph' => 'Selecione a CPU'],
                        ['title' => 'Placa de Vídeo', 'data' => $gpus,         'ph' => 'Selecione a GPU'],
                        ['title' => 'Placa-Mãe',      'data' => $motherboards, 'ph' => 'Selecione a Placa-Mãe'],
                        ['title' => 'Memória RAM',    'data' => $rams,         'ph' => 'Selecione a RAM'],
                        ['title' => 'Armazenamento',  'data' => $discos,       'ph' => 'Selecione o Disco'],
                        ['title' => 'Fonte',          'data' => $psus,         'ph' => 'Selecione a Fonte'],
                        ['title' => 'Gabinete',       'data' => $cases,        'ph' => 'Selecione o Gabinete']
                    ];
                @endphp

                @foreach($builderData as $cat)
                <div class="category-card">
                    <h3>{{ $cat['title'] }}</h3>
                    <span class="item-count">{{ $cat['data']->count() }} itens disponíveis</span>

                    <select name="products[]" required>
                        <option value="">{{ $cat['ph'] }}</option>
                        @foreach($cat['data'] as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }} - R$ {{ number_format($item->price, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endforeach
            </div>

            <div style="text-align: center; margin-bottom: 80px;">
                <button type="submit" class="btn-add-pc">🛒 Adicionar ao Carrinho</button>
            </div>
        </form>
    </main>

</body>
</html>
