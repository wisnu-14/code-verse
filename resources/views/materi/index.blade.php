@extends('layouts.app')
@section('title', 'Materi')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/materiIndex.css') }}">
@endsection
@section('body_class', 'body-dark')
@section('navbar_class-2', 'navbar-dark')
@section('navbar_class', 'nav-transparan')
@section('active_class', 'active')
@section('konten')

    <div class="container-materi">
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
                    <div class="toast-body text-dark">
                        {{ session('error') }}
                        <div class="loading-bar"></div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row mx-0 filter-container">
            <div class="filter">
                <button class="border-0 btn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white"
                        class="bi bi-filter-left" viewBox="0 0 16 16">
                        <path
                            d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                    </svg>
                </button>
                <div class="offcanvas offcanvas-start custom-blur" data-bs-scroll="true" tabindex="-1"
                    id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-white" id="offcanvasWithBothOptionsLabel">Filter materi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form action="{{ route('materi.index') }}" method="GET" class="mb-3">
                            <div class="row">
                                <div class="col-md-10">
                                    <select name="kategori" id="kategori" class="form-select">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($kategoriList as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-dark">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-12 p-3 card-materi">
                @if ($materis->isEmpty())
                    <div class="text-center mt-5 text-danger" role="alert">
                        Materi tidak ada.
                    </div>
                @else
                    @foreach ($materis as $materi)
                        <div class="card main-card mb-3 border-0">
                            <div class="row g-0">
                                @if ($materi->cover)
                                    <div class="col-md-3 cover-container" id="redirectButton"
                                        data-url="{{ route('materi.show', $materi->id) }}">
                                        <img src="{{ asset('cover/' . $materi->cover) }}"
                                            class="cover img-card rounded-start" alt="{{ $materi->cover }}"
                                            style="object-fit: cover;">
                                    </div>
                                @endif
                                <div class="col-md-9">
                                    <div class="card-body">
                                        @if (auth()->check() && auth()->user()->role === 'admin' || auth()->check() && auth()->user()->id === $materi->author_id)
                                            <div class="dropdown position-absolute top-0 end-0 m-1">
                                                <button class="btn btn-link p-0 border-0" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="white" class="bi bi-three-dots-vertical"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                    </svg>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end box-area"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <form action="{{ route('materi.destroy', $materi->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item btn-hapus">
                                                            <!-- Icon Hapus -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('materi.edit', $materi->id) }}"
                                                        class="dropdown-item btn-edit">
                                                        <!-- Icon Edit -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                </ul>
                                            </div>
                                        @endif
                                        <a href="{{ route('materi.show', $materi->id) }}"
                                            class="text-decoration-none text-white">
                                            <h3 class="card-title">{{ $materi->judul }}</h3>
                                        </a>

                                        <p class="card-text deskripsi-card text-white">
                                        <div class=" deskripsi" id="text-container">{{ $materi->deskripsi }}.</div>
                                        </p>

                                        @if ($materi->subMateri->isEmpty())
                                            <div class="submateri-kosong" role="alert">
                                                Tidak ada sub materi!
                                            </div>
                                        @endif
                                        <a href="{{ route('materi.show', $materi->id) }}" class="text-decoration-none">
                                            <p class="card-text kategory-text d-flex justify-content-between">
                                                <small class="">
                                                    {{ $materi->kategori ? $materi->kategori->nama : 'Tidak ada kategori' }}</small>
                                                <small class="">Wisnu Dwi •
                                                    {{ \Carbon\Carbon::parse($materi->created_at)->format('d F Y') }}</small>
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="tambah-materi-container">
                    <div class="card main-card tambah-materi mb-3" onclick="toggleForm(this)">
                        <div class="row g-0">
                            <div class="col-md-3" id="redirectButton">
                                <img src="{{ asset('image/assets/plus-logo.png') }}" class="rounded-start"
                                    width="200" alt="..." style="object-fit: cover; padding: 50px;">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Request Tambah Materi</h3>
                                    <p class="card-text deskripsi-card text-white">
                                    <div class="deskripsi" id="text-container">Tidak menemukan materi yang kamu cari?
                                    </div>
                                    <div class="deskripsi" id="text-container">Kamu bisa me-requestnya disini.</div>
                                    </p>
                                    <p class="card-text kategory-text d-flex justify-content-between">
                                        <small class="">Request</small>
                                        <small class="">Code Verse</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form Container to be shown/hidden -->
                    <div class="form-container" style="display: none;">
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $item)
                                        <li class="alert alert-danger">{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="requestForm" method="POST" action="/request-materi">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    placeholder="Nama anda">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email (Opsional)</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="email@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Materi apa yang kamu inginkan?</label>
                                <textarea class="form-control" id="message" name="message" rows="3" required
                                    placeholder="tuliskan disini..."></textarea>
                                <small class="text-warning">*pesan maximal 100 karakter</small>
                                <br>
                                <small id="charCounter" class="text-white">0 karakter</small>
                                <small id="charCountWarning" class="text-danger" style="display: none;">Pesan melebihi
                                    100
                                    karakter.</small>
                            </div>
                            <button type="submit" class="btn container-fluid btn-kirim-request">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-send-plus-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z" />
                                    <path
                                        d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4 ">
                    {{ $materis->links('pagination::bootstrap-5') }}
                </div>
            </div>
            <!-- Card Kecil di Sebelah Kanan -->
            <div class="col-md-4 col-12 p-3 mb-3 small-card">
                <div class="collapse d-md-block container-sidebar" id="sidebarCollapse">
                    <h4 class="border-bottom pb-3">Artikel Populer 🔥</h4>
                    @foreach ($topViewedMateriByCategory as $categoryId => $materis)
                    @if (count($materis) > 0)
                    @php
                        $category = \App\Models\Kategori::find($categoryId);
                    @endphp

                    <p>{{ $category->nama }}</p>

                    @foreach ($materis as $materi)
                        <div class="card mb-3 custom-card-side">
                            <a href="{{ route('materi.show', $materi->id) }}" class="materi-show-btn">
                                <img src="{{ asset('cover/' . $materi->cover) }}    " alt="{{ $materi->judul }}" class="card-cover-img img-fluid " >
                                <div class="card-body-side">
                                    <h5 class="card-title-side">{{ $materi->judul }}</h5>
                                    <p class="card-text-side">{{ Str::limit($materi->deskripsi, 50) }}</p>
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
    </div>
    <script>
        const messageInput = document.getElementById('message');
        const charCounter = document.getElementById('charCounter');
        const warningText = document.getElementById('charCountWarning');
        const maxChars = 100;

        messageInput.addEventListener('input', function() {
            const charCount = messageInput.value.length;

            charCounter.textContent = `${charCount} karakter`;

            if (charCount > maxChars) {
                warningText.style.display = 'block';
            } else {
                warningText.style.display = 'none';
            }
        });
    </script>

    <script>
        document.getElementById('requestForm').addEventListener('submit', function(e) {
            const messageInput = document.getElementById('message');
            const wordCount = messageInput.value.trim().split(/\s+/).length;

            if (wordCount > 50) {
                e.preventDefault();
                alert('Message cannot exceed 50 words.');
            }
        });

        function toggleForm(card) {
            const formContainer = card.nextElementSibling;
            if (formContainer && formContainer.classList.contains("form-container")) {
                if (formContainer.style.display === "none" || formContainer.style.display === "") {
                    formContainer.style.display = "block";
                } else {
                    formContainer.style.display = "none";
                }
            }
        }

        $(document).ready(function() {
            var maxLength = 100; // Batasi panjang teks
            var text = $('#text-container').text();
            if (text.length > maxLength) {
                $('#text-container').text(text.substring(0, maxLength) + '...');
            }
        });

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
        document.getElementById('redirectButton').addEventListener('click', function() {
            const targetUrl = this.getAttribute('data-url');
            window.location.href = targetUrl;
        });
    </script>
@endsection
