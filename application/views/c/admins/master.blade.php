@layout('c.master')

@section('content')
<div class="content-box-content">
	<h2>Add new Admin</h2>
	<div style="display:block" class="tab-content" id="tab2">
		<form action="{{ URL::to('larouch2012/admins/add') }}" enctype="multipart/form-data" method="post">
			<fieldset> 
				<p>
					<label>Admin username</label>
				 	<input class="text-input medium-input" id="medium-input" name="username" type="text" />
						<br>
				</p>
				<p>
					<label>Admin password</label>
				 	<input class="text-input medium-input" id="medium-input" name="password" type="password" />
						<br>
				</p>
				<p>
					<input class="button" value="Submit" type="submit">
				</p>
			</fieldset>
			<div class="clear"></div><!-- End .clear -->
		</form>
	</div> <!-- End #tab2 -->
</div> <!-- End .content-box-content -->

<div class="content-box-content">
	<div style="display: block;" class="tab-content default-tab" id="tab1">
		<form action="{{ URL::to('larouch2012/admins/update') }}" method="post">
			<table>
				<thead>
					<tr>
					   <th width="31%">Username</th>
					   <th width="31%">Admin type</th>
					   <th width="7%">Tools</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="4">
							{{ $admins->links() }}
							<div class="clear"></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
	                @foreach($admins->results as $admin)
					<tr class="alt-row" id="tr{{ $admin->id }}">
						<td>{{ $admin->email }}</td>
						<td>
							<input type="hidden" name="ids[]" value="{{ $admin->id }}" />
							<select name="admins_type[]">
								<option value="1" <? if($admin->admin_type == 1)echo 'selected="selected"' ?>>1</option>
								<option value="2" <? if($admin->admin_type == 2)echo 'selected="selected"' ?>>2</option>
								<option value="3" <? if($admin->admin_type == 3)echo 'selected="selected"' ?>>3</option>
							</select>
						</td>
						<td width="7%">
							<a href="javascript:void()" onclick="deleteAdmin({{ $admin->id }});" title="Delete"><img src="{{ URL::to('public/resources/images/icons/cross.png') }}" alt="Delete"></a>
						</td>
					</tr>
	                @endforeach
				</tbody>
			</table>
        <input type="submit" value="Update types" />
		</form>
	</div> <!-- End #tab1 -->
</div> <!-- End .content-box-content -->
	
@endsection


<script language="javascript" type="text/javascript">

function deleteAdmin(admin_id){
	$("#tr"+admin_id).fadeTo(100,'0.2');
	$.post("{{ URL::to('larouch2012/admins/delete') }}",{admin_id: admin_id} ,function(data) {
	   $("#tr"+admin_id).hide();
	});
	return false;
}

</script>