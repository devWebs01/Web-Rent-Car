<div>
    <style>
        .navbar-brand {
            padding-top: 15px;
            padding-bottom: 5px;
            margin-right: 1rem;
            font-size: calc(1.26738rem + .20859vw);
            white-space: nowrap;
        }

        .nav-bottom {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
    <nav class="navbar navbar-expand fixed-top py-0 py-lg-5" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container border border-3 rounded border-dark">
            <a class="navbar-brand py-3 bg-body" href="/">
                <span class="fw-bolder text-primary f-2">{{ $shop->name ?? "" }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon">
                </span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start">
                    <li class="nav-item px-3 px-xl-4 d-none d-lg-block">
                        <a class="nav-link fw-medium" aria-current="page" href="/">Beranda</a>
                    </li>
                    <li class="nav-item px-3 px-xl-4 d-none d-lg-block">
                        <a class="nav-link fw-medium" aria-current="page" href="{{ route("geolocation") }}">
                            Rental Mobil
                        </a>
                    </li>
                    @auth
                        @if (auth()->user()->role === "admin")
                            <li class="nav-item px-3 px-xl-4 d-none d-lg-block">
                                <a class="nav-link fw-medium" aria-current="page" href="{{ route("home") }}">Beranda</a>
                            </li>
                        @else
                            <li class="nav-item px-3 px-xl-4 d-none d-lg-block">
                                <a class="nav-link fw-medium" aria-current="page" href="{{ route("transaction.guest") }}">
                                    Transaksi Mobil
                                </a>
                            </li>
                            <li class="nav-item px-3 px-xl-4">
                                <a class="nav-link fw-medium position-relative" aria-current="page"
                                    href="{{ route("user.account", ["user" => auth()->user()->id]) }}">
                                    <span class="d-none d-lg-block">
                                        Akun Profil
                                    </span>
                                    <i class="bi bi-person-circle fs-5 d-block d-lg-none"></i>
                                    @if (!auth()->user()->address || !auth()->user()->identify || !auth()->user()->phone_number)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item px-3 px-xl-4">
                                <a class="nav-link fw-medium" aria-current="page" href="{{ route("logout") }}"
                                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                    <span class="d-none d-lg-block">
                                        Logout
                                    </span>
                                    <i class="bi bi-box-arrow-right fs-5 d-block d-lg-none"></i>
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item px-3 px-xl-4">
                            <a class="nav-link fw-medium" aria-current="page" href="{{ route("register") }}">
                                <span class="d-none d-lg-block">
                                    Register
                                </span>
                            </a>
                        </li>
                        <li class="nav-item px-3 px-xl-4">
                            <a class="nav-link fw-medium" aria-current="page" href="{{ route("login") }}">
                                <span class="d-none d-lg-block">
                                    Login
                                </span>
                                <i class="bi bi-person-circle fs-5 d-block d-lg-none"></i>
                            </a>
                        </li>
                    @endauth
                </ul>

            </div>
        </div>
    </nav>

    <nav
        class="navbar navbar-light text-dark navbar-expand fixed-bottom d-lg-none d-xl-none rounded nav-bottom mx-4 mb-2 p-0">
        <ul class="navbar-nav nav-justified w-100">
            <li class="nav-item">
                <a href="/" class="nav-link">
                    <i class="bi bi-house-door fs-5"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("geolocation") }}" class="nav-link">
                    <i class="bi bi-map-fill fs-5"></i>
                </a>
            </li>
            @auth
                @if (auth()->user()->role === "admin")
                    <li class="nav-item">
                        <a href="{{ route("home") }}" class="nav-link">
                            <i class="bi bi-person-workspace fs-5"></i>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route("transaction.guest") }}" class="nav-link">
                            <i class="bi bi-car-front-fill fs-5"></i>
                        </a>
                    </li>
                @endif
                <form id="logout-form" action="{{ route("logout") }}" method="POST" class="d-none">
                    @csrf
                </form>

            @endauth
        </ul>
    </nav>

</div>
