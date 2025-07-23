<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="og:title" content="{{ config('app.name') }} - {{ $title ?? '' }}" />
<meta property="og:description" content="{{ __('misc.page_description') }}" />
<meta name="description" content="{{ __('misc.page_description') }}" />
<meta property="og:type" content="website" />
<meta property="og:locale" content="hu" />
<meta property="og:image" content="{{ asset('img/og_image.webp') }}" />
<meta property="og:url" content="{{ url()->current() }}" />

<link rel="canonical" href="{{ url()->current() }}" />

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator" content="@nabilhassen08" />
<meta name="twitter:title" content="{{ config('app.name') }} - {{ $title ?? '' }}" />
<meta name="twitter:description" content="{{ __('misc.page_description') }}" />
<meta name="twitter:image" content="{{ asset('img/og_image.webp') }}" />

<title>{{ config('app.name') }} - {{ $title ?? '' }}</title>

<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

<link rel="preload" href="{{ asset('img/logo.png') }}" as="image" fetchpriority="high">

@laravelPWA
<link rel="mask-icon" href="/favicon.png" color="#FFFFFF">

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
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GK93ZW79K1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GK93ZW79K1');
    </script>
@endproduction
