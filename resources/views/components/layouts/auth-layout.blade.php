<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? '' }} | {{ $shop->name ?? '' }}</title>
    <!-- PWA  -->
    <meta name="theme-color" content="#ffffff">

    <meta name="msapplication-TileImage" content="{{ asset('/front-end/assets/img/favicons/aquina-logo-150x150.jpg') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('/front-end/assets/img/favicons/aquina-apple-icon.jpg') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('/front-end/assets/img/favicons/aquina-logo-32x32.jpg') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('/front-end/assets/img/favicons/aquina-logo-16x16.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/front-end/assets/img/favicons/aquina-logo.ico') }}">

    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap"
        rel="stylesheet">

    <link href="{{ asset('/front-end/assets/css/theme.min.css') }}" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/21fb7efcbe.js" crossorigin="anonymous"></script>



    <style>
        .nav-bottom {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .form-control {
            border-radius: 10px;
        }

        .btn {
            border-radius: 10px;
        }
    </style>

</head>

<body>
    @include('layouts.loading')
    <header>
        <nav
            class="navbar navbar-light text-dark navbar-expand fixed-bottom d-lg-none d-xl-none rounded nav-bottom mx-4 mb-2 p-0 ">
            <ul class="navbar-nav nav-justified w-100">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="bi bi-house-door fs-3"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('geolocation') }}" class="nav-link">
                        <i class="bi bi-map-fill fs-3"></i>
                    </a>
                </li>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="bi bi-person-workspace fs-3"></i>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('transaction.guest') }}" class="nav-link">
                                <i class="bi bi-car-front-fill fs-3"></i>
                            </a>
                        </li>
                    @endif
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                @endauth
            </ul>
        </nav>
    </header>

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/front-end/vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('/front-end/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/front-end/vendors/is/is.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('/front-end/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('/front-end/assets/js/theme.js') }}"></script>

    <script src="{{ asset('/sw.js') }}"></script>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');
            const togglePasswordButton = document.getElementById('togglePassword');
            const toggleIcon = document.getElementById('toggleIcon');

            togglePasswordButton.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // Toggle icon class
                if (type === 'text') {
                    toggleIcon.classList.remove('bi-eye');
                    toggleIcon.classList.add('bi-eye-slash');
                } else {
                    toggleIcon.classList.remove('bi-eye-slash');
                    toggleIcon.classList.add('bi-eye');
                }
            });
        });
    </script>

    @stack('scripts')

    @livewireScripts


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
</body>

</html>
