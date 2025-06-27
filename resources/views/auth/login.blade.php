<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">


    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(-45deg, #102846, #1c3a5a, #1e3d66, #102846);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.96);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease;
        }

        .login-logo img {
            width: 100px;
            margin-bottom: 10px;
            animation: zoomIn 1s ease;
        }

        .btn-login {
            background: linear-gradient(135deg, #004085, #0056b3);
            border: none;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.7); }
            to { opacity: 1; transform: scale(1); }
        }

        .text-muted {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="login-box text-center">
        <div class="login-logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <div class="mt-2">
                <b>Colegio Privado</b><br>
                <b>"José Abelardo Quiñones"</b>
            </div>
            <div class="mt-2 text-muted">
                Plataforma de Asistencia Escolar
            </div>
        </div>

        <h4 class="mt-3 mb-3">Iniciar sesión</h4>

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="email" name="email" class="form-control rounded-pill" placeholder="Correo electrónico" required autofocus>
            </div>

            <div class="form-group input-group">
                <input type="password" name="password" id="password" class="form-control rounded-left" placeholder="Contraseña" required>
                <div class="input-group-append">
                    <span class="input-group-text rounded-right">
                        <a href="#" id="togglePassword"><i class="fas fa-eye" id="icon-password"></i></a>
                    </span>
                </div>
            </div>

            <div class="form-group form-check text-left">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-login" onclick="showLoader(this)">
                <i class="fas fa-sign-in-alt mr-1"></i> Ingresar
            </button>
        </form>

        <p class="text-muted mt-4 mb-0">
            © {{ date('Y') }} Colegio Privado "José Abelardo Quiñones"
        </p>
    </div>

    <!-- Scripts -->
    <script>
        function showLoader(btn) {
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Ingresando...';
            btn.form.submit();
        }

        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('togglePassword');
            const input = document.getElementById('password');
            const icon = document.getElementById('icon-password');

            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>

