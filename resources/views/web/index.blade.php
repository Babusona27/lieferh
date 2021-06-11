@extends('web.weblayout')
@section('content')

  @include('web.common.overlay')

  <style>
/** {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
}
*/
/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  top: 32px;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>

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

  <section class="header">
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

    <div class="bnr_text">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 p-0"> 
            <div class="bnr_innertext">
              
              <h4> #startfreshhdeliver</h4>
              <h2> Now Fresh Food delivered to your Doorstep</h2>
              <p> Lorem ipsum dolor sit amet, consectetur adipiscing</p>
              
              <form class="form-inline my-2 my-lg-0" action="{{ URL::to('/products')}}">
                <div class="from_leftbg">
                  <label for="pincode">Enter your postcode</label>

                  <div class="loc-nput autocomplete">
                    <input type="text" class="form-control main" name="pincode" aria-describedby="emailHelp" autocomplete="off" id="myInput"> 
                  </div>

                  <input type="hidden" name="search">
                  <input type="hidden" name="category">
                  
                </div>
                <button class="btn btn-outline-success my-2 my-sm-0">Find a store</button>
              </form>
              @if($errors->any())
                <span>{{$errors->first()}}</span>
              @endif
              
            </div>
          </div>
          <div class="col-sm-6"> </div>
        </div>
      </div>
    </div>
  </section>

  <section class="food_section">
    <div class="container">
      <h2> What's on the menu?</h2>
      
      <div class="row">
        <div class="col-sm-5"> 
          <div class="food_contain_left">
            <div class="food_contain_left-forhov">
              <h4> Lorem ipsum dolor </h4>
              <h6> Lorem ipsum dolor </h6>
              <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod </p>
              <a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
        <div class="col-sm-7">
          <div class="food_contain_right"> 
            <div class="food_contain_rightinner bg1">
              
              <h4> Lorem ipsum </h4>
              <h6> Lorem ipsum dolor </h6>
              <div class="cotain_align_change">           
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p> 
                <a href="#"><span> <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>  
              </div>
              
              
            </div>
            <div class="food_contain_rightinner bg2">
              <h4> Lorem ipsum dolor </h4>  
              <div class="cotain_align_change">           
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p> 
                <a href="#"><span> <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>  
              </div>        
            </div>
          </div>
        </div>  

        <div class="col-sm-6"> 
          <div class="lastcontain left">
            <h4> Lorem ipsum dolor </h4>  
            <div class="cotain_align_change">           
              <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p> 
              <a href="#"><span> <i class="fa fa-angle-right" aria-hidden="true"></i></span>  </a>
            </div>  
          </div>
        </div>
        <div class="col-sm-6"> 
          <div class="lastcontain right">
            <h4> Lorem ipsum dolor </h4>  
            <div class="cotain_align_change">           
              <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p> 
              <a href="#"><span> <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>  
            </div>
          </div>
        </div>      
      </div>
    </div>
  </section>

  <section class="delevered_section">
    <div class="container">
      <h2> Loved by you, delivered by us</h2>
      <div class="row">
        <div class="col-sm-4"> 
          <div class="delevered1">
            <div class="use_padd-delevered">
              <p> Lorem ipsum dolor</p>
            </div>
          </div>
        </div>
        <div class="col-sm-4"> 
          <div class="delevered2">
            <div class="use_padd-delevered">
              <p> Lorem ipsum dolor</p>
            </div>
          </div>
        </div>
        <div class="col-sm-4"> 
          <div class="delevered3">
            <div class="use_padd-delevered">
              <p> Lorem ipsum dolor</p>
            </div>
          </div>
        </div>
        <div class="col-sm-4"> 
          <div class="delevered1">
            <div class="use_padd-delevered">
              <p> Lorem ipsum dolor</p>
            </div>
          </div>
        </div>
        <div class="col-sm-4"> 
          <div class="delevered2">
            <div class="use_padd-delevered">
              <p> Lorem ipsum dolor</p>
            </div>
          </div>
        </div>
        <div class="col-sm-4"> 
          <div class="delevered3">
            <div class="use_padd-delevered">
              <p> Lorem ipsum dolor</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="Fresh_section">
    <div class="container">
      <h2> Work with Start Freshh</h2>
      <div class="row">
        <div class="col-sm-6"> 
          <div class="fresh_maincotain">
            <img src="{{asset('public/web/images/fresh_p1.png')}}" alt="">
            <div class="Fresh_section-innercontain">
              <h6> Riders</h6>
              <p> Become a rider and enjoy the freedom to fit work around your life. Plus great fees, perks and discounts.</p>
              <a href="#"> Ride with us</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6"> 
          <div class="fresh_maincotain">
            <img src="{{asset('public/web/images/fresh_p2.png')}}" alt="">
            <div class="Fresh_section-innercontain">
              <h6> Restaurants</h6>
              <p> Become a rider and enjoy the freedom to fit work around your life. Plus great fees, perks and discounts.</p>
              <a href="#"> partner with us</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <script>
  function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
  }

  /*An array containing all the country names in the world:*/
  var allPincodes = <?php echo json_encode($pincodeResult); ?>;

  /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
  autocomplete(document.getElementById("myInput"), allPincodes);

 
</script>
  
@endsection
