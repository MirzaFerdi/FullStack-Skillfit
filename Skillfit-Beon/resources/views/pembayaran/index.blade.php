@extends('layouts.main')

@section('content')
    <div class="p-6">
        <x-bladewind::notification />
        <?php
            $status_pembayaran = [
                ['label' => 'Lunas','value' => 'Lunas'],
                ['label' => 'Belum Lunas', 'value' => 'Belum Lunas'],
            ];
            $data_penghuni = [];
            foreach ($penghuni as $item) {
                $data_penghuni[] = [
                    'label' => $item->nama_lengkap,
                    'value' => $item->id,
                ];
            }

            $data_iuran = [];
            foreach ($iuran as $item) {
                $data_iuran[] = [
                    'label' => $item->jenis_iuran,
                    'value' => $item->id,
                ];
            }
        ?>
        <h1 class="text-2xl font-bold mb-2">Manajemen Pembayaran</h1>
        <div class="grid grid-cols-3">
            <p class="col-span-2 mb-4">
                Pada halaman ini, anda dapat melihat informasi terkait pembayaran iuran penghuni. Anda dapat menambahkan pembayaran baru, memperbarui informasi pembayaran yang sudah ada, serta melihat detail informasi pembayaran yang terdaftar.
            </p>
        </div>

        <div class="flex justify-between items-center mb-6">
            <x-bladewind::button show_close_icon="true" onclick="showModal('form-tambah')">
                Tambah Pembayaran
            </x-bladewind::button>
        </div>

        <x-bladewind::table compact="true" celled="true" no_data_message="Data Pembayaran Kosong" message_as_empty_state="true"
            has_shadow="true" divider="thin">
            <x-slot name="header">
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama Penghuni</th>
                <th class="border border-gray-300 px-4 py-2">Alamat Rumah</th>
                <th class="border border-gray-300 px-4 py-2">Jenis Iuran</th>
                <th class="border border-gray-300 px-4 py-2">Jumlah Bayar</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal Bayar</th>
                <th class="border border-gray-300 px-4 py-2">Status Pembayaran</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </x-slot>
            <tbody>
                @foreach ($pembayaran as $item)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->penghuni->nama_lengkap }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->penghuni->rumah->alamat }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->iuran->jenis_iuran }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rp. {{ $item->jumlah }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->tanggal }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($item->status == 'Lunas')
                                <span class="bg-green-200 text-green-800 rounded-full px-2 py-1">{{ $item->status }}</span>
                            @else
                                <span class="bg-red-200 text-red-800 rounded-full px-2 py-1">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <x-bladewind::button uppercasing="false" type="primary" size="tiny"
                                name="{{ $item->id }}" has_spinner="true" can_submit="true" color="gray"
                                class="" onclick="showModal('form-edit-{{ $item->id }}')">
                                Ubah
                            </x-bladewind::button>
                        </td>
                    </tr>

                    {{-- Modal Edit Pembayaran --}}
                    <x-bladewind::modal
                        title="Ubah Pembayaran"
                        backdrop_can_close="false"
                        name="form-edit-{{ $item->id }}"
                        ok_button_action="editPembayaran({{ $item->id }})"
                        ok_button_label="Ubah"
                        cancel_button_label="Batal"
                        close_after_action="false"
                        blur_size="small"
                        size="large">
                        <form method="post" action="{{ route('pembayaran.update', $item->id) }}" enctype="multipart/form-data" class="form-edit-{{ $item->id }}">
                            @csrf
                            @method('PUT')
                            <div class="gap-4 mt-2">
                                <x-bladewind::dropdown
                                    required="true"
                                    name="penghuni_id_{{$item->id}}"
                                    placeholder="Pilih Penghuni"
                                    searchable="true"
                                    :data="$data_penghuni"
                                    selected-value="{{ $item->penghuni_id }}" />
                                <x-bladewind::dropdown
                                    required="true"
                                    name="iuran_id_{{$item->id}}"
                                    placeholder="Jenis Iuran"
                                    :data="$data_iuran"
                                    selected-value="{{ $item->iuran_id }}" />
                                <x-bladewind::input
                                    required="true"
                                    name="jumlah"
                                    error_message="Masukkan Jumlah Pembayaran"
                                    label="Berapa Bulan"
                                    value="{{ $item->jumlah / $item->iuran->nominal }}" />
                                <x-bladewind::dropdown
                                    required="true"
                                    name="status_{{$item->id}}"
                                    placeholder="Status Pembayaran"
                                    :data="$status_pembayaran"
                                    selected-value="{{ $item->status }}" />
                            </div>
                        </form>
                    </x-bladewind::modal>
                @endforeach
            </tbody>
        </x-bladewind::table>
        {{-- Modal Tambah Pembayaran --}}
        <x-bladewind::modal
            title="Tambah Pembayaran"
            backdrop_can_close="false"
            name="form-tambah"
            ok_button_action="tambahPembayaran()"
            ok_button_label="Tambah"
            cancel_button_label="Batal"
            close_after_action="false"
            blur_size="small"
            size="large">
            <form method="post" action="{{ route('pembayaran.store') }}"  enctype="multipart/form-data" class="form-tambah">
                @csrf
                <div class="gap-4 mt-2">
                    <x-bladewind::dropdown
                        required="true"
                        name="penghuni_id"
                        placeholder="Pilih Penghuni"
                        searchable="true"
                        :data="$data_penghuni" />
                    <x-bladewind::dropdown
                        required="true"
                        name="iuran_id"
                        placeholder="Jenis Iuran"
                        :data="$data_iuran" />
                    <x-bladewind::input
                        required="true"
                        name="jumlah"
                        error_message="Masukkan Jumlah Pembayaran"
                        label="Berapa Bulan" />
                    <x-bladewind::dropdown
                        required="true"
                        name="status"
                        placeholder="Status Pembayaran"
                        :data="$status_pembayaran" />
                </div>
            </form>
        </x-bladewind::modal>
    </div>
@endsection

@section('script')
    <script>
        const tambahPembayaran = () => {
            const form = document.querySelector('.form-tambah');
            form.submit();
        }

        const editPembayaran = (id) => {
            const form = document.querySelector(`.form-edit-${id}`);
            form.submit();
        }

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showNotification('Gagal', '{{ $error }}', 'error');
            @endforeach
        @endif

        @if (session('success_tambah'))
            showNotification('Berhasil ', 'Pembayaran Berhasil Ditambahkan', 'success');
        @endif

        @if (session('success_edit'))
            showNotification('Berhasil ', 'Pembayaran Berhasil Diubah', 'success');
        @endif
    </script>
@endsection
