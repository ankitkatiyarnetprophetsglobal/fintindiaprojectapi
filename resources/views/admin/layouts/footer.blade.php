<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap 
<script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
-->
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="{{ asset('admin/dist/js/demo.js') }}"></script>  -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>  -->
<!--<script src="{{ asset('admin/dist/js/demo.js') }}"></script>  -->

<script type="text/javascript">
	$('#youth_state').change(function(){				
		var state_id = $('#youth_state').val();		 
		var statename = $(this).find('option:selected').attr("data-name");        		
		$.ajax({
			url: "{{ route('getyouthsdistrict') }}",
			type: "post",
			data: { "id":statename,"stname":state_id,"_token": "{{ csrf_token() }}"} ,
			success: function (response) {
			   //console.log(response);
			   $('#youth_district').html(response);
			},			
		});
	});

	$('#youth_district').change(function(){		
		var dist_id = $('#youth_district').val();
        var distname = $(this).find('option:selected').attr("data-disname");	
       		
		$.ajax({
			url: "{{ route('getyouthsblock') }}",
			type: "post",
			data: { "id":distname,"distname":dist_id,"_token": "{{ csrf_token() }}"} ,
			success: function (response) {
			    //alert(response);	
			   console.log(response);
			   if(response=='<option value="">Select Block</option>'){
			   	$('#youth_block').html('');
			   }else{
                 $('#youth_block').html(response);
			   }   
			},			
		});
	});
</script>  