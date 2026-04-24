<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MontePcController extends Controller
{
    public function index(Request $request)
    {
        $maxPrice = $request->query('max_price');

        // 1. Criamos a base da consulta
        $query = DB::table('products')
            ->select('id', 'name', 'price', 'category')
            ->orderBy('name');

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        // 2. Buscamos cada categoria separadamente (Muito mais leve para a memória)
        // O clone() serve para não "sujar" a query principal
        $data = [
            'cpus'         => (clone $query)->where('category', 'CPU')->get(),
            'gpus'         => (clone $query)->where('category', 'VIDEO-CARD')->get(),
            'rams'         => (clone $query)->where('category', 'MEMORY')->get(),
            'discos'       => (clone $query)->where('category', 'INTERNAL-HARD-DRIVE')->get(),
            'motherboards' => (clone $query)->where('category', 'MOTHERBOARD')->get(),
            'psus'         => (clone $query)->where('category', 'POWER-SUPPLY')->get(),
            'cases'        => (clone $query)->where('category', 'CASE')->get(),
        ];

        return view('montepc', $data);
    }
}
