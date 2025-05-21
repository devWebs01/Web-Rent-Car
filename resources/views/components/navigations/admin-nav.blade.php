<?php

use function Livewire\Volt\{state};
use App\Models\Transaction;

state(['transaction' => fn() => Transaction::whereIn('status', ['MENUNGGU_KONFIRMASI', 'DIKONFIRMASI'])->count()]);

?>
<div>
    @volt
        <ul class="menu-inner py-1">
            <li class="menu-item {{ request()->is('home') ? 'active' : '' }}">
                <a href="/home" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="home">Beranda</div>
                </a>
            </li>
            <li class="menu-header small fw-medium">User</li>
            <li class="menu-item {{ request()->is('superusers/admins') ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="home">Admin</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('superusers/customers') ? 'active' : '' }}">
                <a href="{{ route('customers.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-user-account"></i>
                    <div data-i18n="home">Pelanggan</div>
                </a>
            </li>
            <li class="menu-header small fw-medium">Mobil</li>
            <li class="menu-item {{ request()->is('superusers/categories') ? 'active' : '' }}">
                <a href="{{ route('categories.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-briefcase"></i>
                    <div data-i18n="home">Kategori</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('superusers/products') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-car"></i>
                    <div data-i18n="home">Mobil</div>
                </a>
            </li>
            <li class="menu-header small fw-medium">Transaksi</li>
            <li class="menu-item {{ request()->is('superusers/transactions') ? 'active' : '' }} position-relative">
                <a href="{{ route('transactions.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-up-arrow-circle"></i>
                    <div data-i18n="home">
                        Transaksi Mobil

                        @if ($transaction > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                !
                            </span>
                        @endif
                    </div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('superusers/reports/transactions') ? 'active' : '' }}">
                <a href="{{ route('reports.transactions') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book"></i>
                    <div data-i18n="home">Laporan Transaksi</div>
                </a>
            </li>
        </ul>
    @endvolt
</div>
