<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Este namespace se aplica automáticamente a tus controladores.
     */
    public const HOME = '/menu';

    /**
     * Ruta de redirección basada en el rol del usuario.
     */
    public static function redirectByRole(): string
    {
        $user = auth()->user();

        return match ($user->rol) {
            'admin' => '/usuarios/crear',
            'cocinero' => '/pedidos',
            'mesero' => '/pedidos',
            default => '/menu',
        };
    }

    /**
     * Define las rutas de la aplicación.
     */
    public function boot(): void
    {
        parent::boot();

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
