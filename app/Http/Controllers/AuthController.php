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

    public function adminLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ], [
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um endereço de email válido',
            'password.required' => 'O campo password é obrigatório',
            'password.string' => 'O campo password deve ser uma string'
        ]);

        // Tenta autenticar com 'role' específico
        if (Auth::attempt(array_merge($validated, ['role' => 'Administrador']))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard'); // Redireciona para o painel
        }

        throw ValidationException::withMessages([
            'credentials' => '▪ Desculpe, as credenciais estão incorretas ou você não é um Administrador'
        ]);
    }

    public function funcionarioLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ], [
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um endereço de email válido',
            'password.required' => 'O campo password é obrigatório',
            'password.string' => 'O campo password deve ser uma string'
        ]);

        // Tenta autenticar com 'role' específico
        if (Auth::attempt(array_merge($validated, ['role' => 'Funcionario']))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard'); // Redireciona para o painel
        }

        throw ValidationException::withMessages([
            'credentials' => '▪ Desculpe, as credenciais estão incorretas ou você não é um Funcionário'
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user(); // Obtenha o usuário autenticado

        Auth::logout(); // Faça o logout do usuário
        $request->session()->invalidate(); // Invalida a sessão
        $request->session()->regenerateToken(); // Regenera o token CSRF

        // Fallback para evitar erros de rota
        return redirect()->route('admin.login')->with('success', 'Logout realizado com sucesso!');
    }

    // ===============================
    // Painel e Páginas
    // ===============================

    public function funcionario()
    {
        return view('pages.funcionario');
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
