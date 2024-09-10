<?php
include("header.php");
include("sidebar.php");
$sqlchefsalary = "SELECT chefsalary.*, chef.chefname, chef.cooktype,chef.bankaccountdetail, school.schoolname, school.schooladdress, state.state, city.city, school.pincode FROM chefsalary LEFT JOIN chef ON chef.chefid=chefsalary.chefid LEFT JOIN school ON school.schoolid=chef.schoolid LEFT JOIN state ON state.stateid=school.stateid LEFT JOIN city ON city.cityid=school.cityid WHERE chefsalary.chefsalaryid ='$_GET[salreceiptid]'";
$qsqlchefsalary = mysqli_query($con,$sqlchefsalary);
echo mysqli_error($con);
$rschefsalary = mysqli_fetch_array($qsqlchefsalary);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<BR>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> MidDayMeals - Chef Salary Receipt
                    <small class="float-right"><b>Salary Receipt Date:</b> <?php echo date("d-M-Y",strtotime($rschefsalary['salarydate'])); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
			  <hr>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>MidDayMeals...</strong><br>
                   Commissioner for Public Instruction,<br>
                    N.T.Road, Bangalore, Karnataka<br>
                    Phone: (804) 123-5432<br>
                    Email: info@middaymeals.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $rschefsalary['chefname']; ?></strong><br>
                    <?php echo $rschefsalary['schoolname']; ?><br>
					<?php echo $rschefsalary['schooladdress']; ?>,<?php echo $rschefsalary['city']; ?>, <?php echo $rschefsalary['state']; ?> <br>
                    PIN code: <?php echo $rschefsalary['pincode']; ?><br>
                    <b>Cook Type</b>: <?php echo $rschefsalary['cooktype']; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Salary Receipt No. #<?php echo $rschefsalary['0']; ?></b><br>
                  <br>
                  <b>Salary Month:</b> <?php echo date("Y-M",strtotime($rschefsalary['salarymonth'])); ?><br>
                  <b>Account:</b> <?php echo $rschefsalary['bankaccountdetail']; ?>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>SL No.</th>
                      <th>Description</th>
                      <th style="text-align: right;">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Basic salary</td>
                      <td style="text-align: right;">Rs.<?php echo $rschefsalary['basicsalary']; ?></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Bonus Salary</td>
                      <td style="text-align: right;">Rs.<?php echo $rschefsalary['bonussalary']; ?></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Deductions</td>
                      <td style="text-align: right;">Rs.<?php echo $rschefsalary['deductionsalary']; ?></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead"><b>Payment description:</b></p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;"><?php echo $rschefsalary['salarydetail']; ?></p>
                </div>
                <!-- /.col -->
                <div class="col-6">

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Total salary:</th>
                        <td style="text-align: right;">Rs.<?php echo ($rschefsalary['basicsalary']+$rschefsalary['bonussalary'])-$rschefsalary['deductionsalary']; ?></td>
                      </tr>  
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
					<?php
					/*
                  <a href="invoice-print.php" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
				  */
				  ?><hr>
                 <button type="button" class="btn btn-success float-right"onclick="window.print()" ><i class="far fa-credit-card"></i> Print Receipt
                  </button>
				  <?php
				  /*
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
				  */
				  ?>	
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
include("footer.php");
?>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<script src="dist/js/pages/dashboard3.js"></script>
</body>
</html>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
