<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ChangeUserLimitController extends Controller
{
    public function __invoke(User $user)
    {
        if ($user->is_blocked === 0) {
            $user->update(['is_blocked' => true]);
        } else {
            $user->update(['is_blocked' => false]);
        }
        return redirect()->back()->with('success', 'Статус пользователя изменён!');
    }
}
