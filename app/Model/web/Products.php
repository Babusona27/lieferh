<?php

namespace App\Model\web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Products extends Model
{
    //
    use Sortable;
    public $sortable =['products_id','updated_at'];
    public $sortableAs =['categories_name','products_name'];
    

    //products
    public function products($data)
    {

        if (empty($data['page_number']) or $data['page_number'] == 0) {
            $skip = $data['page_number'] . '0';
        } else {
            $skip = $data['limit'] * $data['page_number'];
        }

        $min_price = $data['min_price'];
        $max_price = $data['max_price'];
        $take = $data['limit'];
        $currentDate = time();
        $type = $data['type'];

        if ($type == "atoz") {
            $sortby = "products_name";
            $order = "ASC";
        } elseif ($type == "ztoa") {
            $sortby = "products_name";
            $order = "DESC";
        } elseif ($type == "hightolow") {
            $sortby = "products_price";
            $order = "DESC";
        } elseif ($type == "lowtohigh") {
            $sortby = "products_price";
            $order = "ASC";
        } elseif ($type == "topseller") {
            $sortby = "products_ordered";
            $order = "DESC";
        } elseif ($type == "mostliked") {
            $sortby = "products_liked";
            $order = "DESC";

        } elseif ($type == "special") {
            $sortby = "specials.products_id";
            $order = "desc";
        } elseif ($type == "flashsale") { //flashsale products
            $sortby = "flash_sale.flash_start_date";
            $order = "asc";
        } else {
            $sortby = "products.products_id";
            $order = "desc";
        }

        $filterProducts = array();
        $eliminateRecord = array();

        $categories = DB::table('products')
            // ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
            // ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.images_id');

        if (isset($data['vendor_str'])) {
            if ($data['vendor_str']=='yes') {
                if (!empty($data['vendor_id'])) {
                    $categories->whereIn('products.manufacturers_id', $data['vendor_id']);
                }
            }
            if ($data['vendor_str']=='no') {
                $categories->where('products.manufacturers_id', '-1');
            }
        }
        

        if (!empty($data['categories_id'])) {
            $categories->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id');
        }

        // if (!empty($data['filters']) and empty($data['search'])) {
        //     $categories->leftJoin('products_attributes', 'products_attributes.products_id', '=', 'products.products_id');
        // }

        // if (!empty($data['search'])) {
        //     $categories->leftJoin('products_attributes', 'products_attributes.products_id', '=', 'products.products_id')
        //         ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
        //         ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id');
        // }
        //wishlist customer id
        if ($type == "wishlist") {
            $categories->LeftJoin('liked_products', 'liked_products.liked_products_id', '=', 'products.products_id')
                ->select('products.*', 'image_categories.images_path as image_path', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url');

        }
        //parameter special
        elseif ($type == "special") {
            $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                ->select('products.*', 'image_categories.images_path as image_path', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price');
        } elseif ($type == "flashsale") {
            //flash sale
            $categories->LeftJoin('flash_sale', 'flash_sale.products_id', '=', 'products.products_id')
                ->select(DB::raw(time() . ' as server_time'), 'products.*', 'image_categories.images_path as image_path', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'flash_sale.flash_start_date', 'flash_sale.flash_expires_date', 'flash_sale.flash_sale_products_price as flash_price');

        } elseif ($type == "compare") {
            //flash sale
            $categories->LeftJoin('flash_sale', 'flash_sale.products_id', '=', 'products.products_id')
                ->select(DB::raw(time() . ' as server_time'), 'products.*', 'image_categories.images_path as image_path', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'flash_sale.flash_start_date', 'flash_sale.flash_expires_date', 'flash_sale.flash_sale_products_price as discount_price');

        } else {
            // $categories->LeftJoin('specials', function ($join) use ($currentDate) {
            //     $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1')->where('expires_date', '>', $currentDate);
            // });
            $categories->select('products.*', 'image_categories.images_path as image_path', 'products_description.*');
        }

        if ($type == "special") { //deals special products
            $categories->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
        }

        if ($type == "flashsale") { //flashsale
            $categories->where('flash_sale.flash_status', '=', '1')->where('flash_expires_date', '>', $currentDate);

        } 
        // elseif ($type != "compare") {
        //     $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
        //         $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
        //     });

        // }

        //get single products
        if (!empty($data['products_id']) && $data['products_id'] != "") {
            $categories->where('products.products_id', '=', $data['products_id']);
        }

        //for min and maximum price
        if (!empty($max_price)) {

            if (!empty($max_price)) {
                //check session contain default currency
                $current_currency = DB::table('currencies')->where('id', session('currency_id'))->first();
                if($current_currency->is_default == 0){
                    $max_price = $max_price / session('currency_value');
                    $min_price = $min_price / session('currency_value');
                }
    
            }

            $categories->whereBetween('products.products_price', [$min_price, $max_price]);
        }

        if (!empty($data['search'])) {

            $searchValue = $data['search'];
            
            //$categories->where('products_options.products_options_name', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);

            // if (!empty($data['categories_id'])) {
            //     $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
            // }

            // if (!empty($data['filters'])) {
            //     $temp_key = 0;
            //     foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {

            //         if ($temp_key == 0) {

            //             $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
            //                 ->where('products_attributes.options_values_id', $option_id_temp);
            //             if (count($data['filters']['filter_attribute']['options']) > 1) {

            //                 $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
            //             }

            //         } else {
            //             $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
            //                 ->where('products_attributes.options_values_id', $option_id_temp);

            //             if (count($data['filters']['filter_attribute']['options']) > 1) {
            //                 $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
            //             }

            //         }
            //         $temp_key++;
            //     }

            // }

            // if (!empty($max_price)) {
            //     $categories->whereBetween('products.products_price', [$min_price, $max_price]);
            // }
            // $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
            //     $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
            // });
            // $categories->orWhere('products_options_values.products_options_values_name', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);
            // if (!empty($data['categories_id'])) {
            //     $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
            // }

            // if (!empty($data['filters'])) {
            //     $temp_key = 0;
            //     foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {

            //         if ($temp_key == 0) {

            //             $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
            //                 ->where('products_attributes.options_values_id', $option_id_temp);
            //             if (count($data['filters']['filter_attribute']['options']) > 1) {

            //                 $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
            //             }

            //         } else {
            //             $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
            //                 ->where('products_attributes.options_values_id', $option_id_temp);

            //             if (count($data['filters']['filter_attribute']['options']) > 1) {
            //                 $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
            //             }

            //         }
            //         $temp_key++;
            //     }

            // }

            // if (!empty($max_price)) {
            //     $categories->whereBetween('products.products_price', [$min_price, $max_price]);
            // }

            // $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
            //     $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
            // });

            $categories->where('products_name', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);

            // if (!empty($data['categories_id'])) {
            //     $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
            // }

            // if (!empty($data['filters'])) {
            //     $temp_key = 0;
            //     foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {

            //         if ($temp_key == 0) {

            //             $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
            //                 ->where('products_attributes.options_values_id', $option_id_temp);
            //             if (count($data['filters']['filter_attribute']['options']) > 1) {

            //                 $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
            //             }

            //         } else {
            //             $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
            //                 ->where('products_attributes.options_values_id', $option_id_temp);

            //             if (count($data['filters']['filter_attribute']['options']) > 1) {
            //                 $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
            //             }

            //         }
            //         $temp_key++;
            //     }

            // }

            // if (!empty($max_price)) {
            //     $categories->whereBetween('products.products_price', [$min_price, $max_price]);
            // }

            // $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
            //     $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
            // });

            // $categories->orWhere('products_model', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);

            // if (!empty($data['categories_id'])) {
            //     $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
            // }

            // if (!empty($data['filters'])) {
            //     $temp_key = 0;
            //     foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {

            //         if ($temp_key == 0) {

            //             $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
            //                 ->where('products_attributes.options_values_id', $option_id_temp);
            //             if (count($data['filters']['filter_attribute']['options']) > 1) {

            //                 $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
            //             }

            //         } else {
            //             $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
            //                 ->where('products_attributes.options_values_id', $option_id_temp);

            //             if (count($data['filters']['filter_attribute']['options']) > 1) {
            //                 $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
            //             }

            //         }
            //         $temp_key++;
            //     }

            // }
            // $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
            //     $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
            // });
        }

        // if (!empty($data['filters'])) {
        //     $temp_key = 0;
        //     foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {

        //         if ($temp_key == 0) {

        //             $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
        //                 ->where('products_attributes.options_values_id', $option_id_temp);
        //             if (count($data['filters']['filter_attribute']['options']) > 1) {

        //                 $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
        //             }

        //         } else {
        //             $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
        //                 ->where('products_attributes.options_values_id', $option_id_temp);

        //             if (count($data['filters']['filter_attribute']['options']) > 1) {
        //                 $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
        //             }

        //         }
        //         $temp_key++;
        //     }

        // }

        //wishlist customer id
        // if ($type == "wishlist") {
        //     $categories->where('liked_customers_id', '=', session('customers_id'));
        // }

        //wishlist customer id
        if ($type == "is_feature") {
            $categories->where('products.is_feature', '=', 1);
        }

        // $categories->where('products_description.language_id', '=', Session::get('language_id'))->where('products_status', '=', 1);

        //get single category products
        if (!empty($data['categories_id'])) {
            $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
            $categories->where('categories.categories_status', '=', 1);
            // $categories->where('categories_description.language_id', '=', Session::get('language_id'));
        }else{
            $categories->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id');
                // ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id');
            $categories->whereIn('products_to_categories.categories_id', function ($query) use ($currentDate) {
                $query->select('categories_id')->from('categories')->where('categories.categories_status',1);
            });
        }

        if ($type == "topseller") {
            $categories->where('products.products_ordered', '>', 0);
        }
        if ($type == "mostliked") {
            $categories->where('products.products_liked', '>', 0);
        }

        $categories->orderBy($sortby, $order)->groupBy('products.products_id');

        //count
        $total_record = $categories->get();
        $products = $categories->skip($skip)->take($take)->get();

        $result = array();
        $result2 = array();

        //check if record exist
        if (count($products) > 0) {

            $index = 0;
            foreach ($products as $products_data) {

                // $reviews = DB::table('reviews')
                //     ->leftjoin('users', 'users.id', '=', 'reviews.customers_id')
                //     ->leftjoin('reviews_description', 'reviews.reviews_id', '=', 'reviews_description.review_id')
                //     ->select('reviews.*', 'reviews_description.reviews_text')
                //     ->where('products_id', $products_data->products_id)
                //     ->where('reviews_status', '1')
                //     ->where('reviews_read', '1')
                //     ->get();
                $reviews = [];
                $avarage_rate = 0;
                $total_user_rated = 0;

                if (count($reviews) > 0) {
                    $five_star = 0;
                    $five_count = 0;

                    $four_star = 0;
                    $four_count = 0;

                    $three_star = 0;
                    $three_count = 0;

                    $two_star = 0;
                    $two_count = 0;

                    $one_star = 0;
                    $one_count = 0;

                    foreach ($reviews as $review) {

                        //five star ratting
                        if ($review->reviews_rating == '5') {
                            $five_star += $review->reviews_rating;
                            $five_count++;
                        }

                        //four star ratting
                        if ($review->reviews_rating == '4') {
                            $four_star += $review->reviews_rating;
                            $four_count++;
                        }
                        //three star ratting
                        if ($review->reviews_rating == '3') {
                            $three_star += $review->reviews_rating;
                            $three_count++;
                        }
                        //two star ratting
                        if ($review->reviews_rating == '2') {
                            $two_star += $review->reviews_rating;
                            $two_count++;
                        }

                        //one star ratting
                        if ($review->reviews_rating == '1') {
                            $one_star += $review->reviews_rating;
                            $one_count++;
                        }
                    }

                    $five_ratio = round($five_count / count($reviews) * 100);
                    $four_ratio = round($four_count / count($reviews) * 100);
                    $three_ratio = round($three_count / count($reviews) * 100);
                    $two_ratio = round($two_count / count($reviews) * 100);
                    $one_ratio = round($one_count / count($reviews) * 100);
                    if(($five_star + $four_star + $three_star + $two_star + $one_star) > 0){
                        $avarage_rate = (5 * $five_star + 4 * $four_star + 3 * $three_star + 2 * $two_star + 1 * $one_star) / ($five_star + $four_star + $three_star + $two_star + $one_star);
                    }else{
                        $avarage_rate = 0;
                    }
                    $total_user_rated = count($reviews);
                    $reviewed_customers = $reviews;
                } else {
                    $reviewed_customers = array();
                    $avarage_rate = 0;
                    $total_user_rated = 0;

                    $five_ratio = 0;
                    $four_ratio = 0;
                    $three_ratio = 0;
                    $two_ratio = 0;
                    $one_ratio = 0;
                }

                $products_data->rating = number_format($avarage_rate, 2);
                $products_data->total_user_rated = $total_user_rated;

                $products_data->five_ratio = $five_ratio;
                $products_data->four_ratio = $four_ratio;
                $products_data->three_ratio = $three_ratio;
                $products_data->two_ratio = $two_ratio;
                $products_data->one_ratio = $one_ratio;

                //review by users
                $products_data->reviewed_customers = $reviewed_customers;
                $products_id = $products_data->products_id;

                //products_image
                $default_images = DB::table('image_categories')
                    ->where('images_id', '=', $products_data->products_image)
                    ->where('images_type', 'MEDIUM')
                    ->first();

                if ($default_images) {
                    $products_data->image_path = $default_images->images_path;
                } else {
                    $default_images = DB::table('image_categories')
                        ->where('images_id', '=', $products_data->products_image)
                        ->where('images_type', 'LARGE')
                        ->first();

                    if ($default_images) {
                        $products_data->image_path = $default_images->images_path;
                    } else {
                        $default_images = DB::table('image_categories')
                            ->where('images_id', '=', $products_data->products_image)
                            ->where('images_type', 'ACTUAL')
                            ->first();
                        $products_data->image_path = $default_images->images_path;
                    }

                }

                $default_images = DB::table('image_categories')
                    ->where('images_id', '=', $products_data->products_image)
                    ->where('images_type', 'LARGE')
                    ->first();
                if ($default_images) {
                    $products_data->default_images = $default_images->images_path;
                } else {
                    $default_images = DB::table('image_categories')
                        ->where('images_type', 'ACTUAL')
                        ->where('images_id', '=', $products_data->products_image)
                        ->first();
                    if ($default_images) {
                        $products_data->default_images = $default_images->images_path;
                    }
                }

                //multiple images
                $products_images = DB::table('products_images')
                    ->LeftJoin('image_categories', 'products_images.image', '=', 'image_categories.images_id')
                    ->select('image_categories.images_path as image_path', 'image_categories.images_type')
                    ->where('products_id', '=', $products_id)
                    ->orderBy('sort_order', 'ASC')
                    ->get();

                $products_data->images = $products_images;

                $default_image_thumb = DB::table('products')
                    ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.images_id')
                    ->select('image_categories.images_path as image_path', 'image_categories.images_type')
                    ->where('products_id', '=', $products_id)
                    ->where('images_type', '=', 'THUMBNAIL')
                    ->first();
                if ($default_image_thumb) {
                    $products_data->default_thumb = $default_image_thumb->image_path;
                } else {
                    $products_data->default_thumb = $products_data->default_images;
                }

                //categories
                $categories = DB::table('products_to_categories')
                    ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                    ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                    ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.categories_parent_id', 'categories.categories_status')
                    ->where('products_id', '=', $products_id)
                    // ->where('categories_description.language_id', '=', Session::get('language_id'))
                    ->where('categories.categories_status', 1)
                    ->orderby('categories_parent_id', 'ASC')
                    ->get();

                $products_data->categories = $categories;
                array_push($result, $products_data);

                $options = array();
                $attr = array();

                // $stocks = 0;
                // $stockOut = 0;
                // if ($products_data->products_type == '0') {
                //     $stocks = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'in')->sum('stock');
                //     $stockOut = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'out')->sum('stock');
                // }

                // $result[$index]->defaultStock = $stocks - $stockOut;
                $result[$index]->defaultStock = 50;

                //like product
                if (!empty(session('customers_id'))) {
                    $liked_customers_id = session('customers_id');
                    $categories = DB::table('liked_products')->where('liked_products_id', '=', $products_id)->where('liked_customers_id', '=', $liked_customers_id)->get();

                    if (count($categories) > 0) {
                        $result[$index]->isLiked = '1';
                    } else {
                        $result[$index]->isLiked = '0';
                    }
                } else {
                    $result[$index]->isLiked = '0';
                }

                // fetch all options add join from products_options table for option name
                // $products_attribute = DB::table('products_attributes')->where('products_id', '=', $products_id)->groupBy('options_id')->get();
                // if (count($products_attribute)) {
                //     $index2 = 0;
                //     foreach ($products_attribute as $attribute_data) {

                //         $option_name = DB::table('products_options')
                //             ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name')->where('products_options.products_options_id', '=', $attribute_data->options_id)->get();

                //         if (count($option_name) > 0) {

                //             $temp = array();
                //             $temp_option['id'] = $attribute_data->options_id;
                //             $temp_option['name'] = $option_name[0]->products_options_name;
                //             $temp_option['is_default'] = $attribute_data->is_default;
                //             $attr[$index2]['option'] = $temp_option;

                //             // fetch all attributes add join from products_options_values table for option value name
                //             $attributes_value_query = DB::table('products_attributes')->where('products_id', '=', $products_id)->where('options_id', '=', $attribute_data->options_id)->get();
                //             $k = 0;
                //             foreach ($attributes_value_query as $products_option_value) {

                //                 $option_value = DB::table('products_options_values')->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)->get();

                //                 $attributes = DB::table('products_attributes')->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])->get();

                //                 $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                //                 $temp_i['id'] = $products_option_value->options_values_id;
                //                 $temp_i['value'] = $option_value[0]->products_options_values_name;
                //                 $temp_i['price'] = $products_option_value->options_values_price;
                //                 $temp_i['price_prefix'] = $products_option_value->price_prefix;
                //                 array_push($temp, $temp_i);

                //             }
                //             $attr[$index2]['values'] = $temp;
                //             $result[$index]->attributes = $attr;
                //             $index2++;
                //         }
                //     }
                // } else {
                //     $result[$index]->attributes = array();
                // }
                $index++;
            }
            $responseData = array('success' => '1', 'product_data' => $result, 'message' => 'Returned all products', 'total_record' => count($total_record));

        } else {
            $responseData = array('success' => '0', 'product_data' => $result, 'message' => 'Empty record', 'total_record' => count($total_record));
        }

        return ($responseData);
    }

    public function getCategories($request)
    {
        $category = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')->where('categories.categories_id', $request->category)
        // ->where('categories.categories_status', 1)
        // ->where('language_id', Session::get('language_id'))
        ->get();
        return $category;
    }

    public function getMainCategories($category)
    {
        $main_category = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
        // ->where('categories.categories_status', 1)
        ->where('categories.categories_id', $category)->get();
        return $main_category;
    }

    public function getProductsById($id)
    {
        $products = DB::table('products')->where('products_id', $id)->get();
        return $products;
    }

    public function getCategoryByParent($products_id)
    {
        $category = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->leftJoin('products_to_categories', 'products_to_categories.categories_id', '=', 'categories.categories_id')
            ->where('products_to_categories.products_id', $products_id)
            ->where('categories.categories_parent_id', 0)
            ->where('categories.categories_status', 1)
            ->get();
        return $category;
    }

    public function getSubCategoryByParent($products_id)
    {
        $sub_category = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->leftJoin('products_to_categories', 'products_to_categories.categories_id', '=', 'categories.categories_id')
            ->where('products_to_categories.products_id', $products_id)
            ->where('categories.categories_parent_id', '>', 0)
            ->where('categories.categories_status', 1)
            ->get();
        return $sub_category;
    }


    // public function paginator($request){
    //     $language_id = '1';
    //     $categories_id = $request->categories_id;
    //     $product  = $request->product;
    //     $results = array();
    //     $data = $this->sortable(['products_id'=>'DESC'])
    //         ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
    //         ->LeftJoin('image_categories', function ($join) {
    //             $join->on('image_categories.'images_id'', '=', 'products.products_image')
    //                 ->where(function ($query) {
    //                     $query->where('image_categories.images_type', '=', 'THUMBNAIL')
    //                         ->where('image_categories.images_type', '!=', 'THUMBNAIL')
    //                         ->orWhere('image_categories.images_type', '=', 'ACTUAL');
    //                 });
    //         });


    //         $data->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
    //             ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
    //             ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id');



    //     $data->select('products.*', 'products_description.*', 'image_categories.images_path as path', 'products.updated_at as productupdate', 'categories_description.categories_id',
    //     'categories_description.categories_name');
    //     if (isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id'])) {
    //         if (!empty(session('categories_id'))) {
    //             $cat_array = explode(',', session('categories_id'));
    //             $data->whereIn('products_to_categories.categories_id', '=', $cat_array);
    //         }

    //         $data->where('products_to_categories.categories_id', '=', $_REQUEST['categories_id']);

    //         if (isset($_REQUEST['product']) and !empty($_REQUEST['product'])) {
    //             $data->where('products_name', 'like', '%' . $_REQUEST['product'] . '%');
    //         }

    //         $products = $data->orderBy('products.products_id', 'DESC')
    //         ->where('categories_status', '1')->paginate(20);

    //     } else {

    //         if (!empty(session('categories_id'))) {
    //             $cat_array = explode(',', session('categories_id'));
    //             $data->whereIn('products_to_categories.categories_id', $cat_array);
    //         }
    //         $products = $data->orderBy('products.products_id', 'DESC')
    //         ->where('categories_status', '1')
    //         ->where('is_current', '1')
    //         ->groupBy('products.products_id')->paginate(20);
    //     }

    //     return $products;



    // }
}
