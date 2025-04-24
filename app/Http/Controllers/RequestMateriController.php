<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestMateri;

class RequestMateriController extends Controller
{
    public function index()
    {
        // Ambil semua data request dari database
        $requests = RequestMateri::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.request', compact('requests'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string|max:100'
        ]);

        // Simpan data request ke database
        RequestMateri::create($validated);

        return redirect('/materi')->with('success', 'Request anda telah kami terima!');
    }

    public function destroy($id)
    {
        // Cari request berdasarkan ID
        $requestMateri = RequestMateri::find($id);

        // Periksa apakah data ditemukan
        if (!$requestMateri) {
            return redirect()->back()->with('error', 'Request tidak ditemukan.');
        }

        // Hapus data
        $requestMateri->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Request berhasil dihapus.');
    }
}
