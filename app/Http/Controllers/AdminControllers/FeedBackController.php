<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;

class FeedBackController extends Controller
{
    public function display()
    {
        $feedback = DB::table('feedback')
        ->leftJoin('users', 'feedback.drivers_id', '=', 'users.id')
            ->leftJoin('customers', 'feedback.customers_id', '=', 'customers.customers_id')
            ->select('feedback.*','users.name as driver_name','customers.name as customer_name')
            ->get();
        return view("admin.feedback.index")->with('feedback', $feedback);
    }
}