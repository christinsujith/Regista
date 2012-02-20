<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url(); ?>css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
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
	<title><?php if($page_title != '') echo $page_title.' | '; ?> Regista Administration System</title>
</head>

<body>
<!--
 /*
     * Author       :   Prabhakar.A
     * Framework    :   Codeigniter 2.1.0 
     * Database     :   mysql 5.5.16   
     * Created      :   01-02-2012
     * Last Updated :   08-02-2012
    */
-->
<div id="main">

	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
				<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="<?php echo base_url(); ?>design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="<?php echo base_url(); ?>design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>

			<strong>Regista</strong> Administration System

		</p>

		  <?php echo $this->session->userdata('type_name'); ?> : <strong><a href="<?php echo site_url(array('api','changepassword')); ?>"><?php echo $this->session->userdata('username'); ?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="<?php echo site_url('api/logout'); ?>" id="logout">Log out</a></strong>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><a href="<?php echo site_url(array('api','changepassword')); ?>">CHANGEPASSWORD</a></strong>
        

	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->   
	<div id="menu" class="box">

	<!--	<ul class="box f-right">
			<li><a href="#" target="_blank"><span><strong>Visit Site &raquo;</strong></span></a></li>
		</ul> -->
 		<ul class="box">
            <li<?php if($fLeftNavigation == 'newsNavigation') { ?> id="menu-active"<?php } ?>><a href="<?php echo site_url(array('api','viewnews')); ?>"><span>News</span></a></li> <!-- Active -->
            <li<?php if($fLeftNavigation == 'pageNavigation') { ?> id="menu-active"<?php } ?>><a href="<?php echo site_url(array('api','viewpages'));  ?>"><span>Pages</span></a></li> <!-- Active -->
            <?php if($this->session->userdata('typeid') != 1) { ?>
             <li<?php if($fLeftNavigation == 'memberNavigation') { ?> id="menu-active"<?php } ?>><a href="<?php echo site_url(array('api','viewmembers'));  ?>"><span>Members</span></a></li> <!-- Active -->
             <?php } ?>
             <?php if($this->session->userdata('typeid')  == 3) { ?>
              <li<?php if($fLeftNavigation == 'userNavigation') { ?> id="menu-active"<?php } ?>><a href="<?php echo site_url(array('api','users'));  ?>"><span>Users</span></a></li> <!-- Active -->
          		<?php } ?>
		</ul>

	</div> <!-- /header -->

	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		<div id="aside" class="box">

			<div class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="http://www.testing.com" target="_blank"></a></p>

			</div> <!-- /padding -->

			<?php if($fLeftNavigation != '') $this->load->view($fLeftNavigation); ?>

		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box">