<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-MCQ</title>
    <link rel="stylesheet" href="{{ asset('assets/css/users/loginpage.css') }}">
    <style>
       /* Modal Styles */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto; /* Centered vertically */
    padding: 20px;
    border: 1px solid #888;
    width: 300px; /* Smaller width for minimized modal */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px; /* Rounded corners */
}

.close {
    color: #aaa;
    float: right;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
}

.verification-message {
    margin-top: 10px;
    font-size: 14px;
    color: #555; /* Grey color for the message */
    text-align: center;
}

.password-box {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: #555;
    }
    </style>
</head>

<body>
    <header>
        <h2 class="MCQS">MCQs for Engineers</h2>
        <nav class="navigation">
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Services</a>
            <button class="btnsignin-popup">Login</button>
        </nav>
    </header>

    @if ($errors->any())
    <div class="alert alert-danger">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Oops!</strong> There were some problems with your input.<br>
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Success!</strong> {{ session('success') }}
    </div>
    @endif

    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close"></ion-icon></span>

        <!-- Login Form -->
        <div class="form-box login">
            <h2>Login</h2>
            <form action="{{ route('login.submit') }}" method="post">
                @csrf
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box password-box">
                    <span class="icon"></span>
                    <input type="password" name="password" id="password1" required>
                    <label>Password</label>
                    <span class="toggle-password" onclick="togglePassword1()">
                        <ion-icon name="eye-outline" id="toggleIcon"></ion-icon>
                    </span>
                </div>




            
                <div class="remember-forget">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't Have An Account?
                        <a href="#" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>
<!-- Registration Form -->
<div class="form-box register">
    <h2>Registration</h2>
    <form id="registrationForm" action="{{ route('user.register') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-box">
            <span class="icon"><ion-icon name="person"></ion-icon></span>
            <input type="text" name="name" required>
            <label>Full Name</label>
        </div>
        <div class="input-box">
            <span class="icon"><ion-icon name="person"></ion-icon></span>
            <input type="text" name="user_name" required>
            <label>Username</label>
        </div>
        <div class="input-box">
            <span class="icon"><ion-icon name="mail"></ion-icon></span>
            <input type="email" name="email" required>
            <label>Email</label>
        </div>
        <div class="input-box password-box">
            <span class="icon"></span>
            <input type="password" name="password" id="password" required>
            <label>Password</label>
            <span class="toggle-password" onclick="togglePassword()">
                <ion-icon name="eye-outline" id="toggleIcon"></ion-icon>
            </span>
        </div>
        <div class="remember-forget">
            <label>
                <input type="checkbox" name="terms" id="termsCheckbox" required> 
                I agree to the terms & conditions
            </label>
        </div>
        <button type="submit" class="btn" id="registerButton">Register</button>
        <div class="login-register">
            <p>Already Have An Account?
                <a href="#" class="login-link">Login</a>
            </p>
        </div>
    </form>
</div>
    </div>

    <!-- Verification Modal -->
    <div id="verificationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Verification</h2>
            <form id="verificationForm" action="{{ route('verify.code.submit') }}" method="post">
                @csrf
                <div class="input-box">
                    <span class="icon"><ion-icon name="key"></ion-icon></span>
                    <input type="text" name="verification_code" required>
                    <label>Enter Verification Code</label>
                </div>
                 <!-- Message below the input box -->
            <p class="verification-message">A verification code has been sent to your email.</p>

                <button type="submit" class="btn">Verify</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/users/loginpage.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        // Get modal element
        var modal = document.getElementById("verificationModal");

        // Get close button
        var closeBtn = document.getElementsByClassName("close")[0];

        // Get registration form
        var registerForm = document.getElementById("registrationForm");

        // Function to open modal
        function openModal() {
            modal.style.display = "block";
        }

        // Function to close modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Listen for form submission
        registerForm.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            var formData = new FormData(registerForm);
            
            fetch('{{ route('user.register') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Open the verification modal
                    openModal();
                } else {
                    // Handle registration failure
                    console.error('Registration failed:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Close the modal when clicking on the 'x'
        closeBtn.onclick = function() {
            closeModal();
        }

        // Close the modal when clicking outside of the modal
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }





         // Toggle password visibility
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.name = 'eye-off-outline';
        } else {
            passwordInput.type = 'password';
            toggleIcon.name = 'eye-outline';
        }
    }

    function togglePassword1() {
        const passwordInput = document.getElementById('password1');
        const toggleIcon = document.getElementById('toggleIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.name = 'eye-off-outline';
        } else {
            passwordInput.type = 'password';
            toggleIcon.name = 'eye-outline';
        }
    }
    // Ensure terms checkbox is checked before form submission
    document.getElementById('registrationForm').addEventListener('submit', function (event) {
        const termsCheckbox = document.getElementById('termsCheckbox');
        if (!termsCheckbox.checked) {
            event.preventDefault();
            alert('Please agree to the terms & conditions before proceeding.');
        }
    });
    </script>
</body>

</html>
