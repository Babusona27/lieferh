<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\web\Products;
use Session;

class ProductController extends Controller
{
    public function __construct(Products $products) {

        $this->products = $products;

    }
    
    public function productList(Request $request)
    {
        $input = $request->all();
        if(empty($input['pincode'])){
            return redirect()->back()->with('message', 'Please enter pincode!');
        }else{
            $pincodes = DB::table('pincodes')->where('pincodes_val',$input['pincode'])->get();
                if(count($pincodes)>0){
                    $products = $this->products->paginator($request);
                    $result['categories'] = DB::table('categories_description')->get();
                    $result['products'] = $products;
                    // echo "<pre>";print_r($result['products']);exit;
                    return view("web.product_list")->with('result', $result);
                }else{
                    $message = 'Pincode Not Found!';
                    return redirect()->back()->withErrors(['Pincode Not Found!']);
                }
        }
    }

    public function pincodeCheck($pincode)
    {
        $result = array();
        if(empty($pincode)){
            $result['status'] = false;
            $result['massage'] = "no postcode found!";
        }else{
            $pincodes = DB::table('pincodes')->where('pincodes_val',$pincode)->get();
                if(count($pincodes)>0){
                    Session::put('pincode', $pincode);
                    $result['status'] = true;
                    $result['massage'] = "postcode found!";
                }else{
                    $result['status'] = false;
                    $result['massage'] = "no postcode found!";
                }
        }
        return $result;
    }

    //shop
    public function shop(Request $request)
    {
        $pincodeCheck = $this->pincodeCheck($request->pincode);
        // $title = array('pageTitle' => 'startfreshh');
        if($pincodeCheck['status']){
            $result = array();
            // $result['commonContent'] = $this->index->commonContent();
            // $final_theme = $this->theme->theme();
            if (!empty($request->page)) {
                $page_number = $request->page;
            } else {
                $page_number = 0;
            }
    
            if (!empty($request->limit)) {
                $limit = $request->limit;
            } else {
                $limit = 15;
            }
    
            if (!empty($request->type)) {
                $type = $request->type;
            } else {
                $type = '';
            }
    
            //min_max_price
            if (!empty($request->price)) {
                $d = explode(";", $request->price);
                $min_price = $d[0];
                $max_price = $d[1];
            } else {
                $min_price = '';
                $max_price = '';
            }
            $exist_category = '1';
            $categories_status = 1;
            //category
            if (!empty($request->category) and $request->category != 'all') {
                $category = $this->products->getCategories($request);
                
                if(!empty($category) and count($category)>0){
                    $categories_id = $category[0]->categories_id;
                    //for main
                    if ($category[0]->categories_parent_id == 0) {
                        $category_name = $category[0]->categories_name;
                        $sub_category_name = '';
                        $category_slug = '';
                        $categories_status = $category[0]->categories_status;
                    } else {
                        //for sub
                        $main_category = $this->products->getMainCategories($category[0]->categories_parent_id);
    
                        $category_slug = '';
                        $category_name = $main_category[0]->categories_name;
                        $sub_category_name = $category[0]->categories_name;
                        $categories_status = $category[0]->categories_status;
                    }
                }else{
                    $categories_id = '';
                    $category_name = '';
                    $sub_category_name = '';
                    $category_slug = '';
                    $categories_status = 0;
                }
                                
    
            } else {
                $categories_id = '';
                $category_name = '';
                $sub_category_name = '';
                $category_slug = '';
                $categories_status = 1;
            }
            $result['pr_categories_id'] = $categories_id;
    
            $result['category_name'] = $category_name;
            $result['category_slug'] = $category_slug;
            $result['sub_category_name'] = $sub_category_name;
            $result['categories_status'] = $categories_status;
    
            //search value
            if (!empty($request->search)) {
                $search = $request->search;
            } else {
                $search = '';
            }
            $result['pr_search_val'] = $search;

            $vendor_id = array();
            $vendor_str = 'no';
            if (!empty($request->pincode)) {
                $pincode = $request->pincode;
                $pincode_id = DB::table('pincodes')
                    ->where('pincodes_val','=', $pincode)
                    ->select('pincodes_id')
                    ->first();
                if ($pincode_id) {
                    $vendor = DB::table('users')
                        ->where('role_type','=', 2)
                        ->where('pincodes_id','=', $pincode_id->pincodes_id)
                        ->select('users.id')
                        ->get();
                    if (count($vendor)>0) {
                        foreach ($vendor as $key => $value) {
                            array_push($vendor_id, $value->id);
                        }
                        $vendor_str = 'yes';
                    }
                }
            }
    
            // $filters = array();
            // if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            //     $index = 0;
            //     $options = array();
            //     $option_values = array();
    
            //     $option = $this->products->getOptions();
    
            //     foreach ($option as $key => $options_data) {
            //         $option_name = str_replace(' ', '_', $options_data->products_options_name);
    
            //         if (!empty($request->$option_name)) {
            //             $index2 = 0;
            //             $values = array();
            //             foreach ($request->$option_name as $value) {
            //                 $value = $this->products->getOptionsValues($value);
            //                 $option_values[] = $value[0]->products_options_values_id;
            //             }
            //             $options[] = $options_data->products_options_id;
            //         }
            //     }
    
            //     $filters['options_count'] = count($options);
    
            //     $filters['options'] = implode($options, ',');
            //     $filters['option_value'] = implode($option_values, ',');
    
            //     $filters['filter_attribute']['options'] = $options;
            //     $filters['filter_attribute']['option_values'] = $option_values;
    
            //     $result['filter_attribute']['options'] = $options;
            //     $result['filter_attribute']['option_values'] = $option_values;
            // }
    
            $data = array('page_number' => $page_number, 'type' => $type, 'limit' => $limit,
                'categories_id' => $categories_id, 'search' => $search,'vendor_id' => $vendor_id, 'vendor_str' => $vendor_str, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
    
            $products = $this->products->products($data); 
            if($products['success'] == 1){
                $result['products'] = $products['product_data'];
            }else{
                $result['products'] = [];
            }
            $result['categories'] = DB::table('categories_description')->get();
            
            
            // $data = array('limit' => $limit, 'categories_id' => $categories_id);
            // $filters = $this->filters($data);
            // $result['filters'] = $filters;
    
            // $cart = '';
            // $result['cartArray'] = $this->products->cartIdArray($cart);
    
            // if ($limit > $result['products']['total_record']) {
            //     $result['limit'] = $result['products']['total_record'];
            // } else {
            //     $result['limit'] = $limit;
            // }
    
            // //liked products
            // $result['liked_products'] = $this->products->likedProducts();
            // $result['categories'] = $this->products->categories();
    
            // $result['min_price'] = $min_price;
            // $result['max_price'] = $max_price;
    
            return view("web.product_list")->with('result', $result);
        }else{
            $massage = $pincodeCheck['massage'];
            return redirect()->back()->withErrors([$massage]);
        }
        

    }

    public function productDetails(Request $request,$p_id)
    {
        //$title = array('pageTitle' => Lang::get('website.Product Detail'));
        $result = array();
        $products_id = $p_id;
        //$result['commonContent'] = $this->index->commonContent();
        //$final_theme = $this->theme->theme();
         //min_price
         // if (!empty($request->min_price)) {
         //     $min_price = $request->min_price;
         // } else {
         //     $min_price = '';
         // }
        $min_price = '';
 
         //max_price
         // if (!empty($request->max_price)) {
         //     $max_price = $request->max_price;
         // } else {
         //     $max_price = '';
         // }
        $max_price = '';
 
         // if (!empty($request->limit)) {
         //     $limit = $request->limit;
         // } else {
         //     $limit = 15;
         // }
        $limit = 15;
 
         $products = $this->products->getProductsById($products_id);
         if(!empty($products) and count($products)>0){
             
             //category
             $category = $this->products->getCategoryByParent($products[0]->products_id);
 
             if (!empty($category) and count($category) > 0) {
                 $category_slug = '';
                 $category_name = $category[0]->categories_name;
             } else {
                 $category_slug = '';
                 $category_name = '';
             }
             $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);
 
             if (!empty($sub_category) and count($sub_category) > 0) {
                 $sub_category_name = $sub_category[0]->categories_name;
                 $sub_category_slug = $sub_category[0]->categories_slug;
             } else {
                 $sub_category_name = '';
                 $sub_category_slug = '';
             }
 
             $result['category_name'] = $category_name;
             $result['category_slug'] = $category_slug;
             $result['sub_category_name'] = $sub_category_name;
             $result['sub_category_slug'] = $sub_category_slug;
 
             // $isFlash = $this->products->getFlashSale($products[0]->products_id);
 
             // if (!empty($isFlash) and count($isFlash) > 0) {
             //     $type = "flashsale";
             // } else {
             //     $type = "";
             // }
             $type = "";

             $postCategoryId = '';
             $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $detail = $this->products->products($data);
             $result['detail'] = $detail;
             // if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
             //     $i = 0;
             //     foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
             //         if ($i == 0) {
             //             $postCategoryId = $postCategory->categories_id;
             //             $i++;
             //         }
             //     }
             // }
 
             // $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             // $simliar_products = $this->products->products($data);
             // $result['simliar_products'] = $simliar_products;
 
             // $cart = '';
             // $result['cartArray'] = $this->products->cartIdArray($cart);
 
             // //liked products
             // $result['liked_products'] = $this->products->likedProducts();
 
             // $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             // $top_seller = $this->products->products($data);
             // $result['top_seller'] = $top_seller;       
         }else{
             $products = '';
             $result['detail']['product_data'] = '';
         }

        return view("web.product_details")->with('result', $result);
    }

    
}
