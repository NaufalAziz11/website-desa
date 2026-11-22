<?php

namespace App\Http\Controllers;

use App\Models\BudgetYear;
use Illuminate\Http\Request;

class TransparencyController extends Controller
{
    public function index(Request $request)
    {
        $years = BudgetYear::where('is_active', true)->orderByDesc('year')->get();

        $selectedYearNumber = $request->query('tahun');
        $selectedYear = $selectedYearNumber
            ? $years->firstWhere('year', (int) $selectedYearNumber)
            : $years->first();

        $pendapatanItems = collect();
        $belanjaItems = collect();
        $pembiayaanItems = collect();
        $summary = null;
        $chartData = null;

        if ($selectedYear) {
            $selectedYear->load('items');
            $pendapatanItems = $selectedYear->items->where('type', 'Pendapatan');
            $belanjaItems = $selectedYear->items->where('type', 'Belanja');
            $pembiayaanItems = $selectedYear->items->where('type', 'Pembiayaan');

            $pendapatan = $selectedYear->summaryByType('Pendapatan');
            $belanja = $selectedYear->summaryByType('Belanja');
            $pembiayaan = $selectedYear->summaryByType('Pembiayaan');

            $summary = [
                'pendapatan' => $pendapatan,
                'belanja' => $belanja,
                'pembiayaan' => $pembiayaan,
                'silpa' => $pendapatan['realized'] - $belanja['realized'],
            ];

            $belanjaGrouped = $belanjaItems->groupBy('category');
            $pendapatanGrouped = $pendapatanItems->groupBy('category');

            $chartData = [
                'belanjaLabels' => $belanjaGrouped->keys()->values()->toArray(),
                'belanjaBudgets' => $belanjaGrouped->map(fn ($group) => $group->sum('budget_amount'))->values()->toArray(),
                'belanjaRealized' => $belanjaGrouped->map(fn ($group) => $group->sum('realized_amount'))->values()->toArray(),
                'pendapatanLabels' => $pendapatanGrouped->keys()->values()->toArray(),
                'pendapatanRealized' => $pendapatanGrouped->map(fn ($group) => $group->sum('realized_amount'))->values()->toArray(),
            ];
        }

        return view('public.transparency', compact(
            'years',
            'selectedYear',
            'pendapatanItems',
            'belanjaItems',
            'pembiayaanItems',
            'summary',
            'chartData'
        ));
    }
}
