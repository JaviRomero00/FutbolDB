<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterSettingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('footer_settings')->updateOrInsert(
            ['id' => 1],
            [
                'site_name' => 'FutbolDB',
                'owner_name' => 'Javi',
                'contact_email' => 'javi@futboldb.com',
                'contact_location' => 'España',
                'about_text' => 'Proyecto académico de DAW para consulta de ligas, equipos y jugadores.',
                'legal_notice' => 'Sitio web con fines educativos. No se garantiza la exactitud de la información.',
                'privacy_notice' => 'No se comparten datos personales con terceros. Uso educativo.',
                'cookies_notice' => 'Este sitio puede usar cookies técnicas necesarias para la sesión.',
                'legal_url' => null,
                'privacy_url' => null,
                'cookies_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
