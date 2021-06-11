<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    
    public function index()
    {
    	$pincodeResult = array();
    	$pincodes = DB::table('pincodes')
           ->select('pincodes.pincodes_val')
           ->get();
	    //$pincodes = array();
	    if (count($pincodes)>0) {
	        foreach ($pincodes as $key => $value) {
	            array_push($pincodeResult, $value->pincodes_val);
	        }
	    }

        return view("web.index")->with('pincodeResult',$pincodeResult);
    }

    
}
