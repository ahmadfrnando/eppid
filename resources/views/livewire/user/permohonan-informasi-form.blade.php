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
        <div class="flex items-center p-4 mb-4 text-sm text-cyan-800 rounded-lg bg-cyan-50 dark:bg-gray-800 dark:text-cyan-400"
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
        <div class="md:grid md:grid-cols-2 md:gap-4 md:space-y-0 md:mb-0 space-y-5 mb-4">
            @csrf
            <div class="md:grid gap-2">
                <div class="flex">
                    <x-label value="Nama / Nama Perusahaan*" />
                    @error('nama')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-input class="w-full" wire:model="nama" />
            </div>
            <div class="md:grid gap-2">
                <div class="flex">
                    <x-label value="Alamat*" />
                    @error('alamat')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-textarea class="w-full" wire:model="alamat" />
            </div>
            <div class="md:grid gap-2">
                <div class="flex">
                    <x-label value="Pekerjaan / Jenis Usaha*" />
                    @error('pekerjaan')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-input class="w-full" wire:model="pekerjaan" />
            </div>
            <div class="md:grid gap-2">
                <div class="flex">
                    <x-label value="Informasi Yang Dimohon*" />
                    @error('informasidimohon')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-input class="w-full" wire:model="informasidimohon" />
            </div>
            <div class="md:grid gap-2">
                <div class="flex">
                    <x-label value="Tujuan Penggunaan Informasi*" />
                    @error('tujuan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-input class="w-full" wire:model="tujuan" />
            </div>
            <div class="md:grid gap-2">
                <div class="flex">
                    <x-label value="Jenis Data Informasi*" />
                    @error('data')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-select class="w-full" wire:model="data">
                    <option value="null" selected disabled>Pilih Data Informasi</option>
                    <option value="Data Perkara">Data Perkara</option>
                    <option value="Data Kepegawaian">Data Kepegawaian</option>
                    <option value="Data Aset/keuangan">Data Aset/keuangan</option>
                    <option value="Data Umum/lainnya">Data Umum/lainnya</option>
                </x-select>
            </div>
            <div class="md:grid gap-2">
                <div class="flex">
                    <x-label value="Jenis Dokumen Informasi*" />
                    @error('jenis')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-select class="w-full" wire:model="jenis">
                    <option value="null" selected disabled>Pilih Jenis Dokumen</option>
                    <option value="Softcopy">Softcopy</option>
                    <option value="Hardcopy">Hardcopy</option>
                </x-select>
            </div>
            <div class="md:grid gap-2">
                <div class="flex">
                    <x-label value="Cara Memperoleh Informasi*" />
                    @error('caramemperoleh')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-select class="w-full" wire:model="caramemperoleh">
                    <option value="null" selected disabled>Pilih Cara Memperoleh Informasi</option>
                    <option value="Melihat">Melihat</option>
                    <option value="Membaca">Membaca</option>
                    <option value="Mendengarkan">Mendengarkan</option>
                </x-select>
            </div>
            <div class="md:grid gap-2">
                <div class="flex">
                    <x-label value="Cara Mendapatkan Informasi*" />
                    @error('caramendapatkan')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-select class="w-full" wire:model="caramendapatkan">
                    <option value="null" selected disabled>Pilih Cara Mendapatkan Informasi</option>
                    <option value="Mengambil Langsung">Mengambil Langsung</option>
                    <option value="Mengirim Via Email">Mengirim Via Email</option>
                </x-select>
            </div>
            <div class="md:grid gap-2">
                <div class="flex">
                    <x-label value="Pilih Upload Berkas*" />
                    @error('jenisberkas')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <x-select class="w-full" wire:model="jenisberkas">
                    <option value="null" selected disabled>Pilih Berkas</option>
                    <option value="KTP atau SKP">KTP atau SKP</option>
                    <option value="Akta Badan Hukum">Akta Badan Hukum</option>
                    <option value="Surat Kuasa dan KTP">Surat Kuasa dan KTP</option>
                    <option value="KITAS dan Paspor">KITAS dan Paspor</option>
                    <option value="Akta Badan Hukum PMA">Akta Badan Hukum PMA</option>
                </x-select>
            </div>
            <div class="md:grid-1 gap-2">
                <div class="flex">
                    <x-label value="Upload Berkas PDF*" />
                    @error('berkas')
                        <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <div wire:loading wire:target="berkas" class="text-blue-500 ms-2 text-sm">Uploading...</div>
                </div>
                <x-input type="file" wire:model="berkas" id="berkas"
                    class="block mt-3 w-full text-sm text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-green-50 file:text-green-700
                hover:file:bg-green-100 file:cursor-pointer
                    
                @endempty
                    
                @endempty
              ">
                </x-input>
            </div>
            <div>
                <x-secondary-button wire:click="confirmTtdPerminfo" wire:loading.attr="disabled">
                    {{ __('Kirim') }}
                </x-secondary-button>
            </div>

            <x-dialog-modal wire:model.live="confirmTtd">
                <x-slot name="title">
                    {{ __('PERMOHONAN INFORMASI') }}
                </x-slot>
                <x-slot name="content" class="col-md-12">
                    <div class="flex">
                        <x-label value="Silahkan Tanda tangan" />
                        @error('signature')
                            <span class="ms-2 text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <x-signature-pad wire:model.defer="signature">

                    </x-signature-pad>
                </x-slot>
                <x-slot name="footer">
                    <x-danger-button wire:click="$set('confirmTtd', false)" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-danger-button>

                    <x-button type="submit" class="ms-3" wire:loading.attr="disabled">
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
                text: 'Data sudah terkirim, silahkan cek riwayat permohonan informasi',
                icon: 'success',
                timer: 3000,
                toast: true,
                position: 'top',
                timerProgressBar: true,
                showConfirmButton: false,
                iconColor: '#28a745',
            });

            setTimeout(function() {
                window.location.href = "{{ route('user.permohonan-informasi') }}";
            }, 3000);
        });
    </script>
@endpush
