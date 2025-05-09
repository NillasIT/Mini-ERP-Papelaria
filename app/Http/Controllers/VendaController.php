<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Venda;

class VendaController extends Controller
{
    public function getVendas()
    {
        $user = auth()->user();

        $query = Venda::with(['produto:id,name', 'user:id,name'])
            ->select(['id', 'produto_id', 'user_id', 'quantidade', 'preco_unitario', 'total', 'data_venda']);

        // Se for funcionário, filtra pelas vendas do próprio usuário
        if ($user->role === 'Funcionário') {
            $query->where('user_id', $user->id);
        }

        $vendas = $query->get();

        return response()->json($vendas);
    }


    public function index()
    {
        $produtos = Product::all();
        $user = auth()->user();

        $query = Venda::with(['produto:id,name', 'user:id,name']);

        if ($user->role === 'Funcionário') {
            $query->where('user_id', $user->id);
        }

        $vendas = $query->get();

        return view('pages.vendas', compact('produtos', 'vendas'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'produto_id' => 'required|exists:products,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Product::findOrFail($validated['produto_id']);

        if ($validated['quantidade'] > $produto->stock) {
            return back()->withErrors(['quantidade' => 'Quantidade excede o estoque disponível.']);
        }

        // Criação da venda
        $venda = auth()->user()->vendas()->create([
            'produto_id' => $produto->id,
            'quantidade' => $validated['quantidade'],
            'preco_unitario' => $produto->price,
            'total' => $produto->price * $validated['quantidade'],
        ]);

        // Atualizar estoque do produto
        $produto->decrement('stock', $validated['quantidade']);

        return redirect()->route('vendas.index')->with('success', 'Venda registrada com sucesso!');
    }
}
