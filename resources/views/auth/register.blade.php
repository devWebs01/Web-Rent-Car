<?php

use function Livewire\Volt\{state};
use App\Models\{Shop};

state(["shop" => fn() => Shop::first()]);

?>

<x-auth-layout>
    <x-slot name="title">Regiter Account</x-slot>
    @volt
        <div>
            <section class="py-5">
                <div class="container">
                    <div class="row align-items-lg-center mb-5">
                        <div class="col-md-6 mb-5 mb-md-0">
                            <h1 class="display-3 fw-bolder">Nikmati pengalaman rental mobil yang mudah, <span
                                    class="text-primary">
                                    nyaman, dan
                                    terpercaya.</span></h1>
                            <p class="lead fw-bold mt-3 mb-4">Daftarkan diri Anda sekarang juga untuk mendapatkan penawaran
                                spesial!</p>
                        </div>
                        <div class="col-md-5 col-md-6">
                            <div class="card">
                                <a href="/" class="text-nowrap logo-img text-center d-block pt-5 w-100">
                                    <h3 class="fw-bolder">{{ $shop->name ?? "" }}</h3>
                                </a>
                                <div class="card-body">
                                    <form method="POST" action="{{ route("register") }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __("Name") }}</label>
                                            <input id="name" type="text"
                                                class="form-control @error("name") is-invalid @enderror" name="name"
                                                value="{{ old("name") }}" required autocomplete="name" autofocus>

                                            @error("name")
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __("Email Address") }}</label>
                                            <input id="email" type="email"
                                                class="form-control @error("email") is-invalid @enderror" name="email"
                                                value="{{ old("email") }}" required autocomplete="email">

                                            @error("email")
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">{{ __("Password") }}</label>

                                            <div class="input-group">

                                                <input id="password" type="password"
                                                    class="form-control @error("password") is-invalid @enderror"
                                                    name="password" required autocomplete="new-password">
                                                <button type="button" class="btn btn-light border" id="togglePassword">
                                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                                </button>
                                            </div>
                                            @error("password")
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="mb-3">
                                            <label for="password-confirm"
                                                class="form-label">{{ __("Confirm Password") }}</label>

                                            <div class="input-group">

                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password">

                                                <button type="button" class="btn btn-light border" id="togglePassword">
                                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">
                                                Daftar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <p class="mb-0 fw-bold">Udah punya akun?</p>
                                    <a class="text-primary fw-bold ms-2" href="{{ route("login") }}">Login sekarang</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    @endvolt

</x-auth-layout>
