<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user(); // Получаем аутентифицированного пользователя

        // Проверяем статус и активность пользователя *после* входа
        if ($user->status !== 'approved' || !$user->account_is_active) {
            // Если статус не 'approved' или пользователь не активен,
            // вызываем logout вручную
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Перенаправляем обратно на страницу входа с сообщением об ошибке
            return redirect()->route('login')->withErrors([
                'email' => 'Ваш аккаунт не одобрен или отключен. Обратитесь к администратору.',
            ]);
        }

        // Если статус и активность в порядке, проверяем роль и перенаправляем
        // Используем логику, аналогичную redirectTo в модели User
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('webmaster')) {
            return redirect()->route('webmaster.dashboard');
        } elseif ($user->hasRole('advertiser')) {
            return redirect()->route('advertiser.dashboard');
        }

        // Если роль не распознана, можно перенаправить на главную
        return redirect('/'); // или route('home'), если определён
    }


 protected function authenticated(Request $request)
    {
        $user = Auth::user(); // Получаем аутентифицированного пользователя


        // Если статус и активность в порядке, перенаправляем на дашборд по роли
        if ($user->hasRole('admin')) {

            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('webmaster')) {
            return redirect()->route('webmaster.dashboard');
        } elseif ($user->hasRole('advertiser')) {
            return redirect()->route('advertiser.dashboard');
        }

        
        return redirect('/'); // или abort(403);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}