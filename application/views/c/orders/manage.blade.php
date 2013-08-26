<div class="content-box-content">
	<div style="display: block;" class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
		<table>
			<thead>
				<tr>
				   <th>Member email</th>
				   <th>Order date</th>
				   <th>Order details</th>
				   <th>Accept</th>
				   <th width="7%">Tools</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4">
						{{ $orders->links() }}
						<div class="clear"></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
                @foreach($orders->results as $order)
				<tr class="alt-row" id="tr{{ $order->id }}">
					<td>{{ $order->member->email }}</td>
					<td>{{ $order->date() }}</td>
					<td><a href="{{ URL::to('larouch2012/orders/show/'.$order->id) }}" title="Show">Order details</a></td>
					@if($order->stage == 1)
						<td><a href="{{ URL::to('larouch2012/orders/accept/'.$order->id) }}" title="Accept">Accept order</a></td>
					@elseif($order->stage == 2)
						<td><a href="{{ URL::to('larouch2012/orders/finished/'.$order->id) }}" title="Finished">Order finished</a></td>
					@endif
					<td width="7%">
						<a href="{{ URL::to('larouch2012/orders/edit/'.$order->id) }}" title="Edit"><img src="{{ URL::to('public/resources/images/icons/pencil.png') }}" alt="Edit"></alt>
				    	<a href="javascript:void()" onclick="deleteOrder({{ $order->id }});" title="Delete"><img src="{{ URL::to('public/resources/images/icons/cross.png') }}" alt="Delete"></a>
					</td>
				</tr>
                @endforeach
			</tbody>
		</table>
	</div> <!-- End #tab1 -->
</div> <!-- End .content-box-content -->

<script language="javascript" type="text/javascript">

function deleteOrder(order_id){
	$("#tr"+order_id).fadeTo(100,'0.2');
	$.post("{{ URL::to('larouch2012/orders/delete') }}",{order_id: order_id} ,function(data) {
	   $("#tr"+order_id).hide();
	});
	return false;
}
</script>