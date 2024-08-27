@extends('layouts.main')

@section('content')
    <div class="p-6">
        <x-bladewind::notification />
        <?php
            $status = [
                [ 'label' => 'Dihuni',  'value' => 'Dihuni' ],
                [ 'label' => 'Belum Dihuni',  'value' => 'Belum Dihuni' ],
            ];
        ?>


        <h1 class="text-2xl font-bold mb-2">Data Rumah</h1>
        <div class="grid grid-cols-3">
            <p class="col-span-2 mb-4">
                Pada halaman ini, anda dapat melihat informasi terkait rumah yang terdaftar. Anda dapat menambahkan rumah baru, memperbarui informasi rumah yang sudah ada, serta melihat detail informasi rumah dan penghuni yang terdaftar.
            </p>
        </div>
        <div class="flex justify-between items-center mb-6">
            <x-bladewind::button show_close_icon="true" onclick="showModal('form-tambah')">
                Tambah Rumah
            </x-bladewind::button>
        </div>

        <x-bladewind::table compact="true" celled="true" no_data_message="Data Rumah Kosong" has_shadow="true"
            divider="thin">
            <x-slot name="header">
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Alamat</th>
                <th class="border border-gray-300 px-4 py-2">Status Rumah</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </x-slot>


            @foreach ($rumah as $item)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->alamat }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->status_rumah }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="grid grid-cols-2 gap-2">
                            <x-bladewind::button uppercasing="false" type="primary" size="small" name="{{ $item->id }}"
                                has_spinner="true" can_submit="true" color="gray" class="w-full"
                                onclick="showModal('form-edit-{{ $item->id }}')">
                                Ubah
                            </x-bladewind::button>
                            <x-bladewind::button uppercasing="false" type="primary" size="small" name="{{ $item->id }}"
                                has_spinner="true" can_submit="true" color="blue" class="w-full"
                                onclick="showModal('show-rumah-{{ $item->id }}')">
                                Detil Rumah
                            </x-bladewind::button>

                        </div>
                    </td>
                </tr>

                {{-- Modal Edit Rumah --}}
                <x-bladewind::modal
                    blur_size="small"
                    type="info"
                    size="large"
                    title="Ubah Data Rumah"
                    ok_button_label="Ubah"
                    cancel_button_label="Tutup"
                    name="form-edit-{{ $item->id }}"
                    ok_button_action="editRumah({{ $item->id }})"
                >
                    <form class="form-edit-{{$item->id}}" method="POST" action="{{ route('rumah.update', $item->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="gap-4 mt-3">
                            <x-bladewind::input
                                required="true"
                                name="alamat"
                                error_message="Masukkan Alamat Rumah"
                                label="Alamat"
                                value="{{ $item->alamat }}"
                            />
                            <x-bladewind::dropdown
                                selected-value="{{ $item->status_rumah }}"
                                required="true"
                                name="status_rumah_{{$item->id}}"
                                placeholder="Pilih Status Rumah"
                                :data="$status"
                            />
                        </div>
                    </form>
                </x-bladewind::modal>

                {{-- Modal Detil Rumah --}}
                <x-bladewind::modal
                    blur_size="small"
                    type="info"
                    size="large"
                    title="Informasi Rumah"
                    ok_button_label=""
                    cancel_button_label="Tutup"
                    name="show-rumah-{{$item->id}}"
                >
                    <div class="py-2">
                        <div class="text-lg font-semibold mb-1">Alamat:</div>
                        <p class="text-base mb-2">{{ $item->alamat }}</p>

                        <div class="text-lg font-semibold mb-1">Penghuni:</div>
                        @if ($item->penghuni->isNotEmpty())
                            <ul class="list-disc list-inside text-base">
                                @foreach ($item->penghuni as $penghuni)
                                    <li class="mb-2">{{ $penghuni->nama_lengkap }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-base">Tidak ada penghuni</p>
                        @endif

                        <div class="text-lg font-semibold mb-1">Status Penghuni:</div>
                        @if ($item->penghuni->isNotEmpty())
                            <p class="text-base mb-2">{{ $penghuni->status_penghuni }}</p>
                        @else
                            <p class="text-base">-</p>
                        @endif

                        <div class="text-lg font-semibold mb-1">Status Pernikahan:</div>
                        @if ($item->penghuni->isNotEmpty())
                            <p class="text-base mb-2">{{ $penghuni->status_menikah }}</p>
                        @else
                            <p class="text-base">-</p>
                        @endif

                        <div class="text-lg font-semibold mb-1">Nomor Telepon:</div>
                        @if ($item->penghuni->isNotEmpty())
                            <p class="text-base mb-2">{{ $penghuni->nomor_telepon }}</p>
                        @else
                            <p class="text-base">-</p>
                        @endif
                    </div>
                </x-bladewind::modal>
            @endforeach
        </x-bladewind::table>

        {{-- Modal Tambah Rumah --}}
        <x-bladewind::modal
            title="Tambah Rumah"
            backdrop_can_close="false"
            name="form-tambah"
            ok_button_action="tambahRumah()"
            ok_button_label="Tambah"
            cancel_button_label="Batal"
            close_after_action="false"
            blur_size="small"
            size="large"
        >
            <form method="post" action="{{ route('rumah.store')}}" class="form-tambah">
                @csrf
                <div class="gap-4 mt-3">
                    <x-bladewind::input
                        required="true"
                        name="alamat"
                        error_message="Masukkan Alamat Rumah"
                        label="Alamat"
                    />
                    <x-bladewind::dropdown
                        required="true"
                        name="status_rumah"
                        placeholder="Status Rumah"
                        :data="$status"
                    />
                </div>
            </form>
        </x-bladewind::modal>
    </div>
@endsection

@section('script')
    <script>
        const tambahRumah = () => {
            if (validateForm('.form-tambah')) {
                domEl('.form-tambah').submit();
            }
        }

        const editRumah = (id) => {
            const form = domEl(`.form-edit-${id}`);
            if (validateForm(form)) {
                form.submit();
            }
        }
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showNotification('Gagal Menambahkan Rumah', '{{ $error }}', 'error');
            @endforeach
        @endif

        @if (session('success_tambah'))
            showNotification('Berhasil', 'Rumah Berhasil Ditambahkan');
        @endif

        @if (session('success_update'))
            showNotification('Berhasil', 'Data Rumah Berhasil Diubah');
        @endif
    </script>
@endsection
