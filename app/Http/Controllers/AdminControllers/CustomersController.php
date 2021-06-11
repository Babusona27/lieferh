<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Model\admin\Customers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;

class CustomersController extends Controller
{
    public function __construct(Customers $Customers)
    {
        $this->Customers = $Customers;
    }


    public function display()
    {
        $result['customers'] = DB::table('customers')
            ->orderBy('customers_id', 'DESC')
            ->paginate(15);
        return view("admin.customers.index")->with('result', $result);
    }
    public function add()
    {
        return view("admin.customers.add");
    }
    public function insert(Request $request)
    {
        // print_r($request->all());exit;
        $customersExist = DB::table('customers')
            ->where('customers_phone','=', $request->customers_phone)
            ->get();
        if (count($customersExist)>0) {
            $errorMessage = "Customer already exist.";
            return redirect()->back()->with('errorMessage', $errorMessage);
        }
        $date = date('y-m-d h:i:s');
        $customers = DB::table('customers')->insert([
            'name'            =>   $request->name,
            'customers_email' =>   $request->customers_email,
            'customers_phone' =>   $request->customers_phone,
            'city'            =>   $request->city,
            'pincode'         =>   $request->pincode,
            'address'         =>   $request->address,
            'latitude'        =>   $request->latitude,
            'longitude'       =>   $request->longitude,
            'created_at'      =>   $date
        ]);
        $success_msg = "Customer has been added successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }

    public function edit(Request $request)
    {
        $customers = DB::table('customers')
           ->select('customers.*')
           ->where('customers_id','=', $request->customers_id )->get();
           
        $result['customers'] = $customers;  
        return view("admin.customers.edit")->with('result', $result);
    }

    public function update(Request $request)
    {
        // print_r($request->all());exit;
        $date = date('y-m-d h:i:s');
        $orders_status = DB::table('customers')
        ->where('customers_id','=', $request->customers_id )
        ->update([
            'name'            =>   $request->name,
            'customers_email' =>   $request->customers_email,
            'customers_phone' =>   $request->customers_phone,
            'city'            =>   $request->city,
            'pincode'         =>   $request->pincode,
            'address'         =>   $request->address,
            'latitude'        =>   $request->latitude,
            'longitude'       =>   $request->longitude,
            'updated_at'    =>   $date,
        ]);
        $success_msg = "Customer has been updated successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }
    public function delete(Request $request)
    {
        DB::table('customers')->where('customers_id', $request->id)->delete();
        $success_msg = "Customer has been deleted successfully!";
        return redirect()->back()->with('success_msg',$success_msg);
    }

    public function uploadExcel()
    {
        return view("admin.customers.excel_upload");
    }

    public function bulkUploadCustomer(Request $request) {

        // $request->validate([
        //     'file' => 'required',
        //     'file.*' => 'mimes:xls,xlsx'
        // ]);


        if($request->hasfile('file'))
        {
            try {
                Excel::import(new UsersImport, request()->file('file')->store('temp'));
            } catch (NoTypeDetectedException $e) {
                $errorMessage = "Sorry you are using a wrong format to upload files.";
                return redirect()->back()->with('errorMessage', $errorMessage);
            }            
        }        

        $success_msg = "Data saved successfully.";
        return redirect()->back()->with('success_msg', $success_msg);
    }

    public function filter(Request $request)
    {
        $filter = $request->FilterBy;
        $param = $request->parameter;

        $result = array();
        $message = array();

        switch ($filter) {
            case 'name':
                $result['customers'] = DB::table('customers')
                    ->where('customers.name', 'LIKE', '%' . $param . '%')
                    ->orderBy('customers_id', 'DESC')
                    ->paginate(15);

                break;

            case 'email':
                $result['customers'] = DB::table('customers')
                    ->where('customers.customers_email', 'LIKE', '%' . $param . '%')
                    ->orderBy('customers_id', 'DESC')
                    ->paginate(15);

                break;

            default:

                $result['customers'] = DB::table('customers')
                    ->orderBy('customers_id', 'DESC')
                    ->paginate(15);
                break;

        }

        return view("admin.customers.index")->with('result', $result)->with('filter', $filter)->with('parameter', $param);

    }

}
