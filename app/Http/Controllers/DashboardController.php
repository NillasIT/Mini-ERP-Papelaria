<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Venda;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $hoje = Carbon::today();
        $user = auth()->user(); // Usuário autenticado

        // Consulta base de vendas
        $queryVendas = Venda::query();

        // Se o usuário for Funcionário, filtrar por ele mesmo
        if ($user->role === 'Funcionário') {
            $queryVendas->where('user_id', $user->id);
        }

        // Últimas 6 vendas
        $ultimasVendas = (clone $queryVendas)
            ->with(['produto', 'user'])
            ->latest('created_at')
            ->take(6)
            ->get();

        // Vendas hoje
        $numeroDeVendas = (clone $queryVendas)
            ->whereDate('created_at', $hoje)
            ->count();

        $totalDeVendas = (clone $queryVendas)
            ->whereDate('created_at', $hoje)
            ->sum('total');

        // Vendas da semana para gráfico
        $vendasSemanais = (clone $queryVendas)
            ->select(
                DB::raw('DAYOFWEEK(created_at) as dia'),
                DB::raw('SUM(total) as total_vendas')
            )
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        $vendasPorDia = array_fill(1, 7, 0);
        foreach ($vendasSemanais as $venda) {
            $vendasPorDia[$venda->dia] = $venda->total_vendas;
        }

        // Dados adicionais (somente Admin vê)
        $produtosEstoqueBaixo = Product::where('stock', '<=', 5)->get();
          

        $numeroDeFuncionarios = $user->role === 'Administrador'
            ? User::count()
            : null;

        $produtosDisponiveis = Product::count();

        return view('pages.dashboard', [
            'numeroDeVendas' => $numeroDeVendas,
            'totalDeVendas' => $totalDeVendas,
            'numeroDeFuncionarios' => $numeroDeFuncionarios,
            'produtosDisponiveis' => $produtosDisponiveis,
            'ultimasVendas' => $ultimasVendas,
            'produtosEstoqueBaixo' => $produtosEstoqueBaixo,
            'vendasSemanais' => array_values($vendasPorDia),
            'userRole' => $user->role,
        ]);
    }
}
