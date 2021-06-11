@extends('web.weblayout')
@section('content')

  @include('web.common.overlay')

  @include('web.common.header')

  <section class="restaurants_bnr">
    <div class="container">
      <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4">
          <div class="form-inline my-2 my-lg-0">
            <div class="from_leftbg">              
              <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Dishes, restaurants, cuisines" id="pr_search" value="<?php echo $result['pr_search_val']?$result['pr_search_val']:''; ?>" >
            </div>
            <a href="javascript:void(0);" onclick="productSearch()" ><span class="from_icon"> <i class="fa fa-search" aria-hidden="true"></i></span></a>
                

            </div>
        </div>
        <div class="col-md-4"> </div>
      </div>
    </div>
  </section>

  <section class="service_section">
    <div class="container">
      <div class="row">
        <div class="col-md-3"> 
          <div class="service_section-left"> 
            <div class="location_part">
              <div class="location_icon"> <img src="{{asset('public/web/images/location_icon.png')}}" alt=""></div>
              <div class="location_text">
                <span> Now</span>
                <h6> Manchester Central</h6>
                <p> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Change</p>
              </div>
            </div>
            <div class="next_frompart">
              {{-- <form>
                <div class="form-check">
                    <label class="form-check-label" for="radio1">
                      <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>Delivery
                    </label>
                    <label class="form-check-label" for="radio2">
                      <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">Pickup
                    </label>
                  </div>                              
              </form> --}}
            </div>
            {{-- <div class="offer_part">
              <div class="offer_maintext">
                <h5> Offers</h5>
                <i class="fa fa-angle-up" aria-hidden="true"></i>
              </div>
            </div>
            <div class="checked_part">
              <div class="form-check">
                  <label class="form-check-label" for="radio1">
                    <input type="radio" class="form-check-input">All offers<span> (220)</span>
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label" for="radio2">
                    <input type="radio" class="form-check-input">Upto 50% off <span> (148)</span>
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input">20% off <span> (85)</span>
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" >Restaurant picks <span>(24)</span>
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input">Special offer <span>(18)</span>
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input">Free delivery <span>(15)</span>
                  </label>
                </div>
            </div> --}}
            <div class="offer_part">
              <div class="offer_maintext">
                <h5> Categories</h5>
                <i class="fa fa-angle-up" aria-hidden="true"></i>
              </div>
            </div>
            <div class="checked_part">
              @foreach($result['categories'] as $categories)
                <div class="form-check">
                  <label class="form-check-label" for="radio1">
                    <input type="radio" class="form-check-input" name="w_category" id="w_category" onclick="productByCat('{{$categories->categories_id}}')" value="{{$categories->categories_id}}" <?php echo $result['pr_categories_id']==$categories->categories_id?"checked":""; ?> >{{$categories->categories_name}} 
                    {{-- <span> (78)</span> --}}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-9"> 
          <div class="service_section-right">
            <div class="product_part"> 
              <h4> Delivering to Manchester Central </h4>
              <div class="care-slider-sec">
                <div class="marketingBannerSlider1 owl-carousel">
                    <div class="marketingBannerSliderBx item">
                      <img src="{{asset('public/web/images/food_pic1.png')}}" alt="" border="0"/>
                      <span> Offers</span>
                    </div>
                    <div class="marketingBannerSliderBx item">
                      <img src="{{asset('public/web/images/food_pic2.png')}}" alt="" border="0"/>
                      <span> Takeaways</span>
                    </div>
                    <div class="marketingBannerSliderBx item" id="active">
                      <img src="{{asset('public/web/images/food_pic3.png')}}" alt="" border="0"/>
                      <span> Grocery</span>
                    </div>
                    <div class="marketingBannerSliderBx item">
                      <img src="{{asset('public/web/images/food_pic4.png')}}" alt="" border="0"/>
                      <span> Burgers</span>
                    </div>
                    <div class="marketingBannerSliderBx item">
                      <img src="{{asset('public/web/images/food_pic5.png')}}" alt="" border="0"/>
                      <span> Chicken</span>
                    </div>                                  
                </div>
              </div>  
            </div>

            <div class="featcher_part">
              <h4> Featured</h4>
              <div class="care-slider-sec">
                <div class="marketingBannerSlider2 owl-carousel">
                  @if(!empty($result['products']))
                  @foreach($result['products'] as $products)
                  @if($products->is_feature == 1)
                  <div class="marketingBannerSliderBx item">                  
                    <div class="box1">
                      <a href="{{url('/productDetails', $products->products_id)}}"><img src="{{asset('public/'.$products->image_path)}}" alt=""></a>
                      <div class="box1_inner">                    
                        <h4> {{$products->products_name}}</h4>
                        <div class="butn_time">
                          <a href="#"> <i class="fa fa-star" aria-hidden="true"></i> 4.6 Excellant</a>
                          <span> <i class="fa fa-clock-o" aria-hidden="true"></i> 15 - 30 Min</span>
                        </div>                      
                        <p> {{$products->categories[0]->categories_name}}</p>
                        <div class="row">
                          <div class="col-md-6"> 
                            <div class="icon_part">
                              <img src="{{asset('public/web/images/location.png')}}" alt="">
                              <span> 0.4 miles away</span>
                            </div>
                          </div>
                          <div class="col-md-6"> 
                            <div class="icon_part">
                              <img src="{{asset('public/web/images/car_icon.png')}}" alt="">
                              <span> Free delivery</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  @endforeach
                  @else 
                  <p>No Products found</p>
                  @endif
                </div>
              </div>
            </div>

            <div class="food_contain">
              <h4> Only on Startfreshh</h4>
              <div class="row">

                @if(!empty($result['products']))
                @foreach($result['products'] as $products)

                <div class="col-md-4"> 
                  <div class="box1">
                    <a href="{{url('/productDetails', $products->products_id)}}"><img src="{{asset('public/'.$products->image_path)}}" alt=""></a>
                    <div class="box1_inner">                    
                      <h4> {{$products->products_name}}</h4>
                      <div class="butn_time">
                        <a href="#"> <i class="fa fa-star" aria-hidden="true"></i> 4.6 Excellant</a>
                        <span> <i class="fa fa-clock-o" aria-hidden="true"></i> 15 - 30 Min</span>
                      </div>                      
                      <p> {{$products->categories[0]->categories_name}}</p>
                      <div class="row">
                        <div class="col-md-6"> 
                          <div class="icon_part">
                            <img src="{{asset('public/web/images/location.png')}}" alt="">
                            <span> 0.4 miles away</span>
                          </div>
                        </div>
                        <div class="col-md-6"> 
                          <div class="icon_part">
                            <img src="{{asset('public/web/images/car_icon.png')}}" alt="">
                            <span> Free delivery</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                 
                  @endforeach
                  @else 
                  <p>No Products found</p>
                  @endif
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript">

    function productSearch(){
        //alert(sort_val);
        var pr_search = $('#pr_search').val();
        //alert(pr_search);
        var qUrl = ""
        var current_url = window.location.href;
        var base_url = current_url.split("?")[0];
        var hashes = current_url.split("?")[1];
        var hash = hashes.split('&');
        for (var i = 0; i < hash.length; i++) {
          params=hash[i].split("=");
          if (params[0]=='search') {
            params[1] = pr_search;
          }
          paramJoin=params.join("="); 
          qUrl = ""+qUrl+paramJoin+"&";   
        }
        if (qUrl!='') {
          qUrl = qUrl.substr(0, qUrl.length - 1);
        }
        
        var joinUrl = base_url+"?"+qUrl
        //alert("My favourite sports are: " + joinUrl);
        window.location.assign(joinUrl);
    }

    function productByCat(cat_id){
      //alert(cat_id);
      var qUrl = ""
      var current_url = window.location.href;
      var base_url = current_url.split("?")[0];
      var hashes = current_url.split("?")[1];
      var hash = hashes.split('&');
      for (var i = 0; i < hash.length; i++) {
        params=hash[i].split("=");
        if (params[0]=='category') {
          params[1] = cat_id;
        }
        paramJoin=params.join("="); 
        qUrl = ""+qUrl+paramJoin+"&";   
      }
      if (qUrl!='') {
        qUrl = qUrl.substr(0, qUrl.length - 1);
      }
      
      var joinUrl = base_url+"?"+qUrl
      //alert("My favourite sports are: " + joinUrl);
      window.location.assign(joinUrl);
  }
    
  </script>
  
@endsection
