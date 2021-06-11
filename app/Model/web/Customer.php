<?php

namespace App\Model\web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;
use Hash;
class Customer extends Model
{
    //
    public function signupProcess($request)
    {
        $res = array();

        $user_name = $request->user_name;
        $email = $request->email;
        $name = $request->name;
        $password = $request->password;
        //$token = $request->token;
        $date = date('y-m-d h:i:s');

        //echo "Value is completed";
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'user_phone' => $request->user_phone,
            'role_type' => 3,
            'password' => Hash::make($password),
            'created_at' => $date,
            'updated_at' => $date,
        );

        //eheck email already exit
        $user_email = DB::table('users')->select('email')->where('role_type', 3)->where('email', $email)->get();
        if (count($user_email) > 0) {
            $res['email'] = "true";
            return $res;
        } else {
            $res['email'] = "false";
            $customer_id = DB::table('users')->insertGetId($data);
            if (!empty($customer_id)) {
                $res['insert'] = "true";

                //check authentication of email and password

                // if (auth()->guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                //     $res['auth'] = "true";
                //     $customer = auth()->guard('customer')->user();
                //     //set session
                //     session(['customers_id' => $customer->id]);

                //     //cart
                //     $cart = DB::table('customers_basket')->where([
                //         ['session_id', '=', $old_session],
                //     ])->get();

                //     if (count($cart) > 0) {
                //         foreach ($cart as $cart_data) {
                //             $exist = DB::table('customers_basket')->where([
                //                 ['customers_id', '=', $customer->id],
                //                 ['products_id', '=', $cart_data->products_id],
                //                 ['is_order', '=', '0'],
                //             ])->delete();
                //         }
                //     }

                //     DB::table('customers_basket')->where('session_id', '=', $old_session)->update([
                //         'customers_id' => $customer->id,
                //     ]);

                //     DB::table('customers_basket_attributes')->where('session_id', '=', $old_session)->update([
                //         'customers_id' => $customer->id,
                //     ]);

                //     //insert device id
                //     if (!empty(session('device_id'))) {
                //         DB::table('devices')->where('device_id', session('device_id'))->update(['customers_id' => $customer->id]);
                //     }

                    $customers = DB::table('users')->where('id', $customer_id)->get();
                    $result['customers'] = $customers;
                    //email and notification
                    // $myVar = new AlertController();
                    // $alertSetting = $myVar->createUserAlert($customers);
                    $res['result'] = $result;
                    return $res;
                // } else {
                //     $res['auth'] = "true";
                //     return $res;
                // }

            } else {
                $res['insert'] = "false";
                return $res;
            }
        }

    }
}
