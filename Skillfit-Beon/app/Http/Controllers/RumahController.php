<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use App\Models\Rumah;
use Illuminate\Http\Request;

class RumahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rumah = Rumah::with('penghuni')->get();
        $penghuni = Penghuni::all();

        return view('rumah.index', compact('rumah', 'penghuni'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'alamat' => 'required|string|max:255|unique:rumah,alamat',
            'status_rumah' => 'required|string',
        ], [
            'alamat.unique' => 'Alamat rumah sudah terdaftar. Silakan gunakan alamat lain.',
        ]);

        $rumah = new Rumah();
        $rumah->alamat = $request->alamat;
        $rumah->status_rumah = $request->status_rumah;
        $rumah->save();

        return redirect()->route('rumah')->with('success_tambah', 'Rumah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rumah = Rumah::find($id)->with('penghuni')->get();
        $penghuni = Penghuni::where('rumah_id', $id)->get();

        return view('rumah.show', compact('rumah', 'penghuni'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {

    //     $validatedData = $request->validate([
    //         'alamat' => 'required|string|max:255',
    //         'status_rumah' => 'required|string',
    //     ]);

    //     $rumah = Rumah::find($id);

    //     if (!$rumah) {
    //         return redirect()->route('rumah.index')->withErrors(['error' => 'Rumah tidak ditemukan']);
    //     }

    //     $rumah->alamat = $request->alamat;
    //     $rumah->status_rumah = $request->status_rumah;
    //     $rumah->save();

    //     return redirect()->route('rumah.index')->with('success', 'Data rumah berhasil diupdate');
    // }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'alamat' => 'required|string|max:255|unique:rumah,alamat',
            'status_rumah_' . $id => 'required|string',
        ], [
            'alamat.unique' => 'Alamat rumah sudah terdaftar. Silakan gunakan alamat lain.',
        ]);

        $rumah = Rumah::find($id);

        if (!$rumah) {
            return redirect()->route('rumah')->withErrors(['error' => 'Rumah tidak ditemukan']);
        }

        $rumah->alamat = $request->alamat;

        $statusKey = 'status_rumah_' . $id;
        if ($request->has($statusKey)) {
            $rumah->status_rumah = $request->input($statusKey);
        }
        $rumah->save();

        return redirect()->route('rumah')->with('success_update', 'Data rumah berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rumah = Rumah::find($id);
        $rumah->delete();

        return redirect()->route('rumah')->with('success', 'Data rumah berhasil dihapus');
    }
}
