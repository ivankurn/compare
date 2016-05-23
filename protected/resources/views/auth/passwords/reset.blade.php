@extends('layouts.Metronic.app')

@section('page-level-plugins-atas')
@endsection

@section('page-level-styles')
<link href="{{ asset('assets/Metronic/pages/css/login-4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-level-plugins-bawah')
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/moment.min.js') }}" type="text/javascript"></script>
@endsection

@section('page-level-scripts')
<script src="{{ asset('assets/Metronic/pages/scripts/login-4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script> 
@endsection

@section('body')

<!-- BEGIN BODY -->
<body class=" login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<a href="index.html">
			<img src="{{ asset('assets/Maxx/pages/img/logo-big-white.png') }}" alt="" /> 
		</a>
	</div>
	<!-- END LOGO -->
	
	<!-- BEGIN CONTENT -->
        <div class="content">

		<!-- BEGIN RESET PASSWORD FORM -->
		<form class="reset-form" action="{{ url('resetpassword') }}" method="post">
	
			{!! csrf_field() !!}
			<input type="hidden" name="reset_token" value="{{ $verify_reset_password }}">
		
			<h3 class="font-green">@lang('reset.reset_password')</h3>			

	@if (!empty($messages) && !is_array($messages))
			<div class="alert alert-danger">
				<button class="close" data-close="alert"></button>
				<span> {{ $messages }} </span>
			</div>
	@endif

			<p> @lang('reset.enter_reset_password') </p>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('reset.password')</label>
				<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" id="register_password" name="password" /> 

	@if (!empty($messages['password']))		
		@foreach ($messages['password'] as $key => $value)
			<span id="password_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
	
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.retype_password')</label>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" /> 
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-success uppercase pull-right">@lang('reset.submit')</button>
			</div>
		</form>
		<!-- END RESET PASSWORD FORM -->
	
	</div>
	<!-- END CONTENT -->
	
	<!-- BEGIN FOOTER -->
    @include('layouts.Metronic.footer')
    <!-- END FOOTER -->
	
@endsection