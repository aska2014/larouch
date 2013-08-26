<script type="text/javascript">
$(document).ready(function()
{
	$("#left_panel").height($("#products").height());

	$("#left_panel").find('.icon').each(function()
	{
		$(this).click(function()
		{
			if($(this).parent().find('ul').is(':visible'))
			{
				$(this).parent().find('ul').slideUp('fast');
				@if(Session::get('lan') == "ar")
					$(this).css('background', 'url({{ URL::to_asset("public/css/themes/brown/images/arrow_left.png") }}) no-repeat');
				@else
					$(this).css('background', 'url({{ URL::to_asset("public/css/themes/brown/images/arrow2.png") }}) no-repeat');
				@endif
			}
			else
			{
				$(this).parent().find('ul').slideDown('fast');
				$(this).css('background', 'url({{ URL::to_asset("public/css/themes/brown/images/arrow3.png") }}) no-repeat');
			}	
		});
	});

	

	$(".cart_btn").click(function()
	{
		var product_id = $(this).parent().parent().attr('id');
		product_id = product_id.replace("product", "");
		if($(this).attr('class') == "cart_btn add_to_cart")
		{
			var d = "status=add_to_cart&product_id=" + product_id;
			$("#product" + product_id).fadeTo('fast', 0.5);
			$.ajax({
				cache:false,
				type:'POST',
				data: d,
				success:function(data)
				{
					$("#product" + product_id).find('.add_to_cart').removeClass('add_to_cart').addClass('remove_from_cart');
					$("#product" + product_id).fadeTo('slow', 1);
				},
				error:function()
				{
					alert('something Went Wrong while sending data');	
					$("#product" + product_id).fadeTo('slow', 1);
				}
			});
		}
		else if($(this).attr('class') == "cart_btn remove_from_cart")
		{
			var d = "status=remove_from_cart&product_id=" + product_id;

			$("#product" + product_id).fadeTo(300, 0.5);
			$.ajax({
				cache:false,
				type:'POST',
				data: d,
				success:function(data)
				{
					$("#product" + product_id).find('.remove_from_cart').removeClass('remove_from_cart').addClass('add_to_cart');
					$("#product" + product_id).fadeTo('slow', 1);
				},
				error:function()
				{
					alert('something Went Wrong while sending data');	
					$("#product" + product_id).fadeTo('slow', 1);
				}
			});
		}
	});
});
</script>