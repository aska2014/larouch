<form action="{{ URL::to('larouch2012/categories/order') }}" method="post">
	<div class="content-box-content">
		<div style="display: block;" class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
			<table>
				<thead>
					<tr>
					   <th width="31%">English Title</th>
					   <th width="31%">Arabic Title</th>
					   <th width="7%">Tools</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="4">
							{{ $categories->links() }}
							<div class="clear"></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
	                @foreach($categories->results as $category)
					<tr class="alt-row" id="tr{{ $category->id }}">
						<td>{{ $category->title_en }}</td>
						<td>{{ $category->title_ar }}</td>
						<td>
							<a href="javascript:void(0);" onclick="order({{ $category->id }},'down')"><img src="{{ URL::to('public/resources/images/down_icon.jpg') }}" style="width:15px;" /></a>
							<a href="javascript:void(0);" onclick="order({{ $category->id }},'up')"><img src="{{ URL::to('public/resources/images/up_icon.jpg') }}"  style="width:15px; margin-left:10px;"/></a>
						</td>
						<td width="7%">
	                	<input type="hidden" id="order{{ $category->id }}" name="order[]" value="{{ $category->_order }}" />
	                    <input type="hidden" id="id{{ $category->id }}" name="id[]" value="{{ $category->id }}" />
							<!-- Icons -->
						<a href="{{ URL::to('larouch2012/categories/edit/'.$category->id) }}" title="Edit"><img src="{{ URL::to('public/resources/images/icons/pencil.png') }}" alt="Edit"></alt>
					    <a href="javascript:void()" onclick="deleteCategory({{ $category->id }});" title="Delete"><img src="{{ URL::to('public/resources/images/icons/cross.png') }}" alt="Delete"></a>
					</td>
					</tr>
	                @endforeach
				</tbody>
			</table>
	        <input type="submit" value="Update orders" />
		</div> <!-- End #tab1 -->
	</div> <!-- End .content-box-content -->
</form>

<script language="javascript" type="text/javascript">

function deleteCategory(category_id){
	$("#tr"+category_id).fadeTo(100,'0.2');
	$.post("{{ URL::to('larouch2012/categories/delete') }}",{category_id: category_id} ,function(data) {
	   $("#tr"+category_id).hide();
	});
	return false;
}

function order(sub_id,status){
	if(status == "up")
	{
		var prev_sub_id = $("#tr" + sub_id).prev('.alt-row').attr('id').replace("tr","");
		var temp = $("#order" + sub_id).val();
		$("#order" + sub_id).val($("#order" + prev_sub_id).val());
		$("#order" + prev_sub_id).val(temp);
		$("#tr" + sub_id).prev('.alt-row').before($("#tr"+sub_id));
	}
	else
	{
		var prev_sub_id = $("#tr" + sub_id).next('.alt-row').attr('id').replace("tr","");
		var temp = $("#order" + sub_id).val();
		$("#order" + sub_id).val($("#order" + prev_sub_id).val());
		$("#order" + prev_sub_id).val(temp);
		$("#tr" + sub_id).next('.alt-row').after($("#tr"+sub_id));
	}
}

</script>