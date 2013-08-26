@layout('master.master')

@section('slider')
	@if(isset($second) && $second)
		@include('checkout.content2')
	@else
		@include('checkout.content')
	@endif
@endsection

@section('scripts')
	@include('checkout.scripts')
@endsection