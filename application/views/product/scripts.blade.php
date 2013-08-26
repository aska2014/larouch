<script type="text/javascript">
$(document).ready(function()
{
	$(".addCart").click(function()
	{
		var product_id = $(this).attr('id');
		product_id = product_id.replace("add_to_cart", "");
		var d = "status=add_to_cart&product_id=" + product_id+ "&quantity=" + $("#p_quantity").val();
		$("#product" + product_id).fadeTo('fast', 0.5);
		$.ajax({
			cache:false,
			type:'POST',
			url: '{{URL::to("home")}}',
			data: d,
			success:function(data)
			{
				@if(Session::get('lan') == "ar")
					$("#addCartForm").replaceWith('هذا المنتج تم إضافته للسلة.<br /><a href="{{ URL::to("shopping-cart") }}">أضغط هنا للذهاب للسلة</a>');
				@else
					$("#addCartForm").replaceWith('This Product has been added to the cart.<br /><a href="{{ URL::to("shopping-cart") }}">Go to your shopping cart</a>');
				@endif
			},
			error:function()
			{
				alert('something Went Wrong while sending data');	
				$("#product" + product_id).fadeTo('slow', 1);
			}
		});
		return false;
	});
});

</script>