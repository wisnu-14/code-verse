@extends('layouts.app')
@section('title', $materi->judul)
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/materiShow.css') }}">
@endsection
@section('body_class', 'body-dark')
@section('navbar_class', 'nav-transparan')
@section('navbar_class-2', 'navbar-dark')
@section('active_class', 'active')
@section('konten')

    <div class="container-fluid materi-show-container">
        <div id="scroll-to-top">
            <div id="progress-circle">
                <div id="progress-bar"></div>
            </div>
            <button onclick="scrollToTop()">↑</button>
        </div>
        <div class="show-materi my-5 d-flex content-colum">
            <div class="row w-100">
                {{-- Konten utama --}}
                <div class="col-md-8 main-content">
                    <div class="content-box">
                        <h1 class="main-heading">{{ $materi->judul }}</h1>
                        <p class="sub-heading">Wisnu DW • {{ \Carbon\Carbon::parse($materi->created_at)->format('d F Y') }}
                            | {{ $materi->kategori ? $materi->kategori->nama : 'Tidak ada kategori' }}</p>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($subMateri as $sub)
                            <div class="sub-content">
                                @if (!empty($sub->sub_judul))
                                    <h3>{{ $sub->sub_judul }}</h3>
                                @endif
                                <p class="mt-3">{{ $sub->penjelasan }}</p>
                                @if ($sub->foto)
                                    <div class="zoom-container">
                                        <img src="{{ asset('storage/sub_foto/' . $sub->foto) }}" alt="{{ $sub->judul }}"
                                            class="img-fluid mb-2 mt-2 zoom-image" width="80%">
                                    </div>
                                    <div id="image-modal" class="modal" onclick="closeModal()">
                                        <span class="close">&times;</span>
                                        <img class="modal-content" id="modal-image">
                                    </div>
                                @endif
                                @if ($sub->kode)
                                    <div class="code-box">
                                        @php
                                            if (strpos($sub->kode, '<?php') !== false) {
                                                $languageClass = 'language-php';
                                            } elseif (strpos($sub->kode, 'function') !== false) {
                                                $languageClass = 'language-javascript';
                                            } elseif (
                                                strpos($sub->kode, 'color') !== false ||
                                                strpos($sub->kode, 'border') !== false
                                            ) {
                                                $languageClass = 'language-css';
                                            } else {
                                                $languageClass = 'language-html';
                                            }
                                        @endphp
                                        <pre><code class="{{ $languageClass }}">{{ $sub->kode }}</code></pre>
                                    </div>
                                @endif
                                @if ($sub->penjelasan_kode)
                                    <p>{{ $sub->penjelasan_kode }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex m-auto">
                        <div class="btn-back mt-4 ">
                            <a href="/materi" class="btn btn-dark ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                                </svg>
                                kembali
                            </a>
                        </div>
                        <div class="d-flex justify-content-center m-auto mt-4">
                            {{ $subMateri->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 sidebar">
                    <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="collapse"
                        data-bs-target="#sidebarCollapse" aria-expanded="false" aria-controls="sidebarCollapse">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M3 4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zM3 7a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zM3 10a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg>
                        Sidebar
                    </button>

                    <div class="collapse d-md-block container-sidebar" id="sidebarCollapse">
                        <h4 class="border-bottom pb-3">Artikel Populer 🔥</h4>
                        @foreach ($topViewedMateriByCategory as $categoryId => $materis)
                        @if (count($materis) > 0)
                        @php
                            $category = \App\Models\Kategori::find($categoryId);
                        @endphp

                        <p>{{ $category->nama }}</p>

                        @foreach ($materis as $materi)
                            <div class="card mb-3 custom-card">
                                <a href="{{ route('materi.show', $materi->id) }}" class="materi-show-btn">
                                    <img src="{{ asset('storage/cover/' . $materi->cover) }}" alt="{{ $materi->judul }}" class="card-cover-img img-fluid " >
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $materi->judul }}</h5>
                                        <p class="card-text">{{ Str::limit($materi->deskripsi, 50) }}</p>
                                        <small class="">
                                            {{ \Carbon\Carbon::parse($materi->created_at)->format('d F Y') }}
                                        </small>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        @endif
                    @endforeach
                </div>

            </div>
        </div>

        <script>
            // Fungsi untuk menambahkan sub materi secara dinamis
            function addSubMateri() {
                const subMateriSection = document.getElementById('sub-materi-section');
                const subMateriItem = document.createElement('div');
                subMateriItem.classList.add('sub-materi-item');
                subMateriItem.innerHTML = `
                <label>Judul Sub Materi</label>
                <input type="text" name="sub_judul[]" required>
                <label>Penjelasan Sub Materi</label>
                <textarea name="penjelasan[]" required></textarea>

                <!-- Textarea untuk memasukkan kode sub materi -->
                <label>Kode Sub Materi</label>
                <textarea name="kode_sub_materi[]" rows="5" placeholder="Masukkan kode sub materi di sini"></textarea>
            `;
                subMateriSection.appendChild(subMateriItem);

                // Re-inisialisasi Prism setelah menambahkan sub materi
                document.addEventListener("DOMContentLoaded", function() {
                    Prism.highlightAll();
                });

            }
            window.onscroll = function() {
                updateScrollProgress();
                toggleScrollButton();
            };

            function updateScrollProgress() {
                var scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                var scrollPosition = window.scrollY;
                var scrollPercent = (scrollPosition / scrollHeight) * 100;

                var progressBar = document.getElementById('progress-bar');
                var progress = (scrollPercent / 100) * 360; // Menghitung berapa banyak bar yang diisi

                // Menggunakan conic-gradient untuk mengisi progress bar
                progressBar.style.background = `conic-gradient(#ffff ${progress}deg, transparent 0%)`;
            }

            function toggleScrollButton() {
                var scrollButton = document.getElementById('scroll-to-top');
                if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                    scrollButton.style.display = "flex";
                } else {
                    scrollButton.style.display = "none";
                }
            }

            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            const modal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');

            // Ketika gambar diklik, tampilkan modal
            document.querySelector('.zoom-container .zoom-image').onclick = function() {
                modal.style.display = 'block';
                modalImage.src = this.src; // Atur sumber gambar modal sesuai gambar yang diklik
            };

            // Fungsi untuk menutup modal
            function closeModal() {
                modal.style.display = 'none';
            }
        </script>
    @endsection
