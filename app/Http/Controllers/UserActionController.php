<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\User;

class UserActionController extends Controller
{
    public function userLogout() {
        Auth::logout();

        return Redirect()->route('login')->with('success', 'User Successfully Logged out');
    }
}
