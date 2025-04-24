@extends('layouts.app')
@section('title', 'Semua Tutorial')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/tutorial/tutorialIndex.css') }}">
@endsection
@section('body_class', 'body-dark')
@section('navbar_class-2', 'navbar-dark')
@section('navbar_class', 'nav-transparan')
@section('active_class', 'active')
@section('konten')
    <div class="container container-tutorial">
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
        <div class="container">
            <h2 class="fw-bold text-white">Most Popular Tutorial <span class="text-warning">🏆 </span></h2>
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
                @foreach ($tutorials as $tutorial)
                    <div class="col">
                        <div class="card h-100">
                            @if ( auth()->check() && auth()->user()->role === 'admin' ||auth()->check() && auth()->user()->id === $tutorial->author_id)
                                <div class="card-actions ">
                                    <a href="{{ route('tutorial.edit', $tutorial->id) }}" class="btn-action btn-edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('tutorial.destroy', $tutorial->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                            <div class="img-container p-4">
                                <a href="{{ route('tutorial.show', $tutorial->id) }}">
                                    <img src="{{ asset('cover/' . $tutorial->cover) }}" class="card-img-top"
                                        alt="{{ $tutorial->cover }}">
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('tutorial.show', $tutorial->id) }}">
                                    <h5 class="card-title text-white">{{ $tutorial->judul }}</h5>
                                </a>
                                <p class="card-text text-white-50 mb-5">
                                    {{ $tutorial->deskripsi }}
                                </p>
                                <a href="{{ route('materi.show', $tutorial->id) }}"
                                    class="text-decoration-none text-white-50 ">
                                    <p class="card-text kategory-text d-flex justify-content-between"
                                        style="font-size: 10px">
                                        <small class="">
                                            {{ $tutorial->kategori ? $tutorial->kategori->nama : 'Tidak ada kategori' }}</small>
                                        <small
                                            class="">{{ \Carbon\Carbon::parse($tutorial->created_at)->format('d F Y') }}</small>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4 ">
                {{ $tutorials->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <script>
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
@endsection
