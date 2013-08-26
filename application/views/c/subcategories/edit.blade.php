<div class="content-box-content">
	<div style="display:block" class="tab-content" id="tab2">
		<form action="" enctype="multipart/form-data" method="post">
			<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
				<p>
					<label>Subcategory English title</label>
				 	<input value="{{ $subcategory->title_en }}" class="text-input medium-input" id="medium-input" name="title_en" type="text" />
						<br>
				</p>
				<p>
					<label>Subcategory Arabic title</label>
				 	<input value="{{ $subcategory->title_ar }}" class="text-input medium-input" id="medium-input" name="title_ar" type="text" />
						<br>
				</p>
				<p>
					<label>Select Category</label>
				 	<select name="category_id">
				 		@foreach($categories as $category)
				 			@if($category->id == $subcategory->category_id)
				 				<option value="{{ $category->id }}" selected="selected">{{ $category->title_en }} &nbsp &nbsp &nbsp {{ $category->title_ar }}</option>
				 			@elseif
				 				<option value="{{ $category->id }}">{{ $category->title_en }} &nbsp &nbsp &nbsp {{ $category->title_ar }}</option>
				 			@endif
				 		@endforeach
				 	</select>
				</p>
				<p>
					<input class="button" value="Submit" type="submit">
				</p>
			</fieldset>
			<div class="clear"></div><!-- End .clear -->
		</form>
	</div> <!-- End #tab2 -->
</div> <!-- End .content-box-content -->