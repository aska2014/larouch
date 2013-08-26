<div class="content-box-content">
	<div style="display: block;" class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

		<table>
			<thead>
				<tr>
				   <th width="31%">Image</th>
				   <th width="7%">Tools</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4">
						{{ $sliders->links() }}
						<div class="clear"></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
                @foreach($sliders->results as $slider)
				<tr class="alt-row" id="tr{{ $slider->id }}">
					<td><a href="{{ $slider->link }}"><img src="{{ $slider->img() }}" width="150px" /></a></td>
					<td width="7%">
						<!-- Icons -->
					<a href="{{ URL::to('larouch2012/slider/edit/'.$slider->id) }}" title="Edit"><img src="{{ URL::to('public/resources/images/icons/pencil.png') }}" alt="Edit"></a>
				    <a href="javascript:void()" onclick="deleteSlider({{ $slider->id }});" title="Delete"><img src="{{ URL::to('public/resources/images/icons/cross.png') }}" alt="Delete"></a></td>
				</tr>
                @endforeach
			</tbody>
		</table>
	</div> <!-- End #tab1 -->
</div> <!-- End .content-box-content -->

<script language="javascript" type="text/javascript">

function deleteSlider(slider_id){
	$("#tr"+slider_id).fadeTo(100,'0.2');
	$.post("{{ URL::to('larouch2012/slider/delete') }}",{slider_id: slider_id} ,function(data) {
	   $("#tr"+slider_id).hide();
	});
	return false;
}

</script>