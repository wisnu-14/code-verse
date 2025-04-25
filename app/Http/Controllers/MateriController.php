<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\kategori;
use App\Models\SubMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{

    public function index(Request $request)
    {
        $kategoriList = Kategori::all();

        if ($request->has('kategori') && $request->kategori != '') {
            $materis = Materi::with('subMateri', 'kategori')
                ->where('kategori_id', $request->kategori)
                ->paginate(10);
        } else {
            $materis = Materi::with('subMateri', 'kategori')
                ->paginate(10);
        }
        $categories = Kategori::all();
        $topViewedMateriByCategory = [];
        foreach ($categories as $category) {
            $topViewedMateriByCategory[$category->id] = Materi::where('kategori_id', $category->id)
                ->orderBy('views', 'desc')
                ->take(5)
                ->get();
        }
        return view('materi.index', compact('materis', 'kategoriList', 'topViewedMateriByCategory'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.materi', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'kategori_id' => 'nullable|string|max:255',
            'sub_judul.*' => 'nullable|string',
            'penjelasan.*' => 'nullable|string',
            'kode_sub_materi.*' => 'nullable|string',
            'penjelasan_kode.*' => 'nullable|string',
            'foto_sub_materi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,avif',
        ]);

        // Proses upload cover materi
        $foto_nama = null;

        if ($request->hasFile('cover')) {
            $foto_file = $request->file('cover');

            // Buat nama file custom: ymdhis.ext
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;

            // Simpan ke storage/app/public/cover dengan nama tersebut
            $foto_file->storeAs('cover', $foto_nama, 'public');
        }


        // Simpan data materi jika judul atau deskripsi diisi
        $materi = null;
        if ($request->judul || $request->deskripsi || $foto_nama || $request->kategori_id) {
            $materi = Materi::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'cover' => $foto_nama,
                'kategori_id' => $request->kategori_id,
            ]);
        }

        // Simpan data sub-materi jika ada isian
        foreach ($request->sub_judul ?? [] as $index => $subJudul) {
            if ($subJudul || $request->penjelasan[$index] || $request->kode_sub_materi[$index] || $request->penjelasan_kode[$index] || $request->hasFile("foto_sub_materi.$index")) {
                $subFotoNama = null;

                if ($request->hasFile("foto_sub_materi.$index")) {
                    $subFotoFile = $request->file("foto_sub_materi.$index");
                    $subFotoNama = date('ymdhis') . "_sub_" . $index . "." . $subFotoFile->extension();

                    $subFotoFile->storeAs('sub_foto', $subFotoNama, 'public');
                }


                SubMateri::create([
                    'materi_id' => $materi->id ?? null, // Tetap simpan jika materi tidak ada
                    'sub_judul' => $subJudul ?? null,
                    'penjelasan' => $request->penjelasan[$index],
                    'kode' => $request->kode_sub_materi[$index],
                    'penjelasan_kode' => $request->penjelasan_kode[$index],
                    'foto' => $subFotoNama,
                ]);
            }
        }

        return redirect('/manage-materi')->with('success', 'Materi berhasil ditambahkan!');
    }


    public function show($id)
    {
        $materi = Materi::with('subMateri')->findOrFail($id);

        // Paginasi untuk subMateri
        $subMateri = $materi->subMateri()->paginate(10);  // Gantilah 5 dengan jumlah item per halaman
        if ($subMateri->isEmpty()) {
            return redirect()->back()->with('error', 'Upss materi tidak tersedia.');
        }

        $categories = Kategori::all();

        // Fetch top 3 most viewed materials for each category
        $topViewedMateriByCategory = [];
        foreach ($categories as $category) {
            $topViewedMateriByCategory[$category->id] = Materi::where('kategori_id', $category->id)
                ->orderBy('views', 'desc')
                ->take(5)
                ->get();
        }

        return view('materi.show', compact('materi', 'subMateri', 'topViewedMateriByCategory'));
    }


    public function edit(Materi $materi)
    {
        $kategoris = Kategori::all();
        return view('materi.edit', compact('materi', 'kategoris'));
    }

    public function update(Request $request, Materi $materi)
    {
        // Validasi data
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sub_judul' => 'array',
            'sub_judul.*' => 'nullable|string|max:255',
            'penjelasan.*' => 'nullable|string',
            'kode_sub_materi.*' => 'nullable|string',
            'penjelasan_kode.*' => 'nullable|string',
            'foto_sub_materi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        // Data materi yang akan di-update
        $materiData = $request->only(['judul', 'deskripsi', 'kategori_id']);

        // Update cover jika ada file baru
        if ($request->hasFile('cover')) {
            // Hapus foto lama jika ada
            if ($materi->cover && Storage::disk('public')->exists('cover/' . $materi->cover)) {
                Storage::disk('public')->delete('cover/' . $materi->cover);
            }

            // Upload foto cover baru
            $coverFile = $request->file('cover');
            $coverName = date('ymdhis') . '.' . $coverFile->extension();

            $coverFile->storeAs('cover', $coverName, 'public'); // Simpan ke storage/app/public/cover

            $materiData['cover'] = $coverName; // Simpan nama foto baru ke database
        }


        // Update materi
        $materi->update($materiData);

        // Meng-update atau membuat sub-materi
        foreach ($request->sub_judul ?? [] as $index => $subJudul) {
            $subMateriId = $request->sub_materi_id[$index] ?? null; // ID sub-materi untuk update

            // Menangani foto sub-materi
            $fotoSubMateri = null;

            if ($request->hasFile("foto_sub_materi.$index")) {
                // Hapus foto lama jika ada
                if ($subMateriId && ($existingSubMateri = SubMateri::find($subMateriId))) {
                    // Cek apakah file ada di storage dan hapus
                    $fotoPath = 'sub_foto/' . $existingSubMateri->foto;
                    if (Storage::disk('public')->exists($fotoPath)) {
                        Storage::disk('public')->delete($fotoPath); // Hapus file foto lama
                    }
                }
            
                // Upload foto sub-materi baru
                $file = $request->file("foto_sub_materi.$index");
                $fotoSubMateri = date('ymdhis') . "_sub_" . $index . "." . $file->extension();
            
                // Simpan foto baru ke storage/app/public/sub_foto
                $file->storeAs('sub_foto', $fotoSubMateri, 'public'); // Menggunakan storage
            }
            // Update atau buat sub-materi baru
            SubMateri::updateOrCreate(
                ['materi_id' => $materi->id, 'id' => $subMateriId], // ID sub-materi jika ada
                [
                    'sub_judul' => $subJudul->sub_judul ?? null, // Simpan null jika kosong
                    'penjelasan' => $request->penjelasan[$index] ?? null,
                    'kode' => $request->kode_sub_materi[$index] ?? null,
                    'penjelasan_kode' => $request->penjelasan_kode[$index] ?? null,
                    'foto' => $fotoSubMateri ?? SubMateri::find($subMateriId)->foto ?? null, // Jika tidak ada foto baru, pakai foto lama
                ]
            );
        }


        // Menghapus sub-materi yang dipilih
        if ($request->has('delete_sub_materi')) {
            SubMateri::whereIn('id', $request->delete_sub_materi)->each(function ($subMateri) {
                // Hapus foto sub-materi jika ada
                if ($subMateri->foto && file_exists(public_path('sub_foto/' . $subMateri->foto))) {
                    unlink(public_path('sub_foto/' . $subMateri->foto));
                }
                // Hapus sub-materi
                $subMateri->delete();
            });
        }

        return redirect(url('/materi/' . $materi->id))
            ->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Materi $materi)
    {
        if ($materi) {
            // Hapus cover foto jika ada
            if ($materi->cover && Storage::disk('public')->exists('cover/' . $materi->cover)) {
                Storage::disk('public')->delete('cover/' . $materi->cover); // Hapus file cover
            }
        
            // Hapus semua sub-foto yang terkait dengan materi
            foreach ($materi->subMateri as $sub) {
                if ($sub->foto && Storage::disk('public')->exists('sub_foto/' . $sub->foto)) {
                    Storage::disk('public')->delete('sub_foto/' . $sub->foto); // Hapus file sub foto
                }
            }
        
            // Hapus materi (data lainnya)
            $materi->delete();
        }
        
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
