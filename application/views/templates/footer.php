
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
	<!-- /.control-sidebar -->
	

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.4
    </div>
  </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="<?php echo base_url(); ?>assets/thdist/js/adminlte.js"></script>
<!-- DataTables -->
<!-- <script src="<?php //echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php //echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php //echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php //echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
  <!-- OPTIONAL SCRIPTS -->
  <script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
  <!-- <script src="<?php //echo base_url(); ?>assets/thdist/js/demo.js"></script> -->
	<script src="<?php echo base_url(); ?>assets/thdist/js/pages/dashboard3.js"></script>
	
	<!-- custome script -->
	<script src="<?php echo base_url(); ?>assets/dist/app.js"></script>
	
	<!-- add individual file group.js -->
	<?php
	//using function
	if(isset($fileName)){
		loadScriptFile($fileName);
	}
	?>



</body>
</body>
</html>
