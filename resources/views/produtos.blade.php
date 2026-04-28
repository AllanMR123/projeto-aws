<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        /* 1. Estilos Globais */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: #050505; color: #fff; padding-top: 100px;
            font-family: 'Segoe UI', Tahoma, sans-serif; overflow-x: hidden;
        }

        /* 2. Header Responsivo */
        header {
            position: fixed; top: 0; left: 0; width: 100%; height: auto;
            min-height: 80px; background: rgba(0, 0, 0, 0.98); border-bottom: 1px solid #0ff;
            z-index: 1000; display: flex; align-items: center; justify-content: space-between;
            padding: 10px 50px; flex-wrap: wrap;
        }
        .header-logo { height: 45px; width: auto; }
        .header-center { display: flex; gap: 25px; }
        .header-center a { color: #fff; text-decoration: none; font-size: 0.9rem; transition: 0.3s; }
        .header-center a:hover, .header-center a.active { color: #0ff; text-shadow: 0 0 8px #0ff; }

        /* 3. Layout e Sidebar */
        .page-wrapper { display: flex; gap: 30px; max-width: 1400px; margin: 0 auto; padding: 20px 50px; }

        .sidebar {
            width: 250px; flex-shrink: 0; background: #111; padding: 20px;
            border: 1px solid #222; border-radius: 12px; position: sticky; top: 110px; height: fit-content;
        }
        .sidebar h3 { color: #0ff; margin-bottom: 15px; text-transform: uppercase; font-size: 0.8rem; }
        .sidebar ul { list-style: none; }
        .sidebar a { color: #ccc; text-decoration: none; display: block; padding: 8px 0; font-size: 0.85rem; transition: 0.2s; }
        .sidebar a:hover, .sidebar a.active { color: #0ff; font-weight: bold; }

        /* 4. Grid de Produtos */
        .main-content { flex: 1; min-width: 0; }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #111; border: 1px solid #222; padding: 20px; border-radius: 12px;
            text-align: center; transition: 0.3s; display: flex; flex-direction: column; justify-content: space-between;
        }
        .product-card:hover { border-color: #0ff; transform: translateY(-5px); box-shadow: 0 0 15px rgba(0, 255, 255, 0.1); }
        .product-card img { width: 100%; height: 160px; object-fit: contain; margin-bottom: 15px; border-radius: 8px; }

        .btn-add {
            background: #0ff; color: #000; border: none; padding: 12px; border-radius: 5px;
            font-weight: bold; cursor: pointer; width: 100%; text-transform: uppercase; font-size: 0.75rem;
            transition: 0.3s;
        }
        .btn-add:hover { background: #00cccc; box-shadow: 0 0 10px #0ff; }

        /* 5. Paginação Neon Estilizada (Versão Final) */
        .pagination-container {
            margin: 60px 0;
            display: flex;
            justify-content: center;
            width: 100%;
            padding: 0 15px;
        }

        /* Esconde textos informativos do Laravel */
        .pagination-container nav div:first-child { display: none !important; }
        .pagination-container nav svg { width: 20px; height: 20px; }

        .pagination-container .pagination {
            display: flex;
            list-style: none;
            gap: 6px;
            padding: 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-container .page-item .page-link {
            background: #111;
            border: 1px solid #333;
            color: #fff;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
            font-size: 0.85rem;
            font-weight: bold;
        }

        .pagination-container .page-item.active .page-link {
            border-color: #0ff;
            color: #0ff;
            background: rgba(0, 255, 255, 0.1);
            box-shadow: 0 0 12px rgba(0, 255, 255, 0.3);
        }

        .pagination-container .page-item.disabled .page-link {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .pagination-container .page-item .page-link:hover:not(.active):not(.disabled) {
            border-color: #0ff;
            color: #0ff;
        }

        /* Esconde setas de texto "Previous/Next" */
        .pagination-container nav span[aria-hidden="true"] { font-size: 1.2rem; }

        /* --- MEDIA QUERIES --- */
        @media (max-width: 992px) {
            header { padding: 15px 20px; justify-content: center; flex-direction: column; gap: 15px; }
            body { padding-top: 160px; }
            .page-wrapper { flex-direction: column; padding: 15px; gap: 20px; }

            .sidebar {
                width: 100%;
                position: relative;
                top: 0;
                overflow-x: auto;
                white-space: nowrap;
                padding: 15px;
            }
            .sidebar ul { display: flex; gap: 15px; }
            .sidebar li { display: inline-block; }
            .sidebar a { padding: 8px 15px; border: 1px solid #333; border-radius: 20px; background: #000; }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 15px;
            }

            .search-form { flex-direction: column; }
            .search-form button { width: 100% !important; }

            .pagination-container .page-item .page-link {
                width: 36px;
                height: 36px;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>

    <header>
        <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}?v=2" class="header-logo"></a>
        <nav class="header-center">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('montepc') }}">Monte seu PC</a>
            <a href="{{ route('products.index') }}" class="active">Produtos</a>
            <a href="{{ route('carrinho') }}">Carrinho</a>
        </nav>
    </header>

    <div class="page-wrapper">
        <aside class="sidebar">
            <h3>Categorias</h3>
            <ul>
                <li><a href="{{ route('products.index') }}" class="{{ !request('category') ? 'active' : '' }}">⚡ Todos</a></li>
                @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('products.index', ['category' => $cat]) }}"
                           class="{{ request('category') == $cat ? 'active' : '' }}">
                            {{ $cat }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <main class="main-content">
            <div style="margin-bottom: 25px;">
                <form action="{{ route('products.index') }}" method="GET" class="search-form" style="display: flex; gap: 8px;">
                    <input type="text" name="search" placeholder="Buscar entre 3.000+ itens..." value="{{ request('search') }}"
                           style="flex: 1; padding: 12px; background: #000; border: 1px solid #333; border-radius: 6px; color: #fff; outline: none;">
                    <button type="submit" class="btn-add" style="width: auto; padding: 0 30px;">Buscar</button>
                </form>
            </div>

            <div class="products-grid">
                @forelse($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('images/categorias/' . \Illuminate\Support\Str::slug($product->category) . '.png') }}"
                             onerror="this.src='https://placehold.jp/24/00f2ff/000000/200x200.png?text={{ str_replace(' ', '+', $product->category) }}'"
                             alt="{{ $product->name }}">

                        <h4 style="font-size: 0.85rem; margin: 10px 0; min-height: 40px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            {{ $product->name }}
                        </h4>

                        <div style="color: #0ff; font-weight: bold; font-size: 1.1rem; margin-bottom: 15px;">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </div>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-add">Adicionar</button>
                        </form>
                    </div>
                @empty
                    <p style="grid-column: 1/-1; text-align: center; color: #0ff; padding: 50px;">Nenhum item encontrado.</p>
                @endforelse
            </div>

            <div class="pagination-container">
                {{ $products->links() }}
            </div>
        </main>
    </div>
</body>
</html>
