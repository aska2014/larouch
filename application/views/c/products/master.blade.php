@layout('c.master')

@section('content')
	@if($page == "add")
		@include('c.products.add')
	@elseif($page == "edit")
		@include('c.products.edit')
	@elseif($page == "manage")
		@include('c.products.manage')
	@endif
@endsection



@section('scripts')
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>

	{{ HTML::style('public/plugins/chosen/chosen.css') }}
	{{ HTML::script('public/plugins/chosen/chosen.jquery.min.js') }}

	<script type="text/javascript">
		$(document).ready(function(){
			$(".chzn-select").chosen();
			$(".chzn-select-deselect").chosen({allow_single_deselect:true}); 

			$(".chzn-results li").css({'background':'none'});
		});

	</script>

@endsection