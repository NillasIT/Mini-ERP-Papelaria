<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'nuit' => 'required|numeric|min:0',
            'email' => 'required|email|unique:fornecedores,email',
            'adress' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:fornecedores,phone',
            'obs' => 'required|string|max:500',
        ]);

        $fornecedor = Fornecedor::create($validated);
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor adicionado com sucesso!');
    }

    public function index()
    {
        $fornecedores = Fornecedor::all();
        return view('pages.fornecedor', compact('fornecedores'));
    }

    public function update(Request $request, Fornecedor $fornecedor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'nuit' => 'required|numeric|min:0',
            'email' => 'required|email|unique:fornecedores,email',
            'adress' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:fornecedores,phone',
            'obs' => 'required|string|max:500',
        ]);

        $fornecedor->update($validated);
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor excluído com sucesso!');
    }

    public function getFornecedores()
    {
        $fornecedores = Fornecedor::all();
        return response()->json($fornecedores);
    }
}
