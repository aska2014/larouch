@layout('c.master')

@section('content')
	@if($page == "add")
		@include('c.subcategories.add')
	@elseif($page == "edit")
		@include('c.subcategories.edit')
	@elseif($page == "manage")
		@include('c.subcategories.manage')
	@endif
@endsection