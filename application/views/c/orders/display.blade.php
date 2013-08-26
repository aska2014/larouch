<div class="content-box-content">
	<div style="display: block;" class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
		<form action="{{ URL::to('larouch2012/orders/search') }}" method="POST">
			<h6>Search by : </h6>


			<select name="member_email" class="chzn-select" data-placeholder="Member email...">
				<option value=""></option>
				@foreach($members as $member)
					<option value="{{ $member->id }}">{{ $member->email }}</option>
				@endforeach
			</select>

			<select name="member_name" class="chzn-select" data-placeholder="Member name...">
				<option value=""></option>
				@foreach($members as $member)
					<option value="{{ $member->id }}">{{ $member->name() }}</option>
				@endforeach
			</select><br /><br />
			
			<input type="submit" value= "Search" />
		</form>

		@if(isset($member_search))
		<p style="margin-top:10px; padding:5px; color:#900;">
			You are searching orders for member : {{ $member->name() }}
		</p>
		@endif

		<table style="margin-top:30px;">
			<thead>
				<tr>
				   <th>Member email</th>
				   <th>Order date</th>
				   <th>Order details</th>
				   <th>Status</th>
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
					@if($order->stage == 2)
						<td>Accepted order</td>
					@elseif($order->stage == 3)
						<td>Finished order</td>
					@else
						<td>Pinding Acception</td>
					@endif
				</tr>
                @endforeach
			</tbody>
		</table>
	</div> <!-- End #tab1 -->
</div> <!-- End .content-box-content -->