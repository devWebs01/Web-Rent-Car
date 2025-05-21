<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination};
use App\Models\Transaction;

name("transactions.index");

usesPagination(theme: "bootstrap");

state(["transactions" => fn() => Transaction::latest()->get()]);

?>
<x-admin-layout>
    <x-slot name="title">Data Transaksi Rental</x-slot>
    @include("layouts.responsive")

    @volt
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Data Transaksi</li>
                </ol>
            </nav>

            <div class="card">
                {{-- <div class="card-header">
                    <div class="row justify-content-between gap-2">
                        <div class="col-md">
                            <a class="btn btn-primary" href="{{ route('transactions.create') }}" role="button">Tambah
                                Transaksi</a>
                            <span wire:loading class="spinner-border spinner-border-sm ms-3"></span>
                        </div>
                        <div class="col-md">
                            <input wire:model.live="search" type="search" class="form-control" name="search"
                                id="search" aria-describedby="helpId" placeholder="..." />
                        </div>
                    </div>
                </div> --}}
                <div class="card-body">
                    <div class="table-responsive rounded">
                        <table wire:ignore id="example" class="table table-hover display border text-nowrap"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Mobil</th>
                                    <th>Tanggal Rental</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $no => $item)
                                    <tr>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->rent_date }}</td>
                                        <td>
                                            <span class="badge bg-primary py-2">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route("transactions.edit", ["transaction" => $item->id]) }}"
                                                class="btn btn-sm btn-primary">Detail</a>
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
