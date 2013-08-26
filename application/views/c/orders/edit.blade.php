<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Showing Order</title>

	<!-- DATE PICKER PLUGIN -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	{{ HTML::style('public/plugins/date_picker/css/jquery.ui.all.css') }}
	{{ HTML::script('public/plugins/date_picker/js/jquery.ui.core.js') }}
	{{ HTML::script('public/plugins/date_picker/js/jquery.ui.widget.js') }}
	{{ HTML::script('public/plugins/date_picker/js/jquery.ui.datepicker.js') }}
	<script>
	$(function() {
		$( ".date_picker" ).datepicker();
	});
	</script>

	<style type="text/css">

		body,html{margin:0px; padding:0px; background:#999; font-size:14px; font-family:Arial, Tahoma, Geneva, sans-serif;}

		#Container{border-right:1px solid #BBB; border-left:1px solid #BBB; box-shadow: 0px 0px 10px #333; margin:0px auto; padding:20px 40px 40px 40px; width:700px; background:#FFF;}

		.clr{clear:both;}
		.print{float:right;}

		h1{margin:0px; text-align: center;}
		h2,h3{margin:0px; margin-top:20px; }
		h2 small{color:#900; float:right; font-size:12px; font-weight: normal;}
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

		.sbmt{background:#333; border:1px solid #000; padding:10px; color:#FFF; cursor: pointer; float:right; margin-top:50px;}

	</style>
</head>

<body>

<div class="navigation">
	<a href="{{ URL::to('larouch2012/orders') }}">Go back</a>
</div>

<div class="navigation" style="top:180px;">
	<a href="{{ URL::to('larouch2012/orders/show/'.$order->id) }}">Order Detail</a>
</div>

<div class="navigation" style="top:260px;">
	<a href="{{ URL::to('larouch2012/orders/edit/'.$order->id) }}" class="active">Edit Order</a>
</div>

<div id="Container">
	<h1>Order #{{ $order->id }}</h1>
	<h2>Member details</h2>
	<form action="{{ URL::to('larouch2012/orders/edit/'.$order->id) }}" method="POST">
	<div class="box">
		<div class="row">
			<div class="label">Firstname : </div>
			<input type="text" name="first_name" value="{{ $order->member->first_name }}" />
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Lastname : </div>
			<input type="text" name="last_name" value="{{ $order->member->last_name }}" />
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Email : </div>
			<input type="text" name="email" value="{{ $order->member->email }}" />
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Address : </div>
			<input type="text" name="address" value="{{ $order->member->address }}" />
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Phone : </div>
			<input type="text" name="phone" value="{{ $order->member->phone }}" />
		</div>
		<div class="clr"></div>
	</div>

	<h2>Order details</h2>
	<div class="box">
		<div class="row">
			<div class="label">Deliver at : </div>
    	    <input type="text" name="deliver_at" value="{{ date('n/j/Y',strtotime($order->deliver_at)) }}" class="date_picker" />
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Deliver range : </div>
	        <select id="deliver_range" name="deliver_range">
	          <option value="As soon as possible">{{ l('As soon as possible') }}</option>
	          <option value="8.00 - 10.00 AM">8.00 - 10.00 AM</option>
	          <option value="10.00 - 12.00 AM">10.00 - 12.00 AM</option>
	          <option value="12.00 - 2.00 PM">12.00 - 2.00 PM</option>
	          <option value="2.00 - 4.00 PM">2.00 - 4.00 PM</option>
	          <option value="4.00 - 6.00 PM">4.00 - 6.00 PM</option>
	          <option value="6.00 - 8.00 PM">6.00 - 8.00 PM</option>
	        </select>
	        <script type="text/javascript">
	        	$(document).ready(function()
	        	{
		        	$("#deliver_range").val("{{ $order->deliver_range }}");
	        	});
	        </script>
		</div>
		<div class="clr"></div>
	</div>

	<h2>Order products </h2>
	<table>
		<thead>
			<tr>
			   <th>Product title</th>
			   <th>Product Subcategory</th>
			   <th>Product price</th>
			   <th>Quantity</th>
			   <th>Remove</th>
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
					<td><input type="text" name="prices[]" value="{{ number_format($row->price,2) }}" /></td>
					<td><input type="text" style="width:30px;" name="qtys[]" value="{{ $row->qty }}" /></td>
					<td><input type="checkbox" name="removes[]" value="yes" /></td>
					<input type="hidden" name="intermediate_ids[]" value="{{ $row->id }}" />
					<input type="hidden" name="product_ids[]" value="{{ $product->id }}" />
				</tr>
			@endforeach
			<tr>
				<td colspan="4"><a href="{{ URL::to('larouch2012/orders/add_product/'.$order->id) }}">Add new Product</a></td>
			</tr>
		</tbody>
	</table>
	<div class="clr"></div>

	<input type="submit" value="Update Order" class="sbmt" />
	</form>
	<div class="total">Total Costs : <span>{{ number_format($costs,2) }}</span></div>

</div>


</body>
</html>