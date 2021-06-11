<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Model\admin\Drivers;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class DriversController extends Controller
{
    public function __construct(Drivers $Drivers)
    {
        $this->Drivers = $Drivers;
    }


    public function display()
    {
        $result['drivers'] = DB::table('users')
        ->where('role_type','=', 3)
        ->paginate(15);
        return view("admin.drivers.index")->with('result', $result);
    }
    public function add()
    {
        return view("admin.drivers.add");
    }
    public function insert(Request $request)
    {
        // echo "<pre>";print_r($request->all());exit;
        if ($request->password != $request->confirm_password) {
            $errorMessage = "Wrong confirm password.";
            return redirect()->back()->with('errorMessage', $errorMessage);
        }
        $driverExist = DB::table('users')
            ->where('user_phone','=', $request->user_phone)
            ->get();
        if (count($driverExist)>0) {
            //echo "<pre>";print_r($request->all());print_r($driverExist);exit;

            $errorMessage = "Driver already exist.";
            return redirect()->back()->with('errorMessage', $errorMessage);
        }
        if(isset($_FILES['address_proof'])){
            $file_name = $_FILES['address_proof']['name'];
            $file_size =$_FILES['address_proof']['size'];
            $file_tmp =$_FILES['address_proof']['tmp_name'];
            $file_type=$_FILES['address_proof']['type'];
            // $file_ext=strtolower(end(explode('.',$_FILES['address_proof']['name'])));
            $file_ext=pathinfo($file_name);
            $extensions= array("jpeg","jpg","png");
            $ext = strtolower($file_ext['extension']);
            if(!in_array($file_ext,$extensions)=== false){
               $errorMessage = "extension not allowed, please choose a JPEG or PNG file.";
                return redirect()->back()->with('errorMessage', $errorMessage);
            }
            if($file_size > 2097152){
               $errorMessage = 'File size must be excately 2 MB';
                return redirect()->back()->with('errorMessage', $errorMessage);
            }
            $filename =  time().$file_name;
            $filepath = public_path('uploads/');
            move_uploaded_file($file_tmp, $filepath.$filename);
         }

        $date = date('y-m-d h:i:s');
        $driver_data = [
            'name'          =>   $request->name,
            'sur_name'      =>   $request->sur_name,
            'role_type'     =>   3,
            'email'         =>   $request->email,
            'user_phone'    =>   $request->user_phone,
            'password'      =>   Hash::make($request->password),
            'user_city'     =>   $request->user_city,
            'user_pincode'  =>   $request->user_pincode,
            'user_address'  =>   $request->user_address,
            'created_at'    =>   $date
        ];
        if( $request->middle_name != "" ){
            $driver_data['middle_name'] = $request->middle_name;
        }
        $driver_id = DB::table('users')->insertGetId($driver_data);
        $driver_details_data = [
            'driver_id'     =>   $driver_id,
            'proprietor'    =>   $request->proprietor,
            'company_name'  =>   $request->company_name,
            'regi_no'       =>   $request->regi_no,
            'vat_no'        =>   $request->vat_no,
            'whatsapp'      =>   $request->whatsapp,
            'vehicle_type'  =>   $request->vehicle_type,
            'bank'          =>   $request->bank,
            'iban'          =>   $request->iban,
            'swift'         =>   $request->swift,
        ];
        if(isset($filename)){
            $driver_details_data['address_proof'] = $filepath.$filename;
        }
        $drivers = DB::table('driver_details')->insert($driver_details_data);
        $success_msg = "Driver has been added successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }

    public function edit(Request $request)
    {
        $drivers = DB::table('users')
            ->leftjoin('driver_details','driver_details.driver_id', '=', 'users.id')
           ->select('users.*','driver_details.*')
           ->where('id','=', $request->drivers_id )->get();
        $result['drivers'] = $drivers;  
        return view("admin.drivers.edit")->with('result', $result);
    }

    public function update(Request $request)
    {
        // echo "<pre>";print_r($request->all());exit;
        if(isset($request->address_proof)){
            $file_name = $_FILES['address_proof']['name'];
            $file_size =$_FILES['address_proof']['size'];
            $file_tmp =$_FILES['address_proof']['tmp_name'];
            $file_type=$_FILES['address_proof']['type'];
            // $file_ext=strtolower(end(explode('.',$_FILES['address_proof']['name'])));
            $file_ext=pathinfo($file_name);
            $extensions= array("jpeg","jpg","png");
            $ext = strtolower($file_ext['extension']);
            if(!in_array($file_ext,$extensions)=== false){
               $errorMessage = "extension not allowed, please choose a JPEG or PNG file.";
                return redirect()->back()->with('errorMessage', $errorMessage);
            }
            if($file_size > 2097152){
               $errorMessage = 'File size must be excately 2 MB';
                return redirect()->back()->with('errorMessage', $errorMessage);
            }
            $filename =  time().$file_name;
            $filepath = public_path('uploads/');
            move_uploaded_file($file_tmp, $filepath.$filename);
         }
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
            // 'user_status'   =>   $request->user_status,
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

        $driver_details_data = [
            'proprietor'    =>   $request->proprietor,
            'company_name'  =>   $request->company_name,
            'regi_no'       =>   $request->regi_no,
            'vat_no'        =>   $request->vat_no,
            'whatsapp'      =>   $request->whatsapp,
            'vehicle_type'  =>   $request->vehicle_type,
            'bank'          =>   $request->bank,
            'iban'          =>   $request->iban,
            'swift'         =>   $request->swift,
        ];
        if(isset($filename)){
            $driver_details_data['address_proof'] = $filepath.$filename;
        }
        $driver_client_details = DB::table('driver_details')
        ->where('driver_id','=', $request->id )
        ->update($driver_details_data);

        $success_msg = "Customer has been updated successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }
    public function delete(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        DB::table('driver_details')->where('driver_id', $request->id)->delete();
        $success_msg = "Driver has been deleted successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }

    public function details(Request $request,$drivers_id)
    {

        $driver_details = DB::table('users')
            ->where('id','=',$drivers_id)
            ->first();
        $result['driver_details'] = $driver_details;

        $task = DB::table('tasks')
            ->where('tasks.drivers_id',$drivers_id);
        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);
            $startdate = trim($range[0]);
            $enddate = trim($range[1]);
            $startdate = str_replace('/', '-', $startdate);
            $enddate = str_replace('/', '-', $enddate); 
            //echo $startdate." ".$enddate;exit;
            $dateFrom = date("Y-m-d",strtotime($startdate));
            $dateTo = date("Y-m-d",strtotime($enddate));
            //echo $dateFrom." ".$dateTo;exit;
            $task->whereBetween('task_date', [$dateFrom, $dateTo]);
        }        
        $task_list = $task->get();

        if (count($task_list)>0) {
            foreach ($task_list as $key => $value) {
                if ($value->drivers_fare_type==1) {
                    $task_detail = DB::table('task_details')
                        ->where('task_id','=',$value->task_id)
                        ->get();
                    $task_list[$key]->totalEarn = count($task_detail)*$value->drivers_fare;
                }else{
                    $task_list[$key]->totalEarn = $value->drivers_fare;
                }
            }
        }

        $result['tasks'] = $task_list;
        
        return view("admin.drivers.details")->with('result', $result);

    }

    /******* excel ********/
    public function exportDetails(Request $request,$drivers_id) 
    {
        $expData['date_range'] = $request->date_range;
        $expData['drivers_id'] = $drivers_id;
        return Excel::download(new UsersExport($expData), 'driverDetails.xlsx');
    }
    /******* excel ********/

    public function filter(Request $request)
    {
        $filter = $request->FilterBy;
        $param = $request->parameter;

        $result = array();
        $message = array();

        switch ($filter) {
            case 'name':
                $result['drivers'] = DB::table('users')
                    ->where('role_type','=', 3)
                    ->where('users.name', 'LIKE', '%' . $param . '%')
                    ->orderBy('users.id', 'DESC')
                    ->paginate(15);

                break;

            case 'email':
                $result['drivers'] = DB::table('users')
                    ->where('role_type','=', 3)
                    ->where('users.email', 'LIKE', '%' . $param . '%')
                    ->orderBy('users.id', 'DESC')
                    ->paginate(15);

                break;

            default:

                $result['drivers'] = DB::table('users')
                    ->where('role_type','=', 3)
                    ->orderBy('users.id', 'DESC')
                    ->paginate(15);
                break;

        return view("admin.drivers.index")->with('result', $result);
        }

        return view("admin.drivers.index")->with('result', $result)->with('filter', $filter)->with('parameter', $param);

    }

}
