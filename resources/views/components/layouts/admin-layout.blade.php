<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset("admin/") }}" data-template="vertical-menu-template-free">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ asset("/back-end/img/favicon/favicon.ico") }}" />

        <title>{{ $title ?? "" }} | {{ $shop->name ?? '' }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet" href="{{ asset("/back-end/vendor/fonts/boxicons.css") }}" />
        <link rel="stylesheet" href="{{ asset("/back-end/vendor/css/core.css") }}"
            class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset("/back-end/css/demo.css") }}" />
        <link rel="stylesheet" href="{{ asset("/back-end/vendor/libs/perfect-scrollbar/perfect-scrollbar.css") }}" />
        <link rel="stylesheet" href="{{ asset("/back-end/vendor/css/theme-default.css") }}"
            class="template-customizer-theme-css" />
        <script src="{{ asset("/back-end/vendor/js/helpers.js") }}"></script>
        <script src="{{ asset("/back-end/js/config.js") }}"></script>

        <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,700;1,500;1,700&display=swap');

            *,
            body {
                font-family: 'Poppins', sans-serif !important;
            }
        </style>

        @livewireStyles

        @stack("css")

    </head>

    <body>

        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">

                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    <div class="app-brand demo">
                        <a href="/" class="app-brand-link">
                            {{ $shop->name ?? '' }}
                        </a>
                        <a href="javascript:void(0);"
                            class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                            <i class="bx bx-chevron-left bx-sm align-middle"></i>
                        </a>
                    </div>

                    <div class="menu-inner-shadow"></div>

                    <x-admin-nav></x-admin-nav>
                </aside>

                <div class="layout-page">

                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                        id="layout-navbar">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                            <ul class="navbar-nav flex-row align-items-center ms-auto">
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                        data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online">
                                            <img src="https://api.dicebear.com/7.x/lorelei/svg?seed={{ auth()->user()->name ?? "user" }}"
                                                alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="/">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-online">
                                                            <img src="https://api.dicebear.com/7.x/lorelei/svg?seed={{ auth()->user()->name ?? "user" }}"
                                                                alt class="w-px-40 h-auto rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span
                                                            class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                                                        <small class="text-muted">{{ auth()->user()->role }}</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route("logout") }}"
                                                onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Keluar</span>
                                            </a>
                                            <form id="logout-form" action="{{ route("logout") }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </nav>

                    <div class="content-wrapper">

                        <div class="container-xxl flex-grow-1 container-p-y">
                            @if (session("errors"))
                                <div class="bs-toast toast fade show position-absolute top-0 end-0 m-3 text-danger"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-body">
                                        <div class="d-flex" role="alert">
                                            <span
                                                class="badge badge-center rounded-pill bg-danger border-label-danger p-3 me-2">
                                                <i class='bx bx-x fs-3'></i>
                                            </span>
                                            <div class="d-flex flex-column ps-1">
                                                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Oops!
                                                </h6>
                                                @foreach ($errors->all() as $error)
                                                    <span>{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @elseif (session("success"))
                                <div class="bs-toast toast fade show position-absolute top-0 end-0 m-3 text-primary"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-body">
                                        <div class="d-flex" role="alert">
                                            <span
                                                class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2">
                                                <i class='bx bx-check fs-3'></i>
                                            </span>
                                            <div class="d-flex flex-column ps-1">
                                                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">
                                                    Horeee!
                                                </h6>
                                                <span> {{ session("success") }} 🥳!</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            {{ $slot }}

                            <footer class="content-footer footer bg-footer-theme border rounded sticky-bottom mt-3 ">
                                <div
                                    class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                                    <div class="mb-2 mb-md-0">
                                        Butuh bantuan ?
                                        {{-- <a href="https://api.whatsapp.com/send/?phone={{ $brand->whatsapp }}&text&type=phone_number&app_absent=0"
                                        target="_blank" class="footer-link fw-bolder text-primary">Whatsapp <i
                                            class="menu-icon tf-icons bx bx-support"></i>
                                    </a> --}}
                                    </div>
                                </div>
                            </footer>

                            <div class="content-backdrop fade"></div>
                        </div>

                    </div>

                </div>

                <div class="layout-overlay layout-menu-toggle"></div>
            </div>
        </div>

        <script src="{{ asset("/back-end/vendor/libs/jquery/jquery.js") }}"></script>
        <script src="{{ asset("/back-end/vendor/libs/popper/popper.js") }}"></script>
        <script src="{{ asset("/back-end/vendor/js/bootstrap.js") }}"></script>
        <script src="{{ asset("/back-end/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>
        <script src="{{ asset("/back-end/vendor/js/menu.js") }}"></script>
        <script src="{{ asset("/back-end/js/main.js") }}"></script>

        <script async defer src="https://buttons.github.io/buttons.js') }}"></script>

        @stack("scripts")

        @livewireScripts

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />

    </body>

</html>
