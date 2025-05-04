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
        return view('pages.vendas', compact('produtos'));
    }

    public function getVendas()
    {
        $vendas = Venda::all();
        return response()->json($vendas);
    }

    public function store(Request $request) {
        $produto = Product::findOrFail($request->produto_id);
        $user = User::findOrFail($request->user_id);

        $quantidade = $request->quantidade;
        $preco_unitario = $produto->price;
        $total = $quantidade * $preco_unitario;

        Venda::create([
            'produto_id' => $produto->id,
            'user_id' => auth()->$user->id,
            'quantidade' => $quantidade,
            'preco_unitario' => $preco_unitario,
            'total' => $total,
        ]);

        $produto->stock -= $quantidade;
        $produto->save();
        return redirect()->route('vendas.index')->with('success', 'Venda realizada com sucesso!');
    }
}
