@extends('layouts.Metronic.app')

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
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-boxed">
	@include('layouts.Metronic.headermenu')
	<div class="clearfix"> </div>
	<div class="container">
        <div class="page-container">
            @include('layouts.Vourest.sidebar_cust')
            <div class="page-content-wrapper">
				<div class="page-content">
                 	<div class="row">
						<div class="col-md-12">
							<div class="portlet light portlet-fit bordered">
								<div class="portlet-title">
									<div class="caption">
										<i class=" icon-layers font-green"></i>
										<span class="caption-subject font-green bold uppercase">Welcome to Vourest</span>
									</div>
								</div>
								<div class="portlet-body">
									<div class="mt-element-step">
										<div class="row step-default">
											<div class="col-md-6 bg-grey mt-step-col active">
												<div class="mt-step-number bg-white font-grey"><span class="icon-diamond"></span></div>
												<div class="mt-step-title uppercase font-grey-cascade">Total Vourest Point</div>
												<div class="mt-step-content font-grey-cascade"> 
													<div style="font-size: 50px;">{{ number_format(Auth::user()->total_point_resto, 0, '.', ',') }}</div>
													<div>Start collecting Points by visiting Vourest partner restaurants</div>
												</div>
											</div>
											
											<div class="col-md-6 bg-grey mt-step-col active" style="background-color: rgb(50, 210, 97) !important">
												<div class="mt-step-number bg-white font-grey"><span class="icon-wallet"></span></div>
												<div class="mt-step-title uppercase font-grey-cascade">Vourest Saldo</div>
												<div class="mt-step-content font-grey-cascade">
													<div style="font-size: 50px;">IDR <?php  echo number_format(Auth::user()->saldo, 0, '.', ',') ?></div>
													<div><a href="topup">Buy Vourest credit</a> to topup Vourest Saldo</div>
												</div>
											</div>
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
																@if($profile['gender'] == "Wanita")
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
														@if($point_resto)
														<div class="col-md-5">
															<div class="portlet sale-summary">
																<div class="portlet-title">
																	<div class="caption font-red sbold"> Points </div>
																	<div class="tools">
																		<a class="reload" href="javascript:;"> </a>
																	</div>
																</div>
																<div class="portlet-body">
																	<ul class="list-unstyled">
																		@foreach($point_resto as $row)
																		<li>
																			<a href="/restaurants/{{ strtolower($row['slug_resto'])}}"><img src="{{URL::to('assets/Maxx/pages/img/brand/')}}/{{ $row['logo']}}" class="img-responsive" width="20%" style="border-radius: 50% !important;display:inline;"></a>
																			<div style="display:inline">{{ $row['nama_resto']}}</div>
																			<div>{{ number_format($row['point_resto'], 0, '.', ',')}}</div>
																		</li>
																		@endforeach
																	</ul>
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
							</div>
						</div>
                    </div>
				</div>
            </div>
        </div>
    </div>
@endsection