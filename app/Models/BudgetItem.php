<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BudgetItem extends Model
{
    protected $fillable = [
        'budget_year_id',
        'type',
        'category',
        'description',
        'budget_amount',
        'realized_amount',
        'notes',
    ];

    public function budgetYear(): BelongsTo
    {
        return $this->belongsTo(BudgetYear::class);
    }

    public function getPercentageAttribute(): float
    {
        if ($this->budget_amount <= 0) {
            return 0;
        }

        return min(100, round(($this->realized_amount / $this->budget_amount) * 100, 1));
    }
}
