@layout('c.master')

@section('content')
	@if($page == "admins")
		@include('c.help.admins')
	@elseif($page == "orders")
		@include('c.help.orders')
	@endif
@endsection