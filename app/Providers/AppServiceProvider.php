<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            if (!Schema::hasTable('footer_settings')) {
                $view->with('footerSettings', $this->defaultFooterSettings());
                return;
            }

            $footer = DB::table('footer_settings')->orderByDesc('id')->first();
            $view->with('footerSettings', $footer ?: $this->defaultFooterSettings());
        });
    }

    private function defaultFooterSettings(): object
    {
        return (object) [
            'site_name' => 'FutbolDB',
            'owner_name' => 'Javi',
            'contact_email' => null,
            'contact_location' => null,
            'about_text' => 'Proyecto académico de DAW para consulta de ligas, equipos y jugadores.',
            'legal_notice' => 'Sitio web con fines educativos. No se garantiza la exactitud de la información.',
            'privacy_notice' => 'No se comparten datos personales con terceros. Uso educativo.',
            'cookies_notice' => 'Este sitio puede usar cookies técnicas necesarias para la sesión.',
            'legal_url' => null,
            'privacy_url' => null,
            'cookies_url' => null,
            'updated_at' => now(),
        ];
    }
}
