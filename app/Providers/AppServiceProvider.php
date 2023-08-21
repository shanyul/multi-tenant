<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function ($query) {
            $tmp = str_replace('?', '"' . '%s' . '"', $query->sql);
            if (is_array($query->bindings) && count($query->bindings) > 0) {
                $tmp = vsprintf($tmp, $query->bindings);
            }
            $tmp = str_replace("\\", "", $tmp);
            Log::info('time: '.$query->time.'ms; '.$tmp."\n\n\t");
        });
    }
}
