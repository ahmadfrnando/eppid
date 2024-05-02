<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase">
            {{ __('PENGAJUAN KEBERATAN') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <livewire:User.pengajuan-keberatan-form>
        </div>
    </div>
</x-app-layout>
