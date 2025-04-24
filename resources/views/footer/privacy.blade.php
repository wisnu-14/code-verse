@extends('layouts.app')
@section('title', 'Materi')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/privacy.css') }}">
@endsection
@section('body_class', 'body-dark')
@section('navbar_class-2', 'navbar-dark')
@section('navbar_class', 'nav-transparan')
@section('konten')
<div class="container privasi">
    <h1 class="display-5 mb-4 text-center">Kebijakan Privasi</h1>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <p>
          Di Codeverse, privasi pengunjung kami sangat penting bagi kami. Dokumen kebijakan privasi ini menjelaskan jenis informasi yang dikumpulkan dan dicatat oleh Codeverse serta bagaimana kami menggunakannya.
        </p>

        <h4 class="mt-4">1. Informasi yang Kami Kumpulkan</h4>
        <p>
          Kami dapat mengumpulkan informasi pribadi seperti nama, alamat email, dan preferensi pengguna ketika Anda secara sukarela mengisi formulir kontak, mendaftar akun, atau berinteraksi dengan fitur interaktif pada situs kami.
        </p>

        <h4 class="mt-4">2. Penggunaan Informasi</h4>
        <p>
          Informasi yang kami kumpulkan digunakan untuk:
          <ul>
            <li>Meningkatkan pengalaman pengguna</li>
            <li>Memberikan konten yang lebih relevan dan personal</li>
            <li>Menanggapi pertanyaan atau permintaan dukungan</li>
            <li>Mengirim email berkala yang berisi informasi, materi pembelajaran, atau pembaruan</li>
          </ul>
        </p>

        <h4 class="mt-4">3. Perlindungan Data</h4>
        <p>
          Kami menerapkan berbagai langkah keamanan untuk menjaga keamanan data pribadi Anda. Namun, harap diperhatikan bahwa tidak ada metode transmisi data melalui internet yang 100% aman.
        </p>

        <h4 class="mt-4">4. Cookie</h4>
        <p>
          Situs kami dapat menggunakan "cookies" untuk meningkatkan pengalaman pengguna. Anda dapat memilih untuk menonaktifkan cookie melalui pengaturan browser Anda, namun hal ini dapat memengaruhi fungsi tertentu dari situs web kami.
        </p>

        <h4 class="mt-4">5. Tautan ke Situs Pihak Ketiga</h4>
        <p>
          Kami dapat menampilkan tautan ke situs web lain. Kami tidak bertanggung jawab atas praktik privasi atau konten situs pihak ketiga tersebut. Kami mendorong pengguna untuk membaca kebijakan privasi masing-masing situs eksternal.
        </p>

        <h4 class="mt-4">6. Perubahan terhadap Kebijakan Privasi</h4>
        <p>
          Codeverse berhak memperbarui kebijakan privasi ini kapan saja. Setiap perubahan akan diposting di halaman ini dengan tanggal pembaruan terbaru di bagian bawah. Kami mendorong pengguna untuk secara berkala meninjau halaman ini agar tetap mendapat informasi tentang bagaimana kami melindungi informasi yang kami kumpulkan.
        </p>

        <h4 class="mt-4">7. Persetujuan Anda</h4>
        <p>
          Dengan menggunakan situs kami, Anda menyetujui kebijakan privasi ini dan menyetujui ketentuan penggunaannya.
        </p>

        <h4 class="mt-4">8. Hubungi Kami</h4>
        <p>
          Jika Anda memiliki pertanyaan atau saran tentang kebijakan privasi ini, silakan hubungi kami di:
          <br />
          <strong>Email:</strong> wisnudwippp12@gmail.com
        </p>

        <p class="text-grey mt-4">Diperbarui terakhir: 23 April 2025</p>
      </div>
    </div>
  </div>
@endsection