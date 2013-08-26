<div class="content-box-content">
	<div style="display:block" class="tab-content" id="tab2">
		<form action="" enctype="multipart/form-data" method="post">
			<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
				<p>
					<label>Page English title</label>
				 	<input value="{{ $page->title_en }}" class="text-input medium-input" id="medium-input" name="title_en" type="text" />
						<br>
				</p>
				<p>
					<label>Page Arabic title</label>
				 	<input value="{{ $page->title_ar }}" class="text-input medium-input" id="medium-input" name="title_ar" type="text" />
						<br>
				</p>
				<p>
					<label>Page English content</label>
				 	<textarea class="text-input textarea" name="content_en" cols="79" rows="20">
				 		{{ $page->content_en }}
				 	</textarea>
				</p>
				<p>
					<label>Page Arabic content</label>
				 	<textarea class="text-input textarea" name="content_ar" cols="79" rows="20">
				 		{{ $page->content_ar }}
				 	</textarea>
				</p>
				<p>
					<input class="button" value="Submit" type="submit">
				</p>
			</fieldset>
			<div class="clear"></div><!-- End .clear -->
		</form>
	</div> <!-- End #tab2 -->
</div> <!-- End .content-box-content -->

{{ HTML::script('resources/editor/nicEdit.js') }}
<script type="text/javascript">
    bkLib.onDomLoaded(function() { 
		nicEditors.allTextAreas({iconsPath: '{{ URL::to("public/resources/editor/nicEditorIcons.gif") }}'});
	});
</script>