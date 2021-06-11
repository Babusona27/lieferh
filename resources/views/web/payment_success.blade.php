@extends('web.weblayout')
@section('content')

  @include('web.common.overlay')

  @include('web.common.header')

  <section class="pay_success_section">
    <div class="container">
      <div class="row">

        @if ($paymentResponseData = Session::get('paymentResponseData'))
        <?php $returnData = $paymentResponseData; ?>
        <?php Session::forget('paymentResponseData');?>
        @endif

       <div class="pay_success">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="pay_success_inner"> 
                    <img src="{{asset('public/web/images/Payment_succes.png')}}" alt="">
                    <h4> Thank You</h4>
                    <p> Your order is succesfully submitted.</p>
                    <p> Payment id : {{$returnData['paymentId']}}</p>
                    <a href="{{ URL::to('/userOrders')}}"> OK</a>
                </div>
              </div>
            </div>
          </div>
       </div>



      </div>
    </div>
  </section>

  
@endsection
