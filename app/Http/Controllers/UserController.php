<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class UserController extends Controller
{
    public function withoutRedis(Request $request) {
        $role_id = $request->input('role_id');
        $roles = Role::all();

        if ($role_id) {
            $users = User::whereHas('roles', function($q) use ($role_id) {
                $q->where('roles.id', $role_id);
            })->get();
        } else {
            $users = User::with('roles')->get();
        }

        return view('users', compact('users', 'roles', 'role_id'));
    }

    public function withRedis(Request $request) {
        $role_id = $request->input('role_id');
        $roles = Role::all();
        $cacheKey = 'users:all';
        if (Redis::exists($cacheKey)) {
            $users = json_decode(Redis::get($cacheKey));
        } else {
            $users = User::with('roles')->get();
            Redis::set($cacheKey, json_encode($users));
            Redis::expire($cacheKey, 120);
        }

        if ($role_id) {
            $users = User::whereHas('roles', function($q) use ($role_id) {
                $q->where('roles.id', $role_id);
            })->get();
        }

        return view('users', compact('users', 'roles', 'role_id'));
    }
}
