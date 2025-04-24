<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- ===== BOX ICONS ===== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>Authentication</title>
</head>

<body>
    <div class="login">
        <div class="login__content">
            <div class="login__img">
                <img src="{{ asset('image/assets/img-login.svg') }}" alt="">
            </div>
            <div class="login__forms">

                <form action="{{ route('login.post') }}" class="login__registre" id="login-in" method="POST">
                    @csrf
                    <h1 class="login__title">Login</h1>
                    @if ($errors->any())
                        <div>
                            @foreach ($errors->all() as $error)
                                <p style="color: red;">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input type="text" name="name" placeholder="name" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" placeholder="Password" class="login__input">
                    </div>
                    <button type="submit" class="login__button container-fluid">Login</button>
                    <div>
                        <span class="login__account">Belum Punya Akun ?</span>
                        <span class="login__signin" id="sign-up">Buat akun</span>
                    </div>
                </form>

                <form action="{{ route('register.post') }}" class="login__create none" id="login-up" method="POST">
                    @csrf
                    <h1 class="login__title">Buat Akun</h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" name="name" placeholder="Username" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input type="text" name="email" placeholder="Email" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" placeholder="Password" class="login__input">
                    </div>
                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password_confirmation" placeholder="Konfirm Password"
                            class="login__input">
                    </div>

                    <button type="submit" class="login__button container-fluid">Buat akun</button>

                    <div>
                        <span class="login__account">Sudah Punya Akun ?</span>
                        <span class="login__signup" id="sign-in">Login</span>
                    </div>

                    <div class="login__social">
                        <a href="#" class="login__social-icon"><i class='bx bxl-facebook'></i></a>
                        <a href="#" class="login__social-icon"><i class='bx bxl-twitter'></i></a>
                        <a href="#" class="login__social-icon"><i class='bx bxl-google'></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===== MAIN JS =====-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        /*===== LOGIN SHOW and HIDDEN =====*/
        const signUp = document.getElementById('sign-up'),
            signIn = document.getElementById('sign-in'),
            loginIn = document.getElementById('login-in'),
            loginUp = document.getElementById('login-up')


        signUp.addEventListener('click', () => {
            // Remove classes first if they exist
            loginIn.classList.remove('block')
            loginUp.classList.remove('none')

            // Add classes
            loginIn.classList.toggle('none')
            loginUp.classList.toggle('block')
        })

        signIn.addEventListener('click', () => {
            // Remove classes first if they exist
            loginIn.classList.remove('none')
            loginUp.classList.remove('block')

            // Add classes
            loginIn.classList.toggle('block')
            loginUp.classList.toggle('none')
        })
    </script>
</body>

</html>
