<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase">
            {{ __('Pengajuan Keberatan') }}
        </h2>
    </x-slot>
    <div class="py-8 space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:Admin.PengkeberAdmin>
        </div>
    </div>
</x-admin-layout>
