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
        // Data atual
        $hoje = Carbon::today();

        // Obter as últimas 6 vendas
        $ultimasVendas = Venda::with(['produto', 'user']) // Carrega relacionamento do produto e do usuário
            ->latest('created_at') // Ordena pelas vendas mais recentes
            ->take(6) // Limita a 6 registros
            ->get();

        // Obter produtos com estoque baixo (menor ou igual a 5)
        $produtosEstoqueBaixo = Product::where('stock', '<=', 5)->get();

        // Obter o total de vendas por dia na última semana
        $vendasSemanais = Venda::select(
            DB::raw('DAYOFWEEK(created_at) as dia'),
            DB::raw('SUM(total) as total_vendas')
        )
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        // Formatar os dados para o gráfico
        $vendasPorDia = array_fill(1, 7, 0); // Inicializa os dias da semana com 0
        foreach ($vendasSemanais as $venda) {
            $vendasPorDia[$venda->dia] = $venda->total_vendas;
        }

        // Dados para passar à view
        $numeroDeVendas = Venda::whereDate('created_at', $hoje)->count();
        $totalDeVendas = Venda::whereDate('created_at', $hoje)->sum('total');
        $numeroDeFuncionarios = User::count();
        $produtosDisponiveis = Product::count();

        return view('pages.dashboard', [
            'numeroDeVendas' => $numeroDeVendas,
            'totalDeVendas' => $totalDeVendas,
            'numeroDeFuncionarios' => $numeroDeFuncionarios,
            'produtosDisponiveis' => $produtosDisponiveis,
            'ultimasVendas' => $ultimasVendas, // Passa as últimas vendas
            'produtosEstoqueBaixo' => $produtosEstoqueBaixo, // Passa os produtos com estoque baixo
            'vendasSemanais' => array_values($vendasPorDia) // Passa os valores das vendas semanais
        ]);
    }
}
