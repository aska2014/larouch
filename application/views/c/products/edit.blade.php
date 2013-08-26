<div class="content-box-content">
	<div style="display:block" class="tab-content" id="tab2">
		<form action="" enctype="multipart/form-data" method="post">
			<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
				<p>
					<label>Product English title</label>
				 	<input value="{{ $product->title_en }}" class="text-input medium-input" id="medium-input" name="title_en" type="text" />
						<br>
				</p>
				<p>
					<label>Product Arabic title</label>
				 	<input value="{{ $product->title_ar }}" class="text-input medium-input" id="medium-input" name="title_ar" type="text" />
						<br>
				</p>
				<p id="addImages">
					<label>Product image</label>
					<img src="{{ URL::to('public/albums/products/product'.$product->id.'.jpg') }}" width="150" />
				    <input class="file-input" id="medium-input" name="main_image" type="file" />
				</p>
				<p>
					<label>Product price</label>
				    <input value="{{ number_format($product->price, 2) }}" class="text-input small-input" id="small-input" name="price" type="text" />
					<br>
				</p>
				<p>
					<label>Show Product in : </label>
				    <select name="type" id="type" class="small-input">
				    	<option value="">Default</option>
				    	<option value="specials">Specials</option>
				    </select>
				</p>

				<p>
					<script type="text/javascript">
						$(document).ready(function()
						{
							$("#type").val('{{ $product->type }}');
							$("#cat{{ $product->subcategory->category_id }}").show();
							$("#category_id").change(function()
							{
								$(".sub_category").attr('name', '');
								$(".sub_category").hide();
								$("#cat" + $("#category_id").val()).show();
								$("#cat" + $("#category_id").val()).attr('name', 'subcategory_id');
							});
						});
					</script>

					<label>Category</label>              
					<select name="category_id" id="category_id" class="small-input">
                    @foreach($categories as $category)
                    	@if($category->id == $product->subcategory->category_id)
                    		<option value="{{ $category->id }}" selected="selected">{{ $category->title_en }} &nbsp &nbsp &nbsp {{ $category->title_ar }}</option>
						@elseif
						<option value="{{ $category->id }}">{{ $category->title_en }} &nbsp &nbsp &nbsp {{ $category->title_ar }}</option>
						@endif
					@endforeach
                    </select>

                    @foreach($categories as $category)
						<select name="subcategory_id" id="cat{{ $category->id }}" style="display:none" class="sub_category small-input">
						@foreach($category->subcategories as $subcategory)
							@if($subcategory->id == $product->subcategory_id)
							<option selected="selected" value="{{ $subcategory->id }}">{{ $subcategory->title_en }} &nbsp &nbsp &nbsp {{ $subcategory->title_ar }}</option>
							@elseif             	
	                		<option value="{{ $subcategory->id }}">{{ $subcategory->title_en }} &nbsp &nbsp &nbsp {{ $subcategory->title_ar }}</option>
							@endif
						@endforeach
						</select>
					@endforeach
				</p>
				<p>
                    <input type="hidden" name="parse_var" value="addProduct" />
					<input class="button" value="Submit" type="submit">
				</p>
			</fieldset>
			<div class="clear"></div><!-- End .clear -->
		</form>
	</div> <!-- End #tab2 -->
</div> <!-- End .content-box-content -->