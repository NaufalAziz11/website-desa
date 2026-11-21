<?php

namespace App\Helpers;

class FormatHelper
{
    public static function rupiah(int|float $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    public static function shortRupiah(int|float $amount): string
    {
        if ($amount >= 1_000_000_000) {
            return 'Rp ' . number_format($amount / 1_000_000_000, 2, ',', '.') . ' M';
        }
        if ($amount >= 1_000_000) {
            return 'Rp ' . number_format($amount / 1_000_000, 1, ',', '.') . ' Jt';
        }

        return self::rupiah($amount);
    }
}
