<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updateUser(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'min:6',
            ],
            [
                'name.required' => 'Поле обязательно для ввода',
                'email.required' => 'Поле обязательно для ввода',
                'email.email' => 'Введите нужный формат',
                'password.min' => 'Минимальное количество символов для пароля - 6',

            ]
        );
        $user = User::find(Auth::user()->id);
        $password = $request->password !== null ? Hash::make($request->password) : $user->password;
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);
        return redirect()->back()->with('success', 'Данные профиля обновлены');
    }

    public function block(User $user){
        if ($user->is_blocked === 0) {
            $user->update(['is_blocked' => true]);
        } else {
            $user->update(['is_blocked' => false]);
        }
        return redirect()->back()->with('success', 'Статус пользователя изменён!');
    }
}
