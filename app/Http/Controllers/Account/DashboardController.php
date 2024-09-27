<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index(Request $request) {
        if(!in_array($request->tab, ['profile', 'properties', 'favourite'])) {
            $request->tab = 'profile';
        }

        $properties = Property::where('user_id', auth()->user()->id)->whereIn('step', ['2', '3'])->get();
        return view('account.dashboard.index',compact('properties', 'request'));
    }
}