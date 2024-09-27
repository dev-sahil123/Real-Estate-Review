<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterMenu;

class FooterMenuController extends Controller
{
    public function index(){
        $footer_menus = FooterMenu::all();

        return view('admin.site_settings.footer.index', compact('footer_menus'));
    }

    public function add(Request $request){
        if($request->id){
            $footer_menu = FooterMenu::find($request->id);
        }else{
            $footer_menu = new FooterMenu();
        }

        return view('admin.site_settings.footer.modal.add', compact('footer_menu'));
    }

    public function store(Request $request){
        if($request->id){
            $footer_menu = FooterMenu::find($request->id);
        }else{
            $footer_menu = new FooterMenu();
        }

        $footer_menu->name = $request->name;
        $footer_menu->link = $request->link;
        $footer_menu->category_name = $request->category_name;
        $footer_menu->status = $request->status;
        $footer_menu->save();

        return back()->with('success', 'Menu saved successfully.');
    } 

    public function delete($id){
        $footer_menu = FooterMenu::find($id);
        $footer_menu->delete();

        return back()->with('success', 'Menu deleted successfully.');
    }
}
