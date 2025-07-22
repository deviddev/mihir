<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">

@guest
    <meta property="og:title" content="Mihir.hu - {{ $title ?? '' }}" />
    <meta property="og:description" content="Mihir.hu friss hírek, történések, események egy helyen" /" />
    <meta name="description" content="Mihir.hu friss hírek, történések, események egy helyen" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en" />
    <meta property="og:image" content="{{ asset('img/og_image.webp') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />

    <link rel="canonical" href="{{ url()->current() }}" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:creator" content="@nabilhassen08" />
    <meta name="twitter:title" content="Mihir.hu - {{ $title ?? '' }}" />
    <meta name="twitter:description" content="Mihir.hu friss hírek, történések, események egy helyen" />
    <meta name="twitter:image" content="{{ asset('img/og_image.webp') }}" />
@endguest

<title>{{ config('app.name') }} - {{ $title ?? '' }}</title>

<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

<link rel="preload" href="{{ asset('img/logo.png') }}" as="image" fetchpriority="high">

@laravelPWA

<script>
    function toggleDarkMode(params) {
        const isThemeDark = localStorage.getItem('themeMode') === 'dark' || (!('themeMode' in localStorage) && window
            .matchMedia('(prefers-color-scheme: dark)').matches);

        document.documentElement.classList.toggle('dark', isThemeDark);

        document
            .querySelector('meta[name="theme-color"]')
            .setAttribute(
                "content",
                isThemeDark ? 'black' : '#EF5A6F'
            );
    }

    toggleDarkMode();

    document.addEventListener('livewire:navigated', () => {
        toggleDarkMode();
    });
</script>

@livewireStyles

@vite('resources/css/app.css')

@production
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=GTM-MLPLQVRV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'GTM-MLPLQVRV');
    </script>
@endproduction
