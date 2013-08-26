@layout('c.master')

@section('content')
	@if($display == "add")
		@include('c.pages.add')
	@elseif($display == "edit")
		@include('c.pages.edit')
	@elseif($display == "manage")
		@include('c.pages.manage')
	@endif
@endsection