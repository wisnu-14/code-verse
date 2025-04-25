@extends('layouts.admin')
@section('title', 'Update Materi')
@section('custom-css-admin-page')
    <link rel="stylesheet" href="{{ asset('css/createMateri.css') }}">
@endsection
@section('navbar_class-2', 'navbar-dark')
@section('active_class', 'active')
@section('adminContent')
    <h2 class="text-white">Edit Materi <span style="color: rgb(116, 116, 116); text-decoration: underline">{{ $materi->judul }}</h2>
    <div class="container-fluid text-white edit-materi">
        <div class="container">
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li class="alert alert-danger">{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul Materi -->
                <div class="row mb-3 align-items-center">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Materi</label>
                    <div class="col-sm-9">
                        <input type="text" name="judul" id="judul"
                            class="form-control form-control-sm @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $materi->judul) }}" placeholder="Masukkan judul materi">
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi Materi -->
                <div class="row mb-3 align-items-center">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Materi</label>
                    <div class="col-sm-9">
                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3"
                            placeholder="Tuliskan deskripsi materi">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Cover Materi -->
                <div class="row mb-3 ">
                    <label for="cover" class="col-sm-2 col-form-label">Cover Materi</label>
                    <div class="col-sm-9">
                        <input type="file" name="cover" id="cover"
                            class="form-control @error('cover') is-invalid @enderror" accept="image/*"
                            onchange="previewCover(event)">
                        <small class="text-warning d-block mt-2">
                            * Minimal ukuran 500 x 500 piksel<br>
                            * Ekstensi yang diperbolehkan: jpeg, png, jpg, gif, svg, webp
                        </small>
                        <div class="">
                            <img id="coverPreview" src="{{ $materi->cover ? asset('cover/' . $materi->cover) : '#' }}"
                                alt="Pratinjau Cover" class="img-thumbnail"
                                style="max-width: 200px; display: {{ $materi->cover ?: 'none' }};">
                        </div>
                        @error('cover')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Kategori Materi -->
                <div class="row mb-3 align-items-center">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori Materi</label>
                    <div class="col-sm-9">
                        <select name="kategori_id" id="kategori"
                            class="form-select @error('kategori_id') is-invalid @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $materi->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="border my-5"></div>

                <!-- Sub Materi -->
                <div id="sub-materi-section" class="mb-3">
                    <h5>Sub Materi</h5>
                    @foreach ($materi->subMateri as $subMateri)
                        <div class="sub-materi-item row border rounded p-3 mb-3">
                            <input type="hidden" name="sub_materi_id[]" value="{{ $subMateri->id }}">

                            <!-- Judul Sub Materi -->
                            <div class="col-md-4 mb-2">
                                <label for="sub_judul_{{ $loop->index }}" class="form-label">Judul Sub Materi</label>
                                <input type="text" name="sub_judul[]" id="sub_judul_{{ $loop->index }}"
                                    class="form-control form-control-sm @error('sub_judul.' . $loop->index) is-invalid @enderror"
                                    value="{{ old('sub_judul.' . $loop->index, $subMateri->sub_judul) }}"
                                    placeholder="Masukkan judul sub materi">
                                @error('sub_judul.' . $loop->index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Penjelasan Sub Materi -->
                            <div class="col-md-8 mb-2">
                                <label for="penjelasan_{{ $loop->index }}" class="form-label">Penjelasan Sub
                                    Materi</label>
                                <textarea name="penjelasan[]" id="penjelasan_{{ $loop->index }}"
                                    class="form-control @error('penjelasan.' . $loop->index) is-invalid @enderror" rows="3"
                                    placeholder="Masukkan penjelasan">{{ old('penjelasan.' . $loop->index, $subMateri->penjelasan) }}</textarea>
                                @error('penjelasan.' . $loop->index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kode Sub Materi -->
                            <div class="col-md-4 mb-2">
                                <label for="kode_sub_materi_{{ $loop->index }}" class="form-label">Kode Sub Materi</label>
                                <textarea name="kode_sub_materi[]" id="kode_sub_materi_{{ $loop->index }}"
                                    class="form-control form-control-sm @error('kode_sub_materi.' . $loop->index) is-invalid @enderror" rows="4"
                                    placeholder="Masukkan kode">{{ old('kode_sub_materi.' . $loop->index, $subMateri->kode) }}</textarea>
                                @error('kode_sub_materi.' . $loop->index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Penjelasan Kode -->
                            <div class="col-md-8 mb-2">
                                <label for="penjelasan_kode_{{ $loop->index }}" class="form-label">Penjelasan Kode</label>
                                <textarea name="penjelasan_kode[]" id="penjelasan_kode_{{ $loop->index }}"
                                    class="form-control @error('penjelasan_kode.' . $loop->index) is-invalid @enderror" rows="4"
                                    placeholder="Penjelasan kode">{{ old('penjelasan_kode.' . $loop->index, $subMateri->penjelasan_kode) }}</textarea>
                                @error('penjelasan_kode.' . $loop->index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gambar Sub Materi -->
                            <div class="col-md-6 mb-2">
                                <label for="foto_sub_materi_{{ $loop->index }}" class="form-label">Gambar Sub
                                    Materi</label>
                                <div class="mb-2">
                                    <img id="subGambarPreview{{ $loop->index }}"
                                        src="{{ $subMateri->foto ? asset('sub_foto/' . $subMateri->foto) : '' }}"
                                        alt="Pratinjau foto" class="img-thumbnail"
                                        style="max-width: 200px; display: {{ $subMateri->foto ? 'block' : 'none' }};">
                                </div>
                                <input type="file" name="foto_sub_materi[]" id="foto_sub_materi_{{ $loop->index }}"
                                    class="form-control @error('foto_sub_materi.' . $loop->index) is-invalid @enderror"
                                    accept="image/*" onchange="previewSubGambar(event, {{ $loop->index }})">
                                @error('foto_sub_materi.' . $loop->index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-2">* Format: jpeg, png, jpg, svg, webp</small>
                            </div>

                            <!-- Hapus Sub Materi -->
                            <div class="col-12 text-end">
                                <label for="delete_sub_materi_{{ $loop->index }}" class="form-label">
                                    <input type="checkbox" name="delete_sub_materi[]"
                                        id="delete_sub_materi_{{ $loop->index }}" value="{{ $subMateri->id }}">
                                    Hapus Sub Materi
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-warning mb-3" onclick="addSubMateri()">Tambah Sub Materi</button>
                <a href="{{ route('materi.index') }}" class="btn btn-primary mb-3">Kembali</a>
                <button type="submit" class="btn btn-primary mb-3">Update Materi</button>
            </form>
        </div>

        <script>
            function previewCover(event) {
                const coverPreview = document.getElementById('coverPreview');
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        coverPreview.src = e.target.result;
                        coverPreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    coverPreview.style.display = 'none';
                }
            }

            function previewSubGambar(event, index) {
                const previewId = `subGambarPreview${index}`;
                const previewElement = document.getElementById(previewId);
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewElement.src = e.target.result;
                        previewElement.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewElement.style.display = 'none';
                }
            }

            function addSubMateri() {
                const subMateriSection = document.getElementById('sub-materi-section');
                const subMateriItem = document.createElement('div');
                subMateriItem.classList.add('sub-materi-item', 'row', 'border', 'rounded', 'p-3', 'mb-3');

                subMateriItem.innerHTML = `
                        <!-- Judul Sub Materi -->
                        <div class="col-md-4 mb-2">
                            <label for="sub_judul_new" class="form-label">Judul Sub Materi</label>
                            <input type="text" name="sub_judul[]" id="sub_judul_new" class="form-control form-control-sm" placeholder="Masukkan judul sub materi">
                        </div>

                        <!-- Penjelasan Sub Materi -->
                        <div class="col-md-8 mb-2">
                            <label for="penjelasan_new" class="form-label">Penjelasan Sub Materi</label>
                            <textarea name="penjelasan[]" id="penjelasan_new" class="form-control" rows="3" placeholder="Masukkan penjelasan"></textarea>
                        </div>

                        <!-- Kode Sub Materi -->
                        <div class="col-md-4 mb-2">
                            <label for="kode_sub_materi_new" class="form-label">Kode Sub Materi</label>
                            <textarea name="kode_sub_materi[]" id="kode_sub_materi_new" class="form-control form-control-sm" rows="4" placeholder="Masukkan kode sub materi di sini"></textarea>
                        </div>

                        <!-- Penjelasan Kode -->
                        <div class="col-md-8 mb-2">
                            <label for="penjelasan_kode_new" class="form-label">Penjelasan Kode</label>
                            <textarea name="penjelasan_kode[]" id="penjelasan_kode_new" class="form-control" rows="4" placeholder="Masukkan penjelasan tentang kode di sini"></textarea>
                        </div>

                        <!-- Gambar Sub Materi -->
                        <div class="col-md-6 mb-2">
                            <label for="foto_sub_materi_new" class="form-label">Gambar Sub Materi</label>
                            <div class="mb-2">
                                <img id="subGambarPreviewNew" src="" alt="Pratinjau Gambar" class="img-thumbnail" style="max-width: 200px; display: none;">
                            </div>
                            <input type="file" name="foto_sub_materi[]" id="foto_sub_materi_new" class="form-control" accept="image/*" onchange="previewSubGambar(event, 'New')">
                        </div>

                        <!-- Tombol Hapus Sub Materi -->
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeSubMateri(this)">
                                Hapus Sub Materi
                            </button>
                        </div>
                        `;

                subMateriSection.appendChild(subMateriItem);
            }

            function removeSubMateri(button) {
                button.closest('.sub-materi-item').remove();
            }
        </script>
    </div>
@endsection
