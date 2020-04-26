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
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/thdist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<style>
		html {
			background: rgb(110, 35, 157);
			background: linear-gradient(90deg, rgba(110, 35, 157, 1) 5%, rgba(157, 35, 149, 1) 16%, rgba(58, 30, 117, 1) 31%, rgba(121, 9, 99, 1) 62%, rgba(64, 105, 173, 1) 83%, rgba(61, 110, 177, 1) 91%, rgba(0, 212, 255, 1) 100%);
		}

		body {
			background: inherit;
		}
	</style>
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

<body>

	<div class="container-fluid">
		<div class="row mt-3">
			<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4 bg-dark py-3 card">
				<ul class="nav  justify-content-center">
					<li class="nav-item mx-2">
						<a class="btn btn-sm bg-info" href="#">SignUp&nbsp;&nbsp;<i class="fas fa-user-plus"></i></a>

					</li>
					<li class="nav-item mx-2">
						<a class="btn btn-sm bg-primary active" href="#">SignIn&nbsp;&nbsp;<i class="fas fa-sign-in-alt"></i></a>
					</li>
				</ul>
			</div>
		</div>



		<div class="row">

			<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4 card">
				<?php if(isset( $message)): ?>
				<div class="alert alert-danger mt-2" role="alert">
					<em>
						<div id="infoMessage"><?php echo $message; ?></div>
					</em>
				</div>
				<?php endif; ?>

				<div class="card-header py-1 bg-primary text-center">
					<img src="./images/icons8-login-64.png" alt="">
					<h3 class="h-100 my-auto">sign in &nbsp;&nbsp;</h3>
				</div>
				<div class="card-body">
					<?php echo form_open("auth/login"); ?>
					<div class="form-group mb-0 p-0">
						<?php echo lang('login_identity_label', 'identity'); ?>

						<input type="Email" name="identity" id="identity" class="form-control" placeholder="example@gmail.com" aria-describedby="helpId" required>
						<small id="helpId" class="text-muted">Help text</small>
					</div>

					<div class="form-group mb-0 p-0">
						<?php echo lang('login_password_label', 'password'); ?>
						<input type="password" name="password" id="password" class="form-control" placeholder="********" aria-describedby="helpId" required>
						<small id="helpId" class="text-muted">Help text</small>
					</div>

					<div class="form-check mb-3">

						<label class="form-check-label">
							<input type="checkbox" class="form-check-input" name="remember" id="" value="checkedValue" checked>
							Remember Me
						</label>
					</div>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE -->
	<script src="<?php echo base_url(); ?>assets/thdist/js/adminlte.js"></script>

	<!-- OPTIONAL SCRIPTS -->
	<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/thdist/js/demo.js"></script>
	<script src="<?php echo base_url(); ?>assets/thdist/js/pages/dashboard3.js"></script>
</body>

</html>
