<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sign in to larouch control panel</title>

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
	{{ HTML::script('resources/script/jquery.date.js') }}
	<!--[if IE]>
	{{ HTML::script('resources/scripts/jquery.bgiframe.js') }}
	<![endif]-->
	<!--[if IE 6]>
	{{ HTML::script('resources/scripts/DD_belatedPNG_0.0.7a.js') }}
	<script type="text/javascript">
		DD_belatedPNG.fix('.png_bg, img, li');
	</script>
	<![endif]-->
		
</head>

<body id="login">
	<div id="login-wrapper" class="png_bg">
		<div id="login-top">
			<h1></h1>
			<!-- Logo (221px width) -->
			<img id="logo" src="resources/images/white_logo.png" alt="Simpla Admin logo" />
		</div> <!-- End #logn-top -->
		
		<div id="login-content">
			<form action="" method="post" enctype="multipart/form-data">
            	@if(isset($login_errors))
           	    <div class="notification error png_bg">
					<div>
						{{ $login_errors }}
					</div>
				</div>
                @endif
            
				<p>
					<label>Username</label>
					<input class="text-input" type="text" name="username" />
				</p>
				<div class="clear"></div>
				<p>
					<label>Password</label>
					<input class="text-input" type="password" name="password" />
				</p>
				<div class="clear"></div>
				<p id="remember-password">
					<input type="checkbox" name="remember" />Remember me
				</p>
				<div class="clear"></div>
				<p>
					<input class="button" type="submit" value="Sign In" />
				</p>
			</form>
		</div> <!-- End #login-content -->
	</div> <!-- End #login-wrapper -->
</body>
</html>