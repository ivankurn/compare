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
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light portlet-fit bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class=" fa fa-home font-green"></i>
							<span class="caption-subject font-green bold uppercase">Welcome to Maxx Coffee</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="mt-element-step">
							<div class="row step-default">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="portlet light bordered">
					<div class="portlet-body">
						<div class="profile">
							<div class="tab-content">
								<div class="row">
									<div class="col-md-3">
										<ul class="list-unstyled profile-nav">
											<li>
												@if(empty($profile['foto']) or $profile['foto'] == "")
													@if($profile['gender'] == "Female")
														<img src="{{URL::to('assets/Maxx/pages/img/profile/')}}/default-female.png" class="img-responsive" style="border-radius: 50% !important;" alt="" />
													@else
														<img src="{{URL::to('assets/Maxx/pages/img/profile/')}}/default-male.png" class="img-responsive" style="border-radius: 50% !important;" alt="" />
													@endif
												@else
												<img src="{{URL::to('assets/Maxx/pages/img/profile/')}}/{{$profile['foto']}}" class="img-responsive" style="border-radius: 50% !important;" alt="" />
												@endif
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-7 profile-info">
												@if(!empty($profile['nama_user']))
												<p style="margin-bottom: 5px;">Name</p>
												<h3 class="font-green sbold" style="margin-top: 5px;margin-bottom: 20px;font-size:20px">{{$profile['nama_user']}}</h3>
												@endif
												@if(!empty($profile['pin']))
												<p style="margin-bottom: 5px;">PIN</p>
												<h3 class="font-green sbold" style="margin-top: 5px;margin-bottom: 20px;font-size:20px">{{$profile['pin']}}</h3>
												@endif
												@if(!empty($profile['email']))
												<p style="margin-bottom: 5px;">Email</p>
												<h3 class="font-green sbold" style="margin-top: 5px;margin-bottom: 20px;font-size:20px">{{$profile['email']}}</h3>
												@endif
												@if(!empty($profile['alamat_user']))
												<p style="margin-bottom: 5px;">Address</p>
												<h3 class="font-green sbold" style="margin-top: 5px;margin-bottom: 20px;font-size:20px">{{$profile['alamat_user']}}, {{$profile['kota_user']}}</h3>
												@endif
												@if(!empty($profile['mobile_phone_user']))
												<p style="margin-bottom: 5px;">Phone Number</p>
												<h3 class="font-green sbold" style="margin-top: 5px;margin-bottom: 20px;font-size:20px">+{{$profile['country_code_user']}}{{$profile['mobile_phone_user']}} </h3>
												@endif
												@if(!empty($profile['tanggal_lahir']))
												<p style="margin-bottom: 5px;">Birth date</p>
												<h3 class="font-green sbold" style="margin-top: 5px;margin-bottom: 20px;font-size:20px">
												<? 
												$date=date_create($profile['tanggal_lahir']);
												echo date_format($date,"j F Y");
												?>
												@endif
												@if(!empty($profile['gender']))
												</h3>
												<p style="margin-bottom: 5px;">Sex</p>
												<h3 class="font-green sbold" style="margin-top: 5px;margin-bottom: 20px;">{{$profile['gender']}}</h3>
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END CONTENT -->
@endsection