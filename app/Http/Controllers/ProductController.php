<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Catálogo Geral com Busca e Paginação
     */
    public function index(Request $request)
    {
        $query = Product::query();
        $categories = Product::distinct()->orderBy('category', 'asc')->pluck('category');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('category', 'like', '%' . $searchTerm . '%');
            });
        }

        if (!$request->filled('search') && !$request->filled('category')) {
            $query->inRandomOrder();
        }

        $products = $query->paginate(24)->onEachSide(1)->withQueryString();
        return view('produtos', compact('products', 'categories'));
    }

    /**
     * Lógica do Monte seu PC (Builder)
     */
    public function builder(Request $request)
{
    $maxPrice = $request->filled('max_price') ? $request->input('max_price') : null;

    // Criamos uma função de busca "solta" para ignorar erros de digitação e espaços
    $getFiltered = function($name) use ($maxPrice) {
        $query = Product::where('category', 'LIKE', '%' . trim($name) . '%');

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query->orderBy('name', 'asc')->get();
    };

    // Buscando com os nomes em minúsculas conforme você confirmou
    $cpus         = $getFiltered('processadores');
    $gpus         = $getFiltered('placas de vídeo');
    $motherboards = $getFiltered('placas-mãe');
    $rams         = $getFiltered('memória ram');
    $discos       = $getFiltered('armazenamento');
    $psus         = $getFiltered('fontes');
    $cases        = $getFiltered('gabinetes');

    // Variável de Debug para vermos na tela o que está acontecendo
    $debugInfo = [
        'total_no_banco' => Product::count(),
        'cpus_encontradas' => $cpus->count(),
    ];

    return view('montepc', compact(
        'cpus', 'gpus', 'motherboards', 'rams', 'discos', 'psus', 'cases', 'debugInfo'
    ));
}

    }

