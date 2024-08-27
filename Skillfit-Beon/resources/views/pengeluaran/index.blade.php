@extends('layouts.main')

@section('content')
    <div class="p-6">
        <x-bladewind::notification />
        <h1 class="text-2xl font-bold mb-2">Manajemen Pengeluaran</h1>
        <div class="grid grid-cols-3">
            <p class="col-span-2 mb-4">
                Pada halaman ini, anda dapat melihat informasi terkait pengeluaran yang terdaftar. Anda dapat menambahkan pengeluaran baru, memperbarui informasi pengeluaran yang sudah ada, serta melihat detail informasi pengeluaran yang terdaftar.
            </p>
        </div>

        <div class="flex justify-between items-center mb-6">
            <x-bladewind::button show_close_icon="true" onclick="showModal('form-tambah')">
                Tambah Pengeluaran
            </x-bladewind::button>
        </div>

        <x-bladewind::table compact="true" celled="true" no_data_message="Data Pengeluaran Kosong" has_shadow="true"
            divider="thin">
            <x-slot name="header">
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Keterangan Pengeluaran</th>
                <th class="border border-gray-300 px-4 py-2">Jumlah Pengeluaran</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </x-slot>
                <tbody>
                    @foreach ($pengeluaran as $item)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->keterangan }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp. {{ $item->nominal }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->tanggal }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <x-bladewind::button uppercasing="false" type="primary" size="tiny" name="{{ $item->id }}"
                                    has_spinner="true" can_submit="true" color="gray" class=""
                                    onclick="showModal('form-edit-{{ $item->id }}')">
                                    Ubah
                                </x-bladewind::button>
                                <x-bladewind::button uppercasing="false" type="primary" size="tiny" name="{{ $item->id }}"
                                    has_spinner="true" can_submit="true" color="red"
                                    onclick="showModal('form-delete-{{ $item->id }}')">
                                    Hapus
                                </x-bladewind::button>
                            </td>
                        </tr>

                        {{-- Modal Edit Pengeluaran --}}
                        <x-bladewind::modal
                            title="Ubah Pengeluaran"
                            backdrop_can_close="false"
                            name="form-edit-{{ $item->id }}"
                            ok_button_action="editPengeluaran()"
                            ok_button_label="Ubah"
                            cancel_button_label="Batal"
                            close_after_action="false"
                            blur_size="small"
                            size="large">
                            <form method="post" action="{{ route('pengeluaran.update', $item->id) }}" enctype="multipart/form-data" class="form-edit-{{ $item->id }}">
                                @csrf
                                @method('PUT')
                                <div class="gap-4 mt-2">
                                    <x-bladewind::input
                                        required="true"
                                        name="keterangan-{{ $item->id }}"
                                        error_message="Masukkan Keterangan Pengeluaran"
                                        label="Keterangan Pengeluaran"
                                        value="{{ $item->keterangan }}" />
                                    <x-bladewind::input
                                        required="true"
                                        name="nominal-{{ $item->id }}"
                                        error_message="Masukkan Jumlah Pengeluaran"
                                        label="Jumlah Pengeluaran"
                                        value="{{ $item->nominal }}" />
                                </div>
                            </form>
                        </x-bladewind::modal>

                        {{-- Modal Hapus Pengeluaran --}}
                            <x-bladewind::modal
                            size="big"
                            blur_size="small"
                            type="warning"
                            title="Hapus Pengeluaran"
                            name="form-delete-{{$item->id}}"
                            ok_button_action="hapusPengeluaran({{ $item->id }})"
                            ok_button_label="Hapus"
                        >
                            <form id="delete-form-{{$item->id}}" method="POST" action="{{ route('pengeluaran.destroy', $item->id) }}" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <p>Apakah anda yakin ingin menghapus pengeluaran ini?</p>
                        </x-bladewind::modal>
                    @endforeach
                </tbody>
        </x-bladewind::table>
        {{-- Modal Tambah Pengeluaran --}}
        <x-bladewind::modal
            title="Tambah Pengeluaran"
            backdrop_can_close="false"
            name="form-tambah"
            ok_button_action="tambahPengeluaran()"
            ok_button_label="Tambah"
            cancel_button_label="Batal"
            close_after_action="false"
            blur_size="small"
            size="large">
            <form method="post" action="{{ route('pengeluaran.store') }}"  enctype="multipart/form-data" class="form-tambah">
                @csrf
                <div class="gap-4 mt-2">
                    <x-bladewind::input
                        required="true"
                        name="keterangan"
                        error_message="Masukkan Keterangan Pengeluaran"
                        label="Keterangan Pengeluaran" />
                    <x-bladewind::input
                        required="true"
                        name="nominal"
                        error_message="Masukkan Jumlah Pengeluaran"
                        label="Jumlah Pengeluaran" />
                </div>
            </form>
        </x-bladewind::modal>
    </div>
@endsection

@section('script')
    <script>

        const tambahPengeluaran = () => {
            const form = document.querySelector('.form-tambah');
            form.submit();
        }

        const editPengeluaran = (id) => {
            const form = document.querySelector(`.form-edit-${id}`);
            form.submit();
        }

        const hapusPengeluaran = (id) => {
            const form = document.getElementById(`delete-form-${id}`);
            form.submit();
        }

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showNotification('Gagal', '{{ $error }}', 'error');
            @endforeach
        @endif

        @if (session('success_tambah'))
            showNotification('Berhasil ', 'Pengeluaran Berhasil Ditambahkan', 'success');
        @endif

        @if (session('success_edit'))
            showNotification('Berhasil ', 'Pengeluaran Berhasil Diubah', 'success');
        @endif

        @if (session('success_hapus'))
            showNotification('Berhasil', 'Pengeluaran Berhasil Dihapus', 'success');
        @endif
    </script>
@endsection
