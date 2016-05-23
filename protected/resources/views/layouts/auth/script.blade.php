<!--[if lt IE 9]>
<script src="{{ asset('assets/Metronic/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('assets/Metronic/global/plugins/excanvas.min.js') }}"></script> 
<![endif]-->

<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('assets/Metronic/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('page-level-plugins-bawah')
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('assets/Maxx/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('page-level-scripts')
@if (!empty(Session::get('privillege_switch') && Session::get('privillege_switch') == 'on'))
<script type="text/javascript">
jQuery(document).ready(function() {
    $('#sidebar_tab_0').click(function() {
		$.post("http://vourest.com/manager/privillege/switch", 
		{ 
			_token: '{{ csrf_token() }}'
		},
		function(data, status) 
		{
			if (data['status'] == "success")
			{
				
			}
			else
			{
				
			}
		},
		"json"
		);
	});
	
	$('#sidebar_tab_1').click(function() {
		$.post("http://vourest.com/manager/privillege/switch", 
		{ 
			_token: '{{ csrf_token() }}'
		},
		function(data, status) 
		{
			if (data['status'] == "success")
			{
				
			}
			else
			{
				
			}
		},
		"json"
		);
	});
	
	$('#change_default_restaurant').click(function() {
		$.post("http://vourest.com/manager/restaurants/by/privillege/ajax", 
		{ 
			_token: '{{ csrf_token() }}'
		},
		function(data, status) 
		{
			var responseArray = jQuery.parseJSON(data);
													
			if (responseArray['status'] == "success")
			{
				var htmlText = '<div class="form-group" id="form-select-restaurant">' +
									'<div class="input-group select2-bootstrap-prepend col-md-6" id="input-restaurant">' +
										'<select class="form-control select2" id="slug_resto" name="resto">' +
											'<option value="">Please select a restaurant</option>';
											
				$.each(responseArray['resto'], function(index, value) {
					htmlText += '<option value="' + value['slug_resto'] + '">' + value['nama_resto'] + '</option>';
				});
				
				htmlText += 			'</select>' +
									'</div>' +
								'</div>';
								
				bootbox.dialog({
					message: 
						'Please select one restaurant as default<br /><br />' +
						htmlText
						,
					title: "Welcome to Vourest Sytem",
					buttons: {
						success: {
							label: "Ok",
							className: "green",
							callback: function() {
								if ($('#slug_resto').val().length != 0)
								{
									$('#form-select-restaurant').removeClass('has-error');
									$('.help-block.help-block-error').remove();
									
									$.post( "http://vourest.com/manager/restaurant/default/ajax", 
									{ 
										_token: '{{ csrf_token() }}',
										slug_resto:	$('#slug_resto').val()
									},
									function(data, status) 
									{
										if (data["status"] == "success")
										{
											location.reload(true);
										}
										else
										{
											
										}	
									},
									"json"
									);
								}
								else 
								{
									$('#form-select-restaurant').addClass('has-error');
									$('<span id="email-error" class="help-block help-block-error">This field is required.</span>').insertAfter(".select2.select2-container.select2-container--bootstrap.select2-container--below");
									
									return false;
								}
							}
						}
					}
				});
				
				ComponentsSelect2.init();
			}
			else
			{
				
			}
		},
		"json"
		);
	});
});
</script>

@if(Request::segment(3) == 'newpromo')
	<script>
		$(document).ready(function(){
		$("#menu_hadiah").hide();
		$("#value_hadiah").hide();

			$("#resto").change(function(){
				$('#coeg').empty();
				$('#hadiah_tipe').val('');
				$("#menu_hadiah").hide();
				$("#value_hadiah").hide();
			});
			

			$("#hadiah_tipe").change(function(){

			var resto = $("#resto").val();

			if(resto == ""){
				alert("Please choose resto first!");
				resto.focus();
			}

			var hadiah = $("#hadiah_tipe").val();
			
			$.ajax({
					type: "POST",
					url : "<?php echo url('hadiahnya')?>",
					data: "hadiah="+hadiah+"&resto="+resto,
					success: function(data){
						
						if(data != "false"){
							$("#menu_hadiah").show();
							$("#value_hadiah").hide();
							$('#coeg').html(data);
						}
						else{
							$("#value_hadiah").show();
							$("#menu_hadiah").hide();
							$("#value").val('');
						}
						
					}
				});
			});


		});

	</script>
	@endif
@endif
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('assets/Metronic/layouts/layout4/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/layouts/layout4/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/Metronic/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
