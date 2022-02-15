<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<title>LetsRun Admin</title>

	<link href="/static-admin/css/style.default.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="/static-admin/js/html5shiv.js"></script>
	<script src="/static-admin/js/respond.min.js"></script>
	<![endif]-->
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
	<div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

	<div class="signinpanel">
		
		<div class="row">
		  
			 <div class="col-md-5 col-md-offset-3 mb30">
				
				<div class="signin-info">
					<div class="logopanel">
						<h1><span>[</span> LetsRun 관리자 <span>]</span></h1>
					</div><!-- logopanel -->

				</div><!-- signin0-info -->
			
			</div><!-- col-sm-7 -->
		</div>
		<div class="row">
			<div class="col-md-5 col-md-offset-3">
				
				<form method="post" action="/conn-admin/member/login">
					<h4 class="nomargin">로그인</h4>
					<p class="mt5 mb20"></p>
				
					<input type="text" class="form-control uname" name="user_id" placeholder="id" required />
					<input type="password" class="form-control pword" name="user_pass" placeholder="Password" required />
					<button class="btn btn-success btn-block">로그인</button>
					
				</form>
			</div><!-- col-sm-5 -->
			
		</div><!-- row -->
		<div class="row">
		  
			<div class="col-md-7 col-md-offset-3">
				<div class="signup-footer">
					<div class="pull-left">
						&copy; 2018. All Rights Reserved.
					</div>
				</div>
			</div>
		</div>
		
	</div><!-- signin -->
  
</section>


<script src="/static-admin/js/jquery-1.10.2.min.js"></script>
<script src="/static-admin/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/static-admin/js/bootstrap.min.js"></script>
<script src="/static-admin/js/modernizr.min.js"></script>
<script src="/static-admin/js/retina.min.js"></script>

<script>
jQuery(window).load(function() {
	// Page Preloader
	jQuery('#status').fadeOut();
	jQuery('#preloader').delay(350).fadeOut(function(){
		jQuery('body').delay(350).css({'overflow':'visible'});
	});
});
</script>


</body>
</html>
