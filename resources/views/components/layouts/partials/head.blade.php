<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="theme-color" />

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

<link rel="preload" href="{{ asset('img/logo.png') }}" as="image" fetchpriority="high">

@if (request()->routeIs('home'))
    <link rel="preload" href="{{ asset('img/light_screenshot.webp') }}" as="image" fetchpriority="high">

    <link rel="preload" href="{{ asset('img/dark_screenshot.webp') }}" as="image" fetchpriority="high">
@endif

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
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })
        (window, document, 'script', 'dataLayer', 'GTM-MLPLQVRV');
    </script>
    <!-- End Google Tag Manager -->
@endproduction
