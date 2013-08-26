<div class="content-box-content">
	<div style="display:block" class="tab-content" id="tab2">
		<form action="" enctype="multipart/form-data" method="post">
			<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
				<p>
					<label>English Quality Gurantee</label>
				 	<input value="{{ $product->quality_en }}" class="text-input medium-input" id="medium-input" name="quality_en" type="text" />
						<br>
				</p>
				<p>
					<label>Arabic Quality Gurantee</label>
				 	<input value="{{ $product->quality_ar }}" class="text-input medium-input" id="medium-input" name="quality_ar" type="text" />
						<br>
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