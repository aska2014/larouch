<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Showing Order</title>

	{{ HTML::script('resources/script/jquery-1.7.1.min.js') }}
	{{ HTML::script('resources/script/print.js') }}

	<script type="text/javascript">
		function printThis()
		{
			$('#Container').printElement();	
		}
	</script>

	<style type="text/css">

		body,html{margin:0px; padding:0px; background:#999; font-size:14px; font-family:Arial, Tahoma, Geneva, sans-serif;}

		#Container{border-right:1px solid #BBB; border-left:1px solid #BBB; box-shadow: 0px 0px 10px #333; margin:0px auto; padding:20px 40px 40px 40px; width:700px; background:#FFF;}

		.clr{clear:both;}
		.print{float:right;}

		h1{margin:0px; text-align: center;}
		h2,h3{margin:0px; margin-top:20px; }
		.box{padding:10px 40px 30px 40px; border-bottom:1px solid #DDD;}

		.row{margin-top:8px;}
		.row .label{width:100px; text-align:right; margin-right:10px; color:#900;  float:left;}
		.row .info{}

		table{text-align: center; margin-top:20px;}
		table th{width:200px; padding:10px; background:#DDD;}
		table td{width:200px; padding:10px; background:#EEE;}

		.total{ margin-top:50px; font-size:18px; font-weight:bold;}
		.total span{color:#900;}

		.navigation{ position: fixed; top:100px; left:0px; }
		.navigation a{padding:20px; background:#BBB; border:1px solid #CCC; color:#900; text-decoration: none;}
		.navigation a.active{ background:#700; color:#FFF; border:0px;}

	</style>
</head>

<body>

<div class="navigation">
	<a href="{{ URL::to('larouch2012/orders') }}">Go back</a>
</div>

<div class="navigation" style="top:180px;">
	<a href="{{ URL::to('larouch2012/orders/show/'.$order->id) }}" class="active">Order Detail</a>
</div>
@if($order->stage == Auth::user()->admin_type)
<div class="navigation" style="top:260px;">
	<a href="{{ URL::to('larouch2012/orders/edit/'.$order->id) }}">Edit Order</a>
</div>
@endif

<div id="Container">
	<a href="javascript:void(0)" onclick="printThis()" class="print">Print Order</a>
	<div class="clr"></div>
	<h1>Order #{{ $order->id }}</h1>
	<h2>Member details</h2>
	<div class="box">
		<div class="row">
			<div class="label">Firstname : </div>
			<div class="info">{{ $order->member->first_name }}</div>
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Lastname : </div>
			<div class="info">{{ $order->member->last_name }}</div>
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Email : </div>
			<div class="info">{{ $order->member->email }}</div>
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Address : </div>
			<div class="info">{{ $order->address }}</div>
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Phone : </div>
			<div class="info">{{ $order->phone }}</div>
		</div>
		<div class="clr"></div>
	</div>

	<h2>Order details</h2>
	<div class="box">
		<div class="row">
			<div class="label">Deliver at : </div>
			<div class="info">{{ date('d M, Y',strtotime($order->deliver_at)) }}</div>
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Deliver range : </div>
			<div class="info">{{ $order->deliver_range }}</div>
		</div>
		<div class="clr"></div>
	</div>

	<h2>Order products</h2>
	<table>
		<thead>
			<tr>
			   <th>Product title</th>
			   <th>Product Subcategory</th>
			   <th>Product price</th>
			   <th>Quantity</th>
			</tr>
		</thead>
		<tbody>
			<? $costs = 0; ?>
			@foreach($order->products()->pivot()->get() as $row)
				<? 
					$product = Product::find($row->product_id);
					$costs += $product->price * $row->qty;
				?>

				<tr>
					<td><a href="{{ $product->url() }}">{{ $product->title_en }}</a></td>
					<td>{{ $product->subcategory->title_en }}</td>
					<td>{{ number_format($row->price, 2) }}</td>
					<td>{{ $row->qty }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="clr"></div>

	<div class="total">Total Costs : <span>{{ number_format($costs,2) }}</span></div>

</div>


</body>
</html>