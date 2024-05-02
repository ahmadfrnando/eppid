<div>
    @if (session('error'))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif
    @if (session('status'))
        <div class="flex items-center p-4 mb-4 text-sm rounded-lg text-cyan-800 bg-red-50 dark:bg-gray-800 dark:text-cyan-400"
            role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd"
                    d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.306 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                    clip-rule="evenodd" />
            </svg>
            <div>
                <span class="font-medium">{{ session('status') }}</span>
            </div>
        </div>
    @endif
    <form wire:submit.prevent="kirim">
        <div class="mb-4 space-y-5 md:grid md:grid-cols-2 md:gap-4 md:space-y-0 md:mb-0">
            @csrf
            <div class="gap-2 md:grid">
                <div class="flex">
                    <x-label value="No. Pendaftaran Permohonan*" />
                    @error('noperminfo')
                        <span class="text-sm text-red-500 ms-2">{{ $message }}</span>
                    @enderror
                </div>
                <x-select class="w-full" wire:model="noperminfos">
                    <option value="null" selected disabled>Pilih No. Pendaftaran Permohonan</option>
                    @if (isset($perminfo))
                        @foreach ($perminfo as $item)
                            <option value="{{ $item->noperminfo }}">{{ $item->noperminfo }}</option>
                        @endforeach
                    @endif
                </x-select>
            </div>
            <div class="gap-2 md:grid">
                <div class="flex">
                    <x-label value="No. Telepon Pemohon*" />
                    @error('notel')
                        <span class="text-sm text-red-500 ms-2">{{ $message }}</span>
                    @enderror
                </div>
                <x-input class="w-full" wire:model="notel" type="number" />
            </div>
            <div class="gap-2 md:grid">
                <div class="flex">
                    <x-label value="Alasan Keberatan*" />
                    @error('alasan')
                        <span class="text-sm text-red-500 ms-2">{{ $message }}</span>
                    @enderror
                </div>
                <x-select class="w-full" wire:model="alasan">
                    <option value="null" selected disabled>Pilih alasan keberatan</option>
                    <option value="Permohonan informasi ditolak">Permohonan informasi ditolak</option>
                    <option value="Informasi berkala tidak disediakan">Informasi berkala tidak disediakan</option>
                    <option value="Permintaan tidak ditanggapin">Permintaan tidak ditanggapin</option>
                    <option value="Permintaan informasi ditanggapi tidak sebagaimana yang diminta">Permintaan informasi
                        ditanggapi tidak sebagaimana yang diminta</option>
                    <option value="Permintaan informasi tidak dipenuhi">Permintaan informasi tidak dipenuhi</option>
                    <option value="Biaya yang dikenakan tidak wajar">Biaya yang dikenakan tidak wajar</option>
                    <option value="Informasi yang disampaikan melebihi jangka waktu yang ditentukan">Informasi yang
                        disampaikan melebihi jangka waktu yang ditentukan</option>
                </x-select>
            </div>
            <div class="gap-2 md:grid">
                <div class="flex">
                    <x-label value="Kasus Posisi*" />
                    @error('kaspol')
                        <span class="text-sm text-red-500 ms-2">{{ $message }}</span>
                    @enderror
                </div>
                <x-input class="w-full" wire:model="kaspol" />
            </div>
            <div>
                <x-secondary-button wire:click="confirmTtdPengkeber" wire:loading.attr="disabled">
                    {{ __('Kirim') }}
                </x-secondary-button>
            </div>

            <x-dialog-modal wire:model.live="confirmTtd">
                <x-slot name="title">
                    {{ __('PENGAJUAN KEBERATAN') }}
                </x-slot>
                <x-slot name="content" class="col-md-12">
                    <div class="flex">
                        <x-label value="Silahkan Tanda tangan" />
                        @error('signature')
                            <span class="text-sm text-red-500 ms-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <x-signature-pad wire:model.defer="signature">

                    </x-signature-pad>
                </x-slot>
                <x-slot name="footer">
                    <x-danger-button wire:click="$set('confirmTtd', false)" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-danger-button>

                    <x-button class="ms-3" type="submit" wire:loading.attr="disabled">
                        {{ __('kirim') }}
                    </x-button>
                </x-slot>
            </x-dialog-modal>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        Livewire.on('terkirim', function(event) {
            Swal.fire({
                title: 'Sukses!',
                text: 'Data sudah terkirim, silahkan cek riwayat pengajuan keberatan',
                icon: 'success',
                timer: 3000,
                toast: true,
                position: 'top',
                timerProgressBar: true,
                showConfirmButton: false,
                iconColor: '#28a745',
            });
            setTimeout(function() {
                window.location.href = "{{ route('user.pengajuan-keberatan') }}";
            }, 3000);
        });
    </script>
@endpush
