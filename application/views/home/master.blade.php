@layout('master.master')

@section('slider')
	@include('home.slider')
@endsection

@section('body')
	@include('home.content')
	@include('home.bottom')
@endsection

@section('scripts')
	@include('home.scripts')
@endsection