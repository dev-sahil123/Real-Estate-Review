<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request){
        $status = 0;
        if($request->tab == 'pending'){
            $status = '0';
        }elseif($request->tab == 'approve'){
            $status = '1';
        }elseif($request->tab == 'reject'){
            $status = '2';
        }
        $properties = Property::where('status', $status)->get();
        return view('admin.properties.index', compact('properties', 'request'));
    }

    public function changeStatus(Request $request, $id){
        $property = Property::find($id);
        $property->status = $request->status;
        $property->save();

        return back()->with('Property '.$request->status_type. 'successfully.');
    }

    public function detail(Request $request){
        $property = Property::find($request->id);
        return view('admin.properties.modals.detail', compact('request', 'property'));
    }

    public function approved()
    {
        $properties = Property::where('status', '0')->get();
        return view('admin.properties.index', compact('properties'));
    }

    public function rejected()
    {
        $properties = Property::where('status', '0')->get();
        return view('admin.properties.index', compact('properties'));
    }
}
