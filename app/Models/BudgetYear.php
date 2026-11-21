<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BudgetYear extends Model
{
    protected $fillable = [
        'year',
        'title',
        'description',
        'document_pdf',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(BudgetItem::class);
    }

    public function summaryByType(string $type): array
    {
        $items = $this->items->where('type', $type);
        $budget = $items->sum('budget_amount');
        $realized = $items->sum('realized_amount');
        $percentage = $budget > 0 ? round(($realized / $budget) * 100, 1) : 0;

        return [
            'budget' => $budget,
            'realized' => $realized,
            'percentage' => $percentage,
        ];
    }
}
