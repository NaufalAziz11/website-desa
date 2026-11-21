<?php

namespace App\Http\Controllers;

use App\Models\BudgetYear;
use App\Models\Official;
use App\Models\Post;
use App\Models\Potential;
use App\Models\VillageProfile;

class HomeController extends Controller
{
    public function index()
    {
        $profile = VillageProfile::first();
        $posts = Post::published()->latest('published_at')->take(3)->get();
        $potentials = Potential::orderByDesc('is_featured')->latest()->take(3)->get();
        $officials = Official::where('is_active', true)->orderBy('order')->take(4)->get();

        $latestBudgetYear = BudgetYear::where('is_active', true)
            ->with('items')
            ->orderByDesc('year')
            ->first();

        $budgetSummary = null;
        if ($latestBudgetYear) {
            $budgetSummary = [
                'year' => $latestBudgetYear->year,
                'title' => $latestBudgetYear->title,
                'pendapatan' => $latestBudgetYear->summaryByType('Pendapatan'),
                'belanja' => $latestBudgetYear->summaryByType('Belanja'),
                'pembiayaan' => $latestBudgetYear->summaryByType('Pembiayaan'),
            ];
        }

        return view('public.home', compact(
            'profile',
            'posts',
            'potentials',
            'officials',
            'budgetSummary'
        ));
    }
}
