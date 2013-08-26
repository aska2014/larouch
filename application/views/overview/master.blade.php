@layout('master.master')

@section('slider')
	@if($subcategory)
		@include('overview.content_sub')
	@else
		@include('overview.content')
	@endif
@endsection