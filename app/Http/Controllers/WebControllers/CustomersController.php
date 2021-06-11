<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\web\Customer;
use App\Model\web\Order;
use Hash;
use Session;
use Validator;
class CustomersController extends Controller
{
    public function __construct(Customer $customer,Order $order) {
        $this->customer = $customer;
        $this->order = $order;
    }

    public function signup()
    {
        if(empty(Session::get('user'))){
            return view("web.sign_up");
        }else{
            return view("web.sign_in");
        }
        // Session::put('user', [
        //     'first_name' => $request->get('first_name'), 
        //     'user_role' => Auth::user()->user_role, 
        //     'city' => Auth::user()->city]
        // );
        
    }
    
    public function signupProcess(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $user_phone = $request->user_phone;
        $password = $request->password;
        $date = date('y-md h:i:s');
        //        //validation start
        $validator = Validator::make(
            array(
                'name' => $request->name,
                'email' => $request->email,
                'user_phone' => $request->user_phone,
                'password' => $request->password,

            ), array(
                'name' => 'required',
                'email' => 'required | email',
                'user_phone' => 'required',
                'password' => 'required',
            )
        );
        if ($validator->fails()) {
            return redirect('signup')->withErrors($validator)->withInput();
        } else {

            $res = $this->customer->signupProcess($request);
            //eheck email already exit
            if ($res['email'] == "true") {
                return redirect('/signup')->withInput($request->input())->withErrors("Email already exist");
            } else {
                if ($res['insert'] == "true") {
                        $result = $res['result'];
                        Session::put('user', $result['customers']);
                        // Session::forget('guest_checkout');
                        // Session::put('user', [
                        //         'id' => $result['customers'][0]->id,
                        //         'user_name' => $result['customers'][0]->user_name, 
                        //         'email' => $result['customers'][0]->email,
                        //         'user_phone' => $result['customers'][0]->user_phone
                        //     ]);
                        return redirect('/');
                } else {
                    return redirect('/signup')->withErrors("something is wrong");
                }
            }

        }
    }
    public function processSignin(Request $request)
    {
        $validator = Validator::make(
            array(
                'email' => $request->email,
                'password' => $request->password,
            ), array(
                'email' => 'required | email',
                'password' => 'required',
            )
        );
        if(!empty($request->previous_url)){
            $baseurl  = "http://45.82.72.81/startfreshh";
            $str = $request->previous_url;
            if (strpos($str, 'product') !== false) {
                $url = str_replace($baseurl,"",$str);
            }else{
                $url = '/';
            }
        }
        // echo $url;exit;
        if ($validator->fails()) {
            return redirect('signin')->withErrors($validator);
        } else {
            
            $user = DB::table('users')->where('role_type', 3)->where('email', $request->email)->get();
            // echo Hash::check($request->password, $user[0]->password);exit;
            if (count($user) > 0) {
                if( Hash::check($request->password, $user[0]->password) == 1 ){
                    Session::put('user', $user);
                    return redirect($url);
                }else{
                    return redirect('signin')->withErrors("Password not mached!");
                }
            }else {
                return redirect('signin')->withErrors("email not exist!");
            }
        }
        
    }
    public function signin()
    {
        return view("web.sign_in");
    }
    public function logout()
    {
        // session()->flush();
        Session::forget('user');
        return redirect('/');
    }

    public function userOrders()
    {
        if(Session::has('user')){
            $user_details = Session::get('user');
            $result = $this->order->orderList($user_details[0]->id);
            if (!empty($result['orders'])) {
                $result = $result['orders'];
                return view('web.user_order', ["result"=>$result]);
            }else{
                $result = array();
                return view('web.user_order', ["result"=>$result]);
            }
        }else{
            return redirect('/signin');
        }
    }

    public function userAccount()
    {
        if(Session::has('user')){
            return view("web.user_account");
        }else{
            return redirect()->back();
        }
        
    }
    
    public function updateUserAccount(Request $request)
    {
        if(Session::has('user')){
            $current_user_details = Session::get('user');
            $input = $request->all();

            // echo "<pre>"; print_r($input);exit;
            $customers_id = $current_user_details[0]->id;
            $customer_data = array();
            if(!empty($input['name'])){
                $customer_data['name'] = $input['name'];
            }
            if(!empty($input['email'])){
                $customer_data['email'] = $input['email'];
            }
            if(!empty($input['user_phone'])){
                $customer_data['user_phone'] = $input['user_phone'];
            }
            if(!empty($input['current_password']) && !empty($input['new_password'])){
                if (!Hash::check($input['current_password'],$current_user_details[0]->password )){
                    $message    = "current password dose not match.";
                    return redirect()->back()->withErrors($message);
                }else{
                    $customer_data['password'] =  Hash::make($input['new_password']);
                }
            }
            if(!empty($customer_data)){
                $customer_data['updated_at'] = date('Y-m-d H:i:s');
                $user = DB::table('users')->where('id', $customers_id)->update($customer_data);
                $updatedUserData = DB::table('users')->where('id', $customers_id)->get();
                Session::put('user', $updatedUserData);
                $message    = "Profile has been updated successfully.";
                return redirect()->back()->withErrors($message);
            }
        }else{
            return redirect('/signin');
        }
        
    }

    public function userAddress()
    {
        if(Session::has('user')){
            $user_details = Session::get('user');
            $result['address_list'] = DB::table('address_book')->where('user_id', $user_details[0]->id)->get();
            $result['pincodes'] = DB::table('pincodes')->get();
            // echo "<pre>"; print_r($result);exit;
            return view("web.user_address")->with('result', $result);
        }else{
            return redirect('/signin');
        }
    }

    public function addUserAddress(Request $request)
    {
        if(Session::has('user')){
            $input = $request->all();
            $user_details = Session::get('user');
                        // echo "<pre>"; print_r($input);exit;
            $default_address = 0;
            if(empty($input['flat_no'])){
                $message    = "Please enter flat no.";
                return redirect()->back()->with('message', $message);
            }else if(empty($input['street'])){
                $message    = "Please enter street.";
                return redirect()->back()->with('message', $message);
            }else if(empty($input['area'])){
                $message    = "Please enter area.";
                return redirect()->back()->with('message', $message);
            }else if(empty($input['pincode'])){
                $message    = "Please enter pincode.";
                return redirect()->back()->with('message', $message);
            }else{
                if(isset($input['default_address'])){
                    $default_address = $input['default_address'];
                }
                $address_data = array(
                'user_id'         => $user_details[0]->id,
                'flat_no'              => $input['flat_no'],
                'entry_street_address' => $input['street'],
                'area'                 => $input['area'],
                'entry_postcode'       => $input['pincode'],
                'entry_country_id'       => 99,
              );
              
                $id = DB::table('address_book')->insertGetId($address_data);

                if($default_address == 1){
                    $result = DB::table('users')
                        ->where('id', $user_details[0]->id)
                        ->update(array(
                            'default_address_id' => $id,
                        ));
                    $user_details[0]->default_address_id = $id;
                    Session::put('user', $user_details);
                }
                $message    = "Address successfully added.";
                return redirect()->back()->withErrors($message);
            }
        }else{
            return redirect('/signin');
        }
    }

    public function updateaddress(Request $request)
    {
        if(Session::has('user')){
            $user_details = Session::get('user');
            $input = $request->all();
            $default_address = 0;
            $customer_data = array();
            if(!empty($input['flat_no'])){
                $customer_data['flat_no'] = $input['flat_no'];
            }
            if(!empty($input['street'])){
                $customer_data['entry_street_address'] = $input['street'];
            }
            if(!empty($input['area'])){
                $customer_data['area'] = $input['area'];
            }
            if(!empty($input['pincode'])){
                $customer_data['entry_postcode'] = $input['pincode'];
            }
            if(!empty($customer_data)){
                DB::table('address_book')
                    ->where('address_book_id', $input['address_book_id'])
                    ->update($customer_data);
            }
            if(isset($input['default_address'])){
                $default_address = $input['default_address'];
            }
            if($default_address == 1){
                DB::table('users')
                    ->where('id', $user_details[0]->id)
                    ->update(array(
                        'default_address_id' => $input['address_book_id'],
                    ));
                $user_details[0]->default_address_id = $input['address_book_id'];
                Session::put('user', $user_details);
            }
            $message    = "Address successfully updated.";
            return redirect()->back()->withErrors($message);
        }else{
            return redirect('/signin');
        }
    }
    public function deleteaddress(Request $request)
    {

        if(Session::has('user')){
            $user_details = Session::get('user');
            if($user_details[0]->default_address_id == $request->address_book_id){
                $message    = "You can not delete default address.";
                return redirect()->back()->withErrors($message);
            }
            DB::table('address_book')
                ->where('address_book_id', '=', $request->address_book_id)
                ->delete();
            $message    = "Address successfully deleted.";
            return redirect()->back()->withErrors($message);
        }else{
            return redirect('/web/signin');
        }
    }
    
}
