<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
        ]);

        $product = Product::create($validated);
        return redirect()->route('produtos.index')->with('success', 'Producto adicionado com sucesso!');
    }

    public function index() {
        $products = Product::all();
        return view('pages.produtos', compact('products'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
        ]);

        $produto = Product::findOrFail($id);
        $produto->update($validated);

        return response()->json(
            ['message' => 'Funcionário atualizado com sucesso!']);
    }

    public function destroy($id) {
        Product::destroy($id);
        return response()->json(['mensagem' => 'Usuário excluido com sucesso']);
    }

    public function editProduct($id)
    {
        $produtos = Product::findOrFail($id);
        return response()->json($produtos);
    }

    public function getProducts() {
        $products = Product::all();
        return response()->json($products);
    }
}