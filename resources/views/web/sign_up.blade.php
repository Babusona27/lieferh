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
                    <h2> SIGN UP</h2>
                    <form action={{ URL::to("/signupProcess")}} method="post">
                      @csrf
                      <div class="form-group">                       
            <span class="fa fa-user-o form-control-icon"></span>
            <input type="text" name="name" id="name" class="form-control" placeholder="Full Name">
          </div> 
                      <div class="form-group">                       
            <span class="fa fa-envelope-o form-control-icon"></span>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email Address">
          </div> 
                      <div class="form-group">                       
            <span class="fa fa-phone form-control-icon"></span>
            <input type="text" name="user_phone" id="user_phone" class="form-control" placeholder="Phone Number">
          </div> 
                      <div class="form-group"> 
                        <span class="fa fa-lock form-control-icon"></span>                                         
                        <input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="New Password">
                      </div>
                      @if($errors->any())
                      <p class="text-light">{{$errors->first()}}</p>
                      @endif                        
                      <div class="form-group"> 
                          <button type="submit" class="btn btn-primary">Sign Up Now</button>                             
                       </div>
                       <!-- <a class="align_center" href="#"> Forgot Password?</a> -->
                      </form>
                       <div class="form-group"> 
                         <div class="text_butn">
                          <p class="left_align"> Have an account? - </p>
                          <button type="button" class="btn custom" onclick="signup()" >Sign In Now</button> 
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
       window.location.href = "{{ URL::to('/signin')}}";
    }
  </script>
  
@endsection
