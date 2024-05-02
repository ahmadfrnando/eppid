<?php
use Carbon\Carbon;
?>
<div>

    <div class="relative overflow-x-auto sm:rounded-lg p-2">
        <div class="flex flex-wrap items-center justify-between pb-4 space-y-4 flex-column sm:flex-row sm:space-y-0">
            <div class="flex space-x-2 items-center justify-center">
                <select wire:model="selectedData" wire:change="UpdatingSearch" id="table-search"
                    class="font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    <option value="null" selected>Semua Data</option>
                    <option value="Data Perkara">Data Perkara</option>
                    <option value="Data Kepegawaian">Data Kepegawaian</option>
                    <option value="Data Aset/keuangan">Data Aset/keuangan</option>
                    <option value="Data Umum/lainnya">Data Umum/lainnya</option>
                </select>
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
                <x-button wire:click="cetakPerminfo()" wire:loading.attr="disabled" target="_blank"
                    class="relative inline-flex items-center text-sm font-medium text-center rounded-lg bg-rose-100 text-rose-800 dark:bg-gray-700 dark:text-rose-400 border border-rose-800 hover:bg-rose-300 ">
                    <svg class="w-4 h-4 text-rose-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="sr-only">Notifications</span>
                    <div
                        class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-rose-800 rounded-full -top-2 -end-2 dark:border-gray-900">
                        {{ $totalPerminfos }}</div>
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
                    placeholder="Search permohonan informasi" wire:model.live="search">
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No. Permohonan Informasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis Data
                        </th>
                        <th scope="col" class="px-6 py-3">
                            informasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            waktu pengajuan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            aksi
                        </th>
                    </tr>
                </thead>
                @foreach ($perminfos as $perminfo)
                    <tbody>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $no++ }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $perminfo->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $perminfo->noperminfo }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $perminfo->data }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $perminfo->informasidimohon }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($perminfo->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                            </td>
                            <td class="px-6 py-4">
                                <button class="w-full">
                                    <span
                                        class=" text-xs font-medium me-2 px-2.5 py-0.5 rounded-full {{ $perminfo->status == 'DITOLAK' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : 'bg-cyan-100 text-cyan-800 dark:bg-cyan-900 dark:text-cyan-300' }}"
                                        wire:click="openModal({{ $perminfo->id }})">{{ $perminfo->status }}</span>
                                </button>
                            </td>
                            <td class="flex px-6 py-4 w-50">
                                <a href="../{{ $perminfo->buktipengajuan }}" target="_blank">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                        <svg class="w-4 h-4 text-blue-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                                            <path fill-rule="evenodd"
                                                d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Bukti Pengajuan</span>
                                    </span>
                                </a>
                                <button>
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300"
                                        wire:click="openModalDoc({{ $perminfo->id }})">
                                        <svg class="w-4 h-4 text-cyan-800" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01" />
                                        </svg>

                                        <span class="sr-only">Kirim Dokumen</span>
                                    </span>
                                </button>
                                <a href="../{{ $perminfo->doc }}" target="_blank"
                                    {{ isset($perminfo->doc) ? '' : 'hidden' }}>
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                        <svg class="w-4 h-4 text-green-800" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v9.293l-2-2a1 1 0 0 0-1.414 1.414l.293.293h-6.586a1 1 0 1 0 0 2h6.586l-.293.293A1 1 0 0 0 18 16.707l2-2V20a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        <span class="sr-only">Dokumen Terkirim</span>
                                    </span>
                                </a>
                            </td>
                        </tr>

                    </tbody>
                @endforeach
            </table>
            <x-dialog-modal wire:model.live="statusChange">
                <x-slot name="title">
                    {{ __('PERMOHONAN INFORMASI') }}
                </x-slot>
                <x-slot name="content">
                    <div class="col-md-12">
                        <x-label for="status" value="{{ __('Status') }}" />
                        <x-select class="w-full mt-2" wire:model="status">
                            <option value="{{ $status }}" selected>{{ $status }}</option>
                            <option value="PROSES" class="{{ $status == 'PROSES' ? 'hidden' : '' }}">PROSES
                            </option>
                            <option value="DITERIMA" class="{{ $status == 'DITERIMA' ? 'hidden' : '' }}">
                                DITERIMA
                            </option>
                            <option value="DITOLAK" class="{{ $status == 'DITOLAK' ? 'hidden' : '' }}">
                                DITOLAK
                            </option>
                        </x-select>
                    </div>
                    <div class="col-md-12">
                        <x-label for="pesan" class="mt-4" value="{{ __('Pesan') }}" />
                        <x-select class="w-full mt-2" wire:model="pesan">
                            <option value="null" selected>Pilih pesan</option>
                            <option value="Silahkan tunggu 14 hari kerja">Silahkan tunggu 14
                                hari
                                kerja</option>
                            <option value="Silahkan ambil dokumen ke pengadilan">Silahkan ambil
                                dokumen ke pengadilan
                            </option>
                            <option value="Silahkan cek email untuk melihat dokumen">Silahkan
                                cek
                                email untuk melihat dokumen</option>
                            <option value="Maaf permintaan anda ditolak, dikarenakan tidak sesuai">
                                Maaf permintaan anda ditolak, dikarenakan tidak sesuai</option>
                        </x-select>
                        <x-textarea class="w-full mt-2" wire:model="pesan"
                            placeholder="{{ $pesan }}">{{ $pesan }}</x-textarea>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <x-danger-button wire:click="$set('statusChange', false)" wire:loading.attr="disabled">
                        {{ __('Batal') }}
                    </x-danger-button>

                    <x-button wire:click="update" class="ms-3" wire:loading.attr="disabled">
                        {{ __('Simpan') }}
                    </x-button>
                </x-slot>
            </x-dialog-modal>

            <x-dialog-modal wire:model.live="modalDoc">
                <x-slot name="title">
                    {{ __('PERMOHONAN INFORMASI') }}
                </x-slot>
                <x-slot name="content">
                    <div class="gap-2 md:grid-1">
                        <div class="flex">
                            <x-label value="Upload Dokumen PDF*" />
                            @error('doc')
                                <span class="text-sm text-red-500 ms-2">{{ $message }}</span>
                            @enderror
                            <div wire:loading wire:target="doc" class="text-sm text-blue-500 ms-2">
                                Uploading...</div>
                        </div>
                        <x-input type="file" wire:model="doc" id="doc"
                            class="block mt-3 w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                         file:border-0
                        file:text-sm file:font-semibold
                        file:bg-green-50 file:text-green-700
                        hover:file:bg-green-100 file:cursor-pointer
                            
                        @endempty
                            
                        @endempty
                      ">
                        </x-input>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <x-danger-button wire:click="$set('modalDoc', false)" wire:loading.attr="disabled">
                        {{ __('Batal') }}
                    </x-danger-button>

                    <x-button wire:click="updateDoc" class="ms-3" wire:loading.attr="disabled">
                        {{ __('Simpan') }}
                    </x-button>
                </x-slot>
            </x-dialog-modal>

        </div>
        <nav class="flex flex-wrap items-end justify-between pt-4 flex-column md:flex-row">
            {{ $perminfos->links(data: ['scrollTo' => false]) }}
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
