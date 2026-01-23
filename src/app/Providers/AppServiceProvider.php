<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(function () {
            return Password::min(8) // Минимум 8 символов
                ->letters() // Хотябы одна буква
                ->numbers(); // Хотябы одна цифра
//                ->mixedCase() // Минимум одна заглавная и одна строчная
//                ->symbols() // Хотябы один спецсимвол
//                ->uncompromised() // Не был ли пароль скомпрометирован (замедляет валидацию, а именно - TTFB)
        });
    }
}
