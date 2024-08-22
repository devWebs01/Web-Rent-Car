<?php
use function Laravel\Folio\{name, middleware};
use function Livewire\Volt\{state};
use App\Models\Transaction;

name('transaction.guest');
middleware(['auth']);

state([
    'transactions' => fn() => Transaction::where('user_id', auth()->user()->id)->get(),
]);

?>

<x-guest-layout>
    <x-slot name="title">Transaksi Rental Mobil</x-slot>
    @include('layouts.table')
    @volt
        <div>
            <div class="container-fluid row mt-5 mb-3">
                <div class="col-lg-6">
                    <h1 id="font-custom" class="display-1 fw-bold">
                        Transaksi Rental <br> Mobil
                    </h1>
                </div>
                <div class="col-lg-6 mt-lg-0 align-content-center">
                    <p>
                        Temukan kemudahan dalam menyewa mobil dengan
                        proses yang cepat dan aman. Pilih mobil sesuai kebutuhan Anda dan nikmati perjalanan tanpa kendala.
                    </p>
                </div>
            </div>
            <div class="rounded border">
                <div class="table-responsive p-3">
                    <table class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama</th>
                                {{-- <th>Kategori</th> --}}
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $no => $item)
                                <tr>
                                    <td>{{ ++$no }}.</td>
                                    <td>{{ $item->product->name }}</td>
                                    {{-- <td>{{ $item->category->name }}</td> --}}
                                    <td>

                                        <button class="btn btn-primary">
                                            {{ $item->status }}
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('invoice.guest', ['transaction' => $item->id]) }}"
                                            class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endvolt
</x-guest-layout>
