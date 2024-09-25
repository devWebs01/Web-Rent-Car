<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state};
use App\Models\Product;
use App\Models\Shop;

name('welcome');

state([
    'products' => fn() => Product::has('imageProducts')->with('imageProducts')->inRandomOrder()->limit(6)->get(),
    'shop' => fn() => Shop::first(),
]);

?>

<x-guest-layout>
    <x-slot name="title">Aquina Rental Mobil Jambi</x-slot>
    @volt
        <div>
            <section>
                <div class="bg-holder" style="background-image:url(assets/img/hero/hero-bg.svg);"></div>
                <!--/.bg-holder-->
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end">
                            <img class="pt-7 pt-md-0 hero-img"
                                src="https://xpeedstudio.com/themes/carrental/wp-content/uploads/sites/8/2020/08/multiple-car.png"
                                alt="hero-header" />
                        </div>
                        <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
                            <h4 class="fw-bold text-danger my-3">Aquina, Teman Setia Perjalanmu</h4>
                            <p class="hero-title fs-6">Bepergian, nikmati, dan jalani hidup baru</p>

                        </div>
                    </div>
                </div>
            </section>

            <section class="pt-5 pt-md-2" id="service">
                <div class="container-fluid">
                    <div class="position-absolute z-index--1 end-0 d-none d-lg-block">
                        <img src="{{ asset('/front-end/assets/img/category/shape.svg') }}" style="max-width: 200px"
                            alt="service" />
                    </div>
                    <div class="mb-7 text-center">
                        <h3 class="fs-xl-10 fs-lg-8 fs-4 fw-bold font-cursive text-capitalize">Pilihan Terbaik Untuk
                            Perjalanan
                        </h3>
                        <h6 class="text-secondary">
                            Kami mengerti bahwa setiap bisnis dan pribadi memiliki kebutuhan transportasi yang beragam. Oleh
                            karena itu, Aquina menawarkan berbagai layanan rental kendaraan sebagai solusi untuk memenuhi
                            kebutuhan
                            transportasi yang dapat disesuaikan dengan berbagai kebutuhan.
                        </h6>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                                <div class="card-body p-xxl-5 p-4">
                                    <img src="https://omnispace.blob.core.windows.net/strapi-prod/2022-09-09/TRAC_Personal_Leasing_7fa804e3f7.svg"
                                        width="75" alt="Service" />
                                    <h4 class="mb-3">Mobil Pilihan</h4>
                                    <p class="mb-0 fw-medium">Nikmati perjalananmu dengan kenyamanan
                                        terbaik.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                                <div class="card-body p-xxl-5 p-4">
                                    <img src="https://omnispace.blob.core.windows.net/strapi-prod/2022-09-05/Mobile_f8f5d7256a.svg"
                                        width="75" alt="Service" />
                                    <h4 class="mb-3">Layanan Terbaik</h4>
                                    <p class="mb-0 fw-medium">Pelayanan terbaik untuk memenuhi kebutuhan
                                        mobilmu.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                                <div class="card-body p-xxl-5 p-4">
                                    <img src="https://omnispace.blob.core.windows.net/strapi-prod/2022-08-19/support_6b2ff398f7_3742193cc3.svg"
                                        width="75" alt="Service" />
                                    <h4 class="mb-3">Pengalaman Lokal</h4>
                                    <p class="mb-0 fw-medium">Nikmati kenyamanan perjalanan di
                                        sekitar kota.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                                <div class="card-body p-xxl-5 p-4">
                                    <img src="https://omnispace.blob.core.windows.net/strapi-prod/2022-09-09/Group_802c8ffea1.svg"
                                        width="75" alt="Service" />
                                    <h4 class="mb-3">Servis Khusus</h4>
                                    <p class="mb-0 fw-medium">Layanan yang disesuaikan dengan
                                        kebutuhanmu.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="destination" class="pt-0">
                <div class="container-fluid">
                    <div class="position-absolute start-100 bottom-0 translate-middle-x d-none d-xl-block ms-xl-n4">
                        <img src="{{ asset('/front-end/assets/img/dest/shape.svg') }}" alt="destination" />
                    </div>
                    <div class="mb-7 text-center">
                        <h5 class="text-secondary">Mobil pilihan</h5>
                        <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Aquina Rental Jambi</h3>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-6 mb-4">
                                <a class="text-decoration-none"
                                    href="{{ route('product-detail', ['product' => $product->id]) }}">
                                    <div class="card position-relative shadow">
                                        <div class="position-absolute z-index--1 me-10 me-xxl-0"
                                            style="right:-160px;top:-210px;">
                                            <img src="{{ asset('/front-end/assets/img/steps/bg.png') }}"
                                                style="max-width:550px;" alt="shape" />
                                        </div>
                                        <div class="card-body p-3">
                                            <img class="mb-4 mt-2 rounded-2 img"
                                                src="{{ Storage::url($product->imageProducts->first()->image_path) }}"
                                                alt="booking" height="300px" width="100%" style="object-fit: cover" />
                                            <div>
                                                <h5 class="fw-medium">{{ $product->name }}</h5>
                                                <p class="fs--1 mb-3 fw-medium text-primary">{{ $product->category->name }}
                                                </p>
                                                <div class="show-onhover position-relative">
                                                    <div class="d-flex gap-3">
                                                        <!-- Tooltip untuk Koper -->
                                                        <button class="btn icon-item" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="{{ $product->space }} Koper">
                                                            <i class="fa-solid fa-car"></i>
                                                        </button>

                                                        <!-- Tooltip untuk Penumpang -->
                                                        <button class="btn icon-item" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="{{ $product->capacity }} Penumpang">
                                                            <i class="fa-solid fa-suitcase-rolling"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
            </section>

        </div>
    @endvolt

</x-guest-layout>
