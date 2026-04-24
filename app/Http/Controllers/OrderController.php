<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Exibe o histórico de pedidos no perfil do usuário.
     */
    public function perfil()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Carrega os pedidos com os itens (Eager Loading) para melhor performance
        $orders = $user->orders()->with('items.product')->latest()->get();

        return view('perfil', compact('orders'));
    }

    /**
     * Exibe a tela de finalização de compra (Checkout).
     */
    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrinho')->with('error', 'Seu carrinho está vazio.');
        }

        return view('checkout');
    }

    /**
     * Processa o carrinho e grava o pedido no banco de dados.
     */
    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('home');
        }

        // Cálculo do valor total do carrinho
        $total = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Uso de Transação: Ou grava tudo com sucesso, ou não grava nada.
        $order = DB::transaction(function () use ($request, $cart, $total) {

            // 1. Cria o registro do Pedido
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'payment_method' => $request->pay ?? 'pix',
                'status' => 'separacao'
            ]);

            // 2. Cria cada item vinculado ao pedido
            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $id,
                    'quantity'   => $details['quantity'],
                    'price'      => $details['price']
                ]);
            }

            return $order;
        });

        // Limpa o carrinho da sessão após o sucesso
        session()->forget('cart');

        return redirect()->route('sucesso', $order->id)->with('success', 'Pedido realizado com sucesso!');
    }

    /**
     * Exibe os detalhes de um pedido específico após a compra.
     */
    public function success($id)
    {
        // Garante que o usuário só veja pedidos que pertencem a ele
        $order = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('sucesso', compact('order'));
    }
}
