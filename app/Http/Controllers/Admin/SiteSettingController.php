<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;


class SiteSettingController extends Controller
{
    public function homePageIndex(Request $request){
        $site_settings = SiteSetting::whereIn('name', ['header_text', 'steps', 'about_renter', 'renter_say'])->pluck('value', 'name');
        
        return view('admin.site_settings.home_page_index', compact('request', 'site_settings'));
    }
    public function homePageStore(Request $request){
        SiteSetting::updateOrCreate(
            ['name' => 'header_text'],
            ['value' => $request->header_text]
        );
        SiteSetting::updateOrCreate(
            ['name' => 'about_renter'],
            ['value' => $request->about_renter]
        );
        SiteSetting::updateOrCreate(
            ['name' => 'renter_say'],
            ['value' => $request->renter_say]
        );

        SiteSetting::updateOrCreate(
            ['name' => 'steps'],
            ['value' => json_encode($request->step)]
        );

        return back()->with('success', 'Settings saved successfully.');
    }

    public function basicInformation(Request $request) {
        $support_email = SiteSetting::value('support_email');
        $privacy_security_link = SiteSetting::value('privacy_security_link');

        return view('admin.site_settings.basic_information',compact('support_email', 'privacy_security_link'));
    }
    public function basicInformationStore(Request $request) {
        SiteSetting::updateOrCreate(
            ['name' => 'support_email'],
            ['value' => $request->support_email]
        );
        SiteSetting::updateOrCreate(
            ['name' => 'privacy_security_link'],
            ['value' => $request->privacy_security_link]
        );

        return back()->with('success', 'Information saved successfully.');
    }
}