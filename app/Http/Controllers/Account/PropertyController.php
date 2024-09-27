<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\FavoriteProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\Document;
use App\Models\Image;

class PropertyController extends Controller
{
    public function addFavorite(Request $request) {
        $property = Property::where('slug', $request->property_slug)->first();
        if($property->user_id == auth()->user()->id){
            return response("You can't favorite your own property", 405);
        }
        if($property) {
            $favorite_property = FavoriteProperty::where('user_id', auth()->id())->where('property_id', $property->id)->first();
            if($favorite_property) {
                $favorite_property->delete();
                return response(['success', 'Property removed from, favorite successfully']);
            }else{
                $favorite_property = new FavoriteProperty();
                $favorite_property->property_id =  $property->id;
                $favorite_property->user_id = auth()->id();
                $favorite_property->save();
                return response(['success', 'Property add to favorite successfully']);
            }
        }
    }

    public function edit(Request $request) {
        if($request->slug) {
            $property = Property::where('slug', $request->slug)->first();
        }else{
            $property = new Property;
        }
        return view('account.property.edit', compact('property', 'request'));
    }

    public function store(Request $request) {
        if($request->slug) {
            $property = Property::where('slug', $request->slug)->first();
        } else {
            $property = new Property;
            $slug = '';
            do {
                $slug = Str::uuid();
                $existing_slug = Property::where('slug', $slug)->exists();
            } while ($existing_slug);
            $property->slug =  $slug;
        }

        $property->user_id = auth()->id();
        $property->name = $request->name;
        $property->address = $request->address;
        $property->suburb = $request->suburb;
        $property->latitude = $request->latitude;
        $property->longitude = $request->longitude;
        $property->rent_move_in = $request->rent_move_in;
        $property->rent_increase = $request->rent_increase;
        $property->rent_increase_opinion = $request->rent_increase_opinion;
        $property->property_condition = $request->property_condition;
        $property->relation_landlord = $request->relation_landlord;
        $property->legal_issue_property = $request->legal_issue_property;
        $property->legal_issue_landlord = $request->legal_issue_landlord;
        $property->rent_increase_file = isset($rent_increase_file) ? $rent_increase_file : null;
        $property->status = '0';
        
        $property->save();

        if ($request->property_image_ids) {
            Image::whereIn('id', json_decode($request->property_image_ids))->update(['type_id' => $property->id]);
        }
        if ($request->rent_increase_file_ids) {
            Document::whereIn('id', json_decode($request->rent_increase_file_ids))->update(['type_id' => $property->id]);
        }
        if ($request->property_file_ids) {
            Document::whereIn('id', json_decode($request->property_file_ids))->update(['type_id' => $property->id]);
        }
        if ($request->relation_landlord_file_ids) {
            Document::whereIn('id', json_decode($request->relation_landlord_file_ids))->update(['type_id' => $property->id]);
        }

        return redirect('account/dashboard?tab=properties')->with('success', 'Property review saved successfully.');
    }
}