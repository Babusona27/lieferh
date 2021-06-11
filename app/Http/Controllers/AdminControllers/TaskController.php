<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Model\admin\Task;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TaskCustomerImport;

use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;

class TaskController extends Controller
{
    public function __construct(Task $Task)
    {
        $this->Task = $Task;
    }


    public function display()
    {
        $adminUserDetails = session('adminUserDetails');
        $role_type = $adminUserDetails->role_type;

        $task = DB::table('tasks')->where('tasks.task_complete',0);
        if ($role_type==2) {
            $task->where('tasks.client_id',$adminUserDetails->id);
        }
        $task_list = $task->orderBy('tasks.task_id', 'DESC')->paginate(16);

        if (!empty($task_list)) {
            foreach ($task_list as $key => $value) {
                $totalTaskDetail = DB::table('task_details')
                    ->where('task_id','=', $value->task_id)
                    ->count();

                $completeTaskDetail = DB::table('task_details')
                    ->where('task_id','=', $value->task_id)
                    ->where('complete_status','=', 1)
                    ->count();
                $taskPercentage = (int)(($completeTaskDetail*100)/$totalTaskDetail);
                $task_list[$key]->taskPercentage = $taskPercentage;
            }
        }

        // echo "<pre>";
        // print_r($task_list);exit;

        $result['tasks'] = $task_list;
        return view("admin.task.index")->with('result', $result);
    }

    public function completeTask()
    {
        $adminUserDetails = session('adminUserDetails');
        $role_type = $adminUserDetails->role_type;

        $task = DB::table('tasks')->where('tasks.task_complete',1);
        if ($role_type==2) {
            $task->where('tasks.client_id',$adminUserDetails->id);
        }
        $task_list = $task->orderBy('tasks.task_id', 'DESC')->paginate(16);

        if (!empty($task_list)) {
            foreach ($task_list as $key => $value) {
                $totalTaskDetail = DB::table('task_details')
                    ->where('task_id','=', $value->task_id)
                    ->count();

                $completeTaskDetail = DB::table('task_details')
                    ->where('task_id','=', $value->task_id)
                    ->where('complete_status','=', 1)
                    ->count();
                $taskPercentage = (int)(($completeTaskDetail*100)/$totalTaskDetail);
                $task_list[$key]->taskPercentage = $taskPercentage;
            }
        }

        $result['tasks'] = $task_list;
        return view("admin.task.complete_task")->with('result', $result);
    }

    public function add(Request $request)
    {
        $tasks = DB::table('tasks')
           ->select('tasks.task_date','tasks.drivers_id')
           ->where('task_status','=', 1 )
           ->get();
        $customers = DB::table('customers')->get();
        $clients = DB::table('users')->where('role_type','=', 2)->get();
        $drivers = DB::table('users')->where('role_type','=', 3)->get();
        $result['tasks'] = $tasks;
        $result['customers'] = $customers;
        $result['drivers'] = $drivers;
        $result['clients'] = $clients;
        return view("admin.task.add")->with('result', $result);
    }
    public function insert(Request $request)
    {
        //echo "<pre>";print_r($request->all());exit;
        $date = date('y-m-d h:i:s');
        $tasks_id = DB::table('tasks')->insertGetId([
            'task_name'     =>   $request->task_name,
            'type'          =>   $request->type,
            'task_date'     =>   $request->date,
            'task_time'     =>   $request->time,
            'task_status'   =>   1,
            'client_id'     =>   $request->client_id,
            'drivers_id'    =>   $request->drivers_id,
            'drivers_fare'  =>   $request->amount,
            'drivers_fare_type' =>   $request->fare_type,
            // 'task_number'   =>   $task_number,
            // 'collection_time' =>  $request->shop_arrive_time,
            'created_at'    =>   $date
        ]);
        $clients_name = substr($request->clients_name, 0, 4);
        $totalLength = 10 - strlen("$tasks_id");
        $task_number = str_pad($clients_name, $totalLength, '0', STR_PAD_RIGHT).$tasks_id;
        $task_update = DB::table('tasks')->where('task_id','=',$tasks_id)
            ->update([
                'task_number'   =>   $task_number,
            ]);

        $customersIds = array();
        $upCustomersIds = array();

        if ($request->upload_customer_status==0) {
            $customersIds = $request->customersId;
        }else{
            if (!empty($request->c_name)) {
                for($i=0;$i<count($request->c_name);$i++){
                    $address =$request->c_address[$i];
                    $apiKey = 'AIzaSyA_EBi3vEsgmF0dQq25jJQ5M_Y_aMNfaU8';

                    $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $output = json_decode($response);
                    // echo "<pre>";
                    //print_r($output);
                    $latitude = $output->results[0]->geometry->location->lat;
                    $longitude = $output->results[0]->geometry->location->lng;

                    $date = date('y-m-d h:i:s');
                    $customers_id = DB::table('customers')->insertGetId([
                        'name' => $request->c_name[$i],
                        'customers_email' => $request->c_email[$i],
                        'customers_phone' => $request->c_phone[$i],
                        'city' => $request->c_city[$i],
                        'pincode' => $request->c_pincode[$i],
                        'address' => $request->c_address[$i],
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'created_at' => $date
                    ]);
                    array_push($upCustomersIds, $customers_id);   
                }          
            }
            $customersIds = $upCustomersIds;
        }

        $client_detail = DB::table('users')
            ->where('id','=',$request->client_id)
            ->first();
        $client_lat = $client_detail->latitude;
        $client_long = $client_detail->longitude;

        $customer_list = DB::table('customers')
            ->select('customers.*',DB::raw("  
              ( 3959 * acos( cos( radians(".$client_lat.") ) 
              * cos( radians(  lieferh_customers.latitude ) ) 
              * cos( radians( lieferh_customers.longitude ) - radians(".$client_long.") ) 
              + sin( radians(".$client_lat.") ) 
              * sin( radians(  lieferh_customers.latitude ) ) ) ) AS distance"))
            ->orderBy('distance', 'ASC')
            ->whereIn('customers_id',$customersIds)
            ->get();

        // echo "<pre>";
        // print_r($customer_list);exit;


        foreach ($customer_list as $key=>$customersId){
            DB::table('task_details')->insert([
                'task_id'          =>   $tasks_id,
                'task_order'     =>   $key+1,
                'customers_id'     =>   $customersId->customers_id
            ]);
        }
        $success_msg = "Task has been added successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }

    public function details($task_id)
    {   
        $result = array();

        $task_details = DB::table('tasks')
            ->where('task_id','=',$task_id)
            ->first();
        $result['task_details'] = $task_details;

        $client_details = DB::table('users')
            ->where('id','=',$task_details->client_id)
            ->first();
        $result['client_details'] = $client_details;

        $driver_details = DB::table('users')
            ->where('id','=',$task_details->drivers_id)
            ->first();
        $result['driver_details'] = $driver_details;

        $customer_list = DB::table('task_details')
            ->join('customers','customers.customers_id', '=', 'task_details.customers_id')
            ->select('task_details.*','customers.*')
            ->where('task_details.task_id','=',$task_id)
            ->orderBy('task_details.task_order', 'ASC')
            ->get();
        $result['customer_list'] = $customer_list;       

        return view("admin.task.details")->with('result', $result);
    }

    public function edit(Request $request,$task_id)
    {
        $tasks = DB::table('tasks')
           ->select('tasks.task_date','tasks.drivers_id')
           ->where('task_status','=', 1 )
           ->get();
        $customers = DB::table('customers')->get();
        $clients = DB::table('users')->where('role_type','=', 2)->get();
        $drivers = DB::table('users')->where('role_type','=', 3)->get();
        $result['tasks'] = $tasks;
        $result['customers'] = $customers;
        $result['drivers'] = $drivers;
        $result['clients'] = $clients;

        /****edit ***/
        $task_details = DB::table('tasks')
            ->where('task_id','=',$task_id)
            ->first();
        $result['task_details'] = $task_details;

        $client_details = DB::table('users')
            ->where('id','=',$task_details->client_id)
            ->first();
        $result['client_details'] = $client_details;

        $driver_details = DB::table('users')
            ->where('id','=',$task_details->drivers_id)
            ->first();
        $result['driver_details'] = $driver_details;

        $customer_list = DB::table('task_details')
            ->join('customers','customers.customers_id', '=', 'task_details.customers_id')
            ->select('task_details.*','customers.*')
            ->where('task_details.task_id','=',$task_id)
            ->orderBy('task_details.task_order', 'ASC')
            ->get();
        $result['customer_list'] = $customer_list;
        /****edit ***/

        return view("admin.task.edit")->with('result', $result);
    }

    public function update(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        $date = date('y-m-d h:i:s');
        $task_update = DB::table('tasks')->where('task_id','=',$request->task_id)
            ->update([
                'task_name'     =>   $request->task_name,
                'type'          =>   $request->type,
                'task_date'     =>   $request->date,
                'task_time'     =>   $request->time,
                'task_status'   =>   1,
                'client_id'     =>   $request->client_id,
                'drivers_id'    =>   $request->drivers_id,
                'drivers_fare'  =>   $request->amount,
                'drivers_fare_type' =>   $request->fare_type,
                // 'collection_time' =>  $request->shop_arrive_time,
                'updated_at'    =>   $date
            ]);

        DB::table('task_details')->where('task_id','=',$request->task_id)->delete();        

        if ($request->sortable_val>0) {
            $task_order = $request->task_order;
            foreach ($request->customersId as $key=>$customersId){
                DB::table('task_details')->insert([
                    'task_id'          =>   $request->task_id,
                    'task_order'     =>   $task_order[$key],
                    'customers_id'     =>   $customersId
                ]);
            }
        }else{
            $client_detail = DB::table('users')
                ->where('id','=',$request->client_id)
                ->first();
            $client_lat = $client_detail->latitude;
            $client_long = $client_detail->longitude;

            $customer_list = DB::table('customers')
                ->select('customers.*',DB::raw("  
                  ( 3959 * acos( cos( radians(".$client_lat.") ) 
                  * cos( radians(  lieferh_customers.latitude ) ) 
                  * cos( radians( lieferh_customers.longitude ) - radians(".$client_long.") ) 
                  + sin( radians(".$client_lat.") ) 
                  * sin( radians(  lieferh_customers.latitude ) ) ) ) AS distance"))
                ->orderBy('distance', 'ASC')
                ->whereIn('customers_id',$request->customersId)
                ->get();

            foreach ($customer_list as $key=>$customersId){
                DB::table('task_details')->insert([
                    'task_id'          =>   $request->task_id,
                    'task_order'     =>   $key+1,
                    'customers_id'     =>   $customersId->customers_id
                ]);
            }
        }

        $success_msg = "Task has been updated successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }

    public function delete(Request $request)
    {
        DB::table('tasks')->where('task_id', $request->task_id)->delete();
        DB::table('task_details')->where('task_id', $request->task_id)->delete();
        $success_msg = "Task has been deleted successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }

    public function taskCustomerUpload(Request $request)
    {
        // echo "<pre>";
        // print_r($request->file('file'));exit;
        $allowed = array('xls','xlsx');
        $filename = $request->file('file')->getClientOriginalName();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            return "notFile";
            exit;
        }

        $task_customers = array();
        try {
            //Excel::import(new TaskCustomerImport, $request->file('file')->store('temp'));
            $collection = Excel::toArray(new TaskCustomerImport, $request->file('file')->store('temp'));
        } catch (NoTypeDetectedException $e) {
            return "notFile";
            exit;
        }

        foreach ($collection as $key => $value) {
            if (!empty($value)) {
                foreach ($value as $key1 => $value1) {
                    if ($key1>0 && !empty($value1)) {
                         // echo "<pre>";
                         // print_r($value);exit;
                        if ($value1[3]!='') {
                             array_push($task_customers, $value1);
                        }
                    }
                }
            }
        }

        // $task_customers = session('task_customers');
        // session(['task_customers' => array()]);

        // echo "<pre>";
        // print_r($task_customers);exit;

        return response()->json(['task_customers'=>$task_customers]);

    }


    public function filter(Request $request)
    {
        $filter = $request->FilterBy;
        $param = $request->parameter;

        $result = array();
        $message = array();

        $adminUserDetails = session('adminUserDetails');
        $role_type = $adminUserDetails->role_type;

        switch ($filter) {
            case 'name':
                $task = DB::table('tasks')->where('tasks.task_complete',0);
                $task->where('tasks.task_name', 'LIKE', '%' . $param . '%');
                if ($role_type==2) {
                    $task->where('tasks.client_id',$adminUserDetails->id);
                }
                $task_list = $task->orderBy('tasks.task_id', 'DESC')->paginate(16);

                break;

            case 'task_no':
                $task = DB::table('tasks')->where('tasks.task_complete',0);
                $task->where('tasks.task_number', '=', $param);
                if ($role_type==2) {
                    $task->where('tasks.client_id',$adminUserDetails->id);
                }
                $task_list = $task->orderBy('tasks.task_id', 'DESC')->paginate(16);

                break;

            default:

                $task = DB::table('tasks')->where('tasks.task_complete',0);
                if ($role_type==2) {
                    $task->where('tasks.client_id',$adminUserDetails->id);
                }
                $task_list = $task->orderBy('tasks.task_id', 'DESC')->paginate(16);

                break;
        }

        if (!empty($task_list)) {
            foreach ($task_list as $key => $value) {
                $totalTaskDetail = DB::table('task_details')
                    ->where('task_id','=', $value->task_id)
                    ->count();

                $completeTaskDetail = DB::table('task_details')
                    ->where('task_id','=', $value->task_id)
                    ->where('complete_status','=', 1)
                    ->count();
                $taskPercentage = (int)(($completeTaskDetail*100)/$totalTaskDetail);
                $task_list[$key]->taskPercentage = $taskPercentage;
            }
        }

        $result['tasks'] = $task_list;

        return view("admin.task.index")->with('result', $result)->with('filter', $filter)->with('parameter', $param);

    }

    public function completefilter(Request $request)
    {
        $filter = $request->FilterBy;
        $param = $request->parameter;

        $result = array();
        $message = array();

        $adminUserDetails = session('adminUserDetails');
        $role_type = $adminUserDetails->role_type;

        switch ($filter) {
            case 'name':
                $task = DB::table('tasks')->where('tasks.task_complete',1);
                $task->where('tasks.task_name', 'LIKE', '%' . $param . '%');
                if ($role_type==2) {
                    $task->where('tasks.client_id',$adminUserDetails->id);
                }
                $task_list = $task->orderBy('tasks.task_id', 'DESC')->paginate(16);

                break;

            case 'task_no':
                $task = DB::table('tasks')->where('tasks.task_complete',1);
                $task->where('tasks.task_number', '=', $param);
                if ($role_type==2) {
                    $task->where('tasks.client_id',$adminUserDetails->id);
                }
                $task_list = $task->orderBy('tasks.task_id', 'DESC')->paginate(16);

                break;

            default:

                $task = DB::table('tasks')->where('tasks.task_complete',1);
                if ($role_type==2) {
                    $task->where('tasks.client_id',$adminUserDetails->id);
                }
                $task_list = $task->orderBy('tasks.task_id', 'DESC')->paginate(16);

                break;
        }

        if (!empty($task_list)) {
            foreach ($task_list as $key => $value) {
                $totalTaskDetail = DB::table('task_details')
                    ->where('task_id','=', $value->task_id)
                    ->count();

                $completeTaskDetail = DB::table('task_details')
                    ->where('task_id','=', $value->task_id)
                    ->where('complete_status','=', 1)
                    ->count();
                $taskPercentage = (int)(($completeTaskDetail*100)/$totalTaskDetail);
                $task_list[$key]->taskPercentage = $taskPercentage;
            }
        }

        $result['tasks'] = $task_list;

        return view("admin.task.complete_task")->with('result', $result)->with('filter', $filter)->with('parameter', $param);

    }

}
