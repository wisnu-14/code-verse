<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('image/assets/logo/code-verse-tittle.png') }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    @include('layouts.includes.cdn')
    @include('layouts.includes.fonts')
    @yield('custom-css-admin-page')
</head>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: rgb(15, 23, 41);

}

    li {
    list-style: none;
}

a {
    text-decoration: none;
}

.main {
    min-height: 100vh;
    width: 100%;
    overflow: hidden;
}

#sidebar {
    max-width: 190px;
    min-width: 190px;
    transition: all 0.35s ease-in-out;
    background-color: #00224D;
    display: flex;
    flex-direction: column;
}

#sidebar.collapsed {
    margin-left: -190px;
}

.toggler-btn {
    background-color: transparent;
    cursor: pointer;
    border: 0;
}

.toggler-btn i {
    font-size: 1rem;
    color: #ffffff;
    font-weight: 1000;
}

.sidebar-nav {
    flex: 1 1 auto;

}

.sidebar-logo {
    padding: 1.15rem 1.5rem;
    text-align: center;
}

.sidebar-logo a {
    color: #FFF;
    font-weight: 800;
    font-size: 1.5rem;
}

.sidebar-header {
    color: #FFF;
    font-size: .6rem;
    padding: 1.5rem 1.5rem .375rem;
}

.sidebar-item {
    align-items: center;
    display: block;
    margin-top: 20px;
}

a.sidebar-link {
    padding: .625rem 1.625rem;
    color: #FFF;
    position: relative;
    transition: all 0.35s;
    display: block;
    font-size: .8rem;
}

.active {
    background: rgb(2, 0, 36);
    background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(168, 16, 190, 1) 0%, rgba(129, 8, 221, 1) 51%, rgba(111, 0, 255, 1) 100%);
}

a.sidebar-link:hover {
    background: rgb(2, 0, 36);
    background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(168, 16, 190, 1) 0%, rgba(129, 8, 221, 1) 51%, rgba(111, 0, 255, 1) 100%);
}

.sidebar-link[data-bs-toggle="collapse"]::after {
    border: solid;
    border-width: 0 .075rem .075rem 0;
    content: "";
    display: inline-block;
    padding: 2px;
    position: absolute;
    right: 1.5rem;
    top: 1.4rem;
    transform: rotate(-135deg);
    transition: all .2s ease-out;
}

.sidebar-link[data-bs-toggle="collapse"].collapsed::after {
    transform: rotate(45deg);
    transition: all .2s ease-out;
}

@media (max-width:768px) {

    .sidebar-toggle {
        margin-left: -190px;
    }

    #sidebar.collapsed {
        margin-left: 0;
    }
}

</style>
<body>
    <div class="d-flex">
        <aside id="sidebar" class="sidebar-toggle">
            <div class="sidebar-logo">
                <a href="#">CodeVerse</a>
            </div>
            <ul class="sidebar-nav p-0">
                <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard" class="sidebar-link">
                        <i class="bi bi-display"></i>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('user') ? 'active' : '' }}">
                    <a href="/user" class="sidebar-link">
                        <i class="bi bi-person-badge"></i>
                        Users
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('manageMateri') ? 'active' : '' }}">
                    <a href="/manageMateri" class="sidebar-link">
                        <i class="bi bi-file-earmark-code"></i>
                        <span>Materi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('manageTutorial') ? 'active' : '' }}">
                    <a href="/manageTutorial" class="sidebar-link">
                        <i class="bi bi-code-slash"></i>
                        <span>Tutorial</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('requests') ? 'active' : '' }}">
                    <a href="/requests" class="sidebar-link">
                        <i class="bi bi-chat-right-dots"></i>
                        <span>Requests</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>wisnu</span>
                </a>
            </div>
        </aside>

        <div class="main">
            <nav class="navbar navbar-expand">
                <button class="toggler-btn" type="button">
                    <i class="bi bi-menu-app-fill"></i>
                </button>
            </nav>
            <main class="p-3">
                @yield('adminContent')
            </main>
        </div>
    </div>
    @include('layouts.includes.js')
    @yield('custom-js-admin-page')
    <script src="{{ asset('js/admin/admin.js') }}"></script>
</body>

</html>
