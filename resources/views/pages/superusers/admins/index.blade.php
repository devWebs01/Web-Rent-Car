<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination, uses};
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;

uses([LivewireAlert::class]);

name("admin.index");
usesPagination(theme: "bootstrap");

state(["search"])->url();

state(["admin" => fn() => User::where("role", "admin")->latest()->get()]);

$deleted = function (User $user) {
    $user->delete();

    $this->flash(
        "success",
        "Proses Berhasil",
        [
            "position" => "center",
            "timer" => 3000,
            "toast" => true,
            "text" => "",
        ],
        "/superusers/admins",
    );
};

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
                    <li class="breadcrumb-item active">Data Admin</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between text-start gap-2">
                        <div class="col">
                            <a class="btn btn-primary" href="{{ route("admin.create") }}" role="button">Tambah
                                Admin</a>
                            <span wire:loading class="spinner-border spinner-border-sm ms-3"></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive rounded">
                        <table wire:ignore id="example"
                            class="table table-hover display border text-nowrap text-nowrap text-nowrap"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telp</th>
                                    <th>Tombol</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $no => $item)
                                    <tr>
                                        <td>{{ ++$no }}.</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone_number }}</td>
                                        <td class="d-flex gap-3 align-items-center">
                                            <div class="btn-group btn-group-sm" role="group"
                                                aria-label="Small button group">

                                            </div>
                                            <a type="button" class="btn btn-sm btn-warning "
                                                href="{{ route("admin.edit", ["user" => $item->id]) }}">
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
                        {{-- {{ $this->users->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    @endvolt

</x-admin-layout>
