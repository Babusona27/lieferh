<section class="header_detailssec">
    <div class="header_detailssec-cotainer">
      <div class="row">
        <div class="col-sm-6 header_details-innerleft">
           Call us : +1(800) 2545-7895 <span> 7 days a week form 9.00am to 7.00 pm</span>
        </div>
        <div class="col-sm-6 header_details-innerright">
          @if(Session::has('user'))
          <div class="cart_part">
              <a href="{{ URL::to('/cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span> 0</span></a>
          </div>
          <div class="cart_part">
            <a href="{{ URL::to('/logout')}}"><i class="fa fa-sign-in" aria-hidden="true"></i><span> logout</span></a>
          </div>
          @else 
          <div class="cart_part">
            <a href="{{ URL::to('/signin')}}"><i class="fa fa-sign-in" aria-hidden="true"></i><span> Login</span></a>
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>  


<section class="restaurants_header">
  <div class="menu">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="{{ URL::to('/')}}">
        <img src="{{asset('public/web/images/logo.png')}}" alt="logo">
      </a>
      <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"> </span>
      </button>-->
      <div class="navbar-collapse">
        <div class="nav_fontasem">
          <p>
            <i class="fa fa-facebook" aria-hidden="true"></i>
            <i class="fa fa-twitter" aria-hidden="true"></i>
            <i class="fa fa-instagram" aria-hidden="true"></i>
          </p>
        </div>
        <div class="nav_textcontain">           
          <h2> Become a Rider</h2>
          <span> FAQ</span>           
        </div>
        <a href="#" class="btn nav_btn1">Add your Shop</a>
        @if(Session::has('user'))
              @php
                  $user = Session::get('user');
              @endphp
              <a href="{{ URL::to('/userAccount')}}" class="btn nav_btn2">{{ $user[0]->name }}</a> 
          @else 
              <a href="{{ URL::to('/signin')}}" class="btn nav_btn2">Sign in</a>
          @endif        
        <div class="nabbar_icon"> <img src="{{asset('public/web/images/nabbar_icon.png')}}" onclick="openNav()" alt=""> </div>          
      </div>                        
    </nav>
  </div>
</section>