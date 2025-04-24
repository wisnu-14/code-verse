@extends('layouts.app')
@section('title', 'Materi')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
@endsection
@section('body_class', 'body-dark')
@section('navbar_class-2', 'navbar-dark')
@section('navbar_class', 'nav-transparan')
@section('konten')
<div class="container about">
    <h1 class="display-4 text-center">Tentang Codeverse</h1>
    <p class="lead text-center">Belajar pemrograman web dan informatika dengan cara yang menyenangkan dan mudah dimengerti!</p>

    <div class="row mt-5">
      <div class="col-md-6">
        <h3>Apa Itu Codeverse?</h3>
        <p>Codeverse adalah platform pembelajaran yang menyediakan berbagai materi dan tutorial tentang pemrograman web, termasuk HTML, CSS, JavaScript, PHP, dan banyak lagi. Kami berkomitmen untuk membantu kamu memahami konsep-konsep dasar hingga lanjutan di dunia pemrograman.</p>
        <ul>
          <li>Materi lengkap untuk pemrograman web</li>
          <li>Berbagai tutorial step-by-step</li>
          <li>Forum komunitas untuk berdiskusi</li>
        </ul>
      </div>
      <div class="col-md-6">
        <h3>Kenapa Memilih Codeverse?</h3>
        <p>Kami percaya bahwa setiap orang bisa belajar pemrograman jika diberikan materi yang tepat. Dengan pendekatan yang mudah dipahami, Codeverse hadir sebagai sumber belajar yang menyenangkan dan dapat diakses kapan saja dan di mana saja.</p>
      </div>
    </div>
  </div>
@endsection