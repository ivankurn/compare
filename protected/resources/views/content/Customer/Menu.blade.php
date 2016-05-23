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
<script src="{{ asset('assets/Maxx/pages/scripts/portfolio-3-menu.min.js') }}" type="text/javascript"></script>
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
							<i class=" fa fa-coffee font-green"></i>
							<span class="caption-subject font-green bold uppercase">Menu</span>
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
								<div id="js-filters-lightbox-gallery2" class="cbp-l-filters-button cbp-l-filters-left">
									<div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase"> All
										<div class="cbp-filter-counter"></div>
									</div>
									@foreach($kategori as $row)
									<div data-filter=".{{ str_replace(" ", "", $row['kategori'])}}" class="cbp-filter-item btn dark btn-outline uppercase"> 
									{{ $row['kategori'] }}
										<div class="cbp-filter-counter"></div>
									</div>
									@endforeach                            
								</div><br /><br />
								<div id="js-grid-lightbox-gallery" class="cbp">
									@foreach($menu as $row)
									<div class="cbp-item <?php echo str_replace(",", " ", str_replace(" ", "", $row['kategori'])); ?> ">
										@if($row['gambar'])
											<a href="{{ URL::to('assets') }}/Maxx/pages/img/menu/{{$row['gambar']}}" class="cbp-caption cbp-lightbox" data-title="<div style='font-size:18px'>{{ $row['nama_menu']}} <br><br>Category: {{ $row['kategori']}} <br><br>{{ $row['deskripsi']}}</div>" rel="nofollow">
										@else
											<a href="{{ URL::to('assets') }}/Maxx/pages/img/menu/default.png" class="cbp-caption cbp-lightbox" data-title="<div style='font-size:18px'>{{ $row['nama_menu']}} <br><br>Category: {{ $row['kategori']}} <br><br>{{ $row['deskripsi']}}</div>" rel="nofollow">
										@endif
											<div class="cbp-caption-defaultWrap">
												<div class="col-xs-12">
													<div class="mt-element-ribbon bg-grey-steel" style="height: 350px;">
														<div class="ribbon ribbon-clip ribbon-color-info uppercase" style="font-size: 14px;height: 50px;">
															<div class="ribbon-sub ribbon-clip" style="background-color: #0fb40b;"></div> {{$row['nama_menu']}} 
														</div>
														
														<p class="ribbon-content">
															<div class="row" style="margin-top: 20px;">
																<div class="col-md-12">
																	@if(empty($row['gambar']))
																	<img  src="{{ URL::to('assets') }}/Maxx/pages/img/menu/default.png" style="border-radius: 50% !important;">
																	@else
																		<img src="{{ URL::to('assets') }}/Maxx/pages/img/menu/{{$row['gambar']}}" style="border-radius: 50% !important;">
																	@endif
																	<div style="margin-top:20px">
																	<?php
																	$typenya = explode(",",$row['type']);
																	$sizenya = explode(",",$row['size']);
																	$harganya = explode(",",$row['harga']);
																	$xxx = 0;
																	?>
																	
																	</div>
																</div>
															</div>
														</p>
													</div>
												</div>
											</div>
											
											<div class="cbp-caption-activeWrap">
												<div class="cbp-l-caption-alignLeft">
													<div class="cbp-l-caption-body">
														<div class="cbp-l-caption-desc" style="font-size:12px;margin-top:-15px;margin-left:-10px">
														{{ $row['deskripsi']}}
														</div>
													</div>
												</div>
											</div>
											
										</a>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END CONTENT -->
@endsection