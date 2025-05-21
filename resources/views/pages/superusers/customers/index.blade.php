<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination};
use App\Models\User;

name("customers.index");

usesPagination(theme: "bootstrap");

state(["users" => fn() => User::query()->where("role", "customer")->latest()->get()])->url();

?>
<x-admin-layout>
    <x-slot name="title">Data Admin</x-slot>
    @include("layouts.responsive")

    @volt
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Data Pelanggan</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive rounded">
                        <table wire:ignore id="example"
                            class="table table-hover display border text-nowrap text-nowrap text-nowrap text-nowrap"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Identitas</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telp</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $no => $item)
                                    <tr>
                                        <td>
                                            @if ($item->identify)
                                                <a href="{{ Storage::url($item->identify) }}" data-fancybox
                                                    data-caption="Single image">
                                                    <img src="{{ Storage::url($item->identify) }}"
                                                        class="img rounded-circle" style="object-fit: cover;" width="30px"
                                                        height="30px" alt="Identify Customer">
                                                </a>
                                            @else
                                                <div class="rounded-circle placeholder border"
                                                    style="width: 30px; height: 30px;" alt="Identify Customer">
                                            @endif
                                        </td>
                                        <td>{{ $item->name ?? "-" }}</td>
                                        <td>{{ $item->email ?? "-" }}</td>
                                        <td>{{ $item->phone_number ?? "-" }}</td>
                                        <td>{{ $item->address ?? "-" }}</td>
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
