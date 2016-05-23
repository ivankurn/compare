@extends('layouts.content.app')

@section('page-level-styles')
<link href="{{ asset('assets/Metronic/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-level-plugins-atas')
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ asset('assets/Metronic/global/plugins/cubeportfolio/css/cubeportfolio.css') }}" rel="stylesheet" type="text/css" /> 
@endsection

@section('page-level-plugins-bawah')
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script> 
<script src="{{ asset('assets/Metronic/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/jquery.pulsate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/jquery-bootpag/jquery.bootpag.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/holder.js') }}" type="text/javascript"></script>
@endsection

@section('page-level-scripts')
<script src="{{ asset('assets/Maxx/pages/scripts/portfolio-1-stores.min.js') }}" type="text/javascript"></script>
<script>
    document.getElementById("theisland").onchange = function() {
        window.location.href = this.value;     
    };
</script>
@endsection

@section('body')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light portlet-fit bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class=" fa fa-map-o font-green"></i>
							<span class="caption-subject font-green bold uppercase">Stores</span>
						</div>
						<div class="actions">
							<div class="btn-group open">
								<select class="bs-select form-control" id="theisland">
									<option value="{{ URL::to('stores') }}/island/{{$current_pulau}}" selected>{{ucfirst($current_pulau)}}</option>
									@foreach($pulau as $row)
										<?php $currentpulau = ucfirst($current_pulau); ?>
										@if($row['pulau'] != $currentpulau)
										<option value="{{ URL::to('stores') }}/island/{{strtolower($row['pulau'])}}">{{$row['pulau']}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="portlet-body">
					@if($error)
						<div class="row">
							<div class="col-md-12" style="margin-top:200px;margin-bottom:250px;text-align:center">
							{{$error}}
							</div>
						</div>
					@elseif($maintenance)
						<div class="row">
							<div class="col-md-12" style="margin-top:200px;margin-bottom:250px;text-align:center">
							{{$maintenance}}
							</div>
						</div>
					@else
					 <div class="row">
                        <div class="col-lg-12">
						<div class="portfolio-content portfolio-1">
							<div id="js-filters-juicy-projects" class="cbp-l-filters-button">
								<div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase"> All
									<div class="cbp-filter-counter"></div>
								</div>
								@foreach($fiturstores as $row)
								<div data-filter=".{{ str_replace(" ", "", $row['nama_fitur'])}}" class="cbp-filter-item btn dark btn-outline uppercase"> 
								<img src="{{ URL::to('assets') }}/Maxx/pages/img/feature/{{ $row['icon'] }}" height="17px"> {{ $row['nama_fitur'] }}
									<div class="cbp-filter-counter">{{ $row['nama_fitur'] }}</div>
								</div>
								@endforeach                            
							</div><br /><br />
							<div id="js-grid-juicy-projects" class="cbp">
								@foreach($stores as $row)
								<div class="cbp-item <?php echo str_replace(",", " ", str_replace(" ", "", $row['nama_fitur'])); ?> ">
									<div class="col-xs-12">
										<div class="mt-element-ribbon bg-grey-steel">
											<div class="ribbon ribbon-clip ribbon-color-info uppercase" style="font-size: 20px;">
												<div class="ribbon-sub ribbon-clip" style="background-color: #0fb40b;"></div> {{$row['nama_store']}} 
											</div>
											
											
											<p class="ribbon-content">
												<div class="row" style="margin-top: 20px;">
													<div class="col-md-6">
													
													<a href="https://www.google.com/maps?q={{$row['latitude']}},{{$row['longitude']}}&hl=es;z=14" style="color:#0000FF;text-align:left" target="_blank"><img style="width:100%" src="http://maps.googleapis.com/maps/api/staticmap?center={{$row['latitude']}},{{$row['longitude']}}&zoom=15&scale=false&size=200x350&maptype=roadmap&format=png&visual_refresh=true&markers=size:large%7Ccolor:0xff0000%7Clabel:toko%7C{{$row['latitude']}},{{$row['longitude']}}"></a>
													
													<div style="margin-top:20px">
													<?php
													$fiturnya = explode(",",$row['nama_fitur']);
													$iconnya = explode(",",$row['icon_fitur']);
													$xxx = 0;
													?>
													@foreach($iconnya as $rows)
														<a class="btn btn-circle btn-icon-only btn-default " href="javascript:;" title="{{$fiturnya[$xxx]}}">
															<img src="{{ URL::to('assets') }}/Maxx/pages/img/feature/{{ $rows }}" style="height: 20px; width: 20px; margin-left: 5px;filter: hue-rotate(180deg);-webkit-filter: hue-rotate(180deg);">
														</a>
													<?php $xxx++;?>
													@endforeach
													</div>
													</div>
													<div class="col-md-6">
													<div class="note note-info" style="font-size:12px"><i class="fa fa-map-marker"></i>  {{$row['alamat_store']}}, {{$row['kota_store']}}, {{$row['provinsi_store']}}, {{$row['kodepos_store']}}</div>
													<div class="note note-info" style="font-size:12px"><i class="fa fa-phone"></i>  Contact: {{$row['phone_store']}}</div>
													<div class="note note-info" style="font-size:12px"><i class="fa fa-clock-o"></i>  {{substr($row['jam_buka'], 0, -3)}} - {{substr($row['jam_tutup'], 0, -3)}}</div>
													</div>
												</div>
											</p>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						</div>
					@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END CONTENT -->
@endsection