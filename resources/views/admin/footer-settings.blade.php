@extends('layouts.app')

@section('title', 'Configuración del footer | FutbolDB')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h1 class="page-title mb-0">Configuración del footer</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Volver al panel</a>
</div>

<div class="card app-card">
    <div class="card-body p-4 p-md-5">
        <form method="POST" action="{{ route('admin.footer.update') }}" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-12">
                <h2 class="section-title">Identidad</h2>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nombre del sitio</label>
                <input name="site_name" value="{{ old('site_name', $settings->site_name) }}" required class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Autor</label>
                <input name="owner_name" value="{{ old('owner_name', $settings->owner_name) }}" required class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Email de contacto</label>
                <input name="contact_email" value="{{ old('contact_email', $settings->contact_email) }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Ubicación</label>
                <input name="contact_location" value="{{ old('contact_location', $settings->contact_location) }}" class="form-control">
            </div>

            <div class="col-12 mt-2">
                <h2 class="section-title">Textos</h2>
            </div>

            <div class="col-12">
                <label class="form-label">Sobre la web</label>
                <textarea name="about_text" rows="3" class="form-control">{{ old('about_text', $settings->about_text) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Aviso legal (resumen)</label>
                <textarea name="legal_notice" rows="3" class="form-control">{{ old('legal_notice', $settings->legal_notice) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Privacidad (resumen)</label>
                <textarea name="privacy_notice" rows="3" class="form-control">{{ old('privacy_notice', $settings->privacy_notice) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Cookies (resumen)</label>
                <textarea name="cookies_notice" rows="3" class="form-control">{{ old('cookies_notice', $settings->cookies_notice) }}</textarea>
            </div>

            <div class="col-12 mt-2">
                <h2 class="section-title">Enlaces (opcionales)</h2>
            </div>

            <div class="col-12">
                <label class="form-label">URL aviso legal</label>
                <input name="legal_url" value="{{ old('legal_url', $settings->legal_url) }}" class="form-control">
            </div>

            <div class="col-12">
                <label class="form-label">URL privacidad</label>
                <input name="privacy_url" value="{{ old('privacy_url', $settings->privacy_url) }}" class="form-control">
            </div>

            <div class="col-12">
                <label class="form-label">URL cookies</label>
                <input name="cookies_url" value="{{ old('cookies_url', $settings->cookies_url) }}" class="form-control">
            </div>

            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
