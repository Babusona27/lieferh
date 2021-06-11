<?php

namespace App\Model\web;

use Illuminate\Database\Eloquent\Model;
use App\Model\web\Cart;
use Session;
use DB;

class Order extends Model
{
    //place_order
    public function place_order($request)
    {
        $cart = new Cart();
        $result = array();
        $return_data = array();
        $customers_id = $request['customers_id'];
        
        $request['shipping_price'] = "";
        $request['shipping_method'] = "";
        $request['lastname'] = '';

        // if (isset($request['coupon_id'])) {
        //     $coupon_id = $request['coupon_id'];
        // }else{
        //     $coupon_id = '';
        // }
        $coupon_id = '';

        // if (isset($request['coupon_discount'])) {
        //     if (!empty($request['coupon_discount'])) {
        //         $coupon_discount = $request['coupon_discount'];
        //     }else{
        //         $coupon_discount = 0;
        //     }
        // }else{
        //     $coupon_discount = 0;
        // }
        $coupon_discount = 0;

        $cart_items = $cart->myCart($result,$customers_id);
        $result['cart'] = $cart_items;
        
        // if (count($result['cart']) > 0) {
        //     foreach ($result['cart'] as $products) {
        //         $req = array();
        //         $attr = array();
        //         $req['products_id'] = $products->products_id;
        //         if (isset($products->attributes)) {
        //             foreach ($products->attributes as $key => $value) {
        //                 $attr[$key] = $value->products_attributes_id;
        //             }
        //             $req['attributes'] = $attr;

        //         }
        //         $check = Products::getquantity($req);
        //         if ($products->customers_basket_quantity > $check['stock']) {
        //             // session(['out_of_stock' => 1]);
        //             // session(['out_of_stock_product' => $products->products_id]);
        //             $return_data['ordersStatus'] = 'out_of_stock';
        //             //$return_data['out_of_stock'] = 'Yes';
        //             $return_data['out_of_stock_product_id'] = $products->products_id;
        //             return $return_data;
        //         }
        //     }
        // }

        $date_added = date('Y-m-d h:i:s');
        // if (Session::get('guest_checkout') == 1) {
        //     $email = session('shipping_address')->email;
        //     $check = DB::table('users')->where('role_id', 2)->where('email', $email)->first();
        //     if ($check == null) {
        //         $customers_id = DB::table('users')
        //             ->insertGetId([
        //                 'role_id' => 2,
        //                 'email' => $email = session('shipping_address')->email,
        //                 'password' => Hash::make('123456dfdfdf'),
        //                 'first_name' => session('shipping_address')->firstname,
        //                 'last_name' => session('shipping_address')->lastname,
        //                 'phone' => session('billing_address')->billing_phone,
        //             ]);
        //         session(['customers_id' => $customers_id]);
        //     } else {
        //         $customers_id = $check->id;
        //         $email = $check->email;
        //         session(['customers_id' => $customers_id]);
        //     }
        // } else {
        //     $customers_id = auth()->guard('customer')->user()->id;
        //     $email = auth()->guard('customer')->user()->email;
        // }

        $cust_address = DB::table('address_book')
            ->where('address_book_id', $request['address_book_id'])
            ->get();
        if (!empty($cust_address)) {
            $delivery_street = $cust_address[0]->entry_street_address;
            $delivery_city = $cust_address[0]->area;
            $delivery_pincode = $cust_address[0]->entry_postcode;
        }

        $customers_id = $request['customers_id'];
        $email = $request['customers_mail'];

        //$warehouses_id = 0;
        // if (!empty($request['pincode_val'])) {
        //     $warehouse_id = DB::table('pincodes')
        //         ->select('pincodes.*','warehouses_pincodes.warehouses_id')
        //         ->LeftJoin('warehouses_pincodes', 'warehouses_pincodes.pincodes_id', '=', 'pincodes.pincodes_id')
        //         ->where('pincodes.pincodes_val', '=', $request['pincode_val'])
        //         ->first();
        //     if (!empty($warehouse_id)) {
        //         $warehouses_id = $warehouse_id->warehouses_id;
        //     }
        // }

        $delivery_company = '';
        $delivery_name = $request['firstname'];

        //$delivery_lastname = $request['lastname'];
        $delivery_street_address = $delivery_street;
        $delivery_suburb = '';
        $delivery_city = $delivery_city;
        $delivery_postcode = $delivery_pincode;
        $delivery_phone = $request['delivery_phone'];

        // $delivery = DB::table('zones')->where('zone_id', '=', session('shipping_address')->zone_id)->get();

        // if (count($delivery) > 0) {
        //     $delivery_state = $delivery[0]->zone_code;
        // } else {
        //     $delivery_state = 'other';
        // }
        $delivery_state = '';

        // $country = DB::table('countries')->where('countries_id', '=', session('shipping_address')->countries_id)->get();

        // $delivery_country = $country[0]->countries_name;
        $delivery_country = 'India';

        $billing_name = $request['firstname'];
        //$billing_lastname = $request['lastname'];
        $billing_street_address = $delivery_street;
        $billing_suburb = '';
        $billing_city = $delivery_city;
        $billing_postcode = $delivery_pincode;
        $billing_phone = $request['delivery_phone'];

        // if (!empty(session('billing_company')->company)) {
        //     $billing_company = session('billing_address')->company;
        // }
        $billing_company = '';

        // $billing = DB::table('zones')->where('zone_id', '=', session('billing_address')->billing_zone_id)->get();

        // if (count($billing) > 0) {
        //     $billing_state = $billing[0]->zone_code;
        // } else {
        //     $billing_state = 'other';
        // }
        $billing_state = '';

        // $country = DB::table('countries')->where('countries_id', '=', session('billing_address')->billing_countries_id)->get();

        // $billing_country = $country[0]->countries_name;
        $billing_country = 'India';

        $payment_method = $request['payment_method'];//razor_pay or cash_on_delivery
        $order_information = array();

        // if (!empty($request->cc_type)) {
        //     $cc_type = $request->cc_type;
        //     $cc_owner = $request->cc_owner;
        //     $cc_number = $request->cc_number;
        //     $cc_expires = $request->cc_expires;
        // } else {
        //     $cc_type = '';
        //     $cc_owner = '';
        //     $cc_number = '';
        //     $cc_expires = '';
        // }
        $cc_type = '';
        $cc_owner = '';
        $cc_number = '';
        $cc_expires = '';

        $last_modified = date('Y-m-d H:i:s');
        $date_purchased = date('Y-m-d H:i:s');

        //price
        // if (!empty($request['shipping_price'])) {
        //     $shipping_price = $request['shipping_price'];
        // } else {
        //     $shipping_price = 0;
        // }
        $shipping_price = 0;
        // $tax_rate = number_format((float) $request['tax_rate'], 2, '.', '');
        $tax_rate = 0;
        $coupon_discount = number_format((float) $coupon_discount, 2, '.', '');
        $order_price = ($request['products_price'] + $tax_rate + $shipping_price) - $coupon_discount;

        $shipping_cost = $shipping_price;
        $shipping_method = $request['shipping_method'];
        //dd($shipping_method);
        $orders_status = '1';
        //$orders_date_finished                =   $request->orders_date_finished;

        if (!empty($request['order_comments'])) {
            $comments = $request['order_comments'];
        } else {
            $comments = '';
        }

        // if (isset($request['timeIdHidden']) && !empty($request['timeIdHidden'])) {
        //     $delivery_time_id = $request['timeIdHidden'];
        // } else {
        //     $delivery_time_id = '';
        // }
        // if (isset($request['deliveryDateHidden']) && !empty($request['deliveryDateHidden'])) {
        //     $delivery_date = date("Y-m-d",strtotime($request['deliveryDateHidden']));
        // } else {
        //     $delivery_date = '';
        // }

        //$web_setting = DB::table('settings')->get();
        //$currency = $web_setting[19]->value;
        $currency = '₹';
        // $total_tax = number_format((float) $request['tax_rate'], 2, '.', '');
        $total_tax = 0;
        $products_tax = 1;

        $coupon_amount = 0;
        $code = '';

        // if (!empty($coupon_id)) {

        //     $coupons_users_id = DB::table('coupons_users')->insertGetId([
        //         'coupans_id' => $coupon_id,
        //         'customers_id' => $customers_id
        //     ]);

        //     $coupon_amount = number_format((float) $coupon_discount, 2, '.', '') + 0;
        //     $code = $request['coupon_id'];

        // } else {
        //     $code = '';
        //     $coupon_amount = '';
        // }

        //payment methods

        if ($payment_method == 'braintree') {
            $payment_method_name = 'Braintree';
            $payments_setting = $this->payments_setting_for_brain_tree();

            //braintree transaction with nonce
            $is_transaction = '1'; # For payment through braintree
            $nonce = $request->payment_method_nonce;

            if ($payments_setting['merchant_id']->environment == '0') {
                $braintree_environment = 'sandbox';
            } else {
                $braintree_environment = 'production';
            }

            $braintree_merchant_id = $payments_setting['merchant_id']->value;
            $braintree_public_key = $payments_setting['public_key']->value;
            $braintree_private_key = $payments_setting['private_key']->value;

            //brain tree credential
            require_once app_path('braintree/index.php');    

            if ($result->success) {

                if ($result->transaction->id) {
                    $order_information = array(
                        'braintree_id' => $result->transaction->id,
                        'status' => $result->transaction->status,
                        'type' => $result->transaction->type,
                        'currencyIsoCode' => $result->transaction->currencyIsoCode,
                        'amount' => $result->transaction->amount,
                        'merchantAccountId' => $result->transaction->merchantAccountId,
                        'subMerchantAccountId' => $result->transaction->subMerchantAccountId,
                        'masterMerchantAccountId' => $result->transaction->masterMerchantAccountId,
                        //'orderId'=>$result->transaction->orderId,
                        'createdAt' => time(),
                        //                        'updatedAt'=>$result->transaction->updatedAt->date,
                        'token' => $result->transaction->creditCard['token'],
                        'bin' => $result->transaction->creditCard['bin'],
                        'last4' => $result->transaction->creditCard['last4'],
                        'cardType' => $result->transaction->creditCard['cardType'],
                        'expirationMonth' => $result->transaction->creditCard['expirationMonth'],
                        'expirationYear' => $result->transaction->creditCard['expirationYear'],
                        'customerLocation' => $result->transaction->creditCard['customerLocation'],
                        'cardholderName' => $result->transaction->creditCard['cardholderName'],
                    );

                    $payment_status = "success";
                }
            } else {
                $payment_status = "failed";
            }

        } else if ($payment_method == 'stripe') { #### stipe payment
            $payment_method_name = 'stripe';
            $payments_setting = $this->payments_setting_for_stripe();
            //require file
            require_once app_path('stripe/config.php');

            //get token from app
            $token = $request->token;

            $customer = \Stripe\Customer::create(array(
                'email' => $email,
                'source' => $token,
            ));

            $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount' => 100 * $order_price,
                'currency' => 'usd',
            ));

            if ($charge->paid == true) {
                $order_information = array(
                    'paid' => 'true',
                    'transaction_id' => $charge->id,
                    'type' => $charge->outcome->type,
                    'balance_transaction' => $charge->balance_transaction,
                    'status' => $charge->status,
                    'currency' => $charge->currency,
                    'amount' => $charge->amount,
                    'created' => date('d M,Y', $charge->created),
                    'dispute' => $charge->dispute,
                    'customer' => $charge->customer,
                    'address_zip' => $charge->source->address_zip,
                    'seller_message' => $charge->outcome->seller_message,
                    'network_status' => $charge->outcome->network_status,
                    'expirationMonth' => $charge->outcome->type,
                );

                $payment_status = "success";

            } else {
                $payment_status = "failed";
            }

        } else if ($payment_method == 'cash_on_delivery') {
            $payments_setting = $this->payments_setting_for_cod();

            $payment_method_name = $payments_setting->name;
            $payment_status = 'success';

        }else if ($payment_method == 'PayPal') {

            $payment_method_name = 'PayPal';
            $payment_status = 'success';
            $order_information = $request['paymentResponseData'];

        } else if ($payment_method == 'instamojo') {
            $instamojo = $this->payments_setting_for_instamojo();
            $payment_method_name = $instamojo['auth_token']->name;
            $payment_status = 'success';
            $order_information = $request->nonce;
        } else if ($payment_method == 'hyperpay') {
            $hyperpay = $this->payments_setting_for_hyperpay();
            $payment_method_name = $hyperpay['userid']->name;
            $payment_status = 'success';
            $order_information = session('paymentResponseData');
        } else if ($payment_method == 'razor_pay') {
            $method = $this->payments_setting_for_razorpay();
            $payment_method_name = $method['RAZORPAY_KEY']->name;
            $payment_status = 'success';
            $order_information = $request['paymentResponseData'];
        } else if ($payment_method == 'pay_tm') {
            $method = $this->payments_setting_for_paytm();
            $payment_method_name = $method['paytm_mid']->name;
            Session(['paytm' => 'sasa']);
            $payment_status = 'success';
            $order_information = session('paymentResponseData');
        }else if ($payment_method == 'banktransfer') {

            $method = $this->payments_setting_for_directbank();
            $payment_method_name = $payment_method;
            $payment_status = 'success';
            $order_information = array(
                'account_name' => $method['account_name']->value,
                'account_number' => $method['account_number']->value,
                'payment_method' => $method['account_name']->payment_method,
                'bank_name' => $method['bank_name']->value,
                'short_code' => $method['short_code']->value,
                'iban' => $method['iban']->value,
                'swift' => $method['swift']->value,
            );
        }  else if ($payment_method == 'paystack') {

            $method = $this->payments_setting_for_paystack();
            $payment_method_name = $payment_method;
            $payment_status = 'success';
            $order_information = session('payment_json');
        }   else if ($payment_method == 'midtrans') {

            $method = $this->payments_setting_for_midtrans();
            $payment_method_name = $payment_method;
            $payment_status = 'success';
            $order_information = json_decode($request->nonce, JSON_UNESCAPED_SLASHES);
        }      

        if ($payment_method == 'banktransfer') {
            session(['banktransfer' => 'yes']);
        }else{
            session(['banktransfer' => 'no']);
        }

        //check if order is verified
        if ($payment_status == 'success') {         

            $orders_id = DB::table('orders')->insertGetId(
                ['customers_id' => $customers_id,
                    //'warehouses_id' => $warehouses_id,
                    'customers_name' => $delivery_name ,
                    'customers_street_address' => $delivery_street_address,
                    'customers_suburb' => $delivery_suburb,
                    'customers_city' => $delivery_city,
                    'customers_postcode' => $delivery_postcode,
                    'customers_state' => $delivery_state,
                    'customers_country' => $delivery_country,
                    //'customers_telephone' => $customers_telephone,
                    'email' => $email,
                    // 'customers_address_format_id' => $delivery_address_format_id,

                    'delivery_name' => $delivery_name,
                    'delivery_street_address' => $delivery_street_address,
                    'delivery_suburb' => $delivery_suburb,
                    'delivery_city' => $delivery_city,
                    'delivery_postcode' => $delivery_postcode,
                    'delivery_state' => $delivery_state,
                    'delivery_country' => $delivery_country,
                    // 'delivery_address_format_id' => $delivery_address_format_id,

                    'billing_name' => $billing_name,
                    'billing_street_address' => $billing_street_address,
                    'billing_suburb' => $billing_suburb,
                    'billing_city' => $billing_city,
                    'billing_postcode' => $billing_postcode,
                    'billing_state' => $billing_state,
                    'billing_country' => $billing_country,
                    //'billing_address_format_id' => $billing_address_format_id,

                    'payment_method' => $payment_method_name,
                    'cc_type' => $cc_type,
                    'cc_owner' => $cc_owner,
                    'cc_number' => $cc_number,
                    'cc_expires' => $cc_expires,
                    'last_modified' => $last_modified,
                    'date_purchased' => $date_purchased,
                    'order_price' => $order_price,
                    'shipping_cost' => $shipping_cost,
                    'shipping_method' => $shipping_method,
                    // 'orders_status' => $orders_status,
                    //'orders_date_finished'  => $orders_date_finished,
                    'currency' => $currency,
                    'order_information' => json_encode($order_information),
                    'coupon_code' => $code,
                    'coupon_amount' => $coupon_amount,
                    'total_tax' => $total_tax,
                    'ordered_source' => '1',
                    'delivery_phone' => $delivery_phone,
                    'billing_phone' => $billing_phone,
                    //'delivery_time_id' => $delivery_time_id,
                    //'delivery_date' => $delivery_date,
                ]);

            //orders status history
            $orders_history_id = DB::table('orders_status_history')->insertGetId(
                ['orders_id' => $orders_id,
                    'orders_status_id' => $orders_status,
                    'date_added' => $date_added,
                    'customer_notified' => '1',
                    'comments' => $comments,
                ]);
            $notification_text = "Your order is in pending status. ";
                DB::table('customer_notification')->insert(
                    ['customers_id' => $customers_id,
                        'order_id' => $orders_id,
                        'type' => 'order',
                        'status' => '1',
                        'text' => $notification_text,
                        'date_and_time' => $date_added,
                    ]);
                
            foreach ($cart_items as $products) {
                //get products info
                //$p_vendor_id = 0;
                $products_model = $products->model;
                // $productDtl = DB::table('products_warehouses')
                //     ->where('products_warehouses.product_warehouse_id', $products->product_warehouse_id)
                //     ->first();
                // if (!empty($productDtl)) {
                //     $p_vendor_id = $productDtl->products_vendor_id;
                //     //$products_model = $productDtl->products_model;
                // }

                $orders_products_id = DB::table('orders_products')->insertGetId(
                    [
                        'orders_id' => $orders_id,
                        'products_id' => $products->products_id,
                        'products_name' => $products->products_name,
                        'products_price' => $products->price,
                        'final_price' => $products->final_price * $products->customers_basket_quantity,
                        'products_tax' => $products_tax,
                        'products_quantity' => $products->customers_basket_quantity,
                        //'vendor_id' => $p_vendor_id,
                        'products_model' => $products_model,
                    ]);
                // $inventory_ref_id = DB::table('inventory')->insertGetId([
                //     'products_id' => $products->products_id,
                //     'reference_code' => '',
                //     'stock' => $products->customers_basket_quantity,
                //     'admin_id' => 0,
                //     'added_date' => time(),
                //     'purchase_price' => 0,
                //     'stock_type' => 'out',
                // ]);

                // if (Session::get('guest_checkout') == 1) {
                //     DB::table('customers_basket')->where('session_id', Session::getId())->where('products_id', $products->products_id)->update(['is_order' => '1']);

                // } else {
                //     DB::table('customers_basket')->where('customers_id', $customers_id)->where('products_id', $products->products_id)->update(['is_order' => '1']);

                // }
                DB::table('customers_basket')->where('customers_id', $customers_id)->where('products_id', $products->products_id)->update(['is_order' => '1']);

                // if (!empty($products->attributes) and count($products->attributes)>0) {

                //     foreach ($products->attributes as $attribute) {
                //         DB::table('orders_products_attributes')->insert(
                //             [
                //                 'orders_id' => $orders_id,
                //                 'products_id' => $products->products_id,
                //                 'orders_products_id' => $orders_products_id,
                //                 'products_options' => $attribute->attribute_name,
                //                 'products_options_values' => $attribute->attribute_value,
                //                 'options_values_price' => $attribute->values_price,
                //                 'price_prefix' => $attribute->prefix,
                //             ]);

                //         DB::table('inventory_detail')->insert([
                //             'inventory_ref_id' => $inventory_ref_id,
                //             'products_id' => $products->products_id,
                //             'attribute_id' => $attribute->products_attributes_id,
                //         ]);
                //     }
                // }

            }

            $responseData = array('success' => '1', 'data' => array(), 'message' => "Order has been placed successfully.");

            //send order email to user
            $order = DB::table('orders')
                ->LeftJoin('orders_status_history', 'orders_status_history.orders_id', '=', 'orders.orders_id')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->where('orders.orders_id', '=', $orders_id)->orderby('orders_status_history.date_added', 'DESC')->get();

            //foreach
            foreach ($order as $data) {
                $orders_id = $data->orders_id;

                $orders_products = DB::table('orders_products')
                    ->join('products', 'products.products_id', '=', 'orders_products.products_id')
                    ->select('orders_products.*', 'products.products_image as image')
                    ->where('orders_products.orders_id', '=', $orders_id)->get();
                $i = 0;
                $total_price = 0;
                $product = array();
                $subtotal = 0;
                foreach ($orders_products as $orders_products_data) {
                    $product_attribute = DB::table('orders_products_attributes')
                        ->where([
                            ['orders_products_id', '=', $orders_products_data->orders_products_id],
                            ['orders_id', '=', $orders_products_data->orders_id],
                        ])
                        ->get();

                    $orders_products_data->attribute = $product_attribute;
                    $product[$i] = $orders_products_data;
                    //$total_tax     = $total_tax+$orders_products_data->products_tax;
                    $total_price = $total_price + $orders_products[$i]->final_price;
                    $subtotal += $orders_products[$i]->final_price;
                    $i++;
                }

                $data->data = $product;
                $orders_data[] = $data;
            }

            $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->orderBy('orders_status_history.date_added', 'desc')
                ->where('orders_id', '=', $orders_id)->get();

            $orders_status = DB::table('orders_status')->get();

            $ordersData['orders_data'] = $orders_data;
            $ordersData['total_price'] = $total_price-$coupon_discount;
            $ordersData['orders_status'] = $orders_status;
            $ordersData['orders_status_history'] = $orders_status_history;
            $ordersData['subtotal'] = $subtotal;

            //notification/email
            // $myVar = new AlertController();
            // $alertSetting = $myVar->orderAlert($ordersData);

            // if (session('step') == '4') {
            //     session(['step' => array()]);
            // }

            // session(['orders_id' => $orders_id]);
            // session(['paymentResponseData' => '']); 
            
            // session(['paymentResponse'=>'']);
            // session(['payment_json','']);

            // //change status of cart products
            // if (Session::get('guest_checkout') == 1) {
            //     DB::table('customers_basket')->where('session_id', Session::getId())->update(['customers_id' => Session::get('customers_id')]);
            //     DB::table('customers_basket')->where('session_id', Session::getId())->update(['is_order' => '1']);
            // } else {
            //     DB::table('customers_basket')->where('customers_id', auth()->guard('customer')->user()->id)->update(['is_order' => '1']);
            // }
            DB::table('customers_basket')->where('customers_id', $customers_id)->update(['is_order' => '1']);           

            //return $payment_status;
            $return_data['ordersStatus'] = 'success';
            $return_data['ordersData'] = $ordersData;
            return $return_data;
        } else if ($payment_status == "failed") {
            $return_data['ordersStatus'] = 'failed';
            return $return_data;
        }

    }

    public function orderList($customers_id)
    {
        //$index = new Index();

        //$title = array('pageTitle' => Lang::get("website.View Order"));
        $result = array();
        //$result['commonContent'] = $index->commonContent();

        //orders
        // if (Session::get('guest_checkout') == 1) {
        //     $orders = DB::table('orders')
        //         ->orderBy('date_purchased', 'DESC')
        //         ->where('orders_id', '=', $id)->where('customers_id', '=', Session::get('customers_id'))->get();
        // } else {
        //     $orders = DB::table('orders')
        //         ->orderBy('date_purchased', 'DESC')
        //         ->where('orders_id', '=', $id)->where('customers_id', auth()->guard('customer')->user()->id)->get();
        // }
        $orders = DB::table('orders')
            ->orderBy('date_purchased', 'DESC')
            ->where('customers_id', $customers_id)->get();

        if (count($orders) > 0) {
            $index = 0;
            foreach ($orders as $orders_data) {

                $orders_status_history = DB::table('orders_status_history')
                    ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                    ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                    ->select('orders_status_description.orders_status_name', 'orders_status.orders_status_id')
                    ->where('orders_id', '=', $orders_data->orders_id)
                    //->where('orders_status_description.language_id', 1)
                    ->orderby('orders_status_history.orders_status_history_id', 'DESC')
                    ->limit(1)->get();

                $products_array = array();
                $index2 = 0;
                $order_products = DB::table('orders_products')
                    ->join('products', 'products.products_id', '=', 'orders_products.products_id')
                    ->join('image_categories', 'products.products_image', '=', 'image_categories.images_id')
                    ->select('image_categories.images_path as image', 'products.products_model as model', 'orders_products.*')
                    ->where('orders_products.orders_id', $orders_data->orders_id)->groupBy('products.products_id')->get();
                if (!empty($order_products)) {
                    foreach($order_products as $key=>$value){
                        if (!empty($order_products[$key]->image)){
                            $order_products[$key]->image = asset('public/'.$value->image);
                        }else{
                            $order_products[$key]->image = asset("public/images/newsletter.jpg");
                        }
                    }
                }

                foreach ($order_products as $products) {
                    array_push($products_array, $products);
                    $attributes = DB::table('orders_products_attributes')->where([['orders_id', $products->orders_id], ['orders_products_id', $products->orders_products_id]])->get();
                    if (count($attributes) == 0) {
                        $attributes = $attributes;
                    }

                    $products_array[$index2]->attributes = $attributes;
                    $index2++;

                }

                $orders_status_history = DB::table('orders_status_history')
                    ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                    ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                    ->select('orders_status_description.orders_status_name', 'orders_status.orders_status_id')
                    ->where('orders_id', '=', $orders_data->orders_id)->where('orders_status_description.language_id', 1)->orderby('orders_status_history.orders_status_history_id', 'DESC')->limit(1)->get();

                $orders[$index]->statusess = $orders_status_history;
                $orders[$index]->products = $products_array;
                $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
                $index++;

            }

            $result['orders'] = $orders;

             //check if payment type direck bank
            $bankdetail = array();

            if($orders[0]->payment_method == 'banktransfer'){
                $payments_setting = $this->payments_setting_for_directbank();    
                
                $bankdetail = array(
                    'account_name' => $payments_setting['account_name']->value,
                    'account_number' => $payments_setting['account_number']->value,
                    'payment_method' => $payments_setting['account_name']->payment_method,
                    'bank_name' => $payments_setting['bank_name']->value,
                    'short_code' => $payments_setting['short_code']->value,
                    'iban' => $payments_setting['iban']->value,
                    'swift' => $payments_setting['swift']->value,
                );
            }
        

            $result['bankdetail'] = $bankdetail;  

            $result['res'] = "view-order";
            return $result;
        } else {
            $result['res'] = "order";
            return $result;
        }
    }


    public function payments_setting_for_cod()
    {
        $payments_setting = DB::table('payment_description')
            ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_description.payment_methods_id')
            ->select('payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method')
            //->where('language_id', 1)
            ->where('payment_description.payment_methods_id', 4)
            ->first();
        return $payments_setting;
    }



}
