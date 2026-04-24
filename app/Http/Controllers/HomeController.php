<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Busca 4 produtos aleatórios para a vitrine da Home
        $featuredProducts = Product::inRandomOrder()->limit(4)->get();

        return view('home', compact('featuredProducts'));
    }
}
