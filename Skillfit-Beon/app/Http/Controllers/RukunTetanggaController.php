<?php

namespace App\Http\Controllers;

use App\Models\RukunTetangga;
use Illuminate\Http\Request;

class RukunTetanggaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rukunTetangga = RukunTetangga::all();

        if($rukunTetangga->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => 'Data rukun tetangga kosong',
            ], 404);
        }

        return response()->json($rukunTetangga);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RukunTetangga $rukunTetangga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RukunTetangga $rukunTetangga)
    {
        //
    }
}
