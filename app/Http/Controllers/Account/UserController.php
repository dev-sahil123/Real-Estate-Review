<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile(Request $request) {
        $user = User::find(auth()->id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->save();

        return redirect()->back()->with('success', 'Profile update successfully.');
    }
}