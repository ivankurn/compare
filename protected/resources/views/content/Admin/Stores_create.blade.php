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
        $('#provinsistore').hide();
        $('#kotanyastore').hide();

        $("#pulau_store").change(function(){
            var pulau = $("#pulau_store").val();
           
            var arr = pulau.split("|");
            var idPulau = arr[0];
            
            $.ajax({
                type: "POST",
                url : "<?php echo url('pulaukelapa')?>",
                data: "id_pulau="+idPulau,
                success: function(data){
                    $('#provinsistore').show();
                    $('#propincuk').html(data);
                }
            });
            
        });


        function myFunction(propinsi){
            var kota = $(propinsi).val();

            alert(kota);
        }

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
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-map-o"></i>
                            <span class="caption-subject bold uppercase">Add Store</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="{{ url('admin/store/add/post') }}" class="form-horizontal" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Store name" name="name_store" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Slug</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Slug store" name="slug_store" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Address</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <textarea  class="form-control" placeholder="Address store" name="alamat" cols="80" rows="5" required></textarea> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Island</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                        <select id="pulau_store" class="form-control select2" name="pulau" required>
                                            <option value="">-- Choose island --</option>
                                            @foreach($pulau as $yu)
                                            <option value="{{ $yu['id_pulau'] }} | {{ $yu['nama_pulau'] }}"> {{ $yu['nama_pulau'] }} </option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>
                                <div class="form-group" id="provinsistore">
                                    <label class="col-md-3 control-label">Province</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div id="propincuk">
                                            
                                        </div>
                                    </div>
                                </div><div class="form-group" id="kotanyastore">
                                    <label class="col-md-3 control-label">City</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div id="coeg">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pos Code</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Pos code store" name="kodepos_store" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="form_control_1"></label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="form-group form-md-line-input has-info">
                                            <input id="pac-input" class="controls" type="text" placeholder="Enter a location" style="padding:10px;width:20%" onkeydown="if (event.keyCode == 13) return false;">
                                        <div id="map-canvas" style="width:900;height:380px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Latitude</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="latitude" id="lat" readonly> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Longitude</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="longitude" id="lng" readonly> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Phone</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="phone store" name="phone_store" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Open Hour</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker timepicker-24 input-sm " name="jam_buka" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Close Hour</label>
                                    <div class="input-group select2-bootstrap-prepend col-md-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker timepicker-24 input-sm " name="jam_tutup" required>
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