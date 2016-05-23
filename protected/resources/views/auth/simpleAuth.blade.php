@extends('layouts.auth.app')

@section('page-level-plugins-atas')
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/Metronic/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
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
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
@endsection

@section('page-level-scripts')
<script src="{{ asset('assets/Metronic/pages/scripts/login-4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script> 
<script src="{{ asset('assets/Metronic/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script>
	jQuery(document).ready(
		function()
		{
@if ($page == 'register')
			$(".register-form").show();
			$(".login-form").hide();
			$(".forget-form").hide();
			$(".resend-form").hide();
@elseif ($page == 'login')
			$(".login-form").show();
			$(".register-form").hide();
			$(".forget-form").hide();
			$(".resend-form").hide();
@elseif ($page == 'forgotpassword') 
			$(".forget-form").show();
			$(".register-form").hide();
			$(".login-form").hide();
			$(".resend-form").hide();
@endif
		}
	);
</script>
@endsection

@section('body')

<!-- BEGIN BODY -->
<body class=" login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<a href="{{ url('home') }}">
			<img src="{{ asset('assets/Maxx/pages/img/logo-big-white.png') }}" alt="Vourest" /> 
		</a>
	</div>
	<!-- END LOGO -->
	
	<!-- BEGIN CONTENT -->
        <div class="content">
		
		<!-- BEGIN REGISTRATION FORM -->
		<form class="register-form" action="{{ url('register') }}" method="post">
		
			{!! csrf_field() !!}
		
			<h3 class="white">Sign Up</h3>
			<p class="hint"> @lang('auth.enter_personal_detail') </p>

@if ($page == 'register')		
	@if (!empty($messages) && !is_array($messages))
			<div class="alert alert-danger">
				<button class="close" data-close="alert"></button>
				<span> {{ $messages }} </span>
			</div>
	@endif
@endif

			

			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.full_name')</label>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Full Name" name="nama_user" value="{{ empty($data['nama_user']) ? '' : $data['nama_user'] }}" />

@if ($page == 'register')		
	@if (!empty($messages['nama_user']))		
		@foreach ($messages['nama_user'] as $key => $value)
				<span id="nama_user_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	
	
			</div>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.address')</label>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Address" name="alamat_user" value="{{ empty($data['alamat_user']) ? '' : $data['alamat_user'] }}"/> 

@if ($page == 'register')			
	@if (!empty($messages['alamat_user']))		
		@foreach ($messages['alamat_user'] as $key => $value)
				<span id="alamat_user_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	
		
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.city')</label>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="City/Town" name="kota_user" value="{{ empty($data['kota_user']) ? '' : $data['kota_user'] }}" /> 

@if ($page == 'register')		
	@if (!empty($messages['kota_user']))		
		@foreach ($messages['kota_user'] as $key => $value)
				<span id="kota_user_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	

			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.select_country_code')</label>
				<select name="country_code_user" class="form-control">
					<option value="">@lang('auth.select_country_code')</option>
					<option value="62" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '62' ? 'selected' : '' }}>Indonesia (+62)</option>
					<option value="93" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '93' ? 'selected' : '' }}>Afghanistan (+93)</option>
					<option value="355" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '355' ? 'selected' : '' }}>Albania (+355)</option>
					<option value="213" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '213' ? 'selected' : '' }}>Algeria (+213)</option>
					<option value="684" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '684' ? 'selected' : '' }}>American Samoa (+684)</option>
					<option value="376" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '376' ? 'selected' : '' }}>Andorra (+376)</option>
					<option value="244" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '244' ? 'selected' : '' }}>Angola (+244)</option>
					<option value="1-264" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-264' ? 'selected' : '' }}>Anguilla (+1-264)</option>
					<option value="672" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '672' ? 'selected' : '' }}>Antarctica (+672)</option>
					<option value="1-268" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-268' ? 'selected' : '' }}>Antigua and Barbuda (+1-268)</option>
					<option value="54" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '54' ? 'selected' : '' }}>Argentina (+54)</option>
					<option value="374" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '374' ? 'selected' : '' }}>Armenia (+374)</option>
					<option value="297" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '297' ? 'selected' : '' }}>Aruba (+297)</option>
					<option value="61" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '61' ? 'selected' : '' }}>Australia (+61)</option>
					<option value="43" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '43' ? 'selected' : '' }}>Austria (+43)</option>
					<option value="994" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '994' ? 'selected' : '' }}>Azerbaijan (+994)</option>
					<option value="1-242" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-242' ? 'selected' : '' }}>Bahamas (+1-242)</option>
					<option value="973" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '973' ? 'selected' : '' }}>Bahrain (+973)</option>
					<option value="880" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '880' ? 'selected' : '' }}>Bangladesh (+880)</option>
					<option value="1-246" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-246' ? 'selected' : '' }}>Barbados (+1-246)</option>
					<option value="375" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '375' ? 'selected' : '' }}>Belarus (+375)</option>
					<option value="32" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '32' ? 'selected' : '' }}>Belgium (+32)</option>
					<option value="501" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '501' ? 'selected' : '' }}>Belize (+501)</option>
					<option value="229" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '229' ? 'selected' : '' }}>Benin (+229)</option>
					<option value="1-441" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-441' ? 'selected' : '' }}>Bermuda (+1-441)</option>
					<option value="975" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '975' ? 'selected' : '' }}>Bhutan (+975)</option>
					<option value="591" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '591' ? 'selected' : '' }}>Bolivia (+591)</option>
					<option value="387" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '387' ? 'selected' : '' }}>Bosnia-Herzegovina (+387)</option>
					<option value="267" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '267' ? 'selected' : '' }}>Botswana (+267)</option>
					<option value="55" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '55' ? 'selected' : '' }}>Brazil (+55)</option>
					<option value="673" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '673' ? 'selected' : '' }}>Brunei Darussalam (+673)</option>
					<option value="359" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '359' ? 'selected' : '' }}>Bulgaria (+359)</option>
					<option value="226" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '226' ? 'selected' : '' }}>Burkina Faso (+226)</option>
					<option value="257" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '257' ? 'selected' : '' }}>Burundi (+257)</option>
					<option value="855" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '855' ? 'selected' : '' }}>Cambodia (+855)</option>
					<option value="237" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '237' ? 'selected' : '' }}>Cameroon (+237)</option>
					<option value="1" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1' ? 'selected' : '' }}>Canada (+1)</option>
					<option value="238" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '238' ? 'selected' : '' }}>Cape Verde (+238)</option>
					<option value="1-345" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-345' ? 'selected' : '' }}>Cayman Islands (+1-345)</option>
					<option value="236" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '236' ? 'selected' : '' }}>Central African Republic (+236)</option>
					<option value="235" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '235' ? 'selected' : '' }}>Chad (+235)</option>
					<option value="56" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '56' ? 'selected' : '' }}>Chile (+56)</option>
					<option value="86" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '86' ? 'selected' : '' }}>China (+86)</option>
					<option value="61" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '61' ? 'selected' : '' }}>Christmas Island (+61)</option>
					<option value="61" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '61' ? 'selected' : '' }}>Cocos (Keeling) Islands (+61)</option>
					<option value="57" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '57' ? 'selected' : '' }}>Colombia (+57)</option>
					<option value="269" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '269' ? 'selected' : '' }}>Comoros (+269)</option>
					<option value="242" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '242' ? 'selected' : '' }}>Congo (+242)</option>
					<option value="243" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '243' ? 'selected' : '' }}>Congo, Dem. Republic (+243)</option>
					<option value="682" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '682' ? 'selected' : '' }}>Cook Islands (+682)</option>
					<option value="506" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '506' ? 'selected' : '' }}>Costa Rica (+506)</option>
					<option value="385" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '385' ? 'selected' : '' }}>Croatia (+385)</option>
					<option value="53" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '53' ? 'selected' : '' }}>Cuba (+53)</option>
					<option value="357" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '357' ? 'selected' : '' }}>Cyprus (+357)</option>
					<option value="420" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '420' ? 'selected' : '' }}>Czech Rep. (+420)</option>
					<option value="45" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '45' ? 'selected' : '' }}>Denmark (+45)</option>
					<option value="253" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '253' ? 'selected' : '' }}>Djibouti (+253)</option>
					<option value="1-767" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-767' ? 'selected' : '' }}>Dominica (+1-767)</option>
					<option value="809" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '809' ? 'selected' : '' }}>Dominican Republic (+809)</option>
					<option value="593" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '593' ? 'selected' : '' }}>Ecuador (+593)</option>
					<option value="20" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '20' ? 'selected' : '' }}>Egypt (+20)</option>
					<option value="503" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '503' ? 'selected' : '' }}>El Salvador (+503)</option>
					<option value="240" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '240' ? 'selected' : '' }}>Equatorial Guinea (+240)</option>
					<option value="291" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '291' ? 'selected' : '' }}>Eritrea (+291)</option>
					<option value="372" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '372' ? 'selected' : '' }}>Estonia (+372)</option>
					<option value="251" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '251' ? 'selected' : '' }}>Ethiopia (+251)</option>
					<option value="500" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '500' ? 'selected' : '' }}>Falkland Islands (Malvinas) (+500)</option>
					<option value="298" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '298' ? 'selected' : '' }}>Faroe Islands (+298)</option>
					<option value="679" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '679' ? 'selected' : '' }}>Fiji (+679)</option>
					<option value="358" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '358' ? 'selected' : '' }}>Finland (+358)</option>
					<option value="33" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '33' ? 'selected' : '' }}>France (+33)</option>
					<option value="594" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '594' ? 'selected' : '' }}>French Guiana (+594)</option>
					<option value="241" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '241' ? 'selected' : '' }}>Gabon (+241)</option>
					<option value="220" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '220' ? 'selected' : '' }}>Gambia (+220)</option>
					<option value="995" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '995' ? 'selected' : '' }}>Georgia (+995)</option>
					<option value="49" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '49' ? 'selected' : '' }}>Germany (+49)</option>
					<option value="233" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '233' ? 'selected' : '' }}>Ghana (+233)</option>
					<option value="350" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '350' ? 'selected' : '' }}>Gibraltar (+350)</option>
					<option value="44" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '44' ? 'selected' : '' }}>Great Britain (+44)</option>
					<option value="30" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '30' ? 'selected' : '' }}>Greece (+30)</option>
					<option value="299" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '299' ? 'selected' : '' }}>Greenland (+299)</option>
					<option value="1-473" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-473' ? 'selected' : '' }}>Grenada (+1-473)</option>
					<option value="590" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '590' ? 'selected' : '' }}>Guadeloupe (French) (+590)</option>
					<option value="1-671" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-671' ? 'selected' : '' }}>Guam (USA) (+1-671)</option>
					<option value="502" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '502' ? 'selected' : '' }}>Guatemala (+502)</option>
					<option value="224" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '224' ? 'selected' : '' }}>Guinea (+224)</option>
					<option value="245" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '245' ? 'selected' : '' }}>Guinea Bissau (+245)</option>
					<option value="592" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '592' ? 'selected' : '' }}>Guyana (+592)</option>
					<option value="509" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '509' ? 'selected' : '' }}>Haiti (+509)</option>
					<option value="504" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '504' ? 'selected' : '' }}>Honduras (+504)</option>
					<option value="852" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '852' ? 'selected' : '' }}>Hong Kong (+852)</option>
					<option value="36" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '36' ? 'selected' : '' }}>Hungary (+36)</option>
					<option value="354" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '354' ? 'selected' : '' }}>Iceland (+354)</option>
					<option value="91" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '91' ? 'selected' : '' }}>India (+91)</option>
					<option value="98" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '98' ? 'selected' : '' }}>Iran (+98)</option>
					<option value="964" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '964' ? 'selected' : '' }}>Iraq (+964)</option>
					<option value="353" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '353' ? 'selected' : '' }}>Ireland (+353)</option>
					<option value="972" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '972' ? 'selected' : '' }}>Israel (+972)</option>
					<option value="39" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '39' ? 'selected' : '' }}>Italy (+39)</option>
					<option value="225" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '225' ? 'selected' : '' }}>Ivory Coast (+225)</option>
					<option value="1-876" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-876' ? 'selected' : '' }}>Jamaica (+1-876)</option>
					<option value="81" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '81' ? 'selected' : '' }}>Japan (+81)</option>
					<option value="962" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '962' ? 'selected' : '' }}>Jordan (+962)</option>
					<option value="7" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '7' ? 'selected' : '' }}>Kazakhstan (+7)</option>
					<option value="254" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '254' ? 'selected' : '' }}>Kenya (+254)</option>
					<option value="686" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '686' ? 'selected' : '' }}>Kiribati (+686)</option>
					<option value="850" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '850' ? 'selected' : '' }}>Korea-North (+850)</option>
					<option value="82" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '82' ? 'selected' : '' }}>Korea-South (+82)</option>
					<option value="965" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '965' ? 'selected' : '' }}>Kuwait (+965)</option>
					<option value="996" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '996' ? 'selected' : '' }}>Kyrgyzstan (+996)</option>
					<option value="856" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '856' ? 'selected' : '' }}>Laos (+856)</option>
					<option value="371" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '371' ? 'selected' : '' }}>Latvia (+371)</option>
					<option value="961" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '961' ? 'selected' : '' }}>Lebanon (+961)</option>
					<option value="266" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '266' ? 'selected' : '' }}>Lesotho (+266)</option>
					<option value="231" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '231' ? 'selected' : '' }}>Liberia (+231)</option>
					<option value="218" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '218' ? 'selected' : '' }}>Libya (+218)</option>
					<option value="423" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '423' ? 'selected' : '' }}>Liechtenstein (+423)</option>
					<option value="370" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '370' ? 'selected' : '' }}>Lithuania (+370)</option>
					<option value="352" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '352' ? 'selected' : '' }}>Luxembourg (+352)</option>
					<option value="853" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '853' ? 'selected' : '' }}>Macau (+853)</option>
					<option value="389" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '389' ? 'selected' : '' }}>Macedonia (+389)</option>
					<option value="261" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '261' ? 'selected' : '' }}>Madagascar (+261)</option>
					<option value="265" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '265' ? 'selected' : '' }}>Malawi (+265)</option>
					<option value="60" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '60' ? 'selected' : '' }}>Malaysia (+60)</option>
					<option value="960" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '960' ? 'selected' : '' }}>Maldives (+960)</option>
					<option value="223" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '223' ? 'selected' : '' }}>Mali (+223)</option>
					<option value="356" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '356' ? 'selected' : '' }}>Malta (+356)</option>
					<option value="692" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '692' ? 'selected' : '' }}>Marshall Islands (+692)</option>
					<option value="596" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '596' ? 'selected' : '' }}>Martinique (French) (+596)</option>
					<option value="222" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '222' ? 'selected' : '' }}>Mauritania (+222)</option>
					<option value="230" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '230' ? 'selected' : '' }}>Mauritius (+230)</option>
					<option value="269" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '269' ? 'selected' : '' }}>Mayotte (+269)</option>
					<option value="52" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '52' ? 'selected' : '' }}>Mexico (+52)</option>
					<option value="691" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '691' ? 'selected' : '' }}>Micronesia (+691)</option>
					<option value="373" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '373' ? 'selected' : '' }}>Moldova (+373)</option>
					<option value="377" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '377' ? 'selected' : '' }}>Monaco (+377)</option>
					<option value="976" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '976' ? 'selected' : '' }}>Mongolia (+976)</option>
					<option value="382" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '382' ? 'selected' : '' }}>Montenegro (+382)</option>
					<option value="1-664" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-664' ? 'selected' : '' }}>Montserrat (+1-664)</option>
					<option value="212" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '212' ? 'selected' : '' }}>Morocco (+212)</option>
					<option value="258" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '258' ? 'selected' : '' }}>Mozambique (+258)</option>
					<option value="95" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '95' ? 'selected' : '' }}>Myanmar (+95)</option>
					<option value="264" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '264' ? 'selected' : '' }}>Namibia (+264)</option>
					<option value="674" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '674' ? 'selected' : '' }}>Nauru (+674)</option>
					<option value="977" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '977' ? 'selected' : '' }}>Nepal (+977)</option>
					<option value="31" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '31' ? 'selected' : '' }}>Netherlands (+31)</option>
					<option value="599" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '599' ? 'selected' : '' }}>Netherlands Antilles (+599)</option>
					<option value="687" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '687' ? 'selected' : '' }}>New Caledonia (French) (+687)</option>
					<option value="64" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '64' ? 'selected' : '' }}>New Zealand (+64)</option>
					<option value="505" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '505' ? 'selected' : '' }}>Nicaragua (+505)</option>
					<option value="227" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '227' ? 'selected' : '' }}>Niger (+227)</option>
					<option value="234" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '234' ? 'selected' : '' }}>Nigeria (+234)</option>
					<option value="683" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '683' ? 'selected' : '' }}>Niue (+683)</option>
					<option value="672" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '672' ? 'selected' : '' }}>Norfolk Island (+672)</option>
					<option value="670" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '670' ? 'selected' : '' }}>Northern Mariana Islands (+670)</option>
					<option value="47" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '47' ? 'selected' : '' }}>Norway (+47)</option>
					<option value="968" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '968' ? 'selected' : '' }}>Oman (+968)</option>
					<option value="92" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '92' ? 'selected' : '' }}>Pakistan (+92)</option>
					<option value="680" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '680' ? 'selected' : '' }}>Palau (+680)</option>
					<option value="507" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '507' ? 'selected' : '' }}>Panama (+507)</option>
					<option value="675" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '675' ? 'selected' : '' }}>Papua New Guinea (+675)</option>
					<option value="595" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '595' ? 'selected' : '' }}>Paraguay (+595)</option>
					<option value="51" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '51' ? 'selected' : '' }}>Peru (+51)</option>
					<option value="63" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '63' ? 'selected' : '' }}>Philippines (+63)</option>
					<option value="48" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '48' ? 'selected' : '' }}>Poland (+48)</option>
					<option value="689" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '689' ? 'selected' : '' }}>Polynesia (French) (+689)</option>
					<option value="351" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '351' ? 'selected' : '' }}>Portugal (+351)</option>
					<option value="1-787" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-787' ? 'selected' : '' }}>Puerto Rico (+1-787)</option>
					<option value="974" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '974' ? 'selected' : '' }}>Qatar (+974)</option>
					<option value="262" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '262' ? 'selected' : '' }}>Reunion (French) (+262)</option>
					<option value="40" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '40' ? 'selected' : '' }}>Romania (+40)</option>
					<option value="7" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '7' ? 'selected' : '' }}>Russia (+7)</option>
					<option value="250" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '250' ? 'selected' : '' }}>Rwanda (+250)</option>
					<option value="290" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '290' ? 'selected' : '' }}>Saint Helena (+290)</option>
					<option value="1-869" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-869' ? 'selected' : '' }}>Saint Kitts Nevis Anguilla (+1-869)</option>
					<option value="1-758" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-758' ? 'selected' : '' }}>Saint Lucia (+1-758)</option>
					<option value="508" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '508' ? 'selected' : '' }}>Saint Pierre and Miquelon (+508)</option>
					<option value="1-784" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-784' ? 'selected' : '' }}>Saint Vincent Grenadines (+1-784)</option>
					<option value="684" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '684' ? 'selected' : '' }}>Samoa (+684)</option>
					<option value="378" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '378' ? 'selected' : '' }}>San Marino (+378)</option>
					<option value="239" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '239' ? 'selected' : '' }}>Sao Tome and Principe (+239)</option>
					<option value="966" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '966' ? 'selected' : '' }}>Saudi Arabia (+966)</option>
					<option value="221" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '221' ? 'selected' : '' }}>Senegal (+221)</option>
					<option value="381" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '381' ? 'selected' : '' }}>Serbia (+381)</option>
					<option value="248" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '248' ? 'selected' : '' }}>Seychelles (+248)</option>
					<option value="232" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '232' ? 'selected' : '' }}>Sierra Leone (+232)</option>
					<option value="65" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '65' ? 'selected' : '' }}>Singapore (+65)</option>
					<option value="421" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '421' ? 'selected' : '' }}>Slovakia (+421)</option>
					<option value="386" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '386' ? 'selected' : '' }}>Slovenia (+386)</option>
					<option value="677" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '677' ? 'selected' : '' }}>Solomon Islands (+677)</option>
					<option value="252" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '252' ? 'selected' : '' }}>Somalia (+252)</option>
					<option value="27" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '27' ? 'selected' : '' }}>South Africa (+27)</option>
					<option value="34" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '34' ? 'selected' : '' }}>Spain (+34)</option>
					<option value="94" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '94' ? 'selected' : '' }}>Sri Lanka (+94)</option>
					<option value="249" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '249' ? 'selected' : '' }}>Sudan (+249)</option>
					<option value="597" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '597' ? 'selected' : '' }}>Suriname (+597)</option>
					<option value="268" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '268' ? 'selected' : '' }}>Swaziland (+268)</option>
					<option value="46" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '46' ? 'selected' : '' }}>Sweden (+46)</option>
					<option value="41" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '41' ? 'selected' : '' }}>Switzerland (+41)</option>
					<option value="963" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '963' ? 'selected' : '' }}>Syria (+963)</option>
					<option value="886" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '886' ? 'selected' : '' }}>Taiwan (+886)</option>
					<option value="992" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '992' ? 'selected' : '' }}>Tajikistan (+992)</option>
					<option value="255" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '255' ? 'selected' : '' }}>Tanzania (+255)</option>
					<option value="66" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '66' ? 'selected' : '' }}>Thailand (+66)</option>
					<option value="228" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '228' ? 'selected' : '' }}>Togo (+228)</option>
					<option value="690" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '690' ? 'selected' : '' }}>Tokelau (+690)</option>
					<option value="676" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '676' ? 'selected' : '' }}>Tonga (+676)</option>
					<option value="1-868" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-868' ? 'selected' : '' }}>Trinidad and Tobago (+1-868)</option>
					<option value="216" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '216' ? 'selected' : '' }}>Tunisia (+216)</option>
					<option value="90" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '90' ? 'selected' : '' }}>Turkey (+90)</option>
					<option value="993" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '993' ? 'selected' : '' }}>Turkmenistan (+993)</option>
					<option value="1-649" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-649' ? 'selected' : '' }}>Turks and Caicos Islands (+1-649)</option>
					<option value="688" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '688' ? 'selected' : '' }}>Tuvalu (+688)</option>
					<option value="44" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '44' ? 'selected' : '' }}>U.K. (+44)</option>
					<option value="256" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '256' ? 'selected' : '' }}>Uganda (+256)</option>
					<option value="380" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '380' ? 'selected' : '' }}>Ukraine (+380)</option>
					<option value="971" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '971' ? 'selected' : '' }}>United Arab Emirates (+971)</option>
					<option value="598" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '598' ? 'selected' : '' }}>Uruguay (+598)</option>
					<option value="1" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1' ? 'selected' : '' }}>USA (+1)</option>
					<option value="998" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '998' ? 'selected' : '' }}>Uzbekistan (+998)</option>
					<option value="678" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '678' ? 'selected' : '' }}>Vanuatu (+678)</option>
					<option value="39" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '39' ? 'selected' : '' }}>Vatican (+39)</option>
					<option value="58" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '58' ? 'selected' : '' }}>Venezuela (+58)</option>
					<option value="84" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '84' ? 'selected' : '' }}>Vietnam (+84)</option>
					<option value="1-284" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-284' ? 'selected' : '' }}>Virgin Islands (British) (+1-284)</option>
					<option value="1-340" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '1-340' ? 'selected' : '' }}>Virgin Islands (USA) (+1-340)</option>
					<option value="681" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '681' ? 'selected' : '' }}>Wallis and Futuna Islands (+681)</option>
					<option value="967" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '967' ? 'selected' : '' }}>Yemen (+967)</option>
					<option value="260" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '260' ? 'selected' : '' }}>Zambia (+260)</option>
					<option value="263" {{ empty($data['country_code_user']) ? '' : $data['country_code_user'] == '263' ? 'selected' : '' }}>Zimbabwe (+263)</option>
				</select>

@if ($page == 'register')			
	@if (!empty($messages['country_code_user']))		
		@foreach ($messages['country_code_user'] as $key => $value)
				<span id="country_code_user_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif
		
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.mobile_phone')</label>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Mobile Phone" name="mobile_phone_user" value="{{ empty($data['mobile_phone_user']) ? '' : $data['mobile_phone_user'] }}" /> 

@if ($page == 'register')			
	@if (!empty($messages['mobile_phone_user']))	
		@foreach ($messages['mobile_phone_user'] as $key => $value)
				<span id="mobile_phone_user_user_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	
		
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.gender')</label>
				<select id="gender" name="gender" class="form-control">
					<option value="">@lang('auth.select_gender')</option>
					<option value="Male" {{ empty($data['gender']) ? '' : $data['gender'] == 'Male' ? 'selected' : '' }}>Male</option>
					<option value="Female" {{ empty($data['gender']) ? '' : $data['gender'] == 'Female' ? 'selected' : ''  }}>Female</option>
				</select>

@if ($page == 'register')		
	@if (!empty($messages['gender']))		
		@foreach ($messages['gender'] as $key => $value)
				<span id="gender_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	
		
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.date_of_birth')</label>
				<input class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" type="text" autocomplete="off" placeholder="Date of Birth" name="tanggal_lahir" value="{{ empty($data['tanggal_lahir']) ? '' : $data['tanggal_lahir'] }}" />

@if ($page == 'register')		
	@if (!empty($messages['tanggal_lahir']))		
		@foreach ($messages['tanggal_lahir'] as $key => $value)
				<span id="tanggal_lahir_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	
		
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Occupation</label>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Occupation" name="occupation" value="{{ empty($data['occupation']) ? '' : $data['occupation'] }}" /> 

@if ($page == 'register')			
	@if (!empty($messages['occupation']))	
		@foreach ($messages['occupation'] as $key => $value)
				<span id="occupation_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	
		
			</div>
		
			<p class="hint"> @lang('auth.enter_account_detail') </p>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.email')</label>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" value="{{ empty($data['email']) ? '' : $data['email'] }}"/> 

@if ($page == 'register')		
	@if (!empty($messages['email']))		
		@foreach ($messages['email'] as $key => $value)
				<span id="email_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	
		
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.password')</label>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> 

@if ($page == 'register')			
	@if (!empty($messages['password']))		
		@foreach ($messages['password'] as $key => $value)
				<span id="password_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	
		
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.retype_password')</label>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" /> 
			</div>
			<div class="form-group margin-top-20 margin-bottom-20">
				<label class="check">
					<input type="checkbox" name="tnc" /> @lang('auth.i_agree')
					<a href="javascript:;"> @lang('auth.terms_of_service') </a> @lang('auth.&')
					<a href="javascript:;"> @lang('auth.privacy_policy') </a>
				</label>
				<div id="register_tnc_error"> </div>
			</div>
			<div class="form-actions">
				<button type="button" id="register-back-btn" class="btn red btn-default">@lang('auth.back')</button>
				<button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">@lang('auth.submit')</button>
			</div>
		</form>
		<!-- END REGISTRATION FORM -->
		
		<!-- BEGIN LOGIN FORM -->
		<form class="login-form" action="{{ url('login') }}" method="post">
	
			{!! csrf_field() !!}
		
			<h3 class="form-title white ">@lang('auth.please_login')</h3>
		
			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				<span> @lang('auth.enter_email_password') </span>
			</div>
		
@if ($page == 'login')
	@if (!empty($messages) && !is_array($messages))
			<div class="alert alert-success">
				<button class="close" data-close="alert"></button>
				<span> {{ $messages }} </span>
			</div>
	@endif
@endif

@if ($page == 'login')
	@if (!empty($error) && !is_array($error))
			<div class="alert alert-danger">
				<button class="close" data-close="alert"></button>
				<span> {{ $error }} </span>
			</div>
	@endif
@endif

@if (session('messages'))
    		<div class="alert alert-success">
				<button class="close" data-close="alert"></button>
				<span>  {{ session('messages') }} </span>
			</div>
@endif

			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.email')</label>
				<input class="form-control form-control-solid placeholder-no-fix" style= "padding: 6px 5px; !important" type="text" autocomplete="off" placeholder="Email" name="email" value="{{ empty($data['email']) ? '' : $data['email'] }}" /> 

@if ($page == 'login')	
	@if (!empty($messages['email']))		
		@foreach ($messages['email'] as $key => $value)
				<span id="email_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	

			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">@lang('auth.password')</label>
				<input class="form-control form-control-solid placeholder-no-fix" style= "padding: 6px 5px; !important" type="password" autocomplete="off" placeholder="Password" name="password" /> 

@if ($page == 'login')		
	@if (!empty($messages['password']))		
		@foreach ($messages['password'] as $key => $value)
			<span id="password_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	

			</div>
			<div class="form-actions">
				<button type="submit" class="btn green uppercase">@lang('auth.login')</button>
				
				<a href="javascript:;" id="forget-password" class="forget-password white" style="color:white;margin-left: 117px;">@lang('auth.forgot_password')</a>
			</div>
			<div class="create-account">
				<p>
					<a href="javascript:;" id="register-btn" class="uppercase white" style="color:white">@lang('auth.create_an_account')</a>
				</p>
			</div>
		</form>
		<!-- END LOGIN FORM -->
	
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form class="forget-form" action="{{ url('forgotpassword') }}" method="post">
	
			{!! csrf_field() !!}
		
			<h3 class="white">@lang('auth.forget_password')</h3>			

@if ($page == 'forgotpassword')				
	@if (!empty($messages) && !is_array($messages))
			<div class="alert alert-success">
				<button class="close" data-close="alert"></button>
				<span> {{ $messages }} </span>
			</div>
	@endif
		
	@if (!empty($error) && !is_array($error))
			<div class="alert alert-danger">
				<button class="close" data-close="alert"></button>
				<span> {{ $error }} </span>
			</div>
	@endif
@endif
			<p> @lang('auth.enter_email_reset') </p>
			<div class="form-group">
				<div class="input-icon">
					<input class="form-control placeholder-no-fix" type="text" style= "padding: 6px 5px; !important" autocomplete="off" placeholder="Email" name="email" value="{{ empty($data['email']) ? '' : $data['email'] }}" /> 
				</div>
				
@if ($page == 'forgotpassword')					
	@if (!empty($messages['email']))		
		@foreach ($messages['email'] as $key => $value)
				<span id="email_{{ $key }}-error" class="help-block" style="color: #e73d4a; margin-top: 5px; margin-bottom: 5px; display: block;">{{ $value }}</span>
		@endforeach
	@endif
@endif	

			</div>
			<div class="form-actions">
				<button type="button" id="back-btn" class="btn red btn-default">@lang('auth.back')</button>
				<button type="submit" class="btn btn-success uppercase pull-right">@lang('auth.submit')</button>
			</div>
		</form>
		<!-- END FORGOT PASSWORD FORM -->
		
	</div>
	<!-- END CONTENT -->
	
	<!-- BEGIN FOOTER -->
    @include('layouts.auth.footer')
    <!-- END FOOTER -->
	
@endsection