<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MontePcController extends Controller
{
    public function index(Request $request)
    {
        // 1. Pega o valor do filtro de preço enviado pelo formulário
        $maxPrice = $request->query('max_price');

        // 2. Cria a base da consulta
        $query = Product::select('id', 'name', 'price', 'category')->orderBy('name');

        // 3. Aplica o filtro de preço se o usuário digitou algum valor
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        // 4. Busca as categorias usando os nomes reais do seu banco
        $cpus         = (clone $query)->where('category', 'Processadores')->get();
        $gpus         = (clone $query)->where('category', 'Placas de Vídeo')->get();
        $motherboards = (clone $query)->where('category', 'Placas-Mãe')->get();
        $rams         = (clone $query)->where('category', 'Memória RAM')->get();
        $discos       = (clone $query)->where('category', 'Armazenamento')->get();
        $psus         = (clone $query)->where('category', 'Fontes')->get();
        $cases        = (clone $query)->where('category', 'Gabinetes')->get();

        // 5. Dados de status para a barra superior
        $debugInfo = [
            'total_produtos' => Product::count(),
            'itens_filtrados' => $cpus->count() + $gpus->count() + $motherboards->count() + $rams->count() + $discos->count() + $psus->count() + $cases->count(),
        ];

        return view('montepc', compact(
            'cpus', 'gpus', 'motherboards', 'rams', 'discos', 'psus', 'cases', 'debugInfo'
        ));
    }
}
