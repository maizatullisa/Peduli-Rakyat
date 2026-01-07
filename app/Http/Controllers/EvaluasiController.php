<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghasilan;
use App\Models\KebutuhanPokok;
use App\Models\KebutuhanPendidikan;

class EvaluasiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $penghasilan = Penghasilan::where('user_id', $user->id)->latest('tanggal')->first();
        $kebutuhanPokok = KebutuhanPokok::where('user_id', $user->id)->latest()->first();
        $kebutuhanPendidikan = KebutuhanPendidikan::where('user_id', $user->id)->latest()->first();

        if (! $penghasilan || ! $kebutuhanPokok) {
            return response()->json(['message' => 'Data belum lengkap untuk evaluasi'], 422);
        }

        $totalPengeluaran =
            ($kebutuhanPokok->beras ?? 0) +
            ($kebutuhanPokok->minyak ?? 0) +
            ($kebutuhanPokok->gas ?? 0) +
            ($kebutuhanPokok->listrik ?? 0) +
            ($kebutuhanPokok->air ?? 0) +
            ($kebutuhanPokok->kesehatan ?? 0);

        if ($kebutuhanPendidikan) {
            $totalPendidikan =
                ($kebutuhanPendidikan->jumlah_anak ?? 0) * ($kebutuhanPendidikan->spp_per_anak ?? 0) +
                ($kebutuhanPendidikan->transport ?? 0) +
                ($kebutuhanPendidikan->buku ?? 0);

            $totalPengeluaran += $totalPendidikan;
        }

        $status = $penghasilan->gaji < $totalPengeluaran ? 'Tidak Mampu' : 'Mampu';

        return response()->json([
            'status' => $status,
            'penghasilan' => $penghasilan->gaji,
            'pengeluaran' => $totalPengeluaran
        ]);
    }
}