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
				<a href="{{ url('home') }}" class="nav-link nav-toggle">
					<i class="icon-home"></i>
					<span class="title">Home</span>
				</a>
			</li>
			<li class="heading">
				<h3 class="uppercase">Store</h3>
			</li>
			<li class="nav-item {{ !empty($sidebar_active) && $sidebar_active == 'menu' ? 'active open' : '' }}">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-coffee"></i>
					<span class="title">Menu</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'menu list' ? 'active open' : '' }}">
						<a href="{{ url('admin/menu/list') }}" class="nav-link nav-toggle">
							<span class="title">List Menu</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'menu add' ? 'active open' : '' }}">
						<a href="{{ url('admin/menu/add') }}" class="nav-link nav-toggle">
							<span class="title">Add Menu</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav_item {{ !empty($sidebar_active) && $sidebar_active == 'store' ? 'active open' : '' }}">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-map-o"></i> 
					<span class="title">Stores</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'store list' ? 'active open' : '' }}">
						<a href="{{ url('admin/store/list') }}" class="nav-link nav-toggle">
							<span class="title">List Store</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'store add' ? 'active open' : '' }}">
						<a href="{{ url('admin/store/add') }}" class="nav-link nav-toggle">
							<span class="title">Add Store</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav_item {{ !empty($sidebar_active) && $sidebar_active == 'promo' ? 'active open' : '' }}">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-tags"></i> 
					<span class="title">Promo</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'promo list' ? 'active open' : '' }}">
						<a href="{{ url('admin/promo/list') }}" class="nav-link nav-toggle">
							<span class="title">List Promo</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'promo add' ? 'active open' : '' }}">
						<a href="{{ url('admin/promo/add') }}" class="nav-link nav-toggle">
							<span class="title">Add promo</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav_item {{ !empty($sidebar_active) && $sidebar_active == 'reward' ? 'active open' : '' }}">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-gift"></i> 
					<span class="title">Rewards</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'reward list' ? 'active open' : '' }}">
						<a href="{{ url('admin/reward/list') }}" class="nav-link nav-toggle">
							<span class="title">List Reward</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'reward add' ? 'active open' : '' }}">
						<a href="{{ url('admin/reward/add') }}" class="nav-link nav-toggle">
							<span class="title">Add Reward</span>
						</a>
					</li>
				</ul>
			</li>
			
			<li class="heading">
				<h3 class="uppercase">Member</h3>
			</li>
			<li class="nav_item {{ !empty($sidebar_active) && $sidebar_active == 'member' ? 'active open' : '' }}">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="icon-users"></i>
					<span class="title">Data Member</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'reward list' ? 'active open' : '' }}">
						<a href="{{ url('admin/member/list') }}" class="nav-link nav-toggle">
							<span class="title">List Member</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'reward add' ? 'active open' : '' }}">
						<a href="{{ url('admin/member/export') }}" class="nav-link nav-toggle">
							<span class="title">Export to XLS</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item {{ !empty($sidebar_active) && $sidebar_active == 'card' ? 'active open' : '' }}">
				<a href="{{ url('admin/card/list') }}" class="nav-link nav-toggle">
					<i class="fa fa-credit-card"></i> 
					<span class="title">Card</span>
				</a>
			</li>
			
			<li class="nav-item {{ !empty($sidebar_active) && $sidebar_active == 'job' ? 'active open' : '' }}">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-briefcase"></i>
					<span class="title">Jobs</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'job list' ? 'active open' : '' }}">
						<a href="{{ url('admin/job/list') }}" class="nav-link nav-toggle">
							<span class="title">List job</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'job add' ? 'active open' : '' }}">
						<a href="{{ url('admin/job/add') }}" class="nav-link nav-toggle">
							<span class="title">Add Job</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'job enquiries' ? 'active open' : '' }}">
						<a href="{{ url('admin/job/enquiries') }}" class="nav-link nav-toggle">
							<span class="title">Job Enquiries</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item {{ !empty($sidebar_active) && $sidebar_active == 'report' ? 'active open' : '' }}">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-file-text-o"></i>
					<span class="title">Report</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'top spending member' ? 'active open' : '' }}">
						<a href="{{ url('admin/report/topspendingmember') }}" class="nav-link nav-toggle">
							<span class="title">Top Spending Member</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'top store' ? 'active open' : '' }}">
						<a href="{{ url('admin/report/topstore') }}" class="nav-link nav-toggle">
							<span class="title">Top Store</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'member report' ? 'active open' : '' }}">
						<a href="{{ url('admin/report/members') }}" class="nav-link nav-toggle">
							<span class="title">Members</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'topup history' ? 'active open' : '' }}">
						<a href="{{ url('admin/report/topuphistory') }}" class="nav-link nav-toggle">
							<span class="title">Topup History</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'transfer history' ? 'active open' : '' }}">
						<a href="{{ url('admin/report/transferhistory') }}" class="nav-link nav-toggle">
							<span class="title">Transfer History</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="heading">
				<h3 class="uppercase">CRM</h3>
			</li>
			<li class="nav-item {{ !empty($sidebar_active) && $sidebar_active == 'send email' ? 'active open' : '' }}">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-envelope"></i>
					<span class="title">Send Email</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'send blast email' ? 'active open' : '' }}">
						<a href="{{ url('admin/sendemail/sendblastemail') }}" class="nav-link nav-toggle">
							<span class="title">Send Blast Email</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="heading">
				<h3 class="uppercase">Config</h3>
			</li>

			<li class="nav-item {{ !empty($sidebar_active) && $sidebar_active == 'config' ? 'active open' : '' }}">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-cogs"></i>
					<span class="title">Config</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'config faq' ? 'active open' : '' }}">
						<a href="{{ url('admin/config/edit/faq') }}" class="nav-link nav-toggle">
							<span class="title">FAQ</span>
						</a>
					</li>
					<li class="nav-item {{ !empty($sidebar_active_sub) && $sidebar_active_sub == 'create promo' ? 'active open' : '' }}">
						<a href="{{ url('admin/config/edit/tos') }}" class="nav-link nav-toggle">
							<span class="title">Term of Service</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="heading">
				<h3 class="uppercase">Enquiries</h3>
			</li>

			<li class="nav-item {{ !empty($sidebar_active) && $sidebar_active == 'restaurant' ? 'active open' : '' }}">
				<a href="{{ url('admin/enquiries/lostcard') }}" class="nav-link nav-toggle">
					<i class="fa fa-frown-o"></i>
					<span class="title">Lost Card</span>
				</a>
			</li>
			
			<li class="nav-item {{ !empty($sidebar_active) && $sidebar_active == 'contactus' ? 'active open' : '' }}">
				<a href="{{ url('admin/enquiries/contacus') }}" class="nav-link nav-toggle">
					<i class="fa fa-fax"></i>
					<span class="title">Contact Us</span>
				</a>
			</li>
			
		</ul>
		<!-- END SIDEBAR MENU -->
		
	</div>
	<!-- END SIDEBAR -->
	
</div>