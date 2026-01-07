<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function getProgress()
    {
        $user = Auth::user();
        $filled = 0;
        $total = 3; 

        if ($user->kebutuhanPokok) $filled++;
        if ($user->kebutuhanPendidikan) $filled++;
        if ($user->penghasilan) $filled++;

        $progress = ($filled / $total) * 100;

        return response()->json([
            'progress' => round($progress)
        ]);
    }
}
