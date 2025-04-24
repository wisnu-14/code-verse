@extends('layouts.app')
@section('title', 'Beranda')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">
@endsection
@section('body_class', 'body-gradasi')
@section('navbar_class', 'nav-transparan')
@section('navbar_class-2', 'navbar-dark')
@section('konten')
    <div class="background-image">
        <div class="container welcome-page d-flex justify-content-center align-items-center " style="min-height: 100vh;">
            <div class="d-block" data-aos="zoom-in-up" data-aos-duration="1000">
                <p class="text-center welcome-text-top mb-md-5">📣CodeVerse merupakan website yang menyediakan berbagai
                    materi pemrograman yang cocok untuk dipelajari oleh pemula. </p>
                <h1 class="welcome-text text-center ">
                    <div class="keyboard">
                        <span class="key text-light">C</span>
                        <span class="key text-light">o</span>
                        <span class="key text-light">d</span>
                        <span class="key text-light">e</span>
                        <span class="text-dark">
                            <span class="key">V</span>
                            <span class="key">e</span>
                            <span class="key">r</span>
                            <span class="key">s</span>
                            <span class="key">e</span>
                        </span>
                    </div>
                </h1>
                <p class="welcome-text-tagline text-center">
                    menuju progammer handal
                </p>
                @if (auth()->check())
                    <div class="container-btn d-flex justify-content-center ">
                        <a href="/materi" class="btn btn-lanjut">Mulai</a>
                    </div>
                @else
                    <div class="container-btn d-flex flex-wrap justify-content-center align-items-center card-btn">
                        <div class="card me-md-4 mt-5 btn-mulai" style="width: 18rem; max-width: 100%;"
                            onclick="window.location.href='/materi'">
                            <div class="card-body text-center">
                                <a href="/materi" class="card-title nav-link">Mulai Sekarang</a>
                                <p class="card-text">Temukan materi menarik yang bisa anda pelajari.</p>
                            </div>
                        </div>
                        <div class="card me-md-4 mt-md-5 btn-daftar" style="width: 18rem; max-width: 100%;"
                            onclick="window.location.href='/login'">
                            <div class="card-body text-center">
                                <a href="/login" class="card-title nav-link">Daftar</a>
                                <p class="card-text">Buat akun untuk mendapat akses lebih ke dalam website ini.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid content section-menu mt-5 pt-3" id="more">
        <div class="row d-flex justify-content-center align-items-center text-white" style="min-height: 100vh;">
            <div class="col-md-5 mb-3 text-center text-md-start" data-aos="zoom-in-up" data-aos-duration="1000">
                <h1 class="text-lead title-about" style="font-size: 45px;">Mulai Perjalanan Coding Anda di
                    Code<span>Verse</span>!</h1>
                <p class="main-text col-md-8">Selamat datang di CodeVerse, tempat Anda mengembangkan keterampilan, berpikir
                    kreatif, dan membangun masa depan digital!</p>
                <div class="d-flex justify-content-center justify-content-md-start gap-3">
                    <a href="#" class="btn btn-light text-dark">Mulai</a>
                    <a href="#" class="btn btn-outline-light">Daftar</a>
                </div>
            </div>
            <div class="col-md-6 text-center d-none d-md-block">
                <img src="{{ asset('image/assets/ilustration-1.png') }}" alt="Ilustrasi 1" class="img-fluid img-about"
                    style="max-width: 80%; padding-top: 50px;">
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center text-white" style="min-height: 100vh;">
            <div class="col-md-6 text-center d-none d-md-block">
                <img src="{{ asset('image/assets/ilustration-2.png') }}" alt="Ilustrasi 2"
                    class="img-fluid img-about img-about-2" width="430" style="max-width: 50%;">
            </div>
            <div class="col-md-6 mb-3 text-center text-md-start  " data-aos="zoom-in-up" data-aos-duration="1000">
                <h1 class="text-lead">Tentang Code<span>Verse</span>!</h1>
                <p class="about-text">
                    CodeVerse adalah platform pembelajaran pemrograman yang dirancang untuk para programmer pemula. Kami
                    menyajikan materi lengkap, tips praktis, dan contoh kode untuk membantu Anda memahami berbagai bahasa
                    pemrograman dengan mudah. Temukan sumber belajar terbaik, tingkatkan keterampilan coding Anda, dan
                    jadilah bagian dari komunitas pengembang masa depan!
                </p>
            </div>
        </div>


    </div>
@endsection
