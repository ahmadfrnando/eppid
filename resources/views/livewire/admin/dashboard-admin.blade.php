<div>
    <div class="grid grid-cols-1 gap-4 mx-auto sm:grid-cols-2 lg:grid-cols-3 max-w-7xl sm:px-6 lg:px-8">
        <x-card href="#" total="{{ $perminfoCount }}" title="Permohonan Informasi">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 text-blue-700">
                <path
                    d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                <path fill-rule="evenodd"
                    d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z"
                    clip-rule="evenodd" />
            </svg>
        </x-card>
        <x-card href="#" total="{{ $pengkeberCount }}" title="Pengajuan Keberatan">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-12 h-12 text-cyan-700">
                <path
                    d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                <path fill-rule="evenodd"
                    d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z"
                    clip-rule="evenodd" />
            </svg>
        </x-card>
        <x-card href="#" total="{{ $userCount }}" title="Daftar User">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-12 h-12 text-yellow-700">
                <path fill-rule="evenodd"
                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z"
                    clip-rule="evenodd" />
            </svg>
        </x-card>
        <div class="col-span-2 row-span-2">
            <div class="relative overflow-x-auto rounded-xl sm:rounded-lg">
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
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Waktu Registrasi
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
                                <td class="px-6 py-4 flex gap-2">
                                    <img class="w-6 h-6 rounded-full" src="{{ $user->profile_photo_url }}"
                                        alt="{{ $user->name }}" alt="Jese image">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($user->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            <nav class="flex flex-wrap items-center justify-between pt-4 flex-column md:flex-row"
                aria-label="Table navigation">
                {{ $users->links(data: ['scrollTo' => false]) }}
            </nav>
        </div>
        <livewire:Admin.userChart>
            <livewire:Admin.perminfoChart>

    </div>
</div>
