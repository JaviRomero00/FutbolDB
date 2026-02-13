<footer class="site-footer">
    <div class="site-footer__inner">
        <section class="site-footer__block">
            <h3>{{ $footerSettings->site_name ?? 'FutbolDB' }}</h3>
            <p class="mb-1">Autor: {{ $footerSettings->owner_name ?? 'Javi' }}</p>
            @if(!empty($footerSettings->contact_email))
                <p class="mb-1">Email: <a href="mailto:{{ $footerSettings->contact_email }}">{{ $footerSettings->contact_email }}</a></p>
            @endif
            @if(!empty($footerSettings->contact_location))
                <p class="mb-0">Ubicación: {{ $footerSettings->contact_location }}</p>
            @endif
        </section>

        <section class="site-footer__block">
            <h3>Sobre la web</h3>
            <p class="mb-0">{{ $footerSettings->about_text ?? 'Proyecto académico.' }}</p>
        </section>

        <section class="site-footer__block">
            <h3>Legal</h3>
            <div class="site-footer__legal-list">
                @if(!empty($footerSettings->legal_url))
                    <a href="{{ $footerSettings->legal_url }}">Aviso legal</a>
                @else
                    <span>Aviso legal: {{ $footerSettings->legal_notice ?? '—' }}</span>
                @endif

                @if(!empty($footerSettings->privacy_url))
                    <a href="{{ $footerSettings->privacy_url }}">Privacidad</a>
                @else
                    <span>Privacidad: {{ $footerSettings->privacy_notice ?? '—' }}</span>
                @endif

                @if(!empty($footerSettings->cookies_url))
                    <a href="{{ $footerSettings->cookies_url }}">Cookies</a>
                @else
                    <span>Cookies: {{ $footerSettings->cookies_notice ?? '—' }}</span>
                @endif
            </div>
        </section>
    </div>

    @php
        $updatedAt = !empty($footerSettings->updated_at)
            ? \Carbon\Carbon::parse($footerSettings->updated_at)->format('d/m/Y H:i')
            : 'No disponible';
    @endphp
    <p class="site-footer__updated">Última actualización: {{ $updatedAt }}</p>
</footer>
