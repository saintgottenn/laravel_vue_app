<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    public function getRoles() 
    {
        $user = User::find(Auth::id());

        return response()->json($user->getRoleNames());
    }
}
