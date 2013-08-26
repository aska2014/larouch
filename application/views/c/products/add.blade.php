<div class="content-box-content">
	<div style="display:block" class="tab-content" id="tab2">
		<form action="" enctype="multipart/form-data" method="post">
			<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
				<p>
					<label>Product English title</label>
				 	<input class="text-input medium-input" id="medium-input" name="title_en" type="text" />
						<br>
				</p>
				<p>
					<label>Product Arabic title</label>
				 	<input class="text-input medium-input" id="medium-input" name="title_ar" type="text" />
						<br>
				</p>
				<p id="addImages">
					<label>Product image</label>
				    <input class="file-input" id="medium-input" name="main_image" type="file" />
				</p>
				<p>
					<label>Product price</label>
				    <input class="text-input small-input" id="small-input" name="price" type="text" />
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
					@endforeach
				</p>
				<p>
					<input class="button" value="Submit" type="submit">
				</p>
			</fieldset>
			<div class="clear"></div><!-- End .clear -->
		</form>
	</div> <!-- End #tab2 -->
</div> <!-- End .content-box-content -->