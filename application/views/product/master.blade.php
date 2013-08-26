@layout('master.master')

@section('slider')
	@include('product.content')
@endsection

@section('body')
	@include('product.bottom')
@endsection

@section('scripts')
	@include('product.scripts')
@endsection