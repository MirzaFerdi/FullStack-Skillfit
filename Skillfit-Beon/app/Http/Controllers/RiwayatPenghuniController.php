<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use App\Models\RiwayatPenghuni;
use App\Models\Rumah;
use Illuminate\Http\Request;

class RiwayatPenghuniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riwayatPenghuni = RiwayatPenghuni::with('penghuni', 'rumah')->get();

        return view('riwayatpenghuni.index', compact('riwayatPenghuni'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rumah = Rumah::find($request->rumah_id);
        $penghuni = Penghuni::find($request->penghuni_id);
        if (!$rumah) {
            return redirect()->back()->withErrors(['error' => 'Rumah tidak ditemukan']);
        }

        if (!$penghuni) {
            return redirect()->back()->withErrors(['error' => 'Penghuni tidak ditemukan']);
        }

        if ($penghuni->rumah_id != $request->rumah_id) {
            return redirect()->back()->withErrors(['error' => 'Penghuni tidak tinggal di rumah tersebut']);
        }


        $rumah->status_rumah = 'Kosong';
        $rumah->save();

        $penghuni->status_penghuni = 'Keluar';
        $penghuni->save();


        $riwayatPenghuni = new RiwayatPenghuni();
        $riwayatPenghuni->penghuni_id = $request->penghuni_id;
        $riwayatPenghuni->rumah_id = $request->rumah_id;
        $riwayatPenghuni->tanggal_masuk = $request->tanggal_masuk;
        $riwayatPenghuni->tanggal_keluar = $request->tanggal_keluar;
        $riwayatPenghuni->save();

        return redirect()->route('riwayat-penghuni.index')->with('success', 'Riwayat penghuni berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $riwayatPenghuni = RiwayatPenghuni::find($id)->with('penghuni', 'rumah')->get();

        return view('riwayat_penghuni.show', compact('riwayatPenghuni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $rumah = Rumah::find($request->rumah_id);
        $penghuni = Penghuni::find($request->penghuni_id);
        $riwayatPenghuni = RiwayatPenghuni::find($id);

        if (!$rumah) {
            return redirect()->back()->withErrors(['error' => 'Rumah tidak ditemukan']);
        }

        if (!$penghuni) {
            return redirect()->back()->withErrors(['error' => 'Penghuni tidak ditemukan']);
        }

        if ($penghuni->rumah_id != $request->rumah_id) {
            return redirect()->back()->withErrors(['error' => 'Penghuni tidak tinggal di rumah tersebut']);
        }

        $riwayatPenghuni->penghuni_id = $request->penghuni_id;
        $riwayatPenghuni->rumah_id = $request->rumah_id;
        $riwayatPenghuni->tanggal_masuk = $request->tanggal_masuk;
        $riwayatPenghuni->tanggal_keluar = $request->tanggal_keluar;
        $riwayatPenghuni->save();

        return redirect()->route('riwayat-penghuni.index')->with('success', 'Riwayat penghuni berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $riwayatPenghuni = RiwayatPenghuni::find($id);

        if (!$riwayatPenghuni) {
            return redirect()->back()->withErrors(['error' => 'Riwayat penghuni tidak ditemukan']);
        }

        $penghuni = Penghuni::find($riwayatPenghuni->penghuni_id);
        $rumah = Rumah::find($riwayatPenghuni->rumah_id);

        if ($penghuni) {
            $penghuni->status_penghuni = 'Tetap';
            $penghuni->save();
        }

        if ($rumah) {
            $rumah->status_rumah = 'Dihuni';
            $rumah->save();
        }

        $riwayatPenghuni->delete();

        return redirect()->route('riwayat-penghuni.index')->with('success', 'Riwayat penghuni berhasil dihapus');
    }
}
