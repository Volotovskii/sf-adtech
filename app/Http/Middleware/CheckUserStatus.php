<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Проверяем, авторизован ли пользователь
        if (Auth::check()) {
            $user = Auth::user();

            // Проверяем статус
            if ($user->status !== 'approved') {
                // Если статус не 'approved', показываем страницу ожидания модерации
                return response()->view('auth.pending', ['user' => $user], 403);
            }

            // Проверяем активность аккаунта (новое имя столбца)
            if (!$user->account_is_active) { // <-- Используем новое имя
                // Если пользователь не активен, показываем страницу блокировки
                return response()->view('auth.banned', ['user' => $user], 403);
            }

            // Если статус 'approved' и account_is_active = true, продолжаем
        }

        // Если пользователь не авторизован или все проверки пройдены
        return $next($request);
    }
}