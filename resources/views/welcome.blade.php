<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Подключаем Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0; /* Серый фон */
            height: 100vh; /* Высота экрана */
            display: flex; /* Flexbox */
            align-items: center; /* Центрируем по вертикали */
            justify-content: center; /* Центрируем по горизонтали */
        }
        .login-register-buttons {
            text-align: center; /* Центрируем текст внутри контейнера */
        }
        .btn {
            margin: 0.5rem; /* Отступ между кнопками */
        }
    </style>
</head>
<body>
    <div class="login-register-buttons">
        <h1>Добро пожаловать</h1>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Войти</a>
        <a href="{{ route('register') }}" class="btn btn-success btn-lg">Регистрация</a>
    </div>

    <!-- Подключаем Bootstrap JS (опционально, если нужен) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>