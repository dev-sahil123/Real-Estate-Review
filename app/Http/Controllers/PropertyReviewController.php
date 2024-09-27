<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PropertyReviewController extends Controller
{
    public function step1(Request $request){
        $support_email = SiteSetting::value('support_email');
        $privacy_security_link = SiteSetting::value('privacy_security_link');
        return view('frontend.property_review.step1', compact('support_email', 'privacy_security_link'));
    }
    public function storeStep1(Request $request){
        $property = new Property;
        $slug = '';
        do {
            $slug = Str::uuid();
            $existing_slug = Property::where('slug', $slug)->exists();
        } while ($existing_slug);

        $property->slug =  $slug;
        $property->step =  $request->step;
        $property->user_id = auth()->id();
        $property->save();
        
        return redirect('write_a_review/step2?slug='.$property->slug);
    }

    public function step2(Request $request){
        if($request->slug){
            $property = Property::where('slug', $request->slug)->first();
        }else{
            return redirect('write_a_review/step1');
        }
        // pred($property);
        return view('frontend.property_review.step2', compact('property'));
    }
    public function storeStep2(Request $request){
        if($request->slug){
            $property = Property::where('slug', $request->slug)->first();
        }else{
            return redirect('write_a_review/step1');
        }
        
        $property->name = $request->name;
        $property->address = $request->address;
        $property->review = $request->review;
        $property->rating = $request->rating;
        $property->suburb = $request->suburb;
        $property->latitude = $request->latitude;
        $property->longitude = $request->longitude;
        $property->rent_move_in = $request->rent_move_in;
        $property->rent_increase = $request->rent_increase;
        $property->rent_increase_opinion = $request->rent_increase_opinion;
        $property->property_condition = $request->property_condition;
        $property->property_condition_opinion = $request->property_condition_opinion;
        $property->step =  $request->step;
        $property->save();

        return redirect('write_a_review/step3?slug='.$property->slug);
    }

    public function step3(Request $request){
        if($request->slug){
            $property = Property::where('slug', $request->slug)->first();
        }else{
            return redirect('write_a_review/step1');
        }
        
        return view('frontend.property_review.step3', compact('property'));
    }
    public function storeStep3(Request $request){
        if($request->slug){
            $property = Property::where('slug', $request->slug)->first();
        }else{
            return redirect('write_a_review/step1');
        }
        $property->relation_landlord = $request->relation_landlord;
        $property->relation_landlord_opinion = $request->relation_landlord_opinion;
        $property->property_living_condition = $request->property_living_condition;
        $property->property_living_condition_opinion = $request->property_living_condition_opinion;
        $property->legal_issue_property = $request->legal_issue_property;
        $property->legal_issue_property_opinion = $request->legal_issue_property_opinion;
        $property->legal_issue_landlord = $request->legal_issue_landlord;
        $property->legal_issue_landlord_opinion = $request->legal_issue_landlord_opinion;
        $property->step = $request->step;

        $property->save();
        
        return redirect('')->with('success', 'Review saved successfully.');
    }
}