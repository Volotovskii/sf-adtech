<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Offer;
use App\Models\User;
use App\Models\RedirectFailure;
use App\Models\LinkLog;
use App\Models\Statistic;
use Illuminate\Http\Request;
// под рег новых
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{


    public function showCreateUserForm()
    {
        return view('admin.create-user'); // шаблон
    }

    //под форму
    public function createUser(Request $request)
    {
        // Валидация
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email|max:191',
            'password' => 'required|string|min:8|confirmed', // confirmed проверяет password_confirmation
            'role' => ['required', Rule::in(['advertiser', 'webmaster'])], // Проверяем, что роль одна из разрешённых
            'status' => ['required', Rule::in(['approved'])], // Или просто 'approved' по умолчанию, без выбора в форме
        ]);

        // Создание пользователя
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Хешируем пароль
        $user->role = $request->role;
        $user->status = $request->status; // или просто 'approved', если это всегда так
        $user->account_is_active = false; // Обычно новый пользователь сразу активен

        $user->save();

        $user->assignRole($request->role);

        // Возвращаемся на страницу со списком пользователей с сообщением
        return redirect()->route('admin.users')->with('success', 'Пользователь успешно создан.');
    }


    public function dashboard()
    {
        $totalClicks = Click::count();
        $totalOffers = Offer::count();
        $totalUsers = User::count();

        return view('admin.dashboard', compact('totalClicks', 'totalOffers', 'totalUsers'));
    }

    public function stats(Request $request)
    {
        $groupBy = $request->input('group_by', 'day');

        switch ($groupBy) {
            case 'hour':
                $stats = Click::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as period, COUNT(*) as count')
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get();
                break;
            case 'minute':
                $stats = Click::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:00") as period, COUNT(*) as count')
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get();
                break;
            case 'day':
            default:
                $stats = Click::selectRaw('DATE(created_at) as period, COUNT(*) as count')
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get();
                break;
        }

        return view('admin.stats', compact('stats', 'groupBy'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // public function toggleUser($id)
    // {
    //     $user = User::find($id);
    //     $user->update(['is_active' => !$user->is_active]);
    //     return redirect()->back()->with('success', 'User status updated.');
    // }
    public function toggleUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            // Возвращаем JSON-ошибку
            return response()->json(['success' => false, 'message' => 'Пользователь не найден.'], 404);
        }

        // Получаем текущий статус перед обновлением
        $currentActiveStatus = $user->account_is_active;

        // Переключаем статус
        $user->update(['account_is_active' => !$currentActiveStatus]);

        // Возвращаем JSON-успех с новым статусом
        if ($request->ajax() || $request->wantsJson()) {

            return response()->json([
                'success' => true,
                'message' => 'Статус обновлён.',
                'account_is_active' => !$currentActiveStatus, // новый статус
                'user_id' => $user->id
            ]);
        }

        return redirect()->back()->with('success', 'Статус обновлён!');

    }

    public function systemStats()
    {
        $totalSystemRevenue = Statistic::sum('system_revenue');
        $totalClicks = Click::count();
        $totalRedirects = Click::whereNotNull('redirected_at')->count();
        //$failedRedirects = Click::whereNull('redirected_at')->count();
        $failedRedirects = RedirectFailure::count();
        //$totalLinksGiven = LinkLog::count();
        $totalLinksGiven = \App\Models\Subscription::where('is_active', true)->count();

        return view('admin.system-stats', compact(
            'totalSystemRevenue',
            'totalClicks',
            'totalRedirects',
            'failedRedirects',
            'totalLinksGiven'
        ));
    }

    // просмотр отказов
    public function redirectFailures()
    {
        $failures = RedirectFailure::with(['webmaster', 'offer'])->latest()->paginate(50);

        return view('admin.redirect-failures', compact('failures'));
    }

    // просмотр выданных ссылок
    public function linkLogs()
    {
        $logs = LinkLog::with(['webmaster', 'offer'])->latest()->paginate(50);

        return view('admin.link-logs', compact('logs'));
    }

    //"ожидающими" пользователями
    public function pendingUsers()
    {
        $pendingUsers = User::where('status', 'pending')->get();
        return view('admin.pending-users', compact('pendingUsers'));
    }

    public function approveUser($id)
    {
        $user = User::find($id);
        $user->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Пользователь одобрен.');
    }


    public function rejectUser($id)
    {
        $user = User::find($id);
        $user->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Пользователь отклонён.');
    }
}
