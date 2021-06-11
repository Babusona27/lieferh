<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use DB;

class Pincode extends Model
{
	
    use Sortable;

    // public function images(){
    //     return $this->belongsTo('App\Images');
    // }

    public $sortable = ['pincodes_id'];

    public function paginator(){
        $pincodes = Pincode::sortable(['pincodes_id'=>'desc'])
            ->select('pincodes.*')
            ->paginate(20);
        return $pincodes;
    }

    public function getter(){
      $pincodes = DB::table('pincodes')
          ->select('pincodes.*')
          ->orderBy('pincodes_id', 'DESC')->get();
      return $pincodes;
    }

    public function insert($request){

      $pincode = DB::table('pincodes')->insert([
          'pincodes_val'     =>   $request->pincodes_val
      ]);
      return $pincode;

    }

    public function edit($request){

        $pincodes = DB::table('pincodes')
           ->select('pincodes.*')
           ->where('pincodes_id','=', $request->id)->get();

        return $pincodes;

    }

    public function updateRecord($request){

        $orders_status = DB::table('pincodes')
          ->where('pincodes_id','=', $request->pincodes_id)
          ->update([
            'pincodes_val'          =>  $request->pincodes_val
          ]);


        return 'success';
    }

    public function deleteRecord($request){
      DB::table('pincodes')->where('pincodes_id', $request->id)->delete();
      return 'success';
    }


}
