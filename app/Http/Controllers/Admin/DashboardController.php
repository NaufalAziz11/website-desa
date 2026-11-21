<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BudgetYear;
use App\Models\Gallery;
use App\Models\Official;
use App\Models\Post;
use App\Models\Potential;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'potentials' => Potential::count(),
            'officials' => Official::where('is_active', true)->count(),
            'galleries' => Gallery::count(),
        ];

        $latestPosts = Post::latest()->take(5)->get();
        $activeBudget = BudgetYear::where('is_active', true)->with('items')->orderByDesc('year')->first();

        $budgetSummary = null;
        if ($activeBudget) {
            $budgetSummary = [
                'year' => $activeBudget->year,
                'pendapatan' => $activeBudget->summaryByType('Pendapatan'),
                'belanja' => $activeBudget->summaryByType('Belanja'),
            ];
        }

        return view('admin.dashboard', compact('stats', 'latestPosts', 'budgetSummary'));
    }
}
