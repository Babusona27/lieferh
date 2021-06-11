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
      <a href="{{ URL::to('/userAccount')}}" class="tablinks"><i class="fa fa-cog" aria-hidden="true"></i> <span>Account Setting</span></a>
      <a href="{{ URL::to('/userAddress')}}" class="tablinks active"><i class="fa fa-map-marker" aria-hidden="true"></i> <span>My Address</span></a>
      <a href="{{ URL::to('/logout')}}" class="tablinks"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span></a>
      
    </div>

    <div id="Address" class="tabcontent">
      <div class="tab_innertext">
        <h2> My Address</h2>
        @if($errors->any())
          <p class="text-danger">{{$errors->first()}}</p>
        @endif
        <div class="new_tabbutn">
          <button class="btn hover" data-toggle="modal" data-target="#form">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Address
          </button>
        </div>

        @foreach($result['address_list'] as $address_list)
        <div class="row">
          <div class="col-1"> 
            <div class="Address_icon">
              <i class="fa fa-home" aria-hidden="true"></i>
            </div>
          </div>
          <!-- <div class="col-3"> 
            <h5> Home</h5>
          </div> -->
          <div class="col-8"> 
            <p> {{ $address_list->flat_no}} , {{$address_list->entry_street_address}},{{$address_list->area}},{{$address_list->entry_postcode}}</p>
          </div>
          <div class="col-3"> 
            <p>
              <a data-toggle="modal" data-target="#edit{{$address_list->address_book_id}}">
                <i class="fa fa-pencil" aria-hidden="true" ></i>
              </a>
               &nbsp;
               <a href="{{ URL::to("/deleteaddress?address_book_id=$address_list->address_book_id")}}">
                <i class="fa fa-trash" aria-hidden="true"></i>
               </a>
            </p>
          </div>
        </div>
        <br>
        @endforeach

      </div>
    </div>

   
</div>


<!-- The Modal -->
   <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel"> Add New Address</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{ URL::to("/addUserAddress")}} method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="flat_no">Flat / House / Office No.*</label>
              <input type="text" class="form-control" id="flat_no" name="flat_no" aria-describedby="emailHelp" placeholder="Address">
              
            </div>
            <div class="form-group">
              <label for="street">Street / Society / Office Name*</label>
              <input type="text" class="form-control" id="street" name="street" placeholder="Street Address">
            </div>
            <div class="form-group form-row">
          <div class="form-group col-md-6">
            <label for="pincode">Pincode*</label>
            <select id="pincode" name="pincode" class="form-control">
              <option selected> Select Pincode</option>
              @foreach($result['pincodes'] as $pincodes)
              <option value="{{$pincodes->pincodes_val}}">{{$pincodes->pincodes_val}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="area">Locality*</label>
            <input type="text" class="form-control" id="area" name="area" placeholder="Enter City">
          </div>
        </div>
            <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="default_address" name="default_address" value="1">
          <label class="form-check-label" for="default_address">Default Address</label>
        </div>
          </div>
          <div class="modal-footer border-top-0 d-flex justify-content-start">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- The Modal -->
  @foreach($result['address_list'] as $address_list)
  <div class="modal fade" id="edit{{$address_list->address_book_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel"> Edit Address</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{ URL::to("/updateaddress")}} method="post">
          @csrf
          <input type="hidden" name="address_book_id" value="{{ $address_list->address_book_id}}">
          <div class="modal-body">
            <div class="form-group">
              <label for="flat_no">Flat / House / Office No.*</label>
              <input type="text" class="form-control" id="flat_no" name="flat_no" aria-describedby="emailHelp" placeholder="Address" value="{{ $address_list->flat_no}}">
              
            </div>
            <div class="form-group">
              <label for="street">Street / Society / Office Name*</label>
              <input type="text" class="form-control" id="street" name="street" placeholder="Street Address" value="{{$address_list->entry_street_address}}">
            </div>
            <div class="form-group form-row">
          <div class="form-group col-md-6">
            <label for="pincode">Pincode*</label>
            <select id="pincode" name="pincode" class="form-control" value="{{$address_list->entry_postcode}}">
              @foreach($result['pincodes'] as $pincodes)
              <option value="{{$pincodes->pincodes_val}}" <?php echo ($pincodes->pincodes_val == $address_list->entry_postcode) ? 'selected' : '';?> >{{$pincodes->pincodes_val}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="area">Locality*</label>
            <input type="text" class="form-control" id="area" name="area" placeholder="Enter City"  value="{{$address_list->area}}">
          </div>
        </div>
            <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="default_address" name="default_address" value="1" <?php if ($user[0]->default_address_id == $address_list->address_book_id) { echo 'checked="checked"'; } ?> >
          <label class="form-check-label" for="default_address">Default Address</label>
        </div>
          </div>
          <div class="modal-footer border-top-0 d-flex justify-content-start">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
  @endforeach

  
@endsection
