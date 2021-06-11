<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\web\Cart;
use Session;
use DB;

class CartController extends Controller
{

	public function __construct(Cart $cart) {

        $this->cart = $cart;

    }
    
    public function cart()
    {
    	if(Session::has('user')){
            $current_user_details = Session::get('user');
            $customers_id = $current_user_details[0]->id;
            $result = array();
            $data = array();

            $cart = $this->cart->myCart($data,$customers_id);
            // if (!empty($cart)) {
            //     foreach($cart as $key=>$value){
            //         if (!empty($cart[$key]->image_path)){
            //             $cart[$key]->image_path = asset($value->image_path);
            //         }else{
            //             $cart[$key]->image_path = asset("images/media/2019/10/newsletter.jpg");
            //         }
            //     }
            // }
            $result['cartList'] = $cart;
            // echo "<pre>";
            // print_r($result['cartList']);exit;

            // $userAddress = DB::table('address_book')
            //     ->where('customers_id', $customers_id)
            //     ->get();

            // $userDetail = DB::table('users')
            //     ->where('id', $customers_id)
            //     ->first();
            // if (count($userAddress)>0) {
            //     if(!Session::has('user_default_address')){
            //         Session::put('user_default_address', $userAddress[0]);
            //     }
                
            //     foreach ($userAddress as $key => $value) {
            //         if ($value->address_book_id == $userDetail->default_address_id) {
            //             $userAddress[$key]->is_default_address = 1;
            //             if(!Session::has('user_default_address')){
            //                 Session::put('user_default_address', $value);
            //             }
            //         }else{
            //             $userAddress[$key]->is_default_address = 0;
            //         }
            //     }
            // }
            // $result['userDetail'] = $userDetail;
            // $result['userAddress'] = $userAddress;

            // $user_pincode = '';
            // if(Session::has('user_pincode_id')){
            //     $user_pincode_id = Session::get('user_pincode_id');
            //     $user_pincode = DB::table('pincodes')
            //         ->where('pincodes_id', $user_pincode_id)
            //         ->first();
            // }
            // $result['user_pincode'] = $user_pincode;
            
            return view("web.cart_list")->with('result', $result);
        }else{
           return redirect('/signin');
        }
    }

    //addToCart
    public function addToCart(Request $request)
    {

        if(Session::has('user')){
            $current_user_details = Session::get('user');
            //echo "<pre>";print_r($current_user_details);exit;
            $input['customers_id'] = $current_user_details[0]->id;
            $input['products_id'] = $request->products_id;
            $input['quantity'] = $request->cartQuantity;

            $result = $this->cart->addToCart($input);
            if (!empty($result['status']) && $result['status'] == 'exceed') {
                return back()->with('stockOut','Out Of Stock!');
            }

            return redirect('/cart')->with('addCartSuccess','Product is successfully added to cart!');
        }else{
           return redirect('/signin');
        }       
        
    }

    public function cartQuantityEdit(Request $request)
    {
        //print_r($request->all());exit;
        $input = $request->all();
        $customers_basket_id = $input['customers_basket_id'];
        $customers_basket_quantity = $input['cnt'];

        DB::table('customers_basket')->where('customers_basket_id', $customers_basket_id)
	        ->update(
	        [
	            'customers_basket_quantity'   =>   $customers_basket_quantity
	        ]);

        return 1;

    }

    public function cartItemDelete(Request $request)
    {
        //print_r($request->all());exit;
        $input = $request->all();
        $customers_basket_id = $input['customers_basket_id'];

        DB::table('customers_basket')->where('customers_basket_id', $customers_basket_id)->delete();

        return 1;

    }

    
}
