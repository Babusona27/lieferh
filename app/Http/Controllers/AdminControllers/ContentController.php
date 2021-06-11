<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;

class ContentController extends Controller
{

    
    public function termsofuse()
    {
        $term_of_use_text = DB::table('content_pages')
            ->where( 'page_name','=','terms_of_use' )
            ->get();
            // echo "<pre>";print_r($term_of_use_text);exit;
        return view("admin.terms_of_use.edit")->with('term_of_use_text', $term_of_use_text);
    }
    
    public function updatetermsofuse(Request $request)
    {
        $orders_status = DB::table('content_pages')
        ->where( 'page_name','=','terms_of_use' )
        ->update([
            'page_text'    =>   $request->term_of_use_text
                ]);
        $success_msg = "Terms Of Use has been updated successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }
    public function privacypolicy()
    {
        $privacy_policy = DB::table('content_pages')
            ->where( 'page_name','=','privacy_policy' )
            ->get();
            // echo "<pre>";print_r($term_of_use_text);exit;
        return view("admin.privacypolicy.edit")->with('privacy_policy', $privacy_policy);
    }
    
    public function updateprivacypolicy(Request $request)
    {
        $orders_status = DB::table('content_pages')
        ->where( 'page_name','=','privacy_policy' )
        ->update([
            'page_text'    =>   $request->privacy_policy
                ]);
        $success_msg = "privacy policy has been updated successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }
    public function help()
    {
        $help = DB::table('content_pages')
            ->where( 'page_name','=','help' )
            ->get();
            // echo "<pre>";print_r($term_of_use_text);exit;
        return view("admin.help.edit")->with('help', $help);;
    }
    
    public function updatehelp(Request $request)
    {
        $orders_status = DB::table('content_pages')
        ->where( 'page_name','=','help' )
        ->update([
            'page_text'    =>   $request->help
                ]);
        $success_msg = "Terms Of Use has been updated successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }
}
