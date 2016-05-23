<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<div class="page-header-inner container">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="{{URL::to('home')}}">
				<img src="{{ url('assets/Maxx/pages/img/logo-big-white.png') }}" alt="logo" class="logo-default" style="margin: 15px 10px 0;" width="150px"/> </a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
		<!-- END RESPONSIVE MENU TOGGLER -->

		<div class="page-top">
			<!-- BEGIN TOP NAVIGATION MENU -->
			
				<form class="search-form" action="{{URL::to('search')}}" method="POST">
					<div class="input-group">
						<input class="form-control input-sm" placeholder="Search..." name="query" type="text">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<span class="input-group-btn">
							<a href="javascript:;" class="btn submit">
								<i class="icon-magnifier"></i>
							</a>
						</span>
					</div>
				</form>
				<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					@if(isset($unread_count))
					<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-bell"></i>
							@if($unread_count>0)
							<span class="badge badge-success" style="background-color: rgb(210, 208, 50) !important;font-size: 12px !important;"> {{$unread_count}} </span>
							@endif
						</a>
						<ul class="dropdown-menu">
							<li class="external">
								<h3>
									<span class="bold">{{$unread_count}} pending</span> notifications</h3>
								<a href="{{URL::to('notifications')}}">view all</a>
							</li>
							<li>
								@if($unread_count != '0')
								<ul class="dropdown-menu-list scroller" style="height: 300px" data-handle-color="#637283">
									@foreach($unread as $row)
									<li>
										<a href="{{URL::to('notifications')}}">
											<span class="time">{{$row['time_ago']}}</span>
											<span class="details">
												@if(stristr($row['subject'], "Pending"))
													<span class="label label-sm label-icon label-info">
														<i class="fa fa-hourglass-start"></i>
													</span>{{$row['subject']}}</span>
												@elseif(stristr($row['subject'], "Approved"))
													<span class="label label-sm label-icon label-success">
														<i class="fa fa-thumbs-o-up"></i>
													</span>{{$row['subject']}}</span>
												@elseif(stristr($row['subject'], "Declined"))
													<span class="label label-sm label-icon label-danger">
														<i class="fa fa-thumbs-o-down"></i>
													</span>{{$row['subject']}}</span>
												@elseif(stristr($row['subject'], "Cleared"))
													<span class="label label-sm label-icon label-success">
														<i class="fa fa-motorcycle"></i>
													</span>{{$row['subject']}}</span>
												@else
													<span class="label label-sm label-icon label-success">
														<i class="fa fa-info"></i>
													</span>{{$row['subject']}}</span>
												@endif
										</a>
									</li>
									@endforeach
								</ul>
								@endif
							</li>
						</ul>
					</li>
					@endif
					<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
						<a href="{{ url('home') }}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-wallet"></i>
							<span class="badge badge-success" style="font-size: 12px !important;;background-color: rgb(50, 210, 97) !important;" id="saldonya"> IDR <?php  echo number_format(Auth::user()->saldo, 0, '.', ',') ?></span>
						</a>
					</li>
					
					<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
						<a href="{{ url('redeemable') }}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-diamond"></i>
							<span class="badge badge-success" style="font-size: 12px !important;"> <?php  echo number_format(Auth::user()->total_point_resto, 0, '.', ',') ?></span>
						</a>
					</li>
@if (!empty(Session::get('lv') && Session::get('lv') == 'Manager Resto'))
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="fa fa-cutlery"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="#" id="change_default_restaurant">
									<i class="fa fa-cutlery"></i> Restaurant Default
								</a>
							</li>
						</ul>
					</li>
@endif
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<span class="username username-hide-on-mobile"> {{ Auth::user()->nama_user }} </span>
							<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
							@if(empty(Auth::user()->foto))
								<img alt="{{ Auth::user()->nama_user }}" class="img-circle" src="{{URL::to('assets/Maxx/pages/img/profile/')}}/default-male.png" /> </a>
							@else
								<img alt="{{ Auth::user()->nama_user }}" class="img-circle" src="{{URL::to('assets/Maxx/pages/img/profile/')}}/{{ Auth::user()->foto }}" /> </a>
							@endif
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								@if(Session::get('lv') == "Customer")
									<a href="{{ url('profile') }}">	<i class="icon-user"></i> My Profile </a>
								@elseif(Session::get('lv') == "Admin Sistem")
									<a href="{{ url('admin/profile') }}">	<i class="icon-user"></i> My Profile </a>
								@elseif(Session::get('lv') == "Owner Resto")
									<a href="{{ url('owner/profile') }}">	<i class="icon-user"></i> My Profile </a>
								@elseif(Session::get('lv') == "Manager Resto")
									<a href="{{ url('manager/profile') }}">	<i class="icon-user"></i> My Profile </a>
								@endif

							</li>
							<li>
								<a href="{{ url('/logout') }}">
									<i class="icon-key"></i> Log Out 
								</a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END PAGE TOP -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->