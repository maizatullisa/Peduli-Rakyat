<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAllUsers()
    {
        // Ambil semua user beserta penghasilannya
        $users = User::with('penghasilan')->get();

        // Format data yang ingin dikembalikan
        $result = $users->map(function ($user) {
            return [
                'id'      => $user->id,
                'name'    => $user->name,
                'email'   => $user->email,
                'lokasi'  => $user->alamat,
                'status'  => $user->penghasilan && $user->penghasilan->jumlah < 1500000
                              ? 'Tidak Mampu'
                              : 'Mampu'
            ];
        });

        return response()->json($result);
    }

        public function destroy($id)
        {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User berhasil dihapus']);
        }

            public function update(Request $request, $id)
        {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => "required|email|unique:users,email,$id",
                'status' => 'required|in:Mampu,Tidak Mampu',
                'alamat' => 'nullable|string',
                'nik' => 'nullable|string',
                'no_kk' => 'nullable|string',
                'lat' => 'nullable|numeric',
                'lng' => 'nullable|numeric',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
                'alamat' => $request->alamat,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);

            return response()->json([
                'message' => 'User berhasil diupdate',
                'user' => $user,
            ]);
        }
        
        public function toggleChecklist($id)
        {
            $user = User::findOrFail($id);
            $user->is_checked = !$user->is_checked;
            $user->save();

            return response()->json([
                'message' => 'Checklist diperbarui.',
                'is_checked' => $user->is_checked
            ]);
        }

        public function getCheckedUsers()
        {
            $users = User::with('penghasilan')->where('is_checked', true)->get();

            $result = $users->map(function ($user) {
                return [
                    'id'      => $user->id,
                    'name'    => $user->name,
                    'email'   => $user->email,
                    'lokasi'  => $user->alamat,
                    'status'  => $user->penghasilan && $user->penghasilan->jumlah < 1500000
                        ? 'Tidak Mampu'
                        : 'Mampu',
                ];
            });

            return response()->json($result);
        }



}
