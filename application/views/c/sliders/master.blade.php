@layout('c.master')

@section('content')
	@if($page == "add")
		@include('c.sliders.add')
	@elseif($page == "edit")
		@include('c.sliders.edit')
	@elseif($page == "manage")
		@include('c.sliders.manage')
	@endif
@endsection