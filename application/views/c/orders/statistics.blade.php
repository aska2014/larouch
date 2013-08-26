{{ HTML::script('public/plugins/flot/jquery.flot.js') }}

<div class="content-box-content">
	<div style="display: block;" class="tab-content default-tab" id="tab1">

		@if(count($statistics) < 15)
			<script type="text/javascript">
				$(function () {

				    var d2 = [
				    				    	[0, 1],
					    			    	[1, 0],
					    			    	[2, 7],
					    			    	[3, 6],
					    			    	[4, 1],
					    			    	[5, 3],
					    			    	[6, 3],
					    			    	[7, 2],
					    			    	[8, 20],
					    			    	[9, 10],
					    			    	[10, 22],
					    			    	[11, 5]
					    			    ];

				    $.plot($("#placeholder"), [d2]);
				});
			</script>
			<p style="font-size:16px; color:#900;">The website has just been launched so we can't calculate statistics for at least 4 weeks from the launching of the website<br />
				But here is a test on how would the statistics look like after these 4 weeks</p>
		@else

			<script type="text/javascript">
			$(function () {

			    var d2 = [
			    	@foreach($statistics as $statistic)
				    	[{{$statistic[0]}}, {{$statistic[1]}}],
				    @endforeach
				    ];

			    $.plot($("#placeholder"), [d2]);
			});
			</script>
			<p>It has been <b><? $end = end($statistics); echo $end[0] ?></b> weeks since this website has been launched</p>
		@endif

		<div style="margin-left:100px;">
			<div style="position:relative; color:#333; top:150px;">Orders</div>
			<div id="placeholder" style="width:600px; margin-left:50px;height:300px;"></div>
			<div style="position:relative; left:300px; color:#333; top:10px;">Weeks</div>
		</div>


	</div> <!-- End #tab1 -->
</div> <!-- End .content-box-content -->