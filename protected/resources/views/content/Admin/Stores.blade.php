@extends('layouts.content.app')

@section('page-level-styles')
<link href="{{ asset('assets/Metronic/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-level-plugins-atas')
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" /> 
@endsection

@section('page-level-plugins-bawah')
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script> 
@endsection

@section('page-level-scripts')
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
				<div class="col-md-12">
					<div class="portlet light portlet-fit bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class=" fa fa-map-o font-green"></i>
								<span class="caption-subject font-green bold uppercase">Stores</span>
							</div>
						</div>
						@if($maintenance)
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-12" style="margin-top:200px;margin-bottom:250px;text-align:center">
								{{$maintenance}}
								</div>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>

			<div class="row">
			@foreach($store as $su)
				<div class="col-md-6">
                    
                   
                    <div class="portlet light portlet-fit bordered">
                    	<div class="mt-element-ribbon light">
							<div class="ribbon ribbon-left ribbon-clip ribbon-shadow ribbon-round ribbon-border-dash-hor ribbon-color-info uppercase">
								<div class="ribbon-sub ribbon-clip ribbon-left"></div> {{ $su['nama_store'] }} </div>
						</div>
                        <div class="portlet-title">
                           	{{ $su['alamat_store']}}
                           	<br>
                           	
                        </div>
                        <div class="portlet-body">
							<div class="row">
								<div class="col-md-7 profile-info">
									<img src="http://maps.googleapis.com/maps/api/staticmap?center={{ $su['latitude'] }},{{ $su['longitude'] }}&amp;zoom=15&amp;scale=false&amp;size=200x200&amp;maptype=roadmap&amp;format=png&amp;visual_refresh=true&amp;markers=size:mid%7Ccolor:0xff0000%7Clabel:kota%7C{{ $su['latitude'] }},{{ $su['longitude'] }}" class="img-responsive pic-bordered" alt="">
									<br>
									<h5 class="font-green sbold" style="margin-top: 5px;margin-bottom: 20px;">  {{ $su['kota_store'] }} - {{ $su['provinsi_store'] }}</h5>
									<br>
									<button type="button" class="btn purple-sharp btn-outline sbold uppercase">Edit</button>
									
								</div>
								<div class="col-md-5">
									<div class="portlet sale-summary">
										
										<div class="portlet-body">
											<ul class="list-unstyled">
												<li>
													<div class="note note-info">
														<i class="fa fa-phone"></i> {{ $su['phone_store'] }}
													</div>
													<div class="note note-info">
														<i class="fa fa-clock-o"></i> {{ $su['jam_buka'] }} - {{ $su['jam_tutup'] }}
													</div>
													<div class="note note-info">
														Facilities :  <i class="fa fa-wifi"></i> 
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>

							</div>  
						</div>
                        
                    </div>
                    <!-- END GEOLOCATION PORTLET-->
                </div>
            @endforeach
            </div>

		
	</div>
</div>
<!-- END CONTENT -->
@endsection