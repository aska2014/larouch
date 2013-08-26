<div class="content-box-content">
	<div style="display:block" class="tab-content" id="tab2">
		<style type="text/css">
			p{font-size:14px;}
			ol{margin-left:20px; font-size:13px; font-family: Tahoma; line-height: 20px; }
			ol li ol{margin-bottom:20px;}
			ol li b{color:#F00; font-size:12px;}
		</style>
		<p><strong>Admins are divided into three types :</strong> 
			<ol>
				<li>One that manages orders, his tasks are : <? if(Auth::user()->admin_type == '1') echo '<b>You are this type of admin</b>' ?>
					<ol>
						<li>Manage orders in it's first stage which include (display order details, print order, edit order and add products in the order) </li>
						<li>Accept orders to send them to next stage ( stage 2 )</li>
						<li>Display Accepted and finished orders ( orders in stage 2 and 3 )</li>
					</ol>
				</li>
				<li>One that manages orders, his tasks are : <? if(Auth::user()->admin_type == '2') echo '<b>You are this type of admin</b>' ?>
					<ol>
						<li>Manage orders in it's second stage which include (display order details, print order, edit order and add products in the order) </li>
						<li>Finish orders to send them to next stage ( stage 3 )</li>
						<li>Display finished orders ( orders in stage 3 )</li>
					</ol>
				</li>
				<li>One that manages the rest of the website, his tasks are : <? if(Auth::user()->admin_type == '3') echo '<b>You are this type of admin</b>' ?>
					<ol>
						<li>Manage products ( add, display, edit )</li>
						<li>Manage categories ( add, display, edit )</li>
						<li>Manage subcategories ( add, display, edit )</li>
						<li>Manage pages ( add, display, edit )</li>
						<li>Manage admins ( add, display, edit type )</li>
					</ol>
				</li>
			</ol></p>
	</div> <!-- End #tab2 -->
</div> <!-- End .content-box-content -->