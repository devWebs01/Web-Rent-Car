<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination, uses};
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;

uses([LivewireAlert::class]);

name("products.index");
usesPagination(theme: "bootstrap");

state(["products" => fn() => Product::latest()->get()]);

$deleted = function (Product $product) {
    $product->delete();

    $this->flash(
        "success",
        "Proses Berhasil",
        [
            "position" => "center",
            "timer" => 3000,
            "toast" => true,
            "text" => "",
        ],
        "/superusers/products",
    );
};

?>
<x-admin-layout>
    <x-slot name="title">Data Mobil</x-slot>
    @include("layouts.responsive")

    @volt
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Data Mobil</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between text-start gap-2">
                        <div class="col">
                            <a class="btn btn-primary" href="{{ route("products.create") }}" role="button">Tambah
                                Mobil</a>
                            <span wire:loading class="spinner-border spinner-border-sm ms-3"></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive rounded">
                        <table wire:ignore id="example" class="table table-hover display border text-nowrap"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Harga/Hari</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $no => $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->getFormattedPriceAttribute() }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->status == 1 ? "success" : "warning" }} py-2">
                                                {{ $item->status == 1 ? "AKTIF" : "TIDAK AKTIF" }}
                                            </span>

                                        </td>
                                        <td class="d-flex gap-3 align-items-center">
                                            <a type="button" class="btn btn-sm btn-warning "
                                                href="{{ route("products.edit", ["product" => $item->id]) }}">
                                                Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger "
                                                wire:click='deleted({{ $item->id }})' wire:loading.attr="disabled">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endvolt

</x-admin-layout>
