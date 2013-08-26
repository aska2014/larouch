<div class="content-box-content">
	<h2>Add Products in Order #{{ $order->id }} 
		<a href="{{ URL::to('larouch2012/orders/show/'.$order->id) }}" style="font-size:14px; text-decoration:underline;"> Or Go back to order</a></h2>

	<div style="display:block" class="tab-content" id="tab2">
		<form action="" enctype="multipart/form-data" method="post" style="padding-top:10px;">
			<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
				<p>
					<script type="text/javascript">
						$(document).ready(function()
						{
							$("#category_id").change(function()
							{
								$(".sub_category").attr('name', '');
								$(".sub_category").hide();
								$("#cat" + $("#category_id").val()).show();
								$("#cat" + $("#category_id").val()).attr('name', 'subcategory_id');
							});
						});
					</script>

					<label>Category > Subcategory > Product</label>              
					<select name="category_id" id="category_id" class="small-input">
                    <option value="">Select category</option>
                    @foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->title_en }} &nbsp &nbsp &nbsp {{ $category->title_ar }}</option>
					@endforeach
                    </select>

                    @foreach($categories as $category)
						<select name="subcategory_id" id="cat{{ $category->id }}" style="display:none" class="sub_category small-input">
							<option value="">Select Subcategory</option>
							@foreach($category->subcategories as $subcategory)

		                		<option value="{{ $subcategory->id }}">{{ $subcategory->title_en }} &nbsp &nbsp &nbsp {{ $subcategory->title_ar }}</option>
							@endforeach
						</select>

						<script type="text/javascript">
							$(document).ready(function()
							{
								$("#cat{{ $category->id }}").change(function()
								{
									$(".product_id").attr('name', '');
									$(".product_id").hide();
									$("#subcategory" + $("#cat{{ $category->id }}").val()).show();
									$("#subcategory" + $("#cat{{ $category->id }}").val()).attr('name', 'product_id');
								});
							});
						</script>

						@foreach($category->subcategories as $subcategory)
							<select name="product_id" id="subcategory{{ $subcategory->id }}" style="display:none" class="product_id small-input">
								<option value="">Select Product</option>
								@foreach($subcategory->products as $product)
			                		<option value="{{ $product->id }}">{{ $product->title_en }} &nbsp &nbsp &nbsp {{ $product->title_ar }}</option>
								@endforeach
							</select>
						@endforeach

					@endforeach
				</p>
				<p>
					<label>Quantity</label>
				 	<input class="text-input medium-input" id="medium-input" name="quantity" type="text" />
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