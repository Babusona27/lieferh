@extends('web.weblayout')
@section('content')

  @include('web.common.overlay')

  @include('web.common.header')

  <div class="tab_barmain">
    
    <div class="tab">
      <a href="{{ URL::to('/userOrders')}}" class="tablinks active"><i class="fa fa-cube" aria-hidden="true"></i> <span> My Orders</span></a> 
      <a href="{{ URL::to('/userAccount')}}" class="tablinks"><i class="fa fa-cog" aria-hidden="true"></i> <span>Account Setting</span></a>
      <a href="{{ URL::to('/userAddress')}}" class="tablinks"><i class="fa fa-map-marker" aria-hidden="true"></i> <span>My Address</span></a>
      <a href="{{ URL::to('/logout')}}" class="tablinks"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span></a>
      
    </div>

    <div class="tabcontent">
      <section class="product_order">

        @foreach($result as $value)

        <div class="product1">

          @foreach($value->products as $value2)
          <div class="product_order-part1">
            <div class="row">
              <div class="col-md-7"> 
                <div class="product_order-part1_inner">
                  <div class="product_order-imgpadd"><img src="{{ $value2->image }}" alt=""></div>
                  <h6><a href="#"> {{ $value2->products_name }} </a></h6>
                  <span> {{$value->orders_status}}</span>
                  <p> {{ $value2->products_quantity }} Items 
                    <!-- <a href="#" class="fa_hover"><i class="fa fa-question-circle" aria-hidden="true"></i></a> -->
                  </p>
                </div>
              </div>
              <div class="col-5"> </div>
            </div>
          </div>
          @endforeach

          <div class="product_order-price">
            <div class="row">
              <div class="pricetext"> 
                <div class="pricetext_left"> Sub Total</div>              
                <div class="pricetext_right"> ₹{{ $value->order_price }}</div>
              </div>
              <!-- <div class="pricetext"> 
                <div class="pricetext_left"> Delivery Charges</div>             
                <div class="pricetext_right"> 0.00</div>
              </div>
              <div class="pricetext"> 
                <div class="pricetext_left"> Total Tax</div>
                <div class="pricetext_right"> 0.00</div>
              </div> -->
              <div class="pricetext"> 
                <div class="pricetext_left"> <h5>Total </h5></div>               
                <div class="pricetext_right" style="color: #22b926;"> <h5>₹{{ $value->order_price }} </h5></div>
              </div>
            </div>
          </div>
          <div class="product_order-progress">
            <h6> Track Order</h6>
            <div class="progress_fullwidth">   

              @if($value->orders_status == 'Pending' || $value->orders_status == 'Process' || $value->orders_status == 'Package' || $value->orders_status == 'Delivery' || $value->orders_status == 'Delivered' || $value->orders_status == 'Cancel' || $value->orders_status == 'Return')
              <div class="using_child complete">                
                <div class="track_ordertext text-center"> Pending</div>
                <div class="progress"> 
                  <div class="progress-bar"></div>
                </div>
                <a href="#"></a>                
              </div>
              @endif
              @if($value->orders_status == 'Process' || $value->orders_status == 'Package' || $value->orders_status == 'Delivery' || $value->orders_status == 'Delivered' || $value->orders_status == 'Cancel' || $value->orders_status == 'Return')
              <div class="using_child complete">                 
                <div class="track_ordertext text-center"> Process</div>
                <div class="progress"> 
                  <div class="progress-bar"></div>
                </div>
                <a href="#"></a>                
              </div>
              @else
              <div class="using_child">                 
                <div class="track_ordertext text-center"> Process</div>
                <div class="progress"> 
                  <div class="progress-bar"></div>
                </div>
                <a href="#"></a>                
              </div>
              @endif
              @if($value->orders_status == 'Package' || $value->orders_status == 'Delivery' || $value->orders_status == 'Delivered' || $value->orders_status == 'Cancel' || $value->orders_status == 'Return')
              <div class="using_child complete">                 
                <div class="track_ordertext text-center"> Packed</div>
                <div class="progress"> 
                  <div class="progress-bar"></div>
                </div>
                <a href="#"></a>                
              </div>
              @else
              <div class="using_child">                 
                <div class="track_ordertext text-center"> Packed</div>
                <div class="progress"> 
                  <div class="progress-bar"></div>
                </div>
                <a href="#"></a>                
              </div>
              @endif
              @if($value->orders_status == 'Delivery' || $value->orders_status == 'Delivered' || $value->orders_status == 'Cancel' || $value->orders_status == 'Return')
              <div class="using_child complete">                 
                <div class="track_ordertext text-center"> Delivery</div>
                <div class="progress"> 
                  <div class="progress-bar"></div>
                </div>
                <a href="#"></a>                
              </div>
              @else
              <div class="using_child">                 
                <div class="track_ordertext text-center"> Delivery</div>
                <div class="progress"> 
                  <div class="progress-bar"></div>
                </div>
                <a href="#"></a>                
              </div>
              @endif
              @if($value->orders_status == 'Delivered' || $value->orders_status == 'Cancel' || $value->orders_status == 'Return')
              <div class="using_child complete">                 
                <div class="track_ordertext text-center"> Delivered</div>
                <div class="progress"> 
                  <div class="progress-bar"></div>
                </div>
                <a href="#"></a>                
              </div>
              @else
              <div class="using_child">                 
                <div class="track_ordertext text-center"> Delivered</div>
                <div class="progress"> 
                  <div class="progress-bar"></div>
                </div>
                <a href="#"></a>                
              </div>
              @endif

            </div>                          
          </div>
        </div>

        @endforeach
        
      </section>
    </div>

   
</div>
  
@endsection
