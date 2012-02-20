<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/1col.css" title="1col" /> <!-- DEFAULT: 1 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/2col.css" title="2col" /> <!-- ALTERNATE: 2 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/switcher.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/toggle.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/ui.core.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/ui.tabs.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
	</script>
	<title>Login |  Administration System</title>
</head>

<body>

<div id="main">

	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
				<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="<?php echo base_url(); ?>design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="<?php echo base_url(); ?>design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>

			<strong>Regista </strong> Administration System

		</p>

	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	<div id="menu" class="box">
<!--
		<ul class="box f-right">
			<li><a href="#" target="_blank"><span><strong>Visit Site &raquo;</strong></span></a></li>
		</ul>
-->
	</div> <!-- /header -->

	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		<div id="aside" class="box">

		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box" style="min-height:350px;padding:50px;" align="center">
        
			
            <p id="logo" align="center"><a href="http://www.testing.com" target="_blank"></a></p>
            <div style="padding:20px; border:1px solid #ccc; width:300px; background-color:#eee;">

				<form method="post" action="<?php echo site_url('api/login'); ?>">
                <?php if(isset($error) && $error != '') { ?><p class="msg error"><?php echo $error; ?></p><?php } ?>
				<table class="nostyle">
					<tr>
						<td>Username :</td>
						<td><input type="text" name="username" class="input-text" /></td>
					</tr>
					<tr>
						<td>Password :</td>
						<td><input type="password" name="password" class="input-text" /></td>
					</tr>
					<tr>
						<td colspan="2" class="t-right"><input type="submit" name="btnLogin" class="input-submit" value="Login" /></td>
					</tr>
				</table>
	            </form>
            
            </div>
        
        
<?php $this->load->view('footer'); ?>