@extends('admin.adminLayout')
@section('content')

<style type="text/css">
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
    #map {
      /*height: 100%;
      position: absolute;
      overflow: hidden;
      width: 100%;*/
      height: 450px;
      width: 100%;
    }
    
  </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            <small>Dashboard </small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
               
        
        <!-- /.content -->
    </div>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_EBi3vEsgmF0dQq25jJQ5M_Y_aMNfaU8&callback=initMap&libraries=&v=weekly"
    defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>

    <script>
    let map;
    let directionsService;
    let directionsRenderer;
    // let branch = [
    //   ["Driver 1", 22.491527, 88.1873101],
    //   ["Driver 2", 22.4945736, 88.18574],
    // ];
    let branch = <?php echo json_encode($result['task_array']); ?>;

    let markers = [];

    // let beaches1 = [
    //   ["Budge Budge ", 22.4584301, 88.1672827, 1],
    //   ["Coogee Beach", 22.4870547, 88.3109856, 2],
    //   ["Cronulla Beach", 22.5676511, 88.3685555, 3],
    // ];

    function initMap() {

      map = new google.maps.Map(document.getElementById("map"), {

        center: { lat: branch[0][1], lng: branch[0][2] },
        zoom: 13,
      });

      for (let i = 0; i < branch.length; i++) {
        addMarker({ lat: branch[i][1], lng: branch[i][2] }, branch[i]);
      }
      // setInterval(function () {

      //   deleteMarkers();
      //   for (let i = 0; i < branch.length; i++) {
      //     addMarker({ lat: branch[i][1], lng: branch[i][2] }, branch[i]);
      //   }


      // }, 30000);
      directionsService = new google.maps.DirectionsService();
      directionsRenderer = new google.maps.DirectionsRenderer();
      google.maps.event.addListener(map, 'click', function () {
        

        deleteMarkers();
        directionsRenderer.setMap(null);
        for (let i = 0; i < branch.length; i++) {
        addMarker({ lat: branch[i][1], lng: branch[i][2] }, branch[i]);
      }

      });
    }

    // Adds a marker to the map and push to the array.
    function addMarker(location, point) {
      const image = {
        url: "<?php echo asset('public/images/driver.png'); ?>",

        // This marker is 20 pixels wide by 32 pixels high.
        // size: new google.maps.Size(20, 20),
        // The origin for this image is (0, 0).
        // origin: new google.maps.Point(0, 0),
        // The anchor for this image is the base of the flagpole at (0, 32).
        // anchor: new google.maps.Point(35, 50),
      };

      const infowindow = new google.maps.InfoWindow({
        content: "<img src="+point[5]+" alt='' width='30' height='30'><h6>"+point[0]+"</h6><h6>"+point[4]+"</h6>",
      });
      const marker = new google.maps.Marker({
        position: location,
        //  animation: google.maps.Animation.DROP,
        map: map,
        icon: image,
      });
      marker.addListener('mouseover', function() {
       infowindow.open(map, marker);
      });
      marker.addListener("click", () => {
       
        displayCustomerAddress(point)
      });

      
      markers.push(marker);
    }

    function addClientMarker(clientDetl) {
      const image = {
        url: "<?php echo asset('public/images/shop_icon.png'); ?>",

        // This marker is 20 pixels wide by 32 pixels high.
        //size: new google.maps.Size(20, 20),
        // The origin for this image is (0, 0).
        // origin: new google.maps.Point(0, 0),
        // The anchor for this image is the base of the flagpole at (0, 32).
        // anchor: new google.maps.Point(35, 50),
      };

      const infowindow = new google.maps.InfoWindow({
        content: "<h6>"+clientDetl[5]+"</h6><h6>"+clientDetl[4]+"</h6>",
      });
      const marker = new google.maps.Marker({
        position: { lat: clientDetl[1], lng: clientDetl[2] },
        //  animation: google.maps.Animation.DROP,
        map: map,
        icon: image,
      });
      
      marker.addListener("click", () => {
       
        infowindow.open(map, marker);
      });

      
      markers.push(marker);
    }

    function displayCustomerAddress(point) {

        var beaches1 = [];
        var clientDetl = [];

        $.ajax({
            type:'POST',
            async:false,
            url:'{{ url('admin/taskById') }}',
            data:{"_token": "{{ csrf_token() }}",task_id:point[3]},
            success:function(data){
              console.log(data.client_array);
              beaches1 = data.task_detail_array;
              clientDetl = data.client_array;
            }
        });

      var count=beaches1.length-1;
      var waypts = [];
      deleteMarkers();

     addClientMarker(clientDetl[0]);

      directionsRenderer.setMap(map);
      directionsRenderer.setOptions( { suppressMarkers: true } );
      for (let i = 0; i < beaches1.length; i++) {        
        addCustomerLocationWIthRoot({ lat: beaches1[i][1], lng: beaches1[i][2] }, beaches1[i]);             
      }


      for (let j = 0; j < beaches1.length-1; j++) {
           waypts.push({
              location: new google.maps.LatLng(beaches1[j][1], beaches1[j][2]),
              stopover: true,
            });
        }

      directionsService.route(
            {
              origin: new google.maps.LatLng(clientDetl[0][1], clientDetl[0][2]),
              waypoints: waypts,
              destination: new google.maps.LatLng(beaches1[count][1], beaches1[count][2]),
              travelMode: google.maps.TravelMode.DRIVING,
            },
            (response, status) => {
              if (status === "OK") {
                directionsRenderer.setDirections(response);
              } else {
                window.alert("Directions request failed due to " + status);
              }
            }
          );

      //     var request = {
      //     origin: new google.maps.LatLng(22.4584301,88.1672827),
      //     destination: oceanBeach,
      //     // Note that JavaScript allows us to access the constant
      //     // using square brackets and a string value as its
      //     // "property."
      //     travelMode: google.maps.TravelMode.DRIVING,
      // };
      // directionsService.route(request, function(response, status) {
      //   if (status == 'OK') {
      //     directionsRenderer.setDirections(response);
      //   }
      // });




    }

    function addCustomerLocationWIthRoot(location, point) {

      generateIcon(point[3], function (src) {
        const marker = new google.maps.Marker({
          position: location,
          // animation: google.maps.Animation.DROP,
          map: map,
          icon: src
        });
        markers.push(marker);

      })
    }
    function deleteMarkers() {
      clearMarkers();
      markers = [];
    }
    function clearMarkers() {
      setMapOnAll(null);
    }
    function setMapOnAll(map) {
      for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
    }



    var generateIconCache = {};

    function generateIcon(number, callback) {

      if (generateIconCache[number] !== undefined) {
        callback(generateIconCache[number]);
      }

      var fontSize = 16,
        imageWidth = imageHeight = 35;

      if (number >= 1000) {
        fontSize = 10;
        imageWidth = imageHeight = 55;
      } else if (number < 1000 && number > 100) {
        fontSize = 14;
        imageWidth = imageHeight = 45;
      }

      var svg = d3.select(document.createElement('div')).append('svg')
        .attr('viewBox', '0 0 54.4 54.4')
        .append('g')

      var circles = svg.append('circle')
        .attr('cx', '27.2')
        .attr('cy', '27.2')
        .attr('r', '21.2')
        .style('fill', 'red');

      var path = svg.append('path')
        .attr('d', 'M27.2,0C12.2,0,0,12.2,0,27.2s12.2,27.2,27.2,27.2s27.2-12.2,27.2-27.2S42.2,0,27.2,0z M6,27.2 C6,15.5,15.5,6,27.2,6s21.2,9.5,21.2,21.2c0,11.7-9.5,21.2-21.2,21.2S6,38.9,6,27.2z')
        .attr('fill', '#FFFFFF');

      var text = svg.append('text')
        .attr('dx', 27)
        .attr('dy', 32)
        .attr('text-anchor', 'middle')
        .attr('style', 'font-size:' + fontSize + 'px; fill: #FFFFFF; font-family: Arial, Verdana; font-weight: bold')
        .text(number);

      var svgNode = svg.node().parentNode.cloneNode(true),
        image = new Image();

      d3.select(svgNode).select('clippath').remove();

      var xmlSource = (new XMLSerializer()).serializeToString(svgNode);

      image.onload = (function (imageWidth, imageHeight) {
        var canvas = document.createElement('canvas'),
          context = canvas.getContext('2d'),
          dataURL;

        d3.select(canvas)
          .attr('width', imageWidth)
          .attr('height', imageHeight);

        context.drawImage(image, 0, 0, imageWidth, imageHeight);

        dataURL = canvas.toDataURL();
        generateIconCache[number] = dataURL;

        callback(dataURL);
      }).bind(this, imageWidth, imageHeight);

      image.src = 'data:image/svg+xml;base64,' + btoa(encodeURIComponent(xmlSource).replace(/%([0-9A-F]{2})/g, function (match, p1) {
        return String.fromCharCode('0x' + p1);
      }));
    }



  </script>
    
@endsection
