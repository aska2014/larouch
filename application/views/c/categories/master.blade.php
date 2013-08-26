@layout('c.master')

@section('content')
	@if($page == "add")
		@include('c.categories.add')
	@elseif($page == "edit")
		@include('c.categories.edit')
	@elseif($page == "manage")
		@include('c.categories.manage')
	@endif
@endsection