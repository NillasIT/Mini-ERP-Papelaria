<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ===============================
    // Login e Logout
    // ===============================

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('painel');
        }

        throw ValidationException::withMessages([
            'credentials' => '▪ Desculpe, as credenciais estão incorrectas'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }

    // ===============================
    // Painel e Páginas
    // ===============================

    public function painel()
    {
        return view('pages.painel');
    }

    public function funcionario()
    {
        return view('pages.funcionario');
    }

    public function inventario()
    {
        return view('pages.inventario');
    }

    public function profile()
    {
        return view('pages.profile');
    }

    // ===============================
    // Funcionários - Visualização e Registro
    // ===============================

    public function showFuncionario()
    {
        return view('auth.register');
    }

    public function addFuncionario(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string',
            'role' => 'required|string',
        ]);

        $user = User::create($validated);
        return redirect()->route('funcionario')->with('success', 'Funcionário registado com sucesso!');
    }

    public function getFuncionarios()
    {
        $funcionarios = User::all();
        return response()->json($funcionarios);
    }

    // ===============================
    // Funcionários - Edição
    // ===============================

    public function editFuncionario($id)
    {
        $funcionarios = User::findOrFail($id);
        return response()->json($funcionarios);
    }

    public function updateFuncionario(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string',
            'role' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $funcionario = User::findOrFail($id);
        $funcionario->update($validated);

        return response()->json(['message' => 'Funcionário atualizado com sucesso!']);
    }

    // ===============================
    // Funcionários - Exclusão
    // ===============================

    public function deleteFuncionario($id)
    {
        User::destroy($id);
        return response()->json(['mensagem' => 'Usuário excluido com sucesso']);
    }
}
