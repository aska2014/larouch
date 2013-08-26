<div class="content-box-content">
	<div style="display:block" class="tab-content" id="tab2">
		<form action="" enctype="multipart/form-data" method="post">
			<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
				<p>
					<label>Subcategory English title</label>
				 	<input class="text-input medium-input" id="medium-input" name="title_en" type="text" />
						<br>
				</p>
				<p>
					<label>Subcategory Arabic title</label>
				 	<input class="text-input medium-input" id="medium-input" name="title_ar" type="text" />
						<br>
				</p>
				<p>
					<label>Select Category</label>
				 	<select name="category_id">
				 		<option value="">Select Category</option>
				 		@foreach($categories as $category)
				 			<option value="{{ $category->id }}">{{ $category->title_en }} &nbsp &nbsp &nbsp {{ $category->title_ar }}</option>
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