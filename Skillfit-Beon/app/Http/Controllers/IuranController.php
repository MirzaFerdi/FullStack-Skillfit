<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iuran = Iuran::all();

        if ($iuran->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data iuran kosong',
            ]);
        }

        return response()->json($iuran);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $iuran = new Iuran();
        $iuran->jenis_iuran = $request->jenis_iuran;
        $iuran->nominal = $request->nominal;
        $iuran->save();

        return response()->json([
            'success' => true,
            'message' => 'Iuran berhasil ditambahkan',
            'data' => $iuran
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $iuran = Iuran::find($id);

        if (!$iuran) {
            return response()->json([
                'success' => false,
                'message' => 'Data iuran tidak ditemukan',
            ]);
        }

        return response()->json($iuran);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $iuran = Iuran::find($id);

        if (!$iuran) {
            return response()->json([
                'success' => false,
                'message' => 'Data iuran tidak ditemukan',
            ]);
        }

        $iuran->jenis_iuran = $request->jenis_iuran;
        $iuran->nominal = $request->nominal;
        $iuran->save();

        return response()->json([
            'success' => true,
            'message' => 'Data iuran berhasil diupdate',
            'data' => $iuran
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $iuran = Iuran::find($id);

        if (!$iuran) {
            return response()->json([
                'success' => false,
                'message' => 'Data iuran tidak ditemukan',
            ]);
        }

        $iuran->delete();


        return response()->json([
            'success' => true,
            'message' => 'Data iuran berhasil dihapus',
        ]);
    }
}
