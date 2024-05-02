<?php
use Carbon\Carbon;
?>
<div>
    <div class="relative overflow-x-auto sm:rounded-lg">
        <div class="flex flex-wrap items-center justify-between pb-4 space-y-4 flex-column sm:flex-row sm:space-y-0">
            <div class="flex items-center justify-center mt-2 space-x-2">
                <x-input id="datepicker" wire:model="selectedDateStart" wire:change="UpdatingSearch" type="text"
                    placeholder="Pilih Tanggal Awal" autocomplete="off" />
                <x-input id="datepicker" wire:model="selectedDateEnd" wire:change="UpdatingSearch" type="text"
                    placeholder="Pilih Tanggal Akhir" autocomplete="off" />
                <x-button wire:click="refresh()" wire:loading.attr="disabled"
                    class="bg-orange-100 text-orange-800 dark:bg-gray-700 dark:text-orange-400 border border-orange-800 hover:bg-orange-300 font-medium rounded-lg text-sm text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-4 h-4 text-orange-800">
                        <path fill-rule="evenodd"
                            d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-.919.53 7.5 7.5 0 0 1-12.548 3.364l-1.902-1.903h3.183a.75.75 0 0 0 0-1.5H2.984a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.53-.918Z"
                            clip-rule="evenodd" />
                    </svg>
                </x-button>
                <x-button wire:click="cetakUser()" wire:loading.attr="disabled" target="_blank"
                    class="relative inline-flex items-center text-sm font-medium text-center rounded-lg  b bg-rose-100 text-rose-800 dark:bg-gray-700 dark:text-rose-400 border border-rose-800 hover:bg-rose-300">
                    <svg class="w-4 h-4 text-rose-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Notifications</span>
                    <div
                        class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                        {{ $totalUsers }}</div>
                </x-button>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none rtl:inset-r-0 rtl:right-0 ps-3">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search user" wire:model.live="search">
            </div>
        </div>
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama lengkap
                        </th>
                        <th scope="col" class="px-6 py-3">
                            email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Waktu Registrasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            aksi
                        </th>
                    </tr>
                </thead>
                @foreach ($users as $user)
                    <tbody>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $no++ }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($user->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                            </td>
                            <td class="px-6 py-4">
                                <button>
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300"
                                        wire:click="openModal({{ $user->id }})">Delete</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>

            <x-dialog-modal wire:model.live="confirmHapus">
                <x-slot name="title">
                    {{ __('DELETE USER') }}
                </x-slot>
                <x-slot name="content" class="col-md-12">
                    {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted') }}
                </x-slot>
                <x-slot name="footer">
                    <x-danger-button wire:click="$set('confirmHapus', false)" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-danger-button>

                    <x-button wire:click="delete" class="ms-3" wire:loading.attr="disabled">
                        {{ __('Hapus') }}
                    </x-button>
                </x-slot>
            </x-dialog-modal>

        </div>
        <nav class="flex flex-wrap items-center justify-between pt-4 flex-column md:flex-row"
            aria-label="Table navigation">
            {{ $users->links(data: ['scrollTo' => false]) }}
        </nav>
    </div>
</div>

@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#datepicker", {
            // Configuration options for Flatpickr
            // You can customize the appearance and behavior here
        });
    </script>
@endpush
