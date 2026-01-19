<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //Get All Users
    public function index()
    {
        $authUser = auth()->user();

        // تحقق لو المستخدم Admin
        if (!$authUser->hasRole('admin')) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $users = User::all()->map(function($u) {
            return [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'roles' => $u->getRoleNames()
            ];
        });

        return response()->json($users);
    }
    //Get User By ID
    public function getUserById($id)
    {
        $authUser = auth()->user();

        if (!$authUser->hasRole('admin')) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->getRoleNames()
        ]);
    }
    //Edit User Role
    public function updateRole(Request $request, User $user)
    {
        $authUser = auth()->user();

        if (!$authUser->hasRole('admin')) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $request->validate([
            'role' => 'required|string|exists:roles,name'
        ]);

        $user->syncRoles([$request->role]);

        return response()->json([
            'message' => 'Role updated successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames()
            ]
        ]);
    }
    //Get ALL Role
    public function getRoles()
    {
        $authUser = auth()->user();

        if (!$authUser->hasRole('admin')) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $roles = Role::all()->pluck('name');
        return response()->json($roles);
    }
}
