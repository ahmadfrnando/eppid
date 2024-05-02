<div class="mt-10 sm:mt-0">
    <x-form-section submit="updatePassword">
        <x-slot name="title">
            {{ __('Update Password') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </x-slot>
        <x-slot name="form">

            <div class="col-span-6 sm:col-span-4">
                <div class="flex">
                    <x-label for="current_password" value="{{ __('Current Password*') }}" />
                    @error('current_password')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-input type="password" class="mt-1 block w-full" wire:model="current_password" />
                <x-input-error for="current_password" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <div class="flex">
                    <x-label for="password" value="{{ __('New Password*') }}" />
                    @error('password')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-input type="password" class="mt-1 block w-full" wire:model="password" />
                <x-input-error for="password" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <div class="flex">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password*') }}" />
                    @error('password_confirmation')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-input type="password" class="mt-1 block w-full" wire:model="password_confirmation" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>
@push('scripts')
    <script>
        Livewire.on('updated', function(event) {
            Swal.fire({
                title: 'Sukses!',
                text: 'Password anda telah terganti',
                icon: 'success',
                timer: 3000,
                toast: true,
                position: 'top',
                timerProgressBar: true,
                showConfirmButton: false,
                iconColor: '#28a745',
            });
        });

        Livewire.on('current_password_incorrect', function(event) {
            Swal.fire({
                title: 'Maaf!',
                text: 'Password lama anda salah, silahkan coba lagi!',
                icon: 'error',
                timer: 3000,
                toast: true,
                position: 'top',
                timerProgressBar: true,
                showConfirmButton: false,
                iconColor: '#a72828',
            });
        });
    </script>
@endpush
