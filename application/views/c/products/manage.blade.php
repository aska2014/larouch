<div class="content-box-content">
	<div style="display: block;" class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
		<form action="{{ URL::to('larouch2012/products/search') }}" method="POST">
			<h6>Search by : </h6>

			<style type="text/css">
				ul.chzn-results li{background:none;}
			</style>

			<select name="subcategory_id" style="width:300px;" class="chzn-select" data-placeholder="SubCategory name...">
				<option value=""></option>
				@foreach($search_subcategories as $subcategory)
					<option value="{{ $subcategory->id }}">{{ $subcategory->title_en }} &nbsp &nbsp &nbsp {{ $subcategory->title_ar }}</option>
				@endforeach
			</select>

			<select name="product_id" class="chzn-select" data-placeholder="Product name...">
				<option value=""></option>
				@foreach($search_products as $product)
					<option value="{{ $product->id }}">{{ $product->title_en }}</option>
				@endforeach
			</select><br /><br />
			
			<input type="submit" value= "Search" />
		</form>
		<table>
			<thead>
				<tr>
				   <th width="31%">English Title</th>
				   <th width="31%">Arabic Title</th>
				   <th width="31%">Subcategory</th>
				   <th width="7%">Tools</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4">
						{{ $products->links() }}
						<div class="clear"></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
                @foreach($products->results as $product)
				<tr class="alt-row" id="tr{{ $product->id }}">
					<td><a href="{{ $product->url() }}">{{ $product->title_en }}</a></td>
					<td><a href="{{ $product->url() }}">{{ $product->title_ar }}</a></td>
					<td>{{ $product->subcategory->title_en }}</td>
					<td width="7%">
						<!-- Icons -->
					<a href="{{ URL::to('larouch2012/products/edit/'.$product->id) }}" title="Edit"><img src="{{ URL::to('public/resources/images/icons/pencil.png') }}" alt="Edit"></a>
				    <a href="javascript:void()" onclick="deleteProduct({{ $product->id }});" title="Delete"><img src="{{ URL::to('public/resources/images/icons/cross.png') }}" alt="Delete"></a></td>
				</tr>
                @endforeach
			</tbody>
		</table>
	</div> <!-- End #tab1 -->
</div> <!-- End .content-box-content -->

<script language="javascript" type="text/javascript">

function deleteProduct(product_id){
	$("#tr"+product_id).fadeTo(100,'0.2');
	$.post("{{ URL::to('larouch2012/products/delete') }}",{product_id: product_id} ,function(data) {
	   $("#tr"+product_id).hide();
	});
	return false;
}

</script>