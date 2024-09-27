<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\FooterMenu;
use App\Models\Property;

class HomeController extends Controller
{
    public function index(Request $request) {
        $site_settings = SiteSetting::whereIn('name', ['header_text', 'steps'])->pluck('value', 'name');
        $footer_menus = FooterMenu::where('status', '1')->get();

        $property_reviews = Property::where('status', '1')->select('rating', 'review', 'user_id', 'slug')->with('user')->limit(10)->latest()->get();
        $properties = Property::where('status', '1')->select('latitude', 'longitude','slug');
        if($request->suburb && $request->rating){
            $properties->where('suburb', $request->suburb)->where('rating', $request->rating);
        }
        $properties = $properties->limit(10)->latest()->get();

        return view('frontend.index', compact('request', 'properties', 'property_reviews', 'site_settings', 'footer_menus'));
    }
}