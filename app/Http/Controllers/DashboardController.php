<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'total'     => Pengaduan::count(),
            'hariIni'   => Pengaduan::whereDate('created_at', today())->count(),
            'mingguIni' => Pengaduan::where('created_at', '>=', now()->subDays(7))->count(),
            'customer'  => User::where('role', 'customer')->count(),
            'terbaru'   => Pengaduan::with('kategori')->latest()->take(5)->get(),
            'akunBaru'  => User::withCount('pengaduan')->latest()->take(5)->get(),
        ]);
    }
}