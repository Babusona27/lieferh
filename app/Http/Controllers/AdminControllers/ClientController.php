<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;

class ClientController extends Controller
{


    public function display()
    {
        $result['clients'] = DB::table('users')
            ->where('role_type','=', 2)
            ->orderBy('users.id', 'DESC')
            ->paginate(15);
        // echo "<pre>";print_r($result);exit;
        return view("admin.clients.index")->with('result', $result);
    }
    public function add()
    {
        return view("admin.clients.add");
    }
    public function insert(Request $request)
    {
        // echo "<pre>";print_r($request->all());exit;  
        if ($request->password != $request->confirm_password) {
            $errorMessage = "Wrong confirm password.";
            return redirect()->back()->with('errorMessage', $errorMessage);
        }
        $clientExist = DB::table('users')
            ->where('user_phone','=', $request->user_phone)
            ->orWhere('email','=', $request->email)
            ->get();
            // echo "<pre>";print_r($clientExist);exit;
        if (count($clientExist)>0) {
            $errorMessage = "Customer already exist.";
            return redirect()->back()->with('errorMessage', $errorMessage);
        }
        $date = date('y-m-d h:i:s');
        $client_data = [
            'name'          =>   $request->name,
            'sur_name'      =>   $request->sur_name,
            'role_type'     =>   2,
            'email'         =>   $request->email,
            'user_phone'    =>   $request->user_phone,
            'password'      =>   Hash::make($request->password),
            'user_city'     =>   $request->user_city,
            'user_pincode'  =>   $request->user_pincode,
            'user_address'  =>   $request->user_address,
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

        $success_msg = "Client has been added successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }

    public function edit(Request $request)
    {
        $clients = DB::table('users')
            ->leftjoin('client_details','client_details.client_id', '=', 'users.id')
            ->select('users.*','client_details.*')
            ->where('id','=', $request->id )->get();
        $result['clients'] = $clients;  
        // echo "<echo>";print_r($result);exit;
        return view("admin.clients.edit")->with('result', $result);
    }

    public function update(Request $request)
    {
        // print_r($request->all());exit;
        $date = date('y-m-d h:i:s');

        $admin_data = array(
            'name'          =>   $request->name,
            'sur_name'      =>   $request->sur_name,
            'middle_name'   =>   $request->middle_name,
            'email'         =>   $request->email,
            'user_phone'    =>   $request->user_phone,
            'user_city'     =>   $request->user_city,
            'user_pincode'  =>   $request->user_pincode,
            'user_address'  =>   $request->user_address,
            'latitude'      =>   $request->latitude,
            'longitude'     =>   $request->longitude,
            'user_status'   =>   $request->user_status,
            'updated_at'    =>   $date
        );
        
        if($request->password != ''){
            if($request->password != $request->confirm_password){
                $errorMessage = "wrong confirm password.";
                return redirect()->back()->with('errorMessage', $errorMessage);
            }
            $admin_data['password'] = Hash::make($request->password);
        }

        $update_user = DB::table('users')
        ->where('id','=', $request->id )
        ->update($admin_data);

        $client_details_data = [
            'client_id'     =>   $request->id,
            'company_name'  =>   $request->company_name,
            'regi_no'       =>   $request->regi_no,
            'vat_no'        =>   $request->vat_no,
            'alt_mobile'    =>$request->alt_mobile,
            'best_time_to_contact'=>$request->best_time_to_contact,
            'alt_adddress'  =>$request->alt_adddress,
            'alt_city'      =>$request->alt_city,
            'alt_pincode'   =>$request->alt_pincode,
            'alt_latitude'  =>$request->alt_latitude,
            'alt_longitude' =>$request->alt_longitude,
        ];
        // if(!isset($request->same_like_above)){
        //     $client_details_data['alt_adddress'] = $request->alt_adddress;
        //     $client_details_data['alt_city'] = $request->alt_city;
        //     $client_details_data['alt_pincode'] = $request->alt_pincode;
        //     $client_details_data['alt_latitude'] = $request->alt_latitude;
        //     $client_details_data['alt_longitude'] = $request->alt_longitude;
        // }
        
        $update_client_details = DB::table('client_details')
        ->where('client_id','=', $request->id )
        ->update($client_details_data);
        
        $success_msg = "Client has been updated successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }
    public function delete(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        DB::table('client_details')->where('client_id', $request->id)->delete();
        $success_msg = "Client has been deleted successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }

    public function filter(Request $request)
    {
        $filter = $request->FilterBy;
        $param = $request->parameter;

        $result = array();
        $message = array();

        switch ($filter) {
            case 'firstname':
                $result['clients'] = DB::table('users')
                    ->where('role_type','=', 2)
                    ->where('users.name', 'LIKE', '%' . $param . '%')
                    ->orderBy('users.id', 'DESC')
                    ->paginate(15);

                break;

            case 'email':
                $result['clients'] = DB::table('users')
                    ->where('role_type','=', 2)
                    ->where('users.email', 'LIKE', '%' . $param . '%')
                    ->orderBy('users.id', 'DESC')
                    ->paginate(15);

                break;

            default:

                $result['clients'] = DB::table('users')
                    ->where('role_type','=', 2)
                    ->orderBy('users.id', 'DESC')
                    ->paginate(15);
                break;
        }

        return view("admin.clients.index")->with('result', $result)->with('filter', $filter)->with('parameter', $param);

    }

}
