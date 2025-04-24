<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('image/assets/logo/code-verse-tittle.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @include('layouts.includes.cdn')
    @include('layouts.includes.fonts')
    @yield('custom_css')
</head>

<body class="@yield('body_class')">
    <nav class="navbar navbar-expand-lg @yield('navbar_class') @yield('navbar_class-2')  @yield('navbar_class-3') fixed-top p-0">
        <div class="container-fluid">
            <a class="navbar-brand nav-judul" href="/">
                <img src="{{ asset('image/assets/logo/code-verse.png') }}" alt="" class="img-fluid"
                width="40">
                Code<span>Verse</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse menu" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    @unless (Route::is('home'))
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a>
                    <a class="nav-link {{ Request::is('materi', 'materi/create', 'materi/*/edit', 'materi/*') ? 'active' : '' }}"
                    href="/materi">Materi</a>
                    <a class="nav-link {{ Request::is('tutorial', 'tutorial/create', 'tutorial/*/edit', 'tutorial/*') ? 'active' : '' }}"
                    href="/tutorial">Tutorial</a>
                    <a class="nav-link {{ Request::is('/download.index') ? 'active' : '' }}"
                    href="/download">Download</a>
                    @if (auth()->check() && auth()->user()->role === 'admin')
                    <a class="nav-link" href="/dashboard" target="_blank">Dashboard</a>
                    @endif
                    @endunless
                    <div class="nav-item dropdown profile">
                        @if (auth()->check())
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('image/public/default-avatar.png') }}" alt="Profile Picture"
                                    class="rounded-circle mt-0 mb-0" width="30" height="30">
                            </a>
                        @else
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path fill-rule="evenodd"
                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                </svg>
                            </a>
                        @endif
                        <ul class="dropdown-menu dropdown-menu-end profile" aria-labelledby="profileDropdown">
                            @if (auth()->check() && (auth()->user()->role == 'user' || auth()->user()->role == 'admin'))
                                <li><a class="dropdown-item" href="/profile">View Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif
                            @if (auth()->check())
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="logout-btn dropdown-item">Logout</button>
                                </form>
                            @else
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="">
        @yield('konten')
    </div>
    <style>
        .text-footer:hover {
            color: #9c9c9c
        }
    </style>
    <footer class="bg-body-dark text-center">
        <div class="container p-4 pb-0">
            <div class="text-menu d-flex justify-content-center gap-3 mb-4">
                <a href="/about-us" class="nav-link text-footer">About Us</a >
                <a href="/contact" class="nav-link text-footer">Contact</a >
                <a href="/privacy-policy" class="nav-link text-footer">Privacy Policy</a >
            </div>
            <section class="mb-3">
                <!-- Facebook -->
                <a data-mdb-ripple-init class="btn btn-sosmed-footer text-white btn-floating m-1"
                    style="background-color: #3b5998;" href="#!" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-facebook" viewBox="0 0 16 16">
                        <path
                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                    </svg>
                </a>

                <!-- Twitter -->
                <a data-mdb-ripple-init class="btn btn-sosmed-footer text-white btn-floating m-1"
                    style="background-color: #55acee;" href="#!" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-twitter-x" viewBox="0 0 16 16">
                        <path
                            d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                    </svg>
                </a>

                <!-- Google -->
                <a data-mdb-ripple-init class="btn btn-sosmed-footer text-white btn-floating m-1"
                    style="background-color: #dd4b39;" href="#!" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-google" viewBox="0 0 16 16">
                        <path
                            d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                    </svg>
                </a>

                <!-- Instagram -->
                <a data-mdb-ripple-init class="btn btn-sosmed-footer text-white btn-floating m-1"
                    style="background-color: #ac2bac;" href="#!" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-instagram" viewBox="0 0 16 16">
                        <path
                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                    </svg>
                </a>

                <!-- Linkedin -->
                <a data-mdb-ripple-init class="btn btn-sosmed-footer text-white btn-floating m-1"
                    style="background-color: #0082ca;" href="#!" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-linkedin" viewBox="0 0 16 16">
                        <path
                            d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                    </svg>
                </a>
                <!-- Github -->
                <a data-mdb-ripple-init class="btn btn-sosmed-footer text-white btn-floating m-1"
                    style="background-color: #333333;" href="#!" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-github" viewBox="0 0 16 16">
                        <path
                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8" />
                    </svg>
                </a>
            </section>
        </div>
        <div class="text-center p-3 bg-body-dark text-white">
            Copyright &copy <span style="color: #868686;">2024 CodeVerse</span>
        </div>
    </footer>
    @include('layouts.includes.js')
</body>

</html>
