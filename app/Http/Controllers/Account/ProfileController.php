<?php

namespace App\Http\Controllers\Account;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function update(Request $request) {
        $user = User::find(auth()->user()->id);
        if($user->email !== $request->email) {
            $validator = Validator::make($request->all(), [
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users',
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/^[^@]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,}$/', $value)) {
                            $fail($attribute.' is invalid.');
                        } else {
                            list(, $domain) = explode('@', $value);
                            if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
                                $fail($attribute.' has an invalid domain.');
                            }
                        }
                    },
                ],
            ]);
            if ($validator->fails()) {
                return redirect('account/dashboard')->withErrors($validator)->withInput();
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->contact_no = $request->contact_no;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }
}