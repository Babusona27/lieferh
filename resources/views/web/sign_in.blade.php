@extends('web.weblayout')
@section('content')

  @include('web.common.overlay')

  @include('web.common.header')

  <section class="signin_part">
        <div class="container">
            <div class="row">
                <div class="col-sm-3"> </div>
                <div class="col-sm-6"> 
                    <div class="login_inner">
                        <div class="login_inner-icon"> <img src="{{asset('public/web/images/login.png')}}" alt="Login"></div>
                        <h2> SIGN IN</h2>
                        <form action={{ URL::to("/processSignin")}} method="post">
                          @csrf
                          <input type="hidden" name="previous_url" value="{{url()->previous()}}">
                          <div class="form-group">                       
                <span class="fa fa-phone form-control-icon"></span>
                <input type="text" name="email" id="email"  class="form-control" placeholder="Enter User Name">
              </div> 
                          <div class="form-group"> 
                            <span class="fa fa-lock form-control-icon"></span>                                         
                            <input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
                          </div>
                          @if($errors->any())
                            <p class="text-light">{{$errors->first()}}</p>
                          @endif                         
                          <div class="form-group"> 
                              <button type="submit" class="btn btn-primary">Sign In Now</button>                             
                           </div>
                          </form>
                           <p class="align_center"> Forgot Password?</p>
                           <div class="form-group"> 
                             <div class="text_butn">
                              <p class="left_align"> Don't have an account? - </p>
                              <button type="submit" class="btn custom" onclick="signup()">Sign Up Now</button> 
                             </div>
                          </div> 
                        
                    </div>
                </div>
                <div class="col-sm-3"> </div>
            </div>
        </div>
    </section>

  <script type="text/javascript">
    function signup() {
       window.location.href = "{{ URL::to('/signup')}}";
    }

    function signin() {
       window.location.href = "{{ URL::to('/userOrders')}}";
    }
  </script>
  
@endsection
