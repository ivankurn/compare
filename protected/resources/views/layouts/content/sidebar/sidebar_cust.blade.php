<div class="page-sidebar-wrapper">

	<!-- BEGIN SIDEBAR -->
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
		<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
		<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
		<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		
		<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<li class="nav-item start {{ !empty($sidebar_active) && $sidebar_active == 'home' ? 'active open' : '' }}">
				<a href="{{ URL::to('home') }}" class="nav-link nav-toggle">
					<i class="fa fa-home"></i>
					<span class="title">Home</span>
				</a>
			</li>
			
			<li class="heading">
				<h3 class="uppercase">Information</h3>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'menu' ? 'active open' : '' }}">
				<a href="{{ URL::to('menu') }}" class="nav-link nav-toggle">
					<i class="fa fa-coffee"></i> 
					<span class="title">Menu</span>
				</a>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'stores' ? 'active open' : '' }}">
				<a href="{{ URL::to('stores') }}" class="nav-link nav-toggle">
					<i class="fa fa-map-o"></i> 
					<span class="title">Stores</span>
				</a>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'promo' ? 'active open' : '' }}">
				<a href="{{ URL::to('promotions') }}" class="nav-link nav-toggle">
					<i class="fa fa-tags"></i> 
					<span class="title">Promo</span>
				</a>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'rewards' ? 'active open' : '' }}">
				<a href="{{ URL::to('rewards') }}" class="nav-link nav-toggle">
					<i class="fa fa-gift"></i> 
					<span class="title">Rewards</span>
				</a>
			</li>
			
			<li class="heading">
				<h3 class="uppercase">Cards</h3>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'my cards' ? 'active open' : '' }}">
				<a href="{{ URL::to('cards') }}" class="nav-link nav-toggle">
					<i class="fa fa-credit-card"></i> 
					<span class="title">My Cards</span>
				</a>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'add card' ? 'active open' : '' }}">
				<a href="{{ URL::to('cards') }}/add" class="nav-link nav-toggle">
					<i class="fa fa-plus-square-o"></i> 
					<span class="title">Add Card</span>
				</a>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'topup' ? 'active open' : '' }}">
				<a href="{{ URL::to('cards') }}/topup" class="nav-link nav-toggle">
					<i class="fa fa-money"></i> 
					<span class="title">Balance Topup</span>
				</a>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'transfer' ? 'active open' : '' }}">
				<a href="{{ URL::to('cards') }}/transfer" class="nav-link nav-toggle">
					<i class="fa fa-exchange"></i> 
					<span class="title">Balance Transfer</span>
				</a>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'lost card' ? 'active open' : '' }}">
				<a href="{{ URL::to('cards') }}/lost" class="nav-link nav-toggle">
					<i class="fa fa-exclamation-triangle"></i> 
					<span class="title">Report Lost Card</span>
				</a>
			</li>
			
			<li class="heading">
				<h3 class="uppercase">Profile</h3>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'profile' ? 'active open' : '' }}">
				<a href="{{ URL::to('profile') }}" class="nav-link nav-toggle">
					<i class="fa fa-user"></i> 
					<span class="title">Profile</span>
				</a>
			</li>
			
			<li class="heading">
				<h3 class="uppercase">About</h3>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'about' ? 'active open' : '' }}">
				<a href="{{ URL::to('about') }}" class="nav-link nav-toggle">
					<i class="fa fa-info-circle"></i> 
					<span class="title">About Maxx Coffee</span>
				</a>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'faq' ? 'active open' : '' }}">
				<a href="{{ URL::to('faq') }}" class="nav-link nav-toggle">
					<i class="fa fa-comments"></i> 
					<span class="title">FAQ</span>
				</a>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'tos' ? 'active open' : '' }}">
				<a href="{{ URL::to('tos') }}" class="nav-link nav-toggle">
					<i class="fa fa-list-alt"></i> 
					<span class="title">Terms of Service</span>
				</a>
			</li>
			<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'contact' ? 'active open' : '' }}">
				<a href="{{ URL::to('contact') }}" class="nav-link nav-toggle">
					<i class="fa fa-paper-plane-o"></i> 
					<span class="title">Contact Us</span>
				</a>
			</li>
		</ul>
		<!-- END SIDEBAR MENU -->
		
	</div>
	<!-- END SIDEBAR -->
	
</div>