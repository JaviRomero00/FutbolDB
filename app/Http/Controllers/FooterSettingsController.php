<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FooterSettingsController extends Controller
{
    public function edit()
    {
        $settings = DB::table('footer_settings')->orderByDesc('id')->first();

        if (!$settings) {
            DB::table('footer_settings')->insert($this->defaultSettings());
            $settings = DB::table('footer_settings')->orderByDesc('id')->first();
        }

        return view('admin.footer-settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'owner_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_location' => ['nullable', 'string', 'max:255'],
            'about_text' => ['nullable', 'string'],
            'legal_notice' => ['nullable', 'string'],
            'privacy_notice' => ['nullable', 'string'],
            'cookies_notice' => ['nullable', 'string'],
            'legal_url' => ['nullable', 'url', 'max:255'],
            'privacy_url' => ['nullable', 'url', 'max:255'],
            'cookies_url' => ['nullable', 'url', 'max:255'],
        ]);

        $settings = DB::table('footer_settings')->orderByDesc('id')->first();

        if (!$settings) {
            DB::table('footer_settings')->insert(array_merge($this->defaultSettings(), $data, [
                'updated_at' => now(),
            ]));
        } else {
            DB::table('footer_settings')->where('id', $settings->id)->update(array_merge($data, [
                'updated_at' => now(),
            ]));
        }

        return redirect()->back()->with('success', 'Pie de página actualizado.');
    }

    private function defaultSettings(): array
    {
        return [
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
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
