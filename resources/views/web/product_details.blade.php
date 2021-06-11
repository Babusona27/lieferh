@extends('web.weblayout')
@section('content')

  @include('web.common.overlay')

  @include('web.common.header')

  <section class="product_details">
    <div class="container">
      <div class="row">
        <div class="col-md-6"> 
          <div class="product_pic"> 
            <img src="{{asset('public').'/'.$result['detail']['product_data'][0]->image_path}}" alt="">
            <!-- <div class="cart_icon">
                          <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div> -->
           </div>
        </div>
        <div class="col-md-6"> 
          <div class="product_text">
            <h2> {{$result['detail']['product_data'][0]->products_name}}</h2>
            <a href="#"> <i class="fa fa-star" aria-hidden="true"></i> 4.6 Excellant</a>
            <span> <i class="fa fa-clock-o" aria-hidden="true"></i> 15 - 30 Min</span>
            <div> <?php echo stripslashes($result['detail']['product_data'][0]->products_description); ?> </div>
            <div class="price">
              <span class="price_now"> Price ₹{{$result['detail']['product_data'][0]->products_price}}</span>
              <!-- <span class="price_previous"> MRP Price $265.00</span> -->
            </div>

            <div class="qty mt-4">
                          <span class="minus prminaus bg-dark">-</span>
                          <input type="number" class="count" name="qty" value="1">
                          <span class="plus prplus bg-dark">+</span>
                          <!-- <div class="cart_icon">
                            <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                          </div> -->
                      </div>

                      <?php if(Session::has('user')){ ?>

                        <form action="{{url('/addToCart')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                          <input type="hidden" name="products_id" value="{{ $result['detail']['product_data'][0]->products_id }}" >
                          <input type="hidden" name="cartQuantity" value="1" id="cartQuantity" >

                          <div class="button"> 
                            <button type="submit" > Add to Cart</button>
                          </div>

                        </form>

                      <?php }else{ ?>
                        <div class="button"> 
                          <button onclick="checkLogin()" > Add to Cart</button>
                        </div>
                      <?php } ?>


          </div>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript">
    function checkLogin() {
       window.location.href = "{{ URL::to('/signin')}}";
    }
  </script>
  
@endsection
