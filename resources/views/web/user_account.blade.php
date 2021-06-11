@extends('web.weblayout')
@section('content')

  @include('web.common.overlay')

  @include('web.common.header')
  @php
  $user = Session::get('user');
  @endphp
  <div class="tab_barmain">
    
    <div class="tab">
      <a href="{{ URL::to('/userOrders')}}" class="tablinks"><i class="fa fa-cube" aria-hidden="true"></i> <span> My Orders</span></a> 
      <a href="{{ URL::to('/userAccount')}}" class="tablinks active"><i class="fa fa-cog" aria-hidden="true"></i> <span>Account Setting</span></a>
      <a href="{{ URL::to('/userAddress')}}" class="tablinks"><i class="fa fa-map-marker" aria-hidden="true"></i> <span>My Address</span></a>
      <a href="{{ URL::to('/logout')}}" class="tablinks"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span></a>
      
    </div>

    <div class="tabcontent">
    <section class="account">
          <div class="container">
              <div class="row">               
                  <div class="col-12"> 
                      <div class="account_inner">                       
                          <h2> Account Setting</h2>
                          @if($errors->any())
                          <p class="text-danger">{{$errors->first()}}</p>
                          @endif
                          <form action={{ URL::to("/updateUserAccount")}} method="post">
                            @csrf
                            <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="NAME">Name*</label>
                      <input type="text" class="form-control" name="name" value="{{ $user[0]->name }}"> 
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Phone Number *</label>
                      <input type="text" class="form-control" name="user_phone" value="{{ $user[0]->user_phone }}"> 
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email *</label>
                      <input type="text" class="form-control" name="email" value="{{ $user[0]->email }}"> 
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Current Password *</label>
                      <input type="text" class="form-control" name="current_password" placeholder="Current Password *"> 
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">New Password *</label>
                      <input type="text" class="form-control" name="new_password" placeholder="New Password *"> 
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                          </form>
                      </div>
                  </div>              
              </div>
          </div>
      </section>
    </div>

   
</div>
  
@endsection
