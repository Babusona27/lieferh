@extends('web.weblayout')
@section('content')

  @include('web.common.overlay')

  @include('web.common.header')

  <section class="cart_inner">
    <div class="container">
      <h2> All Items</h2>
      <div class="cart_inner-product">

        @if(count($result['cartList'])>0)
        
        <div class="cart_product-main change_bg">
          <div class="row">
            <div class="col-2 p-0">             
            </div>
            <div class="col-2 p-0"> 
              <h4> PRODUCT</h4>           
            </div>
            <div class="col-2 p-0"> 
              <h4> PRICE</h4>           
            </div>
            <div class="col-2 p-0"> 
              <h4> QUANTITY</h4>
            </div>
            <div class="col-2 p-0"> 
              <h4> TOTAL</h4>
            </div>
            <div class="col-2 p-0"> 
              
            </div>
          </div>
        </div>

        <?php $subTotal = 0; ?>
        @foreach ($result['cartList'] as $key=>$cartData)
        <?php 
          $totalPrice = $cartData->final_price*$cartData->customers_basket_quantity; 
          $subTotal = $subTotal+$totalPrice;
        ?>

        <div class="cart_product-main">
          <div class="row">
            <div class="col-2 p-0">
              <div class="pic_part"> 
                <img src="{{asset('public/'.$cartData->image_path)}}" alt="">
              </div>            
            </div>
            <div class="col-2 p-0"> 
              <p> {{ $cartData->products_name }}</p>         
            </div>
            <div class="col-2 p-0">
              <p> ₹{{ $cartData->final_price }}</p>           
            </div>
            <div class="col-2 p-0"> 
              <div class="qty">
                  <span class="minus bg-dark" onclick="prMinus('<?php echo $cartData->customers_basket_id; ?>')" >-</span>
                  <input type="number" class="count tCount_<?php echo $cartData->customers_basket_id; ?>" name="qty" value="{{ $cartData->customers_basket_quantity }}">
                  <span class="plus bg-dark" onclick="prPlus('<?php echo $cartData->customers_basket_id; ?>')" >+</span>                  
              </div>
            </div>
            <div class="col-2 p-0"> 
              <p> ₹{{$totalPrice}}</p>
            </div>
            <div class="col-2 p-0"> 
              <div class="socil_icon"> 
                <a href="javascript:void(0);" onclick="deleteItem('<?php echo $cartData->customers_basket_id; ?>')" ><i class="fa fa-trash" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
        </div>

        @endforeach

        
        <div class="blog_last">
          <div class="row">
            <div class="col-6"> </div>
            <div class="col-6"> 
              <div class="checkout_part">
                <h4> Cart Totals</h4>
                <div class="total_sec">
                  <div class="last_price">
                    <!-- <p class="align_left"> SUBTOTAL</p> -->
                    <p class="align_left"> TOTAL</p>                    
                  </div>
                  <div class="last_price2">
                    <!-- <p class="align_right"> ₹358.00</p> -->
                    <p class="align_right"> <strong> ₹<span>{{$subTotal}}</span></strong></p>
                  </div>
                </div>
                <div class="checkout">
                  <a href="{{url('/checkout')}}" class="btn btn-primary mb-2">CHECKOUT</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        @else
        <div>
            <img src="{{ asset('public/images/empty_cart.png') }}" alt="" style="width: 90%; text-align: center;">
        </div>
        @endif
        
      </div>
    </div>
  </section>

  <script type="text/javascript">

    function prMinus(customers_basket_id) {
      //alert(pr_id);
      var total_count = parseInt($('.tCount_'+customers_basket_id).val());
      //alert(total_count);
      if (total_count>1) {
        var cnt = total_count-1;
        $.ajax({

          type:'POST',
          url:'{{ url('cartQuantityEdit') }}',
          data:{"_token": "{{ csrf_token() }}",customers_basket_id:customers_basket_id,cnt:cnt},
          success:function(data){
            location.reload(); 
          }

        });
      }
      
    }

    function prPlus(customers_basket_id) {
      //alert(pr_id);
      var total_count = parseInt($('.tCount_'+customers_basket_id).val());
      var cnt = total_count+1;

      $.ajax({

        type:'POST',
        url:'{{ url('cartQuantityEdit') }}',
        data:{"_token": "{{ csrf_token() }}",customers_basket_id:customers_basket_id,cnt:cnt},
        success:function(data){
          location.reload(); 
        }

      });
      
    }

    function deleteItem(customers_basket_id) {
      if (confirm("Do you want to delete this item?")) {
        $.ajax({

          type:'POST',
          url:'{{ url('cartItemDelete') }}',
          data:{"_token": "{{ csrf_token() }}",customers_basket_id:customers_basket_id},
          success:function(data){
            location.reload(); 
          }

        });
      }
      return false;
    }
    
  </script>
  
@endsection
