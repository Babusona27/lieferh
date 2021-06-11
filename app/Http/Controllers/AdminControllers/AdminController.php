<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Hash;
use DB;

class AdminController extends Controller
{

    public function dashboard()
    {
        $result = array();
        $adminUserDetails = session('adminUserDetails');
        $role_type = $adminUserDetails->role_type;

        $task = DB::table('tasks')
            ->join('users','users.id', '=', 'tasks.drivers_id')
            ->select('tasks.*','users.name','users.latitude','users.longitude','users.user_phone')
            ->whereIn('tasks.type',array('2','3'));
        if ($role_type==2) {
            $task->where('tasks.client_id',$adminUserDetails->id);
        }
        $task_list = $task->get();

        $drPic = asset('public/images/t_img.png');
        $task_array = array();
        if (count($task_list)>0) {
            foreach ($task_list as $key => $value) {
                $p_arr = array($value->name,(float)$value->latitude,(float)$value->longitude,(int)$value->task_id,$value->user_phone,$drPic);
                array_push($task_array, $p_arr);
            }
        }
        // echo "<pre>";
        // print_r($task_array);exit;
        $result['task_array'] = $task_array; 

        return view("admin.dashboard")->with('result', $result);
    }


    public function taskById(Request $request)
    {
        //print_r($request->all());exit;
        $input = $request->all();
        $task_id = $input['task_id'];

        $customer_list = DB::table('task_details')
            ->join('customers','customers.customers_id', '=', 'task_details.customers_id')
            ->select('task_details.*','customers.*')
            ->where('task_details.task_id','=',$task_id)
            ->orderBy('task_details.task_order', 'ASC')
            ->get();

        $task_detail_array = array();
        if (count($customer_list)>0) {
            foreach ($customer_list as $key => $value) {
                $p_arr = array($value->city,(float)$value->latitude,(float)$value->longitude,(int)$key+1);
                array_push($task_detail_array, $p_arr);
            }
        }

        $client_list = DB::table('tasks')
            ->join('users','users.id', '=', 'tasks.client_id')
            ->select('tasks.*','users.*')
            ->where('tasks.task_id','=',$task_id)
            ->get();

        $client_array = array();
        if (count($client_list)>0) {
            foreach ($client_list as $key => $value) {
                $p_arr1 = array((int)$value->task_id,(float)$value->latitude,(float)$value->longitude,$value->name,$value->user_phone,$value->user_address);
                array_push($client_array, $p_arr1);
            }
        }

        return response()->json(['task_detail_array'=>$task_detail_array,'client_array'=>$client_array]);

    }


    public function login()
    {
        if (Auth::check()) {
            $admin = auth()->user();

            return redirect('/admin/dashboard');
        }else{
            return view("admin.login");
        }
    }

    public function checkLogin(Request $request){
        $validator = Validator::make(
            array(
                    'email'    => $request->email,
                    'password' => $request->password
                ),
            array(
                    'email'    => 'required | email',
                    'password' => 'required',
                )
        );
        //check validation
        if($validator->fails()){
            return redirect('/admin')->withErrors($validator)->withInput();
        }else{
            //check authentication of email and password
            $adminInfo = array("email" => $request->email, "password" => $request->password);

            if(auth()->attempt($adminInfo)) {
                $admin = auth()->user();

                $administrators = DB::table('users')->where('id', $admin->id)->where('user_status', '1')->whereIn('role_type',array('1','2'))->first();
                // print_r($administrators);exit;
                if (isset($administrators) && !empty($administrators) ) {
                    session(['adminUserDetails' => $administrators]);

                    return redirect()->intended('admin/dashboard')->with('administrators', $administrators);
                }else{
                    return redirect('/admin')->with('loginError','Email or password is incorrect!');
                }
                
            }else{
                return redirect('/admin')->with('loginError','Email or password is incorrect!');
            }

        }

    }

    //logout
    public function logout(){
        // Auth::guard('admin')->logout();
        Auth::logout();
        return redirect()->intended('/admin');
    }

    public function signUp(){
        return view("admin.clientSignup");
    }

    public function insert(Request $request)
    {
        // echo "<pre>";print_r($request->all());exit;
        if ($request->password != $request->confirm_password) {
            $errorMessage = "wrong confirm password.";
            return redirect()->back()->with('signUpError', $errorMessage);
        }
        $clientExist = DB::table('users')
            ->where('user_phone','=', $request->user_phone)
            ->orWhere('email','=', $request->email)
            ->get();
            // echo "<pre>";print_r($clientExist);exit;
        if (count($clientExist)>0) {
            $errorMessage = "User already exist.";
            return redirect('/admin/signUp')->with('signUpError',$errorMessage);
            // return redirect()->back()->with('errorMessage', $errorMessage);
        }
        $date = date('y-m-d h:i:s');
        $client_data = [
            'name'          =>   $request->name,
            'sur_name'      =>   $request->sur_name,
            'user_type_name'=>   'Client',
            'role_type'     =>   2,
            'email'         =>   $request->email,
            'user_phone'    =>   $request->user_phone,
            'password'      =>   Hash::make($request->password),
            'user_city'     =>   $request->user_city,
            'user_pincode'  =>   $request->user_pincode,
            'user_address'  =>   $request->user_address,
            'user_status'   =>   0,
            'latitude'      =>   $request->latitude,
            'longitude'     =>   $request->longitude,
            'created_at'    =>   $date
        ];
        if( $request->middle_name != "" ){
            $client_data['middle_name'] = $request->middle_name;
        }
        $ClintId = DB::table('users')->insertGetId($client_data);
        
        $client_details_data = [
            'client_id'     =>   $ClintId,
            'company_name'  =>   $request->company_name,
            'regi_no'      =>   $request->regi_no,
            'vat_no'      =>   $request->vat_no,
        ];
        if($request->alt_mobile != ""){
            $client_details_data['alt_mobile'] = $request->alt_mobile;
        }
        if(isset($request->best_time_to_contact)){
            $client_details_data['best_time_to_contact'] = $request->best_time_to_contact;
        }
        if(!isset($request->same_like_above)){
            $client_details_data['alt_adddress'] = $request->alt_adddress;
            $client_details_data['alt_city'] = $request->alt_city;
            $client_details_data['alt_pincode'] = $request->alt_pincode;
            $client_details_data['alt_latitude'] = $request->alt_latitude;
            $client_details_data['alt_longitude'] = $request->alt_longitude;
        }
        $SaveClintDetails = DB::table('client_details')->insert($client_details_data);
        return redirect('/admin')->with('signUpSuccess','You have signed up successfully and wait for the Admin permission!');
        // $success_msg = "Client has been added successfully!";
        // return redirect()->back()->with('success_msg',$success_msg);
    }

}
