@extends('web.weblayout')
@section('content')

  @include('web.common.overlay')

  @include('web.common.header')

  <section class="checkout_section">
    <div class="container">
      <div class="row">
        <!-- <div class="col-sm-12 pr-0">
          <div class="alert alert-success alert-dismissable custom-success-box">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong> hjhkjlhioh </strong>
          </div>
        </div> -->

        @if ($message = Session::get('error'))
        <div class="col-sm-12 pr-0">
          <div class="alert alert-danger alert-dismissable custom-success-box">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong> {!! $message !!} </strong>
          </div>
        </div>
        <?php Session::forget('error');?>
        @endif
      </div>
      
      <div class="row">
        <div class="col-md-8">  
          <div id="checkout_wizard" class="checkout accordion left-chck145">
            <div class="checkout-step">
              <div class="checkout-card" id="headingOne">
                <span class="checkout-step-number">1</span>
                <h4 class="checkout-step-title">
                <button class="wizard-btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Delivery Address</button>
                </h4>
              </div>
              <div id="collapseOne" class="collapse in show" data-parent="#checkout_wizard">
                <div class="checkout-step-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <?php
                          $user_default_address_id='';
                          $user_default_pincode='';
                          $counter = 1;
                        ?>
                        @if(count($result['userAddress'])>0)
                        @foreach ($result['userAddress'] as $key=>$Address)
                        <?php
                          $fullAdddress = '';
                          if ($Address->flat_no!='') {
                            $fullAdddress = $fullAdddress.$Address->flat_no.", ";
                          }
                          if ($Address->entry_street_address!='') {
                            $fullAdddress = $fullAdddress.$Address->entry_street_address.", ";
                          }
                          if ($Address->area!='') {
                            $fullAdddress = $fullAdddress.$Address->area.", ";
                          }
                          if ($Address->entry_city!='') {
                            $fullAdddress = $fullAdddress.$Address->entry_city.", ";
                          }
                          if ($Address->entry_postcode!='') {
                            $fullAdddress = $fullAdddress.$Address->entry_postcode.".";
                          }                          
                          
                          if(Session::has('user_default_address')){
                            $user_default_address = Session::get('user_default_address');
                            $user_default_address_id = $user_default_address->address_book_id;
                            $user_default_pincode=$user_default_address->entry_postcode;
                          }
                        ?>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" id="address_<?php echo $counter; ?>" name="shipping" type="radio" <?php if($user_default_address_id==$Address->address_book_id){echo "checked";} ?> value="<?php echo $Address->address_book_id; ?>" onclick="selectDefaultAddress('<?php echo $Address->address_book_id; ?>')">
                          <label class="custom-control-label text-body" for="address_<?php echo $counter; ?>">#<?php echo $fullAdddress; ?></label>
                        </div>
                        <?php $counter++; ?>
                        @endforeach
                        @endif
                        
                      </div>
                    </div>
                  </div>
                  <p class="phn145"> <a class="" data-toggle="collapse" href="#edit-number"><span>Ship to a different address?</span></a></p>

                  <div class="collapse" id="edit-number">
                    <div class="row">
                      <div class="col-lg-12">
                        <form class="" method="post" action="{{url('/addUserAddress')}}">
                          @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="email1">Flat / House / Office No.*</label>
                              <input type="text" class="form-control" id="flat_no" name="flat_no" aria-describedby="emailHelp" placeholder="Address" required="">
                              
                            </div>
                            <div class="form-group">
                              <label for="password1">Street / Society / Office Name*</label>
                              <input type="text" class="form-control" id="street" name="street" placeholder="Street Address" required="">
                            </div>
                            <div class="form-group form-row">
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Pincode*</label>
                            <input id="pincode" name="pincode" type="text" placeholder="Pincode" class="form-control input-md" required="" value="<?php echo $result['user_pincode']; ?>" readonly >
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">Locality*</label>
                            <input type="text" class="form-control" id="area" name="area" placeholder="Enter City" required="">
                          </div>
                        </div>
                            <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="default_address" name="default_address" value="1">
                          <label class="form-check-label" for="inlineCheckbox1">Default Address</label>
                        </div>
                        <div class="butn_checkout-save">
                          <button class="save-btn14 hover-btn" type="submit" >Save</button>
                        </div>
                          </div>
            
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="butn_checkout">
                    <a href="#"> Next</a>
                  </div>

                </div>
              </div>
            </div>
                    
            <div class="checkout-step">
              <div class="checkout-card" id="headingFour">
                <span class="checkout-step-number">2</span>
                <h4 class="checkout-step-title">
                <button class="wizard-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Payment</button>
                </h4>
              </div>
              <div id="collapseFour" class="collapse address2" aria-labelledby="headingFour" data-parent="#checkout_wizard">                       
                <div class="form-check form-check-inline">                    
                  <input TYPE="radio" class="form-check-input" NAME="RadioGroupName" ID="GroupName1" ONCLICK="ShowRadioButtonDiv('GroupName', 3)" checked>
                  <label for="GroupName1" class="form-check-label"> Case on Delivery</label>
                  <INPUT TYPE="radio" class="form-check-input" NAME="RadioGroupName" ID="GroupName2" ONCLICK="ShowRadioButtonDiv('GroupName', 3)"/>
                  <label for="GroupName2" class="form-check-label"> Online Payment</label>
                </div>
                <div class="group_padd" ID="GroupName1Div" STYLE="display:block;">
                  <p class="delevery"> Cash On Delivery</p>
                  <div class="butn_checkout2">
                    <a href="javascript:void(0);" onclick="orderCashOnDelivery()" > Place Order</a>
                  </div>

                  <div class="alert alert-danger alert-block" id="order_error_div" style="margin-top: 10px;display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong id="order_error_msg"></strong>
                  </div>

                </div>
                <div class="group_padd" ID="GroupName2Div" STYLE="display:none;">
                  <p class="delevery"> Online Payment</p>

                  <?php $subTotal = 0; ?>
                  @foreach ($result['cartList'] as $key=>$cartData)
                  <?php 
                    $totalPrice = $cartData->final_price*$cartData->customers_basket_quantity; 
                    $subTotal = $subTotal+$totalPrice;
                  ?>
                  @endforeach

                  <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{{ URL::to("paypal")}}" >
                    {{ csrf_field() }}

                    <input id="amount" type="hidden" class="form-control" name="amount" value="<?php echo $subTotal;?>">

                    <input id="CUSTOM" type="hidden" class="form-control" name="CUSTOM" value="<?php echo $subTotal;?>">

                    <input type="hidden" name="address_id_hidden" value="<?php echo $user_default_address_id; ?>" id="address_id_hidden" >
                    <input type="hidden" name="pincode_hidden" value="<?php echo $user_default_pincode; ?>" id="pincode_hidden" >
                    <input type="hidden" name="finalOrderTotal" id="finalOrderTotal" value="<?php echo $subTotal;?>">

                    @if ($errors->has('amount'))
                      <span class="help-block">
                          <strong>{{ $errors->first('amount') }}</strong>
                      </span>
                    @endif

                    <div class="butn_checkout2">
                      <button type="submit" >Place Order</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>

          <!-- <button id="expand" name="expand">Show The Div</button> -->
          
        </div>
        <div class="col-md-4 p-0"> 
          <div class="ckeckout_rightcon">
            <h5> Order Summary</h5>

            @if(count($result['cartList'])>0)

            @foreach ($result['cartList'] as $key=>$cartData)

            <div class="product_order-part1_inner">
              <div class="product_order-imgpadd"><img src="{{asset('public/'.$cartData->image_path)}}" alt=""></div>
              <h6> {{ $cartData->products_name }}</h6>
              <p><span class="price1"> ₹{{ $cartData->final_price }}</span> &nbsp;&nbsp; 
                <!-- <span class="price2"> ₹65.00</span></p> -->
              <p class="text_chng"> Quantity : {{ $cartData->customers_basket_quantity }}</p>
            </div>

            @endforeach

            <div class="product_order-price">
              <div class="row">

                <?php $subTotal = 0; ?>
                @foreach ($result['cartList'] as $key=>$cartData)
                <?php 
                  $totalPrice = $cartData->final_price*$cartData->customers_basket_quantity; 
                  $subTotal = $subTotal+$totalPrice;
                ?>
                <div class="pricetext"> 
                  <div class="pricetext_left">{{ $cartData->products_name }}</div>             
                  <div class="pricetext_right"> ₹{{$totalPrice}}</div>
                </div>
                @endforeach
                <!-- <div class="pricetext"> 
                  <div class="pricetext_left"> Total Saving</div>             
                  <div class="pricetext_right"> ₹10</div>
                </div> -->
                
                <div class="pricetext"> 
                  <div class="pricetext_left"> <h5>Total </h5></div>               
                  <div class="pricetext_right" style="color: #22b926;"> <h5> ₹{{$subTotal}}</h5></div>
                </div>
              </div>
            </div>

            @else
            <div>
                <img src="{{ asset('public/images/empty_cart.png') }}" alt="" style="width: 90%; text-align: center;">
            </div>
            @endif

            <div class="secure">
              <i class="fa fa-lock" aria-hidden="true"></i> &nbsp;
              <span> Secure checkout</span>             
            </div>            
            
          </div>
        </div>

        

      </div>
    </div>
  </section>

  <SCRIPT>
    function ShowRadioButtonDiv (IdBaseName, NumberOfButtons) {
        for (x=1;x<=NumberOfButtons;x++) {
            CheckThisButton = IdBaseName + x;
            ThisDiv = IdBaseName + x +'Div';
        if (document.getElementById(CheckThisButton).checked) {
            document.getElementById(ThisDiv).style.display = "block";
            }
        else {
            document.getElementById(ThisDiv).style.display = "none";
            }
        }
        return false;
    }

    function selectDefaultAddress(address_book_id){
      $.ajax({

        type:'POST',
        url:'{{ url('/session_address') }}',
        data:{address_book_id:address_book_id,"_token": "{{ csrf_token() }}"},
        success:function(data){
          console.log(data.userAddress);
          $('#address_id_hidden').val(data.userAddress.address_book_id);
          $('#pincode_hidden').val(data.userAddress.entry_postcode);
          
        }

      });
    }

    function orderCashOnDelivery(){
      //alert('couponCode');
      var pincode_session = '<?php echo $result['user_pincode']; ?>';
      var pincode_hidden = $( "#pincode_hidden" ).val();
      var products_price = $('#finalOrderTotal').val();
      var payment_method = 'cash_on_delivery';
      var address_book_id = $( "#address_id_hidden" ).val();
      
      if (address_book_id=='') {
        $('#order_error_div').css('display','block');
        $('#order_error_msg').html('Please select delivery address.');
        return false;
      }else if (pincode_session!=pincode_hidden) {
        $('#order_error_div').css('display','block');
        $('#order_error_msg').html('Pincode not match.');
        return false;
      }else if (products_price==''||products_price==0) {
        $('#order_error_div').css('display','block');
        $('#order_error_msg').html('Order price can not be 0.');
        return false;
      }else{
        $('#order_error_div').css('display','none');
        //alert('orederjvbhbjh');
        $.ajax({

          type:'POST',
          url:'{{ url('/cashOnDeliveryOrder') }}',
          data:{pincode_val:pincode_hidden,products_price:products_price,payment_method:payment_method,address_book_id:address_book_id,"_token": "{{ csrf_token() }}"},
          success:function(data){
            console.log(data.returnData.out_of_stock);
            if (data.returnData.isLogin=='no') {
              window.location.href = "<?php echo url('/signin'); ?>";
            }else{
              if (data.returnData.status==true) {
                window.location.href = "<?php echo url('/userOrders'); ?>";
              }else{
                if (data.returnData.out_of_stock=='Yes') {
                  $('#order_error_div').css('display','block');
                  $('#order_error_msg').html("<b>"+data.returnData.out_of_stock_product.products_name+"</b> is out of stock.");
                }
                if (data.returnData.out_of_stock=='no') {
                  $('#order_error_div').css('display','block');
                  $('#order_error_msg').html(data.returnData.massage);
                }
              }
              
            }
          }

        });
      }      

    }


  </SCRIPT>

  <script type="text/javascript">
    $(window).scroll(function () {
      if($(window).scrollTop() > 50) {
        $("#head").addClass('sticky');
      } else {
        $("#head").removeClass('sticky');
      }
    });
  </script>
  
@endsection
