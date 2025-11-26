<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel')</title>
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
        .form-container {
            width: 100%;
            max-width: 400px; /* Ограничиваем ширину формы */
            padding: 2rem;
            background-color: white; /* Белый фон для формы */
            border-radius: 0.5rem; /* Скругление углов */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); /* Тень */
        }
    </style>
</head>
<body>
    <div class="form-container">
        @yield('content')
    </div>

    <!-- Подключаем Bootstrap JS (опционально, если нужен) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>