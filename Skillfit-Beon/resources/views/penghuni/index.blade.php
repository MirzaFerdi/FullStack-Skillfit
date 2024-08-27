@extends('layouts.main')


@section('content')
    <div class="p-6">
        <x-bladewind::notification />
        <?php
            $status_penghuni = [
                [ 'label' => 'Penghuni Tetap' , 'value' => 'Penghuni Tetap' ],
                [ 'label' => 'Penghuni Kontrak' , 'value' => 'Penghuni Kontrak' ],
            ];
            $status_menikah = [
                [ 'label' => 'Sudah Menikah',  'value' => 'Sudah Menikah' ],
                [ 'label' => 'Belum Menikah',  'value' => 'Belum Menikah' ],
            ];
            $alamat_rumah = [];
            foreach ($rumah as $item) {
                $alamat_rumah[] = [
                    'label' => $item->alamat,
                    'value' => $item->id,
                ];
            }

        ?>
        <h1 class="text-2xl font-bold mb-2">Manajemen Data Penghuni</h1>
        <div class="grid grid-cols-3">
            <p class="col-span-2 mb-4">
                Pada halaman ini, anda dapat melihat informasi terkait penghuni yang terdaftar. Anda dapat menambahkan penghuni baru, memperbarui informasi penghuni yang sudah ada, serta melihat detail informasi penghuni yang terdaftar.
            </p>
        </div>

        <div class="flex justify-between items-center mb-6">
            <x-bladewind::button show_close_icon="true" onclick="showModal('form-tambah')">
                Tambah Penghuni
            </x-bladewind::button>
        </div>

        <x-bladewind::table compact="true" celled="true" no_data_message="Data Penghuni Kosong" has_shadow="true" divider="thin">
            <x-slot name="header">
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama</th>
                <th class="border border-gray-300 px-4 py-2">Status Pernikahan</th>
                <th class="border border-gray-300 px-4 py-2">No. HP</th>
                <th class="border border-gray-300 px-4 py-2">Alamat Rumah</th>
                <th class="border border-gray-300 px-4 py-2">Status Penghuni</th>
                <th class="border border-gray-300 px-4 py-2">Foto KTP</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </x-slot>
            <tbody>
                @foreach ($penghuni as $item)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->nama_lengkap }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->status_menikah }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->nomor_telepon }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->rumah->alamat }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->status_penghuni }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($item->foto_ktp)
                                <a href="{{ asset('storage/foto_ktp/' . $item->foto_ktp) }}" target="_blank" class="text-blue-500" >Lihat</a>
                            @else
                                <span class="text-gray-500">Tidak Ada</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <x-bladewind::button uppercasing="false" type="primary" size="tiny" name="{{ $item->id }}"
                                has_spinner="true" can_submit="true" color="gray" class=""
                                onclick="showModal('form-edit-{{ $item->id }}')">
                                Ubah
                            </x-bladewind::button>
                            <x-bladewind::button uppercasing="false" type="primary" size="tiny" name="{{ $item->id }}"
                                has_spinner="true" can_submit="true" color="red" class=""
                                onclick="showModal('del-{{ $item->id }}')">
                                Hapus
                            </x-bladewind::button>
                        </td>
                    </tr>
                    {{-- Modal Edit Penghuni --}}
                    <x-bladewind::modal
                        title="Edit Penghuni"
                        name="form-edit-{{ $item->id }}"
                        backdrop_can_close="false"
                        ok_button_action="editPenghuni({{ $item->id }})"
                        ok_button_label="Simpan"
                        cancel_button_label="Batal"
                        close_after_action="false"
                        blur_size="small"
                        size="large"
                    >
                        <form method="post" action="{{ route('penghuni.update', $item->id)}}" class="form-edit-{{$item->id}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="gap-4 mt-2">
                                <x-bladewind::input
                                    required="true"
                                    name="nama_lengkap"
                                    error_message="Masukkan Nama Lengkap"
                                    label="Nama Penghuni"
                                    value="{{ $item->nama_lengkap }}"
                                />
                                <x-bladewind::dropdown
                                    required="true"
                                    name="rumah_id_{{$item->id}}"
                                    placeholder="Alamat Rumah"
                                    searchable="true"
                                    :data="$alamat_rumah"
                                    selected-value="{{ $item->rumah_id }}"
                                />
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <x-bladewind::dropdown
                                    required="true"
                                    name="status_penghuni_{{$item->id}}"
                                    placeholder="Status Penghuni"
                                    :data="$status_penghuni"
                                    selected-value="{{ $item->status_penghuni }}"
                                />
                                <x-bladewind::dropdown
                                    required="true"
                                    name="status_menikah_{{$item->id}}"
                                    placeholder="Status Pernikahan"
                                    :data="$status_menikah"
                                    selected-value="{{ $item->status_menikah }}"
                                />
                            </div>
                            <div class="gap-4 mt-2">
                                <x-bladewind::input
                                    required="true"
                                    name="nomor_telepon"
                                    error_message="Masukkan Nomor Telepon"
                                    label="Nomor Telepon"
                                    value="{{ $item->nomor_telepon }}"
                                />
                                <x-bladewind::filepicker
                                    name="foto_ktp_{{$item->id}}"
                                    required="true"
                                    accepted_file_types="image/*"
                                    placeholder="Upload Foto KTP"
                                    url="{{ asset('storage/foto_ktp/' . $item->foto_ktp) }}"
                                />
                            </div>
                        </form>
                    </x-bladewind::modal>

                    {{-- Modal Hapus Penghuni --}}
                    <x-bladewind::modal
                        size="big"
                        blur_size="small"
                        type="warning"
                        title="Hapus Penghuni"
                        name="del-{{$item->id}}"
                        ok_button_action="deletePenghuni({{ $item->id }})"
                        ok_button_label="Hapus"
                    >
                        <form id="delete-form-{{$item->id}}" method="POST" action="{{ route('penghuni.destroy', $item->id) }}" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                        <span class="text-red-500 font-semibold">Apakah Anda yakin ingin menghapus data ini?</span> <br> <br>
                        <span class="">NB: Ketika anda menghapus penghuni, anda juga  mengeluarkan penghuni dari rumah yang dihuni!</span>
                    </x-bladewind::modal>
                @endforeach
            </tbody>
        </x-bladewind::table>


        {{-- Modal Tambah Penghuni --}}
        <x-bladewind::modal
            title="Tambah Penghuni"
            backdrop_can_close="false"
            name="form-tambah"
            ok_button_action="tambahPenghuni()"
            ok_button_label="Tambah"
            cancel_button_label="Batal"
            close_after_action="false"
            blur_size="small"
            size="large"
        >
            <form method="post" action="{{ route('penghuni.store')}}" class="form-tambah overflow-auto max-h-screen" enctype="multipart/form-data">
                @csrf
                <div class="gap-4 mt-2">
                    <x-bladewind::input
                        required="true"
                        name="nama_lengkap"
                        error_message="Masukkan Nama Lengkap"
                        label="Nama Penghuni"
                    />
                    <x-bladewind::dropdown
                        required="true"
                        name="rumah_id"
                        placeholder="Alamat Rumah"
                        searchable="true"
                        :data="$alamat_rumah"
                    />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::dropdown
                        required="true"
                        name="status_penghuni"
                        placeholder="Status Penghuni"
                        :data="$status_penghuni"
                    />
                    <x-bladewind::dropdown
                        required="true"
                        name="status_menikah"
                        placeholder="Status Pernikahan"
                        :data="$status_menikah"
                    />
                </div>
                <div class="gap-4 mt-2">
                    <x-bladewind::input
                        required="true"
                        name="nomor_telepon"
                        error_message="Masukkan Nomor Telepon"
                        label="Nomor Telepon"
                    />
                    <x-bladewind::filepicker
                        name="foto_ktp"
                        required="true"
                        accepted_file_types="image/*"
                        placeholder="Upload Foto KTP"  />
                </div>
            </form>
        </x-bladewind::modal>
    </div>
@endsection

@section('script')
    <script>
        const  tambahPenghuni = () => {
            if (validateForm('.form-tambah')) {
                domEl('.form-tambah').submit();
            }
        }
        const deletePenghuni = (id) => {
            const form = document.getElementById(`delete-form-${id}`);
            if (form) {
                form.submit();
            }
        }

        const editPenghuni = (id) => {
            const form = domEl(`.form-edit-${id}`);
            if (validateForm(form)) {
                form.submit();
            }
        }

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showNotification('Gagal', '{{ $error }}', 'error');
            @endforeach
        @endif

        @if (session('success_tambah'))
            showNotification('Berhasil ', 'Penghuni Berhasil Ditambahkan', 'success');
        @endif

        @if (session('success_edit'))
            showNotification('Berhasil ', 'Penghuni Berhasil Diubah', 'success');
        @endif

        @if (session('success_hapus'))
            showNotification('Berhasil', 'Penghuni Berhasil Dihapus', 'success');
        @endif
    </script>
@endsection
