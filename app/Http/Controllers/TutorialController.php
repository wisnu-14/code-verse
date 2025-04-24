<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\SubTutorial;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{

    public function index(Request $request)
    {
        $kategoriList = Kategori::all();

        if ($request->has('kategori') && $request->kategori != '') {
            $tutorials = Tutorial::with('subTutorials', 'kategori')
                ->where('kategori_id', $request->kategori)
                ->paginate(10);
        } else {
            $tutorials = Tutorial::with('subTutorials', 'kategori')
                ->paginate(10);
        }
        return view('tutorial.index', compact('tutorials', 'kategoriList'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.tutorial', compact('kategoris'));
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
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('cover'), $foto_nama);
        }

        // Simpan data materi jika judul atau deskripsi diisi
        $tutorial = null;
        if ($request->judul || $request->deskripsi || $foto_nama || $request->kategori_id) {
            $tutorial = Tutorial::create([
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
                    $subFotoFile->move(public_path('sub_foto'), $subFotoNama);
                }
                SubTutorial::create([
                    'tutorial_id' => $tutorial->id ?? null, // Tetap simpan jika materi tidak ada
                    'sub_judul' => $subJudul ?? null,
                    'penjelasan' => $request->penjelasan[$index],
                    'kode' => $request->kode_sub_materi[$index],
                    'penjelasan_kode' => $request->penjelasan_kode[$index],
                    'foto' => $subFotoNama,
                ]);
            }
        }
        return redirect('/manageTutorial')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Mengambil data tutorial beserta kategori
        $tutorial = Tutorial::with('kategori')->findOrFail($id);

        // Paginasi untuk subTutorials berdasarkan tutorial_id
        $subTutorial = SubTutorial::where('tutorial_id', $id)->paginate(5);

        if ($subTutorial->isEmpty()) {
            return redirect('/tutorial')->with('error', 'Upss belum ada isinya!');
        }

        // Mengambil kategori untuk menampilkan materi populer
        $categories = Kategori::all();
        $topViewedTutorialByCategory = [];
        foreach ($categories as $category) {
            $topViewedTutorialByCategory[$category->id] = Tutorial::where('kategori_id', $category->id)
                ->orderBy('views', 'desc')
                ->take(3)
                ->get();
        }

        return view('tutorial.show', compact('tutorial', 'subTutorial', 'topViewedTutorialByCategory'));
    }



    public function edit(Tutorial $tutorial)
    {
        $kategoris = Kategori::all();
        return view('tutorial.edit', compact('tutorial', 'kategoris'));
    }

    public function update(Request $request, Tutorial $tutorial)
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
        $tutorialData = $request->only(['judul', 'deskripsi', 'kategori_id']);

        // Update cover jika ada file baru
        if ($request->hasFile('cover')) {
            // Hapus foto lama jika ada
            if ($tutorial->cover && file_exists(public_path('cover/' . $tutorial->cover))) {
                unlink(public_path('cover/' . $tutorial->cover));
            }

            // Upload foto cover baru
            $coverFile = $request->file('cover');
            $coverName = date('ymdhis') . '.' . $coverFile->extension();
            $coverFile->move(public_path('cover'), $coverName);

            $tutorialData['cover'] = $coverName; // Simpan nama foto baru
        }

        // Update materi
        $tutorial->update($tutorialData);

        // Meng-update atau membuat sub-materi
        foreach ($request->sub_judul ?? [] as $index => $subJudul) {
            $subTutorialId = $request->sub_tutorial_id[$index] ?? null; // ID sub-materi untuk update

            // Menangani foto sub-materi
            $fotoSubTutorial = null;
            if ($request->hasFile("foto_sub_materi.$index")) {
                // Hapus foto lama jika ada
                if ($subTutorialId && ($existingSubTutorial = SubTutorial::find($subTutorialId))) {
                    $fotoPath = public_path('sub_foto/' . $existingSubTutorial->foto);
                    if (is_file($fotoPath)) { // Pastikan path adalah file, bukan direktori
                        unlink($fotoPath); // Hapus file foto lama
                    }
                }

                // Upload foto sub-materi baru
                $file = $request->file("foto_sub_materi.$index");
                $fotoSubTutorial = date('ymdhis') . "_sub_" . $index . "." . $file->extension();
                $file->move(public_path('sub_foto'), $fotoSubTutorial); // Simpan foto baru
            }


            // Update atau buat sub-materi baru
            SubTutorial::updateOrCreate(
                ['tutorial_id' => $tutorial->id, 'id' => $subTutorialId], // ID sub-materi jika ada
                [
                    'sub_judul' => $subJudul->sub_judul ?? null, // Simpan null jika kosong
                    'penjelasan' => $request->penjelasan[$index] ?? null,
                    'kode' => $request->kode_sub_materi[$index] ?? null,
                    'penjelasan_kode' => $request->penjelasan_kode[$index] ?? null,
                    'foto' => $fotoSubTutorial ?? SubTutorial::find($subTutorialId)->foto ?? null, // Jika tidak ada foto baru, pakai foto lama
                ]
            );
        }


        // Menghapus sub-materi yang dipilih
        if ($request->has('delete_sub_materi')) {
            SubTutorial::whereIn('id', $request->delete_sub_materi)->each(function ($subTutorial) {
                // Hapus foto sub-materi jika ada
                if ($subTutorial->foto && file_exists(public_path('sub_foto/' . $subTutorial->foto))) {
                    unlink(public_path('sub_foto/' . $subTutorial->foto));
                }
                // Hapus sub-materi
                $subTutorial->delete();
            });
        }

        return redirect(url('/tutorial/' . $tutorial->id))
            ->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Tutorial $tutorial)
    {
        if ($tutorial->cover && file_exists(public_path('cover/' . $tutorial->cover))) {
            unlink(public_path('cover/' . $tutorial->cover));
        }
        $tutorial->delete();
        return redirect()->route('tutorial.index')->with('success', 'Materi berhasil dihapus.');
    }
}
