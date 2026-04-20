<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\UpdateUserRoleRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->orderBy('name')
            ->get();

        return response()->json([
            'users' => $users
        ]);
    }

    public function getRecentUsers()
    {
        $recentUsers = User::where('created_at', '>=', now()->subDays(7))->get();

        return response()->json([
            'recentUsers' => $recentUsers
        ]);
    }

    public function updateRole(User $user, UpdateUserRoleRequest $request)
    {
        $data = $request->validated();
        $user->update($data);

        return response()->json([
            'user' => $user
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted.'
        ]);
    }
}
