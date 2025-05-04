<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Venda;
use App\Models\User;

class VendaController extends Controller
{
    public function index() {
        $produtos = Product::all();
        $vendas = Venda::with('produto', 'user')->get(); //carregar relações
        return view('pages.vendas', compact('produtos', 'vendas'));
    }

    public function getVendas()
    {
        $vendas = Venda::all();
        return response()->json($vendas);
    }

    public function store(Request $request)
    {
        $produto = Product::findOrFail($request->produto_id);

        // Validação de estoque
        if ($request->quantidade > $produto->stock) {
            return back()->with('error', 'Quantidade solicitada maior que o estoque disponível.');
        }

        $quantidade = $request->quantidade;
        $preco_unitario = $produto->price;
        $total = $quantidade * $preco_unitario;

        // Criar nova venda
        Venda::create([
            'produto_id' => $produto->id,
            'user_id' => auth()->user()->id, // Correção feita aqui
            'quantidade' => $quantidade,
            'preco_unitario' => $preco_unitario,
            'total' => $total,
        ]);

        // Atualizar estoque do produto
        $produto->stock -= $quantidade;
        $produto->save();

        return redirect()->route('vendas.index')->with('success', 'Venda realizada com sucesso!');
    }
}
