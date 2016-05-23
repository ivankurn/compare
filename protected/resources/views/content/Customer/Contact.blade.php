@extends('layouts.content.app')

@section('page-level-styles')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
@endsection

@section('page-level-plugins-atas')
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-level-plugins-bawah')
<script src="{{ asset('assets/Metronic/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@endsection

@section('page-level-scripts')
<script src="{{ URL::asset('assets/Metronic/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/Metronic/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $('#kotanyastore').hide();

        $("#provinsi_store").change(function(){
            var prov = $("#provinsi_store").val();
           
            var arr = prov.split("|");
            var id_prov = arr[0];
            
            $.ajax({
                type: "POST",
                url : "<?php echo url('provinsikota')?>",
                data: "id_provinsi="+id_prov,
                success: function(data){
                    $('#kotanyastore').show();
                    $('#coeg').html(data);
                }
            });
            
        });

        $('body').on('DOMNodeInserted', 'select', function () {
            $(this).select2();
        });
    });
    
</script>
<script>    
var map;

var markers = [];

function initialize() {
  var haightAshbury = new google.maps.LatLng(-7.7972,110.3688);
  var marker = new google.maps.Marker({
  position:new google.maps.LatLng(-7.7972,110.3688),
  map: map,
  anchorPoint: new google.maps.Point(0, -29)
  });

    var mapOptions = {
        zoom: 12,
        center: haightAshbury,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var infowindow = new google.maps.InfoWindow({
        content: '<p>Marker Location:</p>'
    });

map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions); 
  
var input = /** @type  {HTMLInputElement} */(
    document.getElementById('pac-input'));

    var types = document.getElementById('type-selector');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
    deleteMarkers();
    infowindow.close();
    marker.setVisible(true);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
        return;
    }

  // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
    } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
    }
        addMarker(place.geometry.location);
    });

    google.maps.event.addListener(map, 'click', function(event) {

    deleteMarkers();
    addMarker(event.latLng);
    marker.openInfoWindowHtml(latLng);
    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
});

  // Adds a marker at the center of the map.
  addMarker(haightAshbury);

}

function placeMarker(location) {
    marker = new google.maps.Marker({
      position: location,
      map: map,
    });

    markers.push(marker);

    infowindow = new google.maps.InfoWindow({
       content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
    });
    infowindow.open(map,marker);
}

// Add a marker to the map and push to the array.

function addMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  
  $('#lat').val(location.lat());
  $('#lng').val(location.lng());
  markers.push(marker);
}

// Sets the map on all markers in the array.

function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

</script>

@endsection

@section('body')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>Success!</strong>  {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        <strong>Warning!</strong> Something wrong. {{ session('error') }} </div>
    @endif

    <div class="row">
        <div class="col-md-12 ">
		
			@if(isset($success))
				 <div class="alert alert-success"><strong>Success!</strong>  {{$success}}</div>
			@endif
			@if(isset($error))
				 <div class="alert alert-success"><strong>Error!</strong>  {{$error}}</div>
			@endif
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light portlet-fit bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class=" fa fa-paper-plane-o font-green"></i>
						<span class="caption-subject font-green bold uppercase">Contact Us</span>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form action="{{ url('contact/add') }}" class="form-horizontal" method="POST">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Name</label>
							   <div class="input-group select2-bootstrap-prepend col-md-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Enter Your Name" name="nama" required> 
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Email</label>
								<div class="input-group select2-bootstrap-prepend col-md-7">
									<div class="input-group">
										<input type="email" class="form-control" placeholder="Enter Your Email" name="email" required> 
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Phone Number</label>
								<div class="input-group select2-bootstrap-prepend col-md-7">
									<div class="input-group">
										<input type="nohp" class="form-control" placeholder="Enter Your Phone Number" name="nohp" required> 
									</div>
								</div>
							</div>
							<div class="form-group">
							   <label class="col-md-3 control-label">Address</label>
								<div class="input-group select2-bootstrap-prepend col-md-7">
									<div class="input-group">
										<textarea  class="form-control" placeholder="Enter Your Address" name="alamat" cols="80" rows="3" required></textarea> 
									</div>
								</div>
							</div>
							<div class="form-group">
							<label class="col-md-3 control-label">Subject</label>
								<div class="input-group select2-bootstrap-prepend col-md-7">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
											<span class="glyphicon glyphicon-search"></span>
										</button>
									</span>
									<select class="form-control select2" name="perihal" required>
										<option value="">-- Choose Subject --</option>
										<option value="Carrer Opportunity">Carrer Opportunity</option>
										<option value="General Enquiry">General Enquiry</option>
										<option value="Sales Enquiry">Sales Enquiry</option>
									</select>
								   
								</div>
							</div>
							<div class="form-group">
							   <label class="col-md-3 control-label">Message</label>
								<div class="input-group select2-bootstrap-prepend col-md-7">
									<div class="input-group">
										<textarea  class="form-control" placeholder="Enter Message" name="pesan" cols="80" rows="3" required></textarea> 
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-4">
									<button type="submit" class="btn green">Submit</button>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="button" class="btn default">Cancel</button>
								</div>
							</div>
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
@endsection