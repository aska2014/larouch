<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{ $main_active.' | '.$sub_active }}</title>

	{{ HTML::style('resources/css/reset.css') }}
	{{ HTML::style('resources/css/style.css') }}
	{{ HTML::style('resources/css/invalid.css') }}
	<!--[if lte IE 7]>
	{{ HTML::style('resources/css/ie.css'); }}
	<![endif]-->
	
	{{ HTML::script('resources/script/jquery-1.7.1.min.js') }}
	{{ HTML::script('resources/script/simpla.jquery.configuration.js') }}
	{{ HTML::script('resources/script/facebox.js') }}
	{{ HTML::script('resources/script/jquery.wysiwyg.js') }}
	{{ HTML::script('resources/script/jquery.datePicker.js') }}
	{{ HTML::script('resources/script/jquery.date.js') }}<!-- DATE PICKER PLUGIN -->
	<!--[if IE]>
	{{ HTML::script('resources/scripts/jquery.bgiframe.js') }}
	<![endif]-->
	<!--[if IE 6]>
	{{ HTML::script('resources/scripts/DD_belatedPNG_0.0.7a.js') }}
	<script type="text/javascript">
		DD_belatedPNG.fix('.png_bg, img, li');
	</script>
	<![endif]-->

	@yield('scripts')
        
</head>

<body>


<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
		<h1 id="sidebar-title"><a href="#"></a></h1>
	  
		<!-- Logo (221px wide) -->
		<div style="margin-top:50px"></div>
	  
		<div id="profile-links">
			Hello, <a href="#" title="Edit your profile">{{ Auth::user()->name() }}</a>, you have <a href="#messages" rel="modal" title="3 Messages">0 Messages</a><br>
			<br>
			<a href="{{ URL::home() }}" title="View the Site">View the Site</a> | <a href="{{ URL::to('larouch2012/logout') }}" title="Sign Out">Sign Out</a>
		</div>        
		
		<ul id="main-nav">  <!-- Accordion Menu -->
			@if(Auth::user()->admin_type != '3')
				<li> 
					<a href="#" class="nav-top-item<?php if($main_active == "Orders")echo ' current';?>"> <!-- Add the class "current" to current menu item -->
					Orders
					</a>
					<ul <?php if($main_active == "Orders")echo 'style="display: block;"';else echo 'style="display:none;"'; ?>>
						<li><a href="{{ URL::to('larouch2012/orders/manage') }}" <?php if($sub_active == "Manage orders")echo 'class="current"'; ?>>Manage orders</a></li>
						<li><a href="{{ URL::to('larouch2012/orders/display') }}" <?php if($sub_active == "Display archived orders")echo 'class="current"'; ?>>Display archived orders</a></li>
					</ul>
				</li>
			@else
				<li> 
					<a href="#" class="nav-top-item<?php if($main_active == "Products")echo ' current';?>"> <!-- Add the class "current" to current menu item -->
					Products
					</a>
					<ul <?php if($main_active == "Products")echo 'style="display: block;"';else echo 'style="display:none;"'; ?>>
						<li><a href="{{ URL::to('larouch2012/products/add') }}" <?php if($sub_active == "Add new product")echo 'class="current"'; ?>>Add new product</a></li>
						<li><a href="{{ URL::to('larouch2012/products/manage') }}" <?php if($sub_active == "Manage Products")echo 'class="current"'; ?>>Manage Products</a></li> <!-- Add class "current" to sub menu items also -->
					</ul>
				</li>
				<li>
					<a href="#" class="nav-top-item<?php if($main_active == "Quality")echo ' current';?>">
						Quality
					</a>
					<ul <?php if($main_active == "Quality")echo 'style="display: block;"';else echo 'style="display:none;"'; ?>>
						<li><a href="{{ URL::to('larouch2012/quality/edit') }}" <?php if($sub_active == "Edit Quality Guarantee")echo 'class="current"'; ?>>Edit Quality Guarantee</a></li>
					</ul>
				</li>
				<li> 
					<a href="#" class="nav-top-item<?php if($main_active == "Slider")echo ' current';?>"> <!-- Add the class "current" to current menu item -->
					Slider
					</a>
					<ul <?php if($main_active == "Slider")echo 'style="display: block;"';else echo 'style="display:none;"'; ?>>
						<li><a href="{{ URL::to('larouch2012/slider/add') }}" <?php if($sub_active == "Add new slider")echo 'class="current"'; ?>>Add new slider</a></li>
						<li><a href="{{ URL::to('larouch2012/slider/manage') }}" <?php if($sub_active == "Manage Sliders")echo 'class="current"'; ?>>Manage Sliders</a></li> <!-- Add class "current" to sub menu items also -->
					</ul>
				</li>
				<li>
					<a href="#" class="nav-top-item<?php if($main_active == "Categories")echo ' current';?>">
						Categories
					</a>
					<ul <?php if($main_active == "Categories")echo 'style="display: block;"';else echo 'style="display:none;"'; ?>>
						<li><a href="{{ URL::to('larouch2012/categories/add') }}" <?php if($sub_active == "Add new category")echo 'class="current"'; ?>>Add new category</a></li>
						<li><a href="{{ URL::to('larouch2012/categories/manage') }}" <?php if($sub_active == "Manage categories")echo 'class="current"'; ?>>Manage categories</a></li>
					</ul>
				</li>    
				<li>
					<a href="#" class="nav-top-item<?php if($main_active == "SubCategories")echo ' current';?>">
						SubCategories
					</a>
					<ul <?php if($main_active == "SubCategories")echo 'style="display: block;"';else echo 'style="display:none;"'; ?>>
						<li><a href="{{ URL::to('larouch2012/subcategories/add') }}" <?php if($sub_active == "Add new subcategory")echo 'class="current"'; ?>>Add new subcategory</a></li>
						<li><a href="{{ URL::to('larouch2012/subcategories/manage') }}" <?php if($sub_active == "Manage subcategories")echo 'class="current"'; ?>>Manage subcategories</a></li>
					</ul>
				</li>   
				<li>
					<a href="#" class="nav-top-item<?php if($main_active == "Pages")echo ' current';?>">
						Pages
					</a>
					<ul <?php if($main_active == "Pages")echo 'style="display: block;"';else echo 'style="display:none;"'; ?>>
						<li><a href="{{ URL::to('larouch2012/pages/add') }}" <?php if($sub_active == "Add new page")echo 'class="current"'; ?>>Add new page</a></li>
						<li><a href="{{ URL::to('larouch2012/pages/manage') }}" <?php if($sub_active == "Manage pages")echo 'class="current"'; ?>>Manage pages</a></li>
					</ul>
				</li>     
				<li>
					<a href="#" class="nav-top-item<?php if($main_active == "Admins")echo ' current';?>">
						Admins
					</a>
					<ul <?php if($main_active == "Admins")echo 'style="display: block;"';else echo 'style="display:none;"'; ?>>
						<li><a href="{{ URL::to('larouch2012/admins/manage') }}" <?php if($sub_active == "Manage admins")echo 'class="current"'; ?>>Manage admins</a></li>
					</ul>
				</li>
			@endif       
				<li>
					<a href="#" class="nav-top-item<?php if($main_active == "Help")echo ' current';?>">
						Help
					</a>
					<ul <?php if($main_active == "Help")echo 'style="display: block;"';else echo 'style="display:none;"'; ?>>
						<li><a href="{{ URL::to('larouch2012/help/admins') }}" <?php if($sub_active == "Admins")echo 'class="current"'; ?>>Admins</a></li>
						<li><a href="{{ URL::to('larouch2012/help/orders') }}" <?php if($sub_active == "Orders")echo 'class="current"'; ?>>Orders</a></li>
					</ul>
				</li>   
		</ul> <!-- End #main-nav -->
		
			<div id="messages" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
			@if(isset($messages))
			<h3>{{ count($messages) }} Messages</h3>
			 	@foreach($messages as $message):
				<p>
					<strong>{{ $message['created_at'] }}</strong> by {{ $message['member_name'] }}<br>
						{{ $message['body'] }}
					<small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
				</p>	
		        @endforeach
		    @endif
			<form action="" method="post">
				<h4>New Message</h4>
				<fieldset>
					<textarea class="textarea" name="m_body" cols="79" rows="5"></textarea>
				</fieldset>
				<fieldset>
					<select name="m_id" class="small-input">
						<option value="option1">Send to...</option>
	                    <!-- <php while($sqlMembers = mysql_fetch_array($queryMembers)): ?>
	                    <option value="<php echo $sqlMembers['memID']; ?>"><php echo $sqlMembers['name']; ?></option>
	                    <php endwhile; ?> -->
					</select>
	                <input type="hidden" name="parse_var" value="sendMessage" /> 
					<input class="button" value="Send" type="submit">
				</fieldset>
			</form>
		</div> <!-- End #messages -->
	</div></div> <!-- End #sidebar -->

	<div id="main-content"> <!-- Main Content Section with everything -->
		<noscript> <!-- Show a notification if the user has disabled javascript -->
			<div class="notification error png_bg">
				<div>
					Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
				</div>
			</div>
		</noscript>
		
		<!-- Page Head -->
		<h2>Welcome {{ Auth::user()->name() }}</h2>
	    
	    <!-- Start Notifications -->
	    @if(isset($errors))
		    @foreach($errors as $error)
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="{{ URL::to('public/resources/images/icons/cross_grey_small.png') }}" title="Close this notification" alt="close"></a>
				<div>
					Error : {{ $error }}
				</div>
			</div>
			@endforeach
		@elseif(isset($success) && $success)
			<div class="notification success png_bg">
				<a href="#" class="close"><img src="{{ URL::to('public/resources/images/icons/cross_grey_small.png') }}" title="Close this notification" alt="close"></a>
				<div>
					Success : the task has been successfully done.
				</div>
			</div>
		@endif
		<!-- End Notifications -->
	<div class="clear"></div>

	<div class="content-box"><!-- Start Content Box -->
		<div class="content-box-header">
			<h3 style="cursor: s-resize;">{{ $sub_active }}</h3>
			<ul class="content-box-tabs"><!-- href must be unique and match the id of target div -->
			</ul>
			<div class="clear"></div>
		</div> <!-- End .content-box-header -->

	@yield('content')


	</div> <!-- End .content-box -->


	<div class="clear"></div>
	<div id="footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
						© Copyright 2012 | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
		</div> <!-- End #main-content -->
	</div>

<div id="facebox" style="display:none;"><div class="popup"><table><tbody><tr><td class="tl"></td><td class="b"></td><td class="tr"></td></tr><tr><td class="b"></td><td class="body"><div class="content"></div><div class="footer"><a href="#" class="close"><img src="resources/images/closelabel.gif" title="close" class="close_image"></a></div></td><td class="b"></td></tr><tr><td class="bl"></td><td class="b"></td><td class="br"></td></tr></tbody></table></div></div>

</body>
</html>
