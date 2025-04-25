@extends('layouts.app')
@section('title', 'Beranda')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">
@endsection
@section('body_class', 'body-gradasi')
@section('navbar_class', 'nav-transparan')
@section('navbar_class-2', 'navbar-dark')
@section('konten')
<style>

</style>
    <div class="background-image">
        <div class="container d-flex justify-content-center align-items-center " style="min-height: 100vh;">
            <div class="d-block" data-aos="zoom-in-up" data-aos-duration="1000">
                <section class="hero">
                    <div class="overlay">
                        <h1 class="tittle-hero">Code<span>Verse</span></h1>
                        <p>Belajar dimana aja dan kapan aja</p>
                        <a href="/materi" class="btn btn-light btn-custom">Mulai</a>
                        <p class="mt-3">CodeVerse adalah platform independen yang menyediakan materi-materi bahasa pemrograman. Penggunaan situs atau layanan CodeVerse tunduk pada <a href="/privacy-policy" class="text-light">Kebijakan Privasi</a> kami.</p>
                    </div>
                </section>
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
