<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use App\Models\RiwayatPenghuni;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;

class PenghuniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penghuni = Penghuni::with('rumah')->get();
        $rumah = Rumah::all();

        return view('penghuni.index', compact('penghuni', 'rumah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'rumah_id' => 'required',
            'nama_lengkap' => 'required',
            'foto_ktp' => 'required | max:2048',
            'status_penghuni' => 'required',
            'nomor_telepon' => 'required',
            'status_menikah' => 'required',
        ],[
            'rumah_id.required' => 'Rumah harus diisi',
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'foto_ktp.required' => 'Foto KTP harus diisi',
            'foto_ktp.max' => 'Foto KTP maksimal 2MB',
            'status_penghuni.required' => 'Status penghuni harus diisi',
            'nomor_telepon.required' => 'Nomor telepon harus diisi',
            'status_menikah.required' => 'Status menikah harus diisi',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $penghuni = new Penghuni();
        $penghuni->rumah_id = $request->rumah_id;
        $penghuni->nama_lengkap = $request->nama_lengkap;
        $penghuni->status_penghuni = $request->status_penghuni;
        $penghuni->nomor_telepon = $request->nomor_telepon;
        $penghuni->status_menikah = $request->status_menikah;

        if ($request->hasFile('foto_ktp')) {
            if($penghuni->foto_ktp && Storage::exists('public/foto_ktp/'.$penghuni->foto_ktp)){
                Storage::delete('public/foto_ktp/'.$penghuni->foto_ktp);
            }
            $foto_ktp = $request->file('foto_ktp');
            $file_foto = time().'_'.$foto_ktp->getClientOriginalName();
            $path = $foto_ktp->storeAs('public/foto_ktp', $file_foto);
            $penghuni->foto_ktp = $file_foto;
        }

        $penghuni->save();

        $rumah = Rumah::find($request->rumah_id);
        $rumah->status_rumah = 'Dihuni';
        if ($rumah->status_rumah == 'Dihuni') {
            $rumah->status_rumah = 'Dihuni';
        }
        $rumah->save();


        return redirect()->route('penghuni')->with('success_tambah', 'Data penghuni berhasil ditambahkan');
    }


    public function show($id)
    {
        $penghuni = Penghuni::with('rumah')->find($id);

        return view('penghuni.show', compact('penghuni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'rumah_id_' . $id => 'required',
            'nama_lengkap' => 'required',
            'foto_ktp_' . $id => 'image|max:2048',
            'status_penghuni_' . $id => 'required',
            'nomor_telepon' => 'required',
            'status_menikah_' . $id => 'required',
        ],[
            'rumah_id_' . $id . '.required' => 'Rumah harus diisi',
            'nama_lengkap' => 'Nama lengkap harus diisi',
            'foto_ktp_' . $id . '.image' => 'Foto KTP harus berupa gambar',
            'foto_ktp_' . $id . '.max' => 'Foto KTP maksimal 2MB',
            'status_penghuni_' . $id . '.required' => 'Status penghuni harus diisi',
            'nomor_telepon.required' => 'Nomor telepon harus diisi',
            'status_menikah_' . $id . '.required' => 'Status menikah harus diisi',
        ]);

        try {
            // Temukan penghuni atau lempar pengecualian jika tidak ditemukan
            $penghuni = Penghuni::findOrFail($id);

            // Update data penghuni
            $penghuni->rumah_id = $request->input('rumah_id_' . $id);
            $penghuni->nama_lengkap = $request->input('nama_lengkap');
            $penghuni->status_menikah = $request->input('status_menikah_' . $id);
            $penghuni->status_penghuni = $request->input('status_penghuni_' . $id);
            $penghuni->nomor_telepon = $request->input('nomor_telepon');

            // Proses foto KTP
            $fotoKtpInputName = 'foto_ktp_' . $id;
            if ($request->hasFile($fotoKtpInputName)) {
                // Hapus foto lama jika ada
                if ($penghuni->foto_ktp && Storage::exists('public/foto_ktp/' . $penghuni->foto_ktp)) {
                    Storage::delete('public/foto_ktp/' . $penghuni->foto_ktp);
                }

                // Upload foto baru
                $foto_ktp = $request->file($fotoKtpInputName);
                $file_foto = time() . '_' . $foto_ktp->getClientOriginalName();
                $foto_ktp->storeAs('public/foto_ktp', $file_foto);
                $penghuni->foto_ktp = $file_foto;
            }

            // Simpan perubahan
            $penghuni->save();

            return redirect()->route('penghuni')->with('success_edit', 'Data penghuni berhasil diubah');
        } catch (\Exception $e) {
            // Tangani pengecualian dengan pesan error
            return redirect()->route('penghuni')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $penghuni = Penghuni::findOrFail($id);
            $rumah = Rumah::findOrFail($penghuni->rumah_id);

            if ($penghuni->foto_ktp && Storage::exists('public/foto_ktp/'.$penghuni->foto_ktp)) {
                Storage::delete('public/foto_ktp/'.$penghuni->foto_ktp);
            }

            $penghuni->delete();

            if ($rumah->penghuni()->count() == 0) {
                $rumah->status_rumah = 'Belum Dihuni';
                $rumah->save();
            }

            $riwayatPenghuni = new RiwayatPenghuni();
            $riwayatPenghuni->nama = $penghuni->nama_lengkap;
            $riwayatPenghuni->nomor_telepon = $penghuni->nomor_telepon;
            $riwayatPenghuni->rumah_id = $penghuni->rumah_id;
            $riwayatPenghuni->tanggal_masuk = $penghuni->created_at;
            $riwayatPenghuni->tanggal_keluar = now();
            $riwayatPenghuni->save();

            return redirect()->route('penghuni')->with('success_hapus', 'Data penghuni berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('penghuni')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
