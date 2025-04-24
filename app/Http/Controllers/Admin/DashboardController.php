<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\kategori;
use App\Models\Materi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data kategori dan jumlah materi
        $data = Kategori::withCount('materis')
            ->get()
            ->map(function ($kategori) {
                return [
                    'kategori' => $kategori->nama,
                    'jumlah' => $kategori->materis_count,
                ];
            });

        // Ambil data views per kategori
        $views = DB::table('materi')
            ->join('kategoris', 'materi.kategori_id', '=', 'kategoris.id')  // Menggabungkan tabel materi dengan kategoris
            ->select('kategoris.nama as kategori', DB::raw('SUM(materi.views) as total_views'))  // Ambil nama kategori dan jumlah views
            ->groupBy('materi.kategori_id')  // Kelompokkan berdasarkan kategori_id
            ->get()
            ->map(function ($view) {
                return [
                    'kategori' => $view->kategori,  // Nama kategori
                    'total_views' => $view->total_views,  // Jumlah views per kategori
                ];
            });

        $visitors = DB::table('visitors')
            ->select(DB::raw('DATE(visited_at) as visit_date'), DB::raw('count(id) as total_visitors'))
            ->groupBy(DB::raw('DATE(visited_at)'))
            ->where('visited_at', '>=', Carbon::now()->subWeek()) // Ambil data seminggu terakhir
            ->orderBy('visit_date', 'asc')
            ->get();

        // Kirim data ke view

        // Ambil jumlah total materi
        $materiCount = Materi::count();  // Menghitung total jumlah materi di tabel materi

        //mengambil user dengan role admin,author
        $users = User::whereIn('role', ['author', 'admin'])->get();

        return view('admin.index', compact('data', 'views', 'visitors', 'materiCount', 'users'));
    }

    public function user()
    {
        $users = User::select('id', 'name', 'email', 'role', 'created_at', 'updated_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.user', compact('users'));
    }

    public function manageMateri()
    {
        return view('admin.materi');
    }
}
