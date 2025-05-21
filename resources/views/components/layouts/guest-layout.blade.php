<!DOCTYPE html>
<html lang="en-US" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- SEO  -->
        <title>{{ $title ?? "" }} | Layanan Rental Mobil Terbaik</title>

        <meta name="description"
            content="{{ $shop->name ?? "" }}  Mobil menyediakan layanan sewa mobil terbaik dengan berbagai pilihan kendaraan. Nikmati perjalanan Anda bersama kami di Jambi.">
        <meta name="keywords"
            content="{{ $shop->name ?? "" }}  Mobil, sewa mobil, layanan rental, sewa mobil Jambi, perjalanan, rental mobil terbaik">
        <meta name="author" content="{{ $shop->name ?? "" }}  Mobil">
        <meta property="og:title" content="{{ $shop->name ?? "" }}  Mobil - Layanan Sewa Mobil Terbaik di Jambi">
        <meta property="og:description"
            content="Pilih dari berbagai kendaraan dan nikmati pengalaman rental yang mudah dengan {{ $shop->name ?? "" }}  Mobil di Jambi.">
        <meta property="og:image" content="{{ asset("/front-end/assets/img/favicons/aquina-logo-150x150.jpg") }}">
        <meta property="og:url" content="https://www.aquina-rental-mobil.my.id">
        <meta property="og:type" content="website">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $shop->name ?? "" }}  Mobil - Layanan Sewa Mobil Terbaik di Jambi">
        <meta name="twitter:description"
            content="Pilih dari berbagai kendaraan dan nikmati pengalaman rental yang mudah dengan {{ $shop->name ?? "" }}  Mobil di Jambi.">
        <meta name="twitter:image" content="{{ asset("/front-end/assets/img/favicons/aquina-logo-150x150.jpg") }}">
        <link rel="canonical" href="https://www.aquina-rental-mobil.my.id">

        <!-- Google  -->
        <meta name="google-site-verification" content="YHJ5TZaVWyTVFx_I13N3G22U8AeRQgStUbawuUd5JBs" />
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
            })(window, document, 'script', 'dataLayer', 'GTM-5ZQFHPFT');
        </script>
        <!-- End Google Tag Manager -->

        <!-- PWA  -->
        <meta name="theme-color" content="#ffffff">

        <meta name="msapplication-TileImage"
            content="{{ asset("/front-end/assets/img/favicons/aquina-logo-150x150.jpg") }}">
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset("/front-end/assets/img/favicons/aquina-apple-icon.jpg") }}">
        <link rel="icon" type="image/png" sizes="32x32"
            href="{{ asset("/front-end/assets/img/favicons/aquina-logo-32x32.jpg") }}">
        <link rel="icon" type="image/png" sizes="16x16"
            href="{{ asset("/front-end/assets/img/favicons/aquina-logo-16x16.jpg") }}">
        <link rel="shortcut icon" type="image/x-icon"
            href="{{ asset("/front-end/assets/img/favicons/aquina-logo.ico") }}">

        <link rel="manifest" href="{{ asset("/manifest.json") }}">

        <link href="{{ asset("/front-end/assets/css/theme.min.css") }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <script src="https://kit.fontawesome.com/21fb7efcbe.js" crossorigin="anonymous"></script>

        @vite([])

        @livewireStyles

        @stack("css")

        <style>
            .form-control {
                border-radius: 10px;
            }

            .btn {
                border-radius: 10px;
            }
        </style>
    </head>

    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5ZQFHPFT" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        @include("layouts.loading")

        <main class="main" id="top">

            @include("components.navigations.guest-nav")

            <section class="container">
                {{ $slot }}
            </section>

            <script src="{{ asset("/front-end/vendors/@popperjs/popper.min.js") }}"></script>
            <script src="{{ asset("/front-end/vendors/bootstrap/bootstrap.min.js") }}"></script>
            <script src="{{ asset("/front-end/vendors/is/is.min.js") }}"></script>
            <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
            <script src="{{ asset("/front-end/vendors/fontawesome/all.min.js") }}"></script>
            <script src="{{ asset("/front-end/assets/js/theme.js") }}"></script>
            <link
                href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap"
                rel="stylesheet">

            <script src="{{ asset("/sw.js") }}"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl)
                    })
                });

                if ("serviceWorker" in navigator) {
                    // Register a service worker hosted at the root of the
                    // site using the default scope.
                    navigator.serviceWorker.register("/sw.js").then(
                        (registration) => {
                            console.log("Service worker registration succeeded:", registration);
                        },
                        (error) => {
                            console.error(`Service worker registration failed: ${error}`);
                        },
                    );
                } else {
                    console.error("Service workers are not supported.");
                }
            </script>

            @stack("scripts")

            @livewireScripts

            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <x-livewire-alert::scripts />
    </body>

</html>
