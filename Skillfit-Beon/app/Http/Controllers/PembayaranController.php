<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Pembayaran;
use App\Models\Penghuni;
use App\Models\RukunTetangga;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        $penghuni = Penghuni::all();
        $iuran = Iuran::all();

        return view('pembayaran.index', compact('pembayaran', 'penghuni', 'iuran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'penghuni_id' => 'required|integer',
            'iuran_id' => 'required|integer',
            'jumlah' => 'required|integer',
            'status' => 'required|string',
        ]);

        $iuran = Iuran::find($request->iuran_id);

        if (!$iuran) {
            return redirect()->back()->withErrors(['error' => 'Iuran tidak ditemukan']);
        }

        $pembayaran = new Pembayaran();
        $pembayaran->penghuni_id = $request->penghuni_id;
        $pembayaran->iuran_id = $request->iuran_id;
        $pembayaran->jumlah = $iuran->nominal * $request->jumlah;
        $pembayaran->tanggal = now();
        $pembayaran->status = $request->status;

        $rukun_tetangga = RukunTetangga::find(1);

        if (!$rukun_tetangga) {
            return redirect()->back()->withErrors(['error' => 'Rukun Tetangga tidak ditemukan']);
        }

        $rukun_tetangga->saldo += $pembayaran->jumlah;
        $rukun_tetangga->save();

        $pembayaran->save();

        return redirect()->route('pembayaran')->with('success_tambah', 'Pembayaran berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::find($id);

        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'penghuni_id_' . $id => 'required|integer',
            'iuran_id_' . $id => 'required|integer',
            'jumlah' => 'required|integer',
            'status_' . $id => 'required|string',
        ]);

        $pembayaran = Pembayaran::find($id);
        if (!$pembayaran) {
            return redirect()->back()->withErrors(['error' => 'Pembayaran tidak ditemukan']);
        }

        $iuran = Iuran::find($request->input('iuran_id_' . $id));
        if (!$iuran) {
            return redirect()->back()->withErrors(['error' => 'Iuran tidak ditemukan']);
        }

        $rukun_tetangga = RukunTetangga::find(1);
        if (!$rukun_tetangga) {
            return redirect()->back()->withErrors(['error' => 'Rukun Tetangga tidak ditemukan']);
        }

        $oldJumlah = $pembayaran->jumlah;
        $oldSaldo = $rukun_tetangga->saldo;

        $pembayaran->penghuni_id = $request->input('penghuni_id_' . $id);
        $pembayaran->iuran_id = $request->input('iuran_id_' . $id);
        $pembayaran->jumlah = $iuran->nominal * $request->jumlah;
        $pembayaran->tanggal = now();
        $pembayaran->status = $request->input('status_' . $id);

        $rukun_tetangga->saldo = $oldSaldo - $oldJumlah + $pembayaran->jumlah;
        $rukun_tetangga->save();

        $pembayaran->save();


        return redirect()->route('pembayaran')->with('success_edit', 'Pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return redirect()->route('pembayaran')->withErrors(['error' => 'Pembayaran tidak ditemukan']);
        }

        $rukun_tetangga = RukunTetangga::find($pembayaran->rukun_tetangga_id);
        $iuran = Iuran::find($pembayaran->iuran_id);

        if (!$rukun_tetangga) {
            return redirect()->route('pembayaran')->withErrors(['error' => 'Rukun Tetangga tidak ditemukan']);
        }

        if (!$iuran) {
            return redirect()->route('pembayaran')->withErrors(['error' => 'Iuran tidak ditemukan']);
        }

        $oldJumlah = $pembayaran->jumlah;
        $oldSaldo = $rukun_tetangga->saldo;

        $rukun_tetangga->saldo = $oldSaldo - $oldJumlah;
        $rukun_tetangga->save();

        $pembayaran->delete();

        return redirect()->route('pembayaran')->with('success', 'Data pembayaran berhasil dihapus');
    }
}
