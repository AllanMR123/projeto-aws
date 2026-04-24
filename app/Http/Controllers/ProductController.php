<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Catálogo Geral de Produtos
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
                  ->orWhere('brand', 'like', '%' . $searchTerm . '%');
            });
        }

        if (!$request->filled('search') && !$request->filled('category')) {
            $query->inRandomOrder();
        }

        $products = $query->paginate(24)->withQueryString();
        return view('produtos', compact('products', 'categories'));
    }

    /**
     * Simulador Monte seu PC (AJUSTADO COM OS NOMES DO SEU BANCO)
     */
    public function builder(Request $request)
    {
        $maxPrice = $request->input('max_price');

        $getFiltered = function($category) use ($maxPrice) {
            $q = Product::where('category', $category);
            if ($maxPrice) {
                $q->where('price', '<=', $maxPrice);
            }
            return $q->orderBy('name', 'asc')->get();
        };

        // NOMES CORRIGIDOS BASEADOS NO SEU PRINT:
        $cpus = $getFiltered('CPU');
        $gpus = $getFiltered('VIDEO-CARD');
        $rams = $getFiltered('MEMORY');
        $hdssd = $getFiltered('INTERNAL-HARD-DRIVE');

        return view('montepc', compact('cpus', 'gpus', 'rams', 'hdssd'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('produtos.show', compact('product'));
    }
}
