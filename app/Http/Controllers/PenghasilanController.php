<?php

namespace App\Http\Controllers;

use App\Models\Penghasilan;
use Illuminate\Http\Request;

class PenghasilanController extends Controller
{
    // GET /api/penghasilan
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->penghasilan()->latest()->get()
        );
    }

    // POST /api/penghasilan
    public function store(Request $request)
    {
        $data = $request->validate([
            'gaji' => 'required|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        $item = $request->user()->penghasilan()->create($data);

        return response()->json($item, 201);
    }

    // PUT /api/penghasilan/{id}
    public function update(Request $request, $id)
    {
        $item = $request->user()->penghasilan()->findOrFail($id);

        $data = $request->validate([
            'gaji' => 'required|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        $item->update($data);

        return response()->json([
            'message' => 'Data diperbarui',
            'data' => $item,
        ]);
    }

    // DELETE /api/penghasilan/{id}
    public function destroy(Request $request, $id)
    {
        $item = $request->user()->penghasilan()->findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Data dihapus'], 200);
    }
}
