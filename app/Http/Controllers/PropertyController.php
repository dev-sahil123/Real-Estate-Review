<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProperty;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index(Request $request) {
        if($request->city){
            $properties = Property::where('suburb', $request->city)->where('status', '1')->get();
        }else{
            $properties = Property::where('status', '1')->with('user')->get();
        }

        return view('frontend.properties.index', compact('properties', 'request'));
    }

    public function detail(Request $request, $slug) {
        $property = Property::where('slug', $slug)->first();
        if(!$property) {
            abort(404);
        }
        
        return view('frontend.properties.detail', compact('property'));
    }
}