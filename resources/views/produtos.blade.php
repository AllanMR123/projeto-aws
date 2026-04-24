<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - TechBuild</title>
    @vite(['resources/css/style.css'])
    <style>
        /* 1. Reset e Estilos Globais Padronizados */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background-color: #050505;
            color: #fff;
            padding-top: 100px;
            font-family: 'Segoe UI', sans-serif;
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

        .header-center {
            display: flex;
            gap: 30px;
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
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Botão de Perfil Padronizado (Ciano) */
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

        #cart-count-badge {
            background: #0ff;
            color: #000;
            padding: 2px 7px;
            border-radius: 50%;
            font-size: 10px;
            font-weight: bold;
            margin-left: 5px;
        }

        /* 3. Layout de Colunas */
        .page-wrapper {
            display: flex;
            gap: 30px;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 50px 50px;
            align-items: flex-start;
        }

        .sidebar {
            width: 280px;
            flex-shrink: 0;
            background: rgba(15, 15, 15, 0.95);
            padding: 20px;
            border: 1px solid #0ff;
            border-radius: 12px;
            position: sticky;
            top: 100px;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
        }

        .sidebar h3 {
            color: #0ff;
            margin-bottom: 15px;
            text-transform: uppercase;
            font-size: 0.8rem;
            border-bottom: 1px solid #333;
            padding-bottom: 5px;
            letter-spacing: 1px;
        }

        .sidebar a {
            color: #ccc;
            text-decoration: none;
            display: block;
            padding: 8px 0;
            font-size: 0.85rem;
            transition: 0.2s;
        }

        .sidebar a:hover, .sidebar a.active {
            color: #0ff;
            transform: translateX(5px);
        }

        .main-content {
            flex: 1;
            min-width: 0;
        }

        /* 4. Grid de Produtos */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #111;
            border: 1px solid #222;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-card:hover {
            border-color: #0ff;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.1);
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%; height: 160px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .product-card h4 { font-size: 0.85rem; height: 40px; overflow: hidden; color: #eee; margin-bottom: 10px; }

        /* 5. Side Cart (Mini Carrinho) */
        #side-cart {
            position: fixed;
            top: 0; right: -420px;
            width: 380px; height: 100%;
            background: #0a0a0a;
            border-left: 2px solid #0ff;
            z-index: 2001;
            transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: -10px 0 30px rgba(0, 255, 255, 0.2);
            padding: 25px;
            display: flex;
            flex-direction: column;
        }

        #cart-item-preview { margin-top: 20px; flex-grow: 1; overflow-y: auto; padding-right: 10px; }

        .mini-cart-item { padding: 15px 0; border-bottom: 1px solid #222; text-align: left; }
        .mini-cart-item p { font-size: 0.8rem; color: #eee; font-weight: bold; margin-bottom: 8px; }

        .mini-qty-input {
            width: 45px; background: #000; border: 1px solid #333; color: #0ff; text-align: center; border-radius: 4px;
        }

        #cart-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 2000;
            display: none;
            backdrop-filter: blur(4px);
        }

        #backToTop {
            position: fixed;
            bottom: 30px; right: 30px;
            display: none;
            background: #0ff;
            color: #000;
            border: none;
            padding: 15px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 999;
        }
    </style>
</head>
<body>

    @php
        $traducoes = [
            'CASE' => 'Gabinetes', 'CPU' => 'Processadores', 'MEMORY' => 'Memória RAM',
            'MOTHERBOARD' => 'Placas-Mãe', 'VIDEO-CARD' => 'Placas de Vídeo',
            'POWER-SUPPLY' => 'Fontes', 'MONITOR' => 'Monitores', 'INTERNAL-HARD-DRIVE' => 'SSD / HD',
            'MOUSE' => 'Mouses', 'KEYBOARD' => 'Teclados', 'HEADPHONES' => 'Headsets'
        ];

        $categoriesSorted = collect($categories)->map(function($cat) use ($traducoes) {
            $chave = strtoupper(str_replace('-', ' ', $cat));
            return (object) [
                'slug' => $cat,
                'nome' => $traducoes[$chave] ?? ucwords(strtolower($chave))
            ];
        })->sortBy('nome');
    @endphp

    <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}?v=2" alt="Logo">
        </div>
        <nav class="header-center">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('montepc') }}">Monte seu PC</a>
            <a href="{{ route('products.index') }}" class="active">Produtos</a>
            <a href="{{ route('carrinho') }}">
                Carrinho <span id="cart-count-badge">{{ count(session('cart', [])) }}</span>
            </a>
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

    <div class="page-wrapper">
        <aside class="sidebar">
            <h3>Categorias</h3>
            <ul>
                <li><a href="{{ route('products.index') }}" class="{{ !request('category') ? 'active' : '' }}">⚡ Todos</a></li>
                @foreach($categoriesSorted as $cat)
                    <li>
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                           class="{{ request('category') == $cat->slug ? 'active' : '' }}">
                            {{ $cat->nome }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <main class="main-content">
            <div style="margin-bottom: 30px;">
                <form action="{{ route('products.index') }}" method="GET" style="display: flex; gap: 10px;">
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    <input type="text" name="search" placeholder="Buscar hardware..." value="{{ request('search') }}"
                           style="flex: 1; padding: 12px; background: #000; border: 1px solid #0ff; border-radius: 6px; color: #fff; outline: none;">
                    <button type="submit" class="btn-perfil">Buscar</button>
                </form>
            </div>

            <div class="products-grid">
                @forelse($products as $product)
                    @php $catSlug = strtolower(str_replace(' ', '-', $product->category)); @endphp
                    <div class="product-card">
                        <div>
                            <img src="{{ asset('images/categorias/' . $catSlug . '.png') }}"
                                 onerror="this.src='https://placehold.jp/24/00f2ff/000000/200x200.png?text={{ $product->category }}'">
                            <h4>{{ $product->name }}</h4>
                        </div>
                        <div>
                            <div style="color: #0ff; font-weight: bold; margin-bottom: 10px;">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <button type="submit" class="btn-perfil" style="width: 100%; font-size: 0.75rem;">Adicionar</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="grid-column: 1/-1; text-align: center; color: #0ff; padding: 50px;">Nenhum item encontrado.</p>
                @endforelse
            </div>

            <div style="margin-top: 50px; display: flex; justify-content: center;">
                {{ $products->links() }}
            </div>
        </main>
    </div>

    <div id="side-cart">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; padding-bottom: 15px;">
            <h2 style="color: #0ff; font-size: 1rem;">🛒 MEU CARRINHO</h2>
            <button onclick="closeCart()" style="background: none; border: none; color: #fff; font-size: 1.8rem; cursor: pointer;">&times;</button>
        </div>
        <div id="cart-item-preview"></div>
        <div style="margin-top: auto; padding-top: 15px; border-top: 2px solid #333;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <span style="color: #888;">Total:</span>
                <span id="mini-cart-total" style="color: #0ff; font-weight: bold; font-size: 1.2rem;">R$ 0,00</span>
            </div>
            <a href="{{ route('carrinho') }}" class="btn-perfil" style="display: block; text-align: center;">Finalizar Compra</a>
        </div>
    </div>

    <div id="cart-overlay" onclick="closeCart()"></div>
    <button id="backToTop" onclick="window.scrollTo(0,0)">↑</button>

    <script>
        function refreshSideCart(data) {
            const container = document.getElementById('cart-item-preview');
            const totalElement = document.getElementById('mini-cart-total');
            const badge = document.getElementById('cart-count-badge');
            container.innerHTML = '';

            Object.keys(data.cart).forEach(id => {
                const item = data.cart[id];
                container.innerHTML += `
                    <div class="mini-cart-item">
                        <p>${item.name}</p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #0ff; font-size: 0.9rem;">R$ ${parseFloat(item.price).toLocaleString('pt-BR', {minimumFractionDigits: 2})}</span>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <input type="number" value="${item.quantity}" min="1" onchange="updateMiniQty('${id}', this.value)" class="mini-qty-input">
                                <button onclick="removeMiniItem('${id}')" style="background:none; border:none; color:#ff4444; cursor:pointer; font-size:0.7rem;">Remover</button>
                            </div>
                        </div>
                    </div>
                `;
            });
            totalElement.innerText = `R$ ${data.total}`;
            if(badge) badge.innerText = data.count;
        }

        function sendCartAction(url, method, bodyData) {
            const formData = new FormData();
            Object.keys(bodyData).forEach(key => formData.append(key, bodyData[key]));
            formData.append('_token', '{{ csrf_token() }}');
            if(method !== 'POST') formData.append('_method', method);

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => refreshSideCart(data));
        }

        function updateMiniQty(id, qty) { sendCartAction(`/carrinho/update/${id}`, 'PATCH', { quantity: qty }); }
        function removeMiniItem(id) { if(confirm('Remover?')) sendCartAction(`/carrinho/remove/${id}`, 'DELETE', {}); }

        function openCart(data) {
            refreshSideCart(data);
            document.getElementById('side-cart').style.right = '0';
            document.getElementById('cart-overlay').style.display = 'block';
        }

        function closeCart() {
            document.getElementById('side-cart').style.right = '-420px';
            document.getElementById('cart-overlay').style.display = 'none';
        }

        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.json())
                .then(data => openCart(data));
            });
        });

        window.onscroll = function() {
            document.getElementById("backToTop").style.display = (document.documentElement.scrollTop > 500) ? "block" : "none";
        };
    </script>
</body>
</html>
