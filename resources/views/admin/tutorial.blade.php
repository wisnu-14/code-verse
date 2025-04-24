@extends('layouts.admin')
@section('title', 'Manage Tutorial')
@section('custom-css-admin-page')
    <link rel="stylesheet" href="{{ asset('css/admin/manageMateri.css') }}">
@endsection
@section('custom-js-admin-page')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endsection
@section('adminContent')
    @if (session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div class="toast show" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="{{ asset('image/assets/logo/code-verse.png') }}" class="rounded me-2" alt="..."
                        width="20px">
                    <strong class="me-auto">Notifikasi</strong>
                    <small>Baru Saja</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body text-dark">
                    {{ session('success') }}
                    <div class="loading-bar"></div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div class="toast show" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="{{ asset('image/assets/logo/code-verse.png') }}" class="rounded me-2" alt="..."
                        width="20px">
                    <strong class="me-auto">Notifikasi</strong>
                    <small>Baru Saja</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                    <div class="loading-bar"></div>
                </div>
            </div>
        </div>
    @endif
    <h3 class="text-white">Create new tutorial</h3>
    <div class="container-fluid text-white create-materi">
        <div class="container">
            <p class="text-success">{{ session('success') }}</p>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li class="alert alert-danger">{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('tutorial.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Materi</label>
                    <div class="col-sm-9">
                        <input type="text" name="judul" id="judul"
                            class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}"
                            placeholder="Masukkan judul tutorial">
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi Materi -->
                <div class="row mb-3">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Materi</label>
                    <div class="col-sm-9">
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Masukkan deskripsi tutorial">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Cover Materi -->
                <div class="row mb-3">
                    <label for="cover" class="col-sm-2 col-form-label">Cover Materi</label>
                    <div class="col-sm-9">
                        <input type="file" name="cover" id="cover"
                            class="form-control @error('cover') is-invalid @enderror" accept="image/*"
                            onchange="previewCover(event)">
                        @error('cover')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small class="text-warning d-block mt-2">
                            * Minimal ukuran 500 x 500 pixel<br>
                            * Ekstensi yang diperbolehkan: jpeg, png, jpg, gif, svg, webp
                        </small>
                        <div class="">
                            <img id="coverPreview" alt="Pratinjau Cover" class="img-thumbnail"
                                style="max-width: 200px; display: none;">
                        </div>
                    </div>
                </div>
                @error('cover')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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
                </script>

                <!-- Kategori Materi -->
                <div class="row mb-3 align-items-center">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori Materi</label>
                    <div class="col-sm-4">
                        <select name="kategori_id" id="kategori" class="form-select">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('kategori_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="border my-5"></div>

                <!-- Sub Materi -->
                <div id="sub-materi-section" class="mb-3">
                    <h5>Sub Tutorial</h5>
                </div>

                <button type="button" class="btn btn-secondary mb-3" onclick="addSubMateri()">
                    <i class="bi bi-arrow-down-square"></i> Tambah Sub Tutorial
                </button>
                <button type="submit" class="btn btn-primary mb-3">
                    <i class="bi bi-arrow-right-circle"></i> Simpan Tutorial
                </button>
                <button type="reset" class="btn btn-primary mb-3">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </button>
            </form>
        </div>

        <script>
            function addSubMateri() {
                const subMateriSection = document.getElementById('sub-materi-section');
                const subMateriItem = document.createElement('div');
                subMateriItem.classList.add('sub-materi-item', 'row', 'border', 'rounded', 'p-3', 'mb-3');

                const subMateriCount = document.querySelectorAll('.sub-materi-item').length;

                subMateriItem.innerHTML = `
                            <div class="row g-3 align-items-center rounded p-3 mb-4">
                                <!-- Judul Sub Materi -->
                                <div class="col-sm-6">
                                    <label for="sub_judul[]" class="form-label">Judul Sub Tutorial</label>
                                    <input type="text" name="sub_judul[]" id="sub_judul[]"
                                        class="form-control form-control-sm @error('sub_judul') is-invalid @enderror"
                                        value="{{ old('sub_judul[]') }}" placeholder="Masukkan judul sub tutorial">
                                    @error('sub_judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Penjelasan Sub Materi -->
                                <div class="col-sm-6">
                                    <label for="penjelasan[]" class="form-label">Penjelasan Sub Tutorial</label>
                                    <textarea name="penjelasan[]" id="penjelasan[]"
                                            class="form-control form-control-sm @error('penjelasan') is-invalid @enderror"
                                            rows="3" placeholder="Masukkan penjelasan sub tutorial">{{ old('penjelasan[]') }}</textarea>
                                    @error('penjelasan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Kode Sub Materi -->
                                <div class="col-sm-6">
                                    <label for="kode_sub_materi[]" class="form-label">Kode Sub Tutorial</label>
                                    <textarea name="kode_sub_materi[]" id="kode_sub_materi[]"
                                            class="form-control form-control-sm @error('kode_sub_materi') is-invalid @enderror"
                                            rows="3" placeholder="Masukkan kode sub tutorial">{{ old('kode_sub_materi[]') }}</textarea>
                                    @error('kode_sub_materi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Penjelasan Kode -->
                                <div class="col-sm-6">
                                    <label for="penjelasan_kode[]" class="form-label">Penjelasan Kode</label>
                                    <textarea name="penjelasan_kode[]" id="penjelasan_kode[]"
                                            class="form-control form-control-sm @error('penjelasan_kode') is-invalid @enderror"
                                            rows="3" placeholder="Masukkan penjelasan kode">{{ old('penjelasan_kode[]') }}</textarea>
                                    @error('penjelasan_kode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Gambar Sub Materi -->
                                <div class="col-sm-6">
                                    <label for="foto_sub_materi[]" class="form-label">Gambar Sub Tutorial</label>
                                    <div class="mb-3">
                                        <img id="subGambarPreview" alt="Pratinjau Gambar" class="img-thumbnail"
                                            style="max-width: 200px; display: none;">
                                    </div>
                                    <input type="file" name="foto_sub_materi[]" id="foto_sub_materi[]"
                                        class="form-control form-control-sm @error('foto_sub_materi') is-invalid @enderror"
                                        accept="image/*" onchange="previewSubGambar(event)">
                                    <small class="text-warning d-block mt-2">
                                        * Ekstensi foto yang diperbolehkan: jpeg, png, jpg, gif, svg, webp
                                    </small>
                                    @error('foto_sub_materi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Tombol Hapus Sub Materi -->
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeSubMateri(this)">
                                        <i class="bi bi-dash-circle-fill"></i> Hapus Sub Tutorial
                                    </button>
                                </div>
                            </div>

                            `;

                subMateriSection.appendChild(subMateriItem);
            }

            function previewSubGambar(event, index) {
                const previewElement = document.getElementById(`subGambarPreview${index}`);
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

            function removeSubMateri(button) {
                const subMateriItem = button.closest('.sub-materi-item');
                subMateriItem.remove();
            }

            function showToast() {
                var toastElement = document.getElementById('successToast');
                toastElement.classList.add('show');

                setTimeout(function() {
                    toastElement.classList.add('fade-out');
                }, 3000);


                setTimeout(function() {
                    toastElement.classList.remove('show', 'fade-out');
                }, 3500);
            }

            window.onload = function() {
                showToast();
            };
        </script>
    </div>
@endsection
