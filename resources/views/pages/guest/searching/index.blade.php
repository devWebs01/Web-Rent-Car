<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination};
use App\Models\Shop;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;

name("geolocation");

usesPagination(theme: "bootstrap");

state(["selectedDate", "categoryId"])->url();
state([
    "firstRental" => fn() => shop::first(),
    "categories" => fn() => Category::get(),
    "duration",
    "rent_date",
]);

$search = computed(function () {
    $selectedDate = Carbon::parse($this->selectedDate);
    $categoryId = $this->categoryId;
    $duration = $this->duration;

    if (!$selectedDate || is_null($duration)) {
        return null;
    }

    $availableProducts = Product::whereDoesntHave("transactions", function ($query) use ($selectedDate, $duration) {
        $query->where(function ($query) use ($selectedDate, $duration) {
            $query->whereHas("datings", function ($query) use ($selectedDate, $duration) {
                $query->whereIn("status", ["DALAM_PENGGUNAAN", "TERLAMBAT"])->where(function ($query) use ($selectedDate, $duration) {
                    $query->where("dateOfTransaction", "<=", $selectedDate)->orWhere("dateOfTransaction", "<", $selectedDate->copy()->addDays($duration));
                });
            });
        });
    })
        ->when($categoryId !== "all", function ($query) use ($categoryId) {
            $query->whereHas("category", function ($query) use ($categoryId) {
                $query->where("id", $categoryId);
            });
        })
        ->get();

    return $availableProducts;
});

?>
<x-guest-layout>
    <x-slot name="title">Mapping Pages</x-slot>
    @volt
        <div>
            <div class="container-fluid mt-5">
                <div class="rounded col-12 h-50 position-absolute top-0 start-0 bg-primary" style="z-index:-2;">
                </div>
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="bg-white p-5 shadow rounded">
                            <h1 class="display-4 fw-bold mb-0">Jadwalkan <span class="text-primary">Rental Mobil</span> mu
                            </h1>
                            <p>Kemanapun tujuan Anda, rental mobil <span class="text-primary">
                                    {{ $firstRental->name }}</span> adalah pilihan yang tepat.
                            </p>
                        </div>

                        <div class="row mt-5 mt-lg-0">
                            <div class="col-md">
                                <div class="my-3">
                                    <label for="selectedDate" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control form-control-lg"
                                        wire:model.live="selectedDate" id="selectedDate" aria-describedby="helpId"
                                        placeholder="Enter Selected Date Rent product"
                                        wire:change="$set('categoryId', 'all')" />
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="my-3">
                                    <label for="duration" class="form-label">Durasi/Hari</label>
                                    <input type="number" class="form-control form-control-lg" wire:model.live="duration"
                                        id="duration" min="1" max="30" aria-describedby="helpId"
                                        placeholder="Enter Duration Rent product" />
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="my-3">
                                    <label for="categoryId" class="form-label">Pilih Kategori Mobilmu</label>
                                    <select class="form-select form-select-lg" wire:model.live="categoryId" id="categoryId">
                                        <option selected value="all">Select one</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- result search --}}
            <section class="pt-5" id="destination">
                <div class="container-fluid">
                    @if ($this->search() == null)
                        <div class="card">
                            <div class="card-body">
                                <h3 class="fw-bold text-center">Tidak ditemukan</h3>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            @foreach ($this->search() as $product)
                                <div class="col-md-6 mb-4">
                                    <a class="text-decoration-none"
                                        href="{{ route("product-detail", ["product" => $product->id]) }}">
                                        <div class="card position-relative shadow">
                                            <div class="position-absolute z-index--1 me-10 me-xxl-0"
                                                style="right:-160px;top:-210px;">
                                                <img src="{{ asset("/front-end/assets/img/steps/bg.png") }}"
                                                    style="max-width:550px;" alt="shape" />
                                            </div>
                                            <div class="card-body p-3">
                                                <img class="mb-4 mt-2 rounded-2 img"
                                                    @if ($product->imageProducts->isNotEmpty()) src="{{ Storage::url($product->imageProducts->first()->image_path) }}"
                                                @else src="https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg" @endif
                                                    alt="booking" height="300px" width="100%"
                                                    style="object-fit: cover" />

                                                <div>
                                                    <h5 class="fw-medium">{{ $product->name }}</h5>
                                                    <p class="fs--1 mb-3 fw-medium text-primary">
                                                        {{ $product->category->name }}
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
                    @endif
                </div>
            </section>
        </div>
    @endvolt

    <div class="container-fluid row pt-12 mb-3">
        <div class="col-lg-6">
            <h1 id="font-custom" class="display-1 fw-bold">
                Kunjungi Lokasi <br> Kami
            </h1>
        </div>
        <div class="col-lg-6 mt-lg-0 align-content-center">
            <p>
                Temukan jarak antara lokasi Anda dengan lokasi rental kami.
                Lalu kami akan mengarahkan anda jarak ke lokasi rental kami.
            </p>
        </div>
    </div>
    @include("pages.guest.searching.geolocation")

</x-guest-layout>
