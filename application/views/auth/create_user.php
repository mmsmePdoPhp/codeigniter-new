<!-- ***************************************************** -->

<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Dashboard v3</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>auth/create_user">New Users</a></li>
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>users/index">All Users</a></li>
			
		</ol>
	</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 offset-sm-1">
				<div class="card">
					<div class="card-header text-center">
						Crate New User
					</div>
					<div class="card-body">

						<?php if ((validation_errors())) : ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<?php echo validation_errors(); ?>
								<button type="button" class="close text-orange" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true" class="text-light">&times;</span>
								</button>
							</div>
						<?php endif; ?>


						<?php echo form_open('auth/create_user', ['class' => ' text-light card card-body text-inputs-orange']); ?>
						<div class="row">
							<div class="col-sm-4 offset-2">
								<label for="first_name" class="pl-2">First Name</label>

								<input type="text" id="first_name" name="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control text-center " placeholder="first_name">
							</div>
							<div class="col-sm-4">
								<label for="last_name" class="pl-2">Last Name</label>

								<input type="text" name="last_name" id="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control text-center" placeholder="last_name">
							</div>
						</div>

						<div class="row  py-2">
							<div class="col-sm-8 offset-2">
								<div class="form-group">
									<label for="company" class="pl-2">Company Name</label>
									<input type="text" class="form-control text-center text-primary text-bold" value="<?php echo set_value('company'); ?>" name="company" id="username" placeholder="your company ...">
								</div>
							</div>

						</div>	


						<div class="row py-2">
							<div class="col-sm-8 offset-2">
								<div class="form-group">
									<label for="email" class="pl-2">Email</label>
									<input type="email" value="<?php echo set_value('email'); ?>" class="form-control text-center text-primary text-bold" name="email" id="email" require placeholder="example@gmail.com ...">
								</div>
							</div>
						</div>


						<div class="row  py-2">

							<div class="col-sm-8 offset-2">
								<div class="form-group">
									<label for="phone" class="pl-2">Phone</label>
									<input type="tel" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control text-center text-primary text-bold" phone="phone" id="name" placeholder="+989** *** ** **">
								</div>
							</div>
						</div>

						<div class="row  py-2">
							<div class="col-sm-8 offset-2">
								<div class="form-group">
									<label for="password" class="pl-2">Password</label>
									<input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control text-center text-primary text-bold" name="password" id="password" placeholder="********">
								</div>
							</div>

						</div>

						<div class="row  py-2">
							<div class="col-sm-8 offset-2">
								<div class="form-group">
									<label for="password_confirm" class="pl-2">Confirm Password</label>
									<input type="password" name="password_confirm" value="<?php echo set_value('password_confirm'); ?>" class="form-control text-center text-primary text-bold" id="password_confirm" placeholder="********">
								</div>
							</div>

						</div>

						



						<div class="form-group mt-3 row">
							<input type="submit" class="form-control text-center col-4 col-sm-2 bg-orange offset-4 offset-sm-5" id="submit" value="Save">
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


      <p>
            <?php echo lang('create_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      </p>

      <p>
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </p>

      <p>
            <?php echo lang('create_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </p>

      <p>
            <?php echo lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm);?>
      </p>


      <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>

<?php echo form_close();?>
