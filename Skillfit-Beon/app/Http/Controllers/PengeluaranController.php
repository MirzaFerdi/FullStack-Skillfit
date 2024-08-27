<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\RukunTetangga;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::all();

        return view('pengeluaran.index', compact('pengeluaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'keterangan' => 'required|string',
            'nominal' => 'required|numeric',
        ]);

        $rukun_tetangga = RukunTetangga::find(1);

        if (!$rukun_tetangga) {
            return redirect()->back()->withErrors(['error' => 'Rukun Tetangga tidak ditemukan']);
        }

        if ($rukun_tetangga->saldo < $request->nominal) {
            return redirect()->back()->withErrors(['error' => 'Saldo tidak mencukupi']);
        }

        $pengeluaran = new Pengeluaran();
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->nominal = $request->nominal;
        $pengeluaran->tanggal = now();

        $rukun_tetangga->saldo -= $request->nominal;
        $rukun_tetangga->save();

        $pengeluaran->save();


        return redirect()->route('pengeluaran')->with('success_tambah', 'Pengeluaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengeluaran = Pengeluaran::find($id);

        return view('pengeluaran.show', compact('pengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'keterangan_' . $id => 'required|string',
            'nominal_' . $id => 'required|numeric',
        ]);

        $pengeluaran = Pengeluaran::find($id);

        if (!$pengeluaran) {
            return redirect()->back()->withErrors(['error' => 'Pengeluaran tidak ditemukan']);
        }

        $rukun_tetangga = RukunTetangga::find(1);

        if (!$rukun_tetangga) {
            return redirect()->back()->withErrors(['error' => 'Rukun Tetangga tidak ditemukan']);
        }

        $oldNominal = $pengeluaran->nominal;
        $newNominal = $request->input('nominal_' . $id);

        $pengeluaran->keterangan = $request->input('keterangan_' . $id);
        $pengeluaran->nominal = $newNominal;
        $pengeluaran->tanggal = now();
        $pengeluaran->save();

        $rukun_tetangga->saldo += $oldNominal - $newNominal;
        $rukun_tetangga->save();

        return redirect()->route('pengeluaran')->with('success_edit', 'Pengeluaran berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);

        if (!$pengeluaran) {
            return redirect()->back()->withErrors(['error' => 'Pengeluaran tidak ditemukan']);
        }

        $rukun_tetangga = RukunTetangga::find(1);

        if (!$rukun_tetangga) {
            return redirect()->back()->withErrors(['error' => 'Rukun Tetangga tidak ditemukan']);
        }

        $rukun_tetangga->saldo += $pengeluaran->nominal;
        $rukun_tetangga->save();

        $pengeluaran->delete();

        return redirect()->route('pengeluaran')->with('success_hapus', 'Pengeluaran berhasil dihapus dan saldo diperbarui');
    }
}
