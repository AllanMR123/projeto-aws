<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Exibe a página principal do carrinho.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);

        return view('carrinho', compact('cart', 'total'));
    }

    /**
     * Adiciona um produto ao carrinho e redireciona para ele.
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "category" => $product->category
            ];
        }

        session()->put('cart', $cart);

        // AJUSTE AQUI: Em vez de usar o handleResponse (que volta),
        // redirecionamos direto para a rota do carrinho.
        if ($request->ajax()) {
            return $this->handleResponse($request, 'Produto adicionado!');
        }

        return redirect()->route('carrinho')->with('success', 'Produto adicionado ao seu carrinho!');
    }

    /**
     * Adiciona múltiplos produtos (Monte seu PC).
     */
    public function addBulk(Request $request)
    {
        $ids = $request->input('products', []);
        $cart = session()->get('cart', []);

        foreach ($ids as $id) {
            if (!$id) continue;
            $product = Product::find($id);
            if ($product) {
                if (isset($cart[$id])) {
                    $cart[$id]['quantity']++;
                } else {
                    $cart[$id] = [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "category" => $product->category
                    ];
                }
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('carrinho')->with('success', 'Setup adicionado ao carrinho!');
    }

    /**
     * Atualiza a quantidade (Suporta AJAX para o Side Cart).
     */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id]) && $request->quantity > 0) {
            $cart[$id]['quantity'] = (int) $request->quantity;
            session()->put('cart', $cart);

            return $this->handleResponse($request, 'Quantidade atualizada!');
        }

        return redirect()->back()->with('error', 'Quantidade inválida.');
    }

    /**
     * Remove um item (Suporta AJAX para o Side Cart).
     */
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return $this->handleResponse($request, 'Item removido.');
        }

        return redirect()->back();
    }

    /**
     * Limpa todo o carrinho.
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Carrinho esvaziado!');
    }

    /**
     * MÉTODO AUXILIAR: Centraliza a resposta para evitar repetição de código.
     */
    private function handleResponse(Request $request, $message)
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'cart' => $cart,
                'total' => number_format($total, 2, ',', '.'),
                'count' => count($cart)
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * MÉTODO AUXILIAR: Calcula o valor total do carrinho.
     */
    private function calculateTotal($cart)
    {
        return array_reduce($cart, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }
}
