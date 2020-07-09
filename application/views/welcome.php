<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Meta control to meta information- START-->

<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>-->

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title> <?php echo $pagetitle; ?></title>
<meta name="resource-type" content="document" />

<meta http-equiv="content-Language" content="en"/>

<meta name="robots" content="index, follow" />

<meta name="language" content="en-us" />

<meta name="rating" content="general" />

<meta name="distribution" content="global" />
<meta name="generator" content="notepad++"/>

<!-- bootstrap framework css -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/css/bootstrap-responsive.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/img/icsw2_16/icsw2_16.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/img/splashy/splashy.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/img/flags/flags.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Abel">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/beoro.css">

</head>
<div id="main">
		<link sizes="27x32" href="<?php echo base_url();?>assets/images/favicon1.png" type="image/x-icon" rel="shortcut icon">	
		<div id="header">
			<?php $this->load->view('content/header'); ?>
		</div>
		<div id="container" style="left:20%; margin-left:-50px; margin-top: -25px; position: absolute;top:20%;height:100%;width:900px">
		<?php $this->view($content); ?>
		</div>
		<div id="footer">
		<?php $this->load->view('content/footer'); ?>
		</div>
</div>
</body>
</html>