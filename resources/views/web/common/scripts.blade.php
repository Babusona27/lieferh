<!-- all scripts are here -->
<script src="{{asset('public/web/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/web/js/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/web/js/owl.carousel.min.js')}}" type="text/javascript"></script>

<!-- for nav menu -->

<script>
    function openNav() {
      document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
      document.getElementById("myNav").style.width = "0%";
    }
</script>

<script>
  $(".marketingBannerSlider1").owlCarousel({
		 loop:true,
    margin:10,
    nav:true,
    dots:false,
      navText: ["<img src='{{asset('public/web/images/slider-left.png')}}'>","<img src='{{asset('public/web/images/slider-right.png')}}'>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
  });
</script>

<script>
  $(".marketingBannerSlider2").owlCarousel({
		 loop:true,
    margin:30,
    nav:true,
    dots:false,
      navText: ["<img src='{{asset('public/web/images/left_arrow.png')}}'>","<img src='{{asset('public/web/images/right_arrow.png')}}'>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
  });
</script>

<script>
	$(document).ready(function(){
	    $('.count').prop('disabled', true);
			$(document).on('click','.prplus',function(){
			$('.count').val(parseInt($('.count').val()) + 1 );
		});
    	$(document).on('click','.prminaus',function(){
			$('.count').val(parseInt($('.count').val()) - 1 );
				if ($('.count').val() == 0) {
					$('.count').val(1);
				}
	    	});
		});
</script>

