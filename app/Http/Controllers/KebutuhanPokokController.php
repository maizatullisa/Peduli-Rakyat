<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanPokok;
use Illuminate\Http\Request;

class KebutuhanPokokController extends Controller
{
    // Tampilkan seluruh catatan kebutuhan pokok user
    public function index(Request $request)
    {
        $data = $request->user()
                        ->kebutuhanPokok()
                        ->latest()
                        ->get();

        return response()->json($data, 200);
    }

    // Simpan catatan kebutuhan pokok baru
    public function store(Request $request)
    {
        $attrs = $request->validate([
            'beras'     => 'required|integer|min:0',
            'minyak'    => 'required|integer|min:0',
            'gas'       => 'required|integer|min:0',
            'listrik'   => 'required|integer|min:0',
            'air'       => 'required|integer|min:0',
            'kesehatan' => 'required|integer|min:0',
        ]);

        $need = $request->user()->kebutuhanPokok()->create($attrs);

        return response()->json($need, 201);
    }
}
