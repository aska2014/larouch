<div class="content-box-content">
	<div style="display:block" class="tab-content" id="tab2">
		<form action="" enctype="multipart/form-data" method="post">
			<fieldset>
				<p>
					<label>Slider image</label>
					<img src="{{ URL::to('public/albums/sliders/slider'.$slider->id.'.jpg') }}" width="150" />
				    <input class="file-input" id="medium-input" name="main_image" type="file" />
				</p>
				<p id="addImages">
					<label>Image link to</label>
					<input value="{{ $slider->link }}" class="text-input medium-input" id="medium-input" name="link" type="text" />
				</p>
				<p>
					<input class="button" value="Submit" type="submit">
				</p>
			</fieldset>
			<div class="clear"></div><!-- End .clear -->
		</form>
	</div> <!-- End #tab2 -->
</div> <!-- End .content-box-content -->