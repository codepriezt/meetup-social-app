<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;

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
        Schema::defaultStringLength(191);
        Blade::component('component.input-error', 'inputError');
        Blade::component('component.alert', 'alert'); 
        Blade::component('component.header');

        Builder::macro('search', function ($attributes, string $searchTerms) {
            $this->where(function (Builder $query) use ($attributes, $searchTerms) {
                foreach (array_wrap($attributes) as $attributes) {
                    $query->orWhere(function ($query) use ($attributes, $searchTerms) {
                        foreach (explode('', $searchTerms) as $searchTerm) {
                            $query->where($attributes, 'LIKE', "%{$searchTerm}%");
                        }
                    });
                }
            });
        });
    }
}
