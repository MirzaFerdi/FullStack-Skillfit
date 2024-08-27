@extends('layouts.main')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-2">Manajemen Riwayat Penghuni</h1>
        <div class="grid grid-cols-3">
            <p class="col-span-2 mb-4">
                Pada halaman ini, anda dapat melihat informasi terkait riwayat penghuni yang terdaftar. Anda dapat melihat data penghuni yang pernah tinggal di rumah, termasuk tanggal masuk dan tanggal keluar penghuni.
            </p>
        </div>

        <x-bladewind::table compact="true" celled="true" no_data_message="Data Riwayat Penghuni Kosong" has_shadow="true"
            divider="thin">
            <x-slot name="header">
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama Penghuni</th>
                <th class="border border-gray-300 px-4 py-2">No. HP</th>
                <th class="border border-gray-300 px-4 py-2">Alamat Rumah</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal Masuk</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal Keluar</th>
            </x-slot>
            <tbody>
                @foreach ($riwayatPenghuni as $item)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->nama }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->nomor_telepon }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->rumah->alamat }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->tanggal_masuk }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->tanggal_keluar }}</td>
                    </tr>
                @endforeach
            </tbody>
        </x-bladewind::table>
    </div>
@endsection
