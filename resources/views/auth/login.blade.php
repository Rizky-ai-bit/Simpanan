<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/JM.png') }}" rel="icon">
    <link href="{{ asset('assets/img/JM.png') }}" rel="apple-touch-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, beige, skyblue);
            padding: 20px;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(rgba(187, 251, 255, 0.8), rgba(141, 216, 255, 0.8)), url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 50px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .left-panel h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .left-panel p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .right-panel {
            flex: 1;
            padding: 50px 40px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h1 {
            color: rgba(34, 135, 236, 0.8);
            font-size: 32px;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #777;
            font-size: 16px;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
            outline: none;
        }

        .input-group input:focus {
            border-color: rgba(109, 108, 131, 0.8);
            box-shadow: 0 0 0 2px rgba(34, 135, 236, 0.8);
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 42px;
            color: #888;
            font-size: 18px;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, #6c63ff, rgba(34, 135, 236, 0.8));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 25px;
        }

        .login-btn:hover {
            background: linear-gradient(to right, rgba(34, 135, 236, 0.8), #3d36c2);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.4);
        }

        .separator {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .separator .line {
            flex: 1;
            height: 1px;
            background: #ddd;
        }

        .separator span {
            padding: 0 15px;
            color: #777;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f5f5;
            color: #555;
            font-size: 20px;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: all 0.3s;
        }

        .social-btn:hover {
            background: #e9e9e9;
            transform: translateY(-3px);
        }

        .signup-link {
            text-align: center;
            color: #777;
        }

        .signup-link a {
            color: #6c63ff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .signup-link a:hover {
            color: #4a42d4;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                max-width: 500px;
            }

            .left-panel {
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            .options {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .forgot-password {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-panel">
            <h2>Selamat Datang</h2>
        </div>

        <div class="right-panel">
            <div class="login-header">
                <h1>Masuk ke Akun</h1>
                <p>Silakan masukkan username dan password Anda untuk melanjutkan</p>
            </div>

            <form id="loginForm" action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="username">Email</label>
                    <i class="fas fa-user"></i>
                    <input type="email" name="email" id="username" placeholder="Masukkan email" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="login-btn">Masuk</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            @if (session('sukses'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('sukses') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    html: `
                    <img src="https://media.giphy.com/media/v1.Y2lkPWVjZjA1ZTQ3bjVreHM0cGczb3R6YThlbWxxb2wwMmc4eHB1aHp5bWVjOTJzOTViOSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/5xqyWhU3zZ0qZ6C6di/giphy.gif"
                    width="140"
                    style="border-radius: 10px;"
                    alt="Logout GIF">
                    <p style="margin-top: 10px;">Cek Kembali Password Dan Emailnya!!!</p>`,
                    title: 'Kesalahan!',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });

            // Form submission with SweetAlert
            const loginForm = document.getElementById('loginForm');

            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                const remember = document.getElementById('remember').checked;

                // Animasi tombol
                const loginBtn = document.querySelector('.login-btn');
                loginBtn.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    loginBtn.style.transform = '';
                }, 200);

                // Validasi input
                if (!username || !password) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Silakan isi username dan password!',
                        confirmButtonColor: '#1a2980',
                        background: '#fff',
                        iconColor: '#e74c3c'
                    });
                    return;
                }

                // Simulasi loading
                Swal.fire({
                    title: 'Memproses...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });

            // Animasi input focus
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('i').style.color = '#1a2980';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('i').style.color = '#888';
                });
            });
        });
    </script>
</body>

</html>
