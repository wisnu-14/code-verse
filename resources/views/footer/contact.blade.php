@extends('layouts.app')
@section('title', 'Materi')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection
@section('body_class', 'body-dark')
@section('navbar_class-2', 'navbar-dark')
@section('navbar_class', 'nav-transparan')
@section('konten')
<div class="container contact">
    <h1 class="display-4 text-center mb-4">Kontak Kami</h1>
    <p class="lead text-center mb-5">Kami senang mendengar dari Anda! Silakan hubungi kami melalui informasi berikut:</p>

    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Informasi Kontak</h5>
            <ul class="list-unstyled mt-3">
              <li><strong>Email:</strong> wisnudwippp12@gmail.com</li>
              <li><strong>WhatsApp:</strong> +62 812-3456-7890</li>
              <li><strong>Instagram:</strong> <a href="https://www.instagram.com/wisdw_/" target="_blank">@wisdw</a></li>
            </ul>
            <p class="mt-4 mb-0">Kami akan merespons pertanyaan atau kolaborasi secepat mungkin.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection