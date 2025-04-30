<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password'=> 'required|string'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('painel');
        }

        throw ValidationException::withMessages([
            'credentials' => '▪ Desculpe, as credenciais estão incorrectas'
        ]);
    }

    public function painel () {
        return view('pages.painel');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function employeeRegister(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

        ]);
    }
}
