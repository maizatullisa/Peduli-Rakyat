<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $req)
    {
        $v = Validator::make($req->all(), [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|string|min:6|confirmed',
            'nik'                   => 'required|string|unique:users',
            'alamat'                => 'required|string',
            'no_kk'                 => 'required|string',
            'lat'                   => 'nullable|numeric',
            'lng'                   => 'nullable|numeric',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 422);
        }

        $user = User::create([
            'name'     => $req->name,
            'email'    => $req->email,
            'password' => Hash::make($req->password),
            'nik'      => $req->nik,
            'alamat'   => $req->alamat,
            'no_kk'    => $req->no_kk,
            'lat'      => $req->lat,
            'lng'      => $req->lng,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }

    // LOGIN
    public function login(Request $req)
    {
        $req->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $req->email)->first();

        if (! $user || ! Hash::check($req->password, $user->password)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 200);
    }

    // LOGOUT
    public function logout(Request $req)
    {
        $req->user()->tokens()->delete();
        return response()->json(['message' => 'Logout berhasil'], 200);
    }

    // GET lokasi semua pengguna (yang sudah mengisi data lokasi)
public function lokasiPengguna()
{
    $users = User::select('name', 'alamat', 'lat', 'lng')
        ->whereNotNull('lat')
        ->whereNotNull('lng')
        ->get();

    return response()->json($users);
}

}
