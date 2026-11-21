<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BudgetItem;
use App\Models\BudgetYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BudgetController extends Controller
{
    public function index()
    {
        $years = BudgetYear::with('items')->orderByDesc('year')->get();

        return view('admin.budgets.index', compact('years'));
    }

    public function storeYear(Request $request)
    {
        $data = $request->validate([
            'year' => ['required', 'integer', 'min:2000', 'max:2100', 'unique:budget_years,year'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'document_pdf' => ['nullable', 'mimes:pdf', 'max:10240'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('document_pdf')) {
            $data['document_pdf'] = $request->file('document_pdf')->store('budgets', 'public');
        }

        $year = BudgetYear::create($data);

        return redirect()->route('admin.budgets.show', $year)->with('success', 'Tahun anggaran berhasil dibuat.');
    }

    public function showYear(BudgetYear $budgetYear)
    {
        $budgetYear->load('items');

        return view('admin.budgets.show', compact('budgetYear'));
    }

    public function updateYear(Request $request, BudgetYear $budgetYear)
    {
        $data = $request->validate([
            'year' => ['required', 'integer', 'min:2000', 'max:2100', 'unique:budget_years,year,' . $budgetYear->id],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'document_pdf' => ['nullable', 'mimes:pdf', 'max:10240'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('document_pdf')) {
            if ($budgetYear->document_pdf) {
                Storage::disk('public')->delete($budgetYear->document_pdf);
            }
            $data['document_pdf'] = $request->file('document_pdf')->store('budgets', 'public');
        }

        $budgetYear->update($data);

        return redirect()->route('admin.budgets.show', $budgetYear)->with('success', 'Tahun anggaran berhasil diperbarui.');
    }

    public function destroyYear(BudgetYear $budgetYear)
    {
        if ($budgetYear->document_pdf) {
            Storage::disk('public')->delete($budgetYear->document_pdf);
        }
        $budgetYear->delete();

        return redirect()->route('admin.budgets.index')->with('success', 'Tahun anggaran berhasil dihapus.');
    }

    public function storeItem(Request $request, BudgetYear $budgetYear)
    {
        $data = $this->validateItem($request);
        $budgetYear->items()->create($data);

        return redirect()->route('admin.budgets.show', $budgetYear)->with('success', 'Rincian anggaran berhasil ditambahkan.');
    }

    public function updateItem(Request $request, BudgetItem $budgetItem)
    {
        $data = $this->validateItem($request);
        $budgetItem->update($data);

        return redirect()->route('admin.budgets.show', $budgetItem->budget_year_id)->with('success', 'Rincian anggaran berhasil diperbarui.');
    }

    public function destroyItem(BudgetItem $budgetItem)
    {
        $yearId = $budgetItem->budget_year_id;
        $budgetItem->delete();

        return redirect()->route('admin.budgets.show', $yearId)->with('success', 'Rincian anggaran berhasil dihapus.');
    }

    private function validateItem(Request $request): array
    {
        return $request->validate([
            'type' => ['required', 'in:Pendapatan,Belanja,Pembiayaan'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'budget_amount' => ['required', 'integer', 'min:0'],
            'realized_amount' => ['required', 'integer', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
