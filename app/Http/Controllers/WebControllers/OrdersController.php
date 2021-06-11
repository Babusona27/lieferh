<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\web\Cart;
use App\Model\web\Order;
use Session;
use DB;
use Validator;
use URL;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class OrdersController extends Controller
{
    private $_api_context;

    public function __construct(Cart $cart,Order $order) {

        $this->cart = $cart;
        $this->order = $order;

        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);

    }

    public function checkout()
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

            $userAddress = DB::table('address_book')
                ->where('user_id', $customers_id)
                ->get();

            $userDetail = DB::table('users')
                ->where('id', $customers_id)
                ->first();
            if (count($userAddress)>0) {
                if(!Session::has('user_default_address')){
                    Session::put('user_default_address', $userAddress[0]);
                }
                
                foreach ($userAddress as $key => $value) {
                    if ($value->address_book_id == $userDetail->default_address_id) {
                        $userAddress[$key]->is_default_address = 1;
                        if(!Session::has('user_default_address')){
                            Session::put('user_default_address', $value);
                        }
                    }else{
                        $userAddress[$key]->is_default_address = 0;
                    }
                }
            }
            $result['userDetail'] = $userDetail;
            $result['userAddress'] = $userAddress;

            $user_pincode = '';
            if(Session::has('pincode')){
                $user_pincode = Session::get('pincode');
            }
            $result['user_pincode'] = $user_pincode;
            
            return view("web.checkout")->with('result', $result);
        }else{
           return redirect('/signin');
        }
    }

    /**************** session_address ****************/
    public function session_address(Request $request)
    {

        $input = $request->all();
        $address_book_id = $input['address_book_id'];
        $userAddress = DB::table('address_book')
                ->where('address_book_id', $address_book_id)
                ->first();

        $current_user_details = Session::get('user');
        $customers_id = $current_user_details[0]->id;
        $result = DB::table('users')
            ->where('id', $customers_id)
            ->update(array(
                'default_address_id' => $address_book_id,
            ));

        if ($userAddress) {
            Session::put('user_default_address', $userAddress);
        }

        return response()->json(['userAddress'=>$userAddress]);
    }
    /**************** session_address ****************/

    /**************** order cash on delivery ****************/
    public function cashOnDeliveryOrder(Request $request)
    {

        $input = $request->all();
        $returnData = array();

        if(Session::has('user')){
            $returnData['isLogin'] = 'yes';
            $current_user_details = Session::get('user');
            $customers_id = $current_user_details[0]->id;
            $input['customers_id'] = $customers_id;
            $input['customers_mail'] = $current_user_details[0]->email;
            $input['firstname'] = $current_user_details[0]->name;
            $input['delivery_phone'] = $current_user_details[0]->user_phone;
            $input['order_comments'] = '';
            $input['paymentResponseData'] = '';

            $userDetail = DB::table('users')
                ->where('id', $customers_id)
                ->first();
            $input['address_book_id'] = $userDetail->default_address_id;

            //$cart_items = $this->cart->myCart(array(),$customers_id);
            
            // if (count($cart_items) > 0) {
            //     foreach ($cart_items as $products) {
            //         $req = array();
            //         $attr = array();
            //         $req['product_warehouse_id'] = $products->product_warehouse_id;
            //         if (isset($products->attributes)) {
            //             foreach ($products->attributes as $key => $value) {
            //                 $attr[$key] = $value->products_attributes_id;
            //             }
            //             $req['attributes'] = $attr;

            //         }
            //         $check = Products::getquantity($req);
            //         if ($products->customers_basket_quantity > $check['stock']) {
            //             $returnData['status'] = false;
            //             $returnData['massage'] = 'out of stock';
            //             $returnData['out_of_stock'] = 'Yes';
            //             $returnData['out_of_stock_product_id'] = $products->product_warehouse_id;
            //             $returnData['out_of_stock_product'] = $products;
            //             return response()->json(['returnData'=>$returnData]);
            //         }
            //     }
            // }

            $placeOrder = $this->order->place_order($input);

            if ($placeOrder['ordersStatus'] == 'success') {
                $returnData['status'] = true;
                $returnData['out_of_stock'] = 'no';
                $returnData['result'] = $placeOrder['ordersData'];
                $returnData['massage'] = 'Order has been processed successfully.';
            }else{
                $returnData['out_of_stock'] = 'no';
                $returnData['status'] = false;
                $returnData['massage'] = 'Error while placing order.';
            }

        }else{
            $returnData['isLogin'] = 'no';
        }

        return response()->json(['returnData'=>$returnData]);
    }
    /**************** order cash on delivery ****************/


    /**************** paypal ****************/

    public function postPaymentWithpaypal(Request $request)
    {
        Session::put('products_price', $request->get('amount'));

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Product')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Enter Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('checkout');                
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('checkout');                
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {            
            return Redirect::away($redirect_url);
        }

        \Session::put('error','Unknown error occurred');
        return Redirect::route('checkout');
    }

    public function getPaymentStatus(Request $request)
    {     
        $paymentResponseData = $request->all(); 
        //$custom = $_POST;
        $payment_id = Session::get('paypal_payment_id');
        $products_price = Session::get('products_price');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('checkout');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {         
            \Session::put('success','Payment success !!');
            \Session::put('paymentResponseData',$paymentResponseData);

            //\Session::put('custom',$custom);

            $current_user_details = Session::get('user');
            $customers_id = $current_user_details[0]->id;
            $input['customers_id'] = $customers_id;
            $input['customers_mail'] = $current_user_details[0]->email;
            $input['firstname'] = $current_user_details[0]->name;
            $input['delivery_phone'] = $current_user_details[0]->user_phone;
            $input['order_comments'] = '';
            $input['paymentResponseData'] = $paymentResponseData;
            $input['products_price'] = $products_price;
            $input['payment_method'] = 'PayPal';

            $userDetail = DB::table('users')
                ->where('id', $customers_id)
                ->first();
            $input['address_book_id'] = $userDetail->default_address_id;

            $placeOrder = $this->order->place_order($input);

            return Redirect::route('paymentSuccess');
        }

        \Session::put('error','Payment failed !!');
        return Redirect::route('checkout');
    }

    public function paymentSuccess()
    {
        return view("web.payment_success");
    }
    /**************** paypal ****************/



}
