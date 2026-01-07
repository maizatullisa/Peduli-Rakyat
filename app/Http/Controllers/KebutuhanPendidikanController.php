<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanPendidikan;
use Illuminate\Http\Request;

class KebutuhanPendidikanController extends Controller
{
    // Tampilkan semua catatan kebutuhan pendidikan user
    public function index(Request $request)
    {
        $data = $request->user()
                        ->kebutuhanPendidikan()
                        ->latest()
                        ->get();

        return response()->json($data, 200);
    }

    // Simpan catatan kebutuhan pendidikan baru
    public function store(Request $request)
    {
        $attrs = $request->validate([
            'jumlah_anak'   => 'required|integer|min:0',
            'spp_per_anak'  => 'required|integer|min:0',
            'transport'     => 'required|integer|min:0',
            'buku'          => 'required|integer|min:0',
            'pendapatan'    => 'required|integer|min:0',
        ]);

        $need = $request->user()
                        ->kebutuhanPendidikan()
                        ->create($attrs);

        return response()->json($need, 201);
    }
}
