<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Dashboard 3</title>

	<!-- Font Awesome Icons -->
	
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> 
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/thdist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/app.css">
	
  <script src="<?php echo base_url(); ?>assets/node_modules/vue/dist/vue.js"></script>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<div id="app">
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			
	<?php if (isset($_SESSION['insert_success'])) : ?>
						<div class="alert alert-primary alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
							<?php echo $_SESSION['insert_success']; ?>
						</div>
					<?php endif; ?>


					<?php if (isset($_SESSION['insert_error'])) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
							<?php echo $_SESSION['insert_error']; ?>
						</div>
					<?php endif; ?>
