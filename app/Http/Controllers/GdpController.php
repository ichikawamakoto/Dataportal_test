<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class GdpController extends Controller
{
    public function index(Request $request)
    {
        DB::enableQueryLog();
        $query = User::query();
        if ($request->date_start) {
            $query->where('created_at', '>=', $request->date_start);
        }
        if ($request->date_end) {
            $query->where('created_at', '<=', $request->date_end);
        }
        $rows = $query
            ->select(DB::raw('id, DATE(created_at) as date_created'))
            ->orderBy('created_at')
            ->get();
        Log::debug(DB::getQueryLog());
    }
}
