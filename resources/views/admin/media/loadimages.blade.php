
            @if(isset($allimage))
            <!-- <select class="image-picker show-html " name="image_id" id="select_img"> -->
                <option value=""></option>
                @foreach($allimage as $key=>$image)
                  <option data-img-src="{{asset('public').'/'.$image->images_path}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->images_id}}"> {{$image->images_id}} </option>
                @endforeach
            <!-- </select> -->
            @endif
