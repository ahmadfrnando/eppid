<?php
use Carbon\Carbon;
?>
<div>
    <div class="relative overflow-x-auto sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div>
                <h1 class="uppercase p-5 text-2xl font-semibold text-left rtl:text-right text-gray-900 dark:text-white">
                    PENGAJUAN KEBERATAN</h1>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search pengajuan keberatan" wire:model.live="search">
            </div>
        </div>
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3  hidden md:table-cell">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3  hidden md:table-cell">
                            No. Pendaftaran Permohonan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama pemohon
                        </th>
                        <th scope="col" class="px-6 py-3  hidden md:table-cell">
                            alasan pemohon
                        </th>
                        <th scope="col" class="px-6 py-3  hidden md:table-cell">
                            waktu pengajuan
                        </th>
                        <th scope="col" class="px-6 py-3  hidden md:table-cell">
                            status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            action
                        </th>
                    </tr>
                </thead>
                @foreach ($pengkebers as $pengkeber)
                    <tbody>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row"
                                class="px-6 py-4  hidden md:table-cell font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $no++ }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4  hidden md:table-cell font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $pengkeber->noperminfo }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $pengkeber->nama }}
                            </td>
                            <td class="px-6  hidden md:table-cell py-4">
                                {{ $pengkeber->alasan }}
                            </td>
                            <td class="px-6  hidden md:table-cell py-4">
                                {{ \Carbon\Carbon::parse($pengkeber->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                            </td>
                            <td class="px-6  hidden md:table-cell py-4">
                                <span
                                    class=" text-xs font-medium me-2 px-2.5 py-0.5 rounded-full {{ $pengkeber->status == 'DITOLAK' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : 'bg-cyan-100 text-cyan-800 dark:bg-cyan-900 dark:text-cyan-300' }}">{{ $pengkeber->status }}</span>
                            </td>
                            <td class="px-6 py-4" x-data="{ open: false }">
                                <div class="flex">
                                    <a href="public/storage/{{ $pengkeber->buktipengajuan }}" target="_blank">
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
                                    <a href="../{{ $pengkeber->doc }}" target="_blank"
                                        {{ isset($pengkeber->doc) ? '' : 'hidden' }}>
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                            <svg class="w-4 h-4 text-green-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 12.732A1.99 1.99 0 0 1 7 13H3v6a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2h-2a4 4 0 0 1-4-4v-2.268ZM7 11V7.054a2 2 0 0 0-1.059.644l-2.46 2.87A2 2 0 0 0 3.2 11H7Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M14 3.054V7h-3.8c.074-.154.168-.3.282-.432l2.46-2.87A2 2 0 0 1 14 3.054ZM16 3v4a2 2 0 0 1-2 2h-4v6a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-3Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Dokumen Informasi</span>
                                        </span>
                                    </a>

                                    <button @click="open = ! open">
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                            <svg class="w-4 h-4 text-yellow-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M3 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-6.616l-2.88 2.592C8.537 20.461 7 19.776 7 18.477V17H5a2 2 0 0 1-2-2V6Zm4 2a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2H7Zm8 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2Zm-8 3a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H7Zm5 0a1 1 0 1 0 0 2h5a1 1 0 1 0 0-2h-5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Pesan</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="max-w-[120px] mt-2 w-full flex" x-show="open">
                                    <span class="text-xs italic text-justify text-red-600">Note :
                                        {{ $pengkeber->pesan }}</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
            aria-label="Table navigation">
            {{ $pengkebers->links(data: ['scrollTo' => false]) }}
        </nav>
    </div>
</div>
