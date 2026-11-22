<?php

namespace App\Providers;

use App\Models\VillageProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale('id');

        View::composer('*', function ($view) {
            static $villageProfile = null;
            static $checked = false;

            if (! $checked) {
                $checked = true;
                try {
                    if (Schema::hasTable('village_profiles')) {
                        $villageProfile = VillageProfile::first();
                    }
                } catch (\Throwable $e) {
                    $villageProfile = null;
                }
            }

            $view->with('villageProfile', $villageProfile);
        });
    }
}
