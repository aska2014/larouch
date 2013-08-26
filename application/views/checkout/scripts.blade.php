<!-- DATE PICKER PLUGIN -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
{{ HTML::style('public/plugins/date_picker/css/jquery.ui.all.css') }}
{{ HTML::script('public/plugins/date_picker/js/jquery.ui.core.js') }}
{{ HTML::script('public/plugins/date_picker/js/jquery.ui.widget.js') }}
{{ HTML::script('public/plugins/date_picker/js/jquery.ui.datepicker.js') }}
<script>
$(function() {
	$( ".date_picker" ).datepicker();
});
</script>
