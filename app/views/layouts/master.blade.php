<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo isset($title) ? $title : '' ; ?></title>
	<link href="/css/styles.css" rel="stylesheet" type="text/css" />
	<script src="/js/jquery-1.11.0.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/bootstrap-datepicker.js"></script>
	<script src="/js/erps.js"></script>
	
</head>
<body>
<style>
		
	</style>
	<?php $token = csrf_token(); ?>
	<nav class="navbar navbar-inverse" role="navigation">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="logo" href="/">
			<span class="glyphicon glyphicon-signal" style="margin-left:10px;margin-top:18px;color:white;font-size:12px;" ></span>
			<span style="margin-left:5px;color:white;">Enterprise Resource Planning System (ERPs)</span>
		  </a>
	    </div>
	  </div><!-- /.container-fluid -->
	</nav>
	<div class="container">
        <div class="row">
			<?php /*<!--h1>{{ $heading }}</h1--> */ ?>
			<?php if ( Auth::check() ) { ?>
			<div class="row">
				<div class="col-md-2">
					<ul class="nav nav-pills nav-stacked">
						<li class="<?php echo ( Request::segment(1) === 'dashboard' ) ? 'active' : ''; ?>"><a href="<?php echo URL::to('/'); ?>">Dashboard</a></li>
						<li class="<?php echo ( Request::segment(1) === 'clients' ) ? 'active' : ''; ?>"><a href="<?php echo URL::to('/clients'); ?>">Clients</a></li>
						<li class="<?php echo ( Request::segment(1) === 'hr' ) ? 'active' : ''; ?>"><a href="<?php echo URL::to('/hr'); ?>">Human Resources</a></li>
						<li><a href="#">Payroll</a></li>	
						<li><a href="#">Production</a></li>
						<li><a href="#">Marketing and Sales</a></li>
						<li><a href="#">IT</a></li>												
						<li><a href="#">Supplier</a></li>
						<li><a href="#">Messenger</a></li>
						<li><a href="#">Settings</a></li>
						<li><a href="<?php echo URL::to('/logout?_token='.$token); ?>">Logout</a></li>
					</ul>
				</div>
				<div class="col-3">
					<?php echo isset($partial) ? $partial."<br /><br />" : '' ; ?>
					<?php echo isset($content) ? $content."<br />" : '' ; ?>
				</div>
			</div>
			<?php } else { ?>
				<?php echo isset($content) ? $content."<br />" : '' ; ?>
			<?php } ?>
			<div id="footer" class="well">
				<div>ERPs - Enterprise Resources Planning System | ERPS Copyright <?php echo date('Y'); ?></div>
				<div style="font-size:10px;">ERPs is a free product created by <a href="http://jerrybeniten.com" target="_new">Jerry Beniten</a> - Proud to be Pinoy!</div>
			</div>
        </div>
	</div>
</body>
</html>
