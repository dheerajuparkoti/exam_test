<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-MCQ</title>
    <link rel="stylesheet"href="{{ asset('assets/css/users/loginpage.css') }}">
</head>

<body>
    <header>
        <h2 class="MCQS">MCQs for Engineers</h2>
        <nav class ="navigation">
            {{-- <a href="#">Home</a> --}}
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Services</a>
            <button class ="btnsignin-popup">Login</button>
        </nav>
    </header>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
        @endforeach
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Information!</strong> {{ $error }}
        </div>


    @endif


    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close"></ion-icon></span>
        <div class="form-box login">
            <h2>login</h2>
            <form action="{{ route('login.submit') }}" method="post">
                @csrf
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class ="remember-forget">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit"class="btn">login</button>
                <div class="login-register">
                    <p>Don't Have An Account?
                        <a href="#" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>

        <!--for register-->

        <div class="form-box register">
            <h2>Registration</h2>
            <form action="#">
                <div class ="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text"required>
                    <label>UserName</label>
                </div>

                <div class ="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email"required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password"required>
                    <label>password</label>

                </div>
                <div class ="remember-forget">
                    <label><input type="checkbox">I agree to the terms & conditions</label>

                </div>
                <button type="submit"class="btn">Register</button>
                <div class="login-register">
                    <p>Already Have An Account?
                        <a href="#" class="login-link">login</a>
                    </p>
                </div>
            </form>
        </div>
        <script src="{{ asset('assets/js/users/loginpage.js') }}"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
