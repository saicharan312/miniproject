<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['status']))
{
	$sqlupd = "UPDATE stock_invoice SET invoice_status='$_GET[status]' WHERE stock_invoice_id='$_GET[stock_invoice_id]'";
	$qsqlupd = mysqli_query($con,$sqlupd);
	$sqlupd = "UPDATE stock SET status='$_GET[status]' WHERE stock_invoice_id='$_GET[stock_invoice_id]'";
	$qsqlupd = mysqli_query($con,$sqlupd);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<script>alert('Item $_GET[status] successfully...');</script>";
	}
}
$sqlstock_invoice = "SELECT stock_invoice.*, fooddepartmentofficer.officername,fooddepartmentofficer.stateid as fdostateid,fooddepartmentofficer.cityid as fdocityid, fooddepartmentofficer.officercode, school.schoolname,school.schooladdress,school.stateid as schoolstateid, school.cityid as schoolcityid, school.pincode FROM `stock_invoice` LEFT JOIN fooddepartmentofficer ON stock_invoice.officerid=fooddepartmentofficer.officerid LEFT JOIN school school ON school.schoolid=stock_invoice.schoolid WHERE stock_invoice.stock_invoice_id='$_GET[stock_invoice_id]'";
$qsqlstock_invoice = mysqli_query($con,$sqlstock_invoice);
echo mysqli_error($con);
$rsstock_invoice = mysqli_fetch_array($qsqlstock_invoice);
//sqlofficerstatecity Record Starts here
$sqlofficerstatecity="SELECT * FROM `city` left join state ON city.stateid=state.stateid WHERE city.cityid='$rsstock_invoice[fdocityid]'";
$qsqlofficerstatecity = mysqli_query($con,$sqlofficerstatecity);
$rsofficerstatecity = mysqli_fetch_array($qsqlofficerstatecity);
//sqlofficerstatecity Record Ends here
//schoolcityid Record Starts here
$sqlschoolstatecity="SELECT * FROM `city` left join state ON city.stateid=state.stateid WHERE city.cityid='$rsstock_invoice[schoolcityid]'";
$qsqlschoolstatecity = mysqli_query($con,$sqlschoolstatecity);
$rsschoolstatecity = mysqli_fetch_array($qsqlschoolstatecity);
//schoolcityid Record Ends here
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
                    <i class="fas fa-globe"></i> MidDayMeals - Food Delivery Receipt
                    <small class="float-right"><b>Receipt Date:</b> <?php echo date("d-M-Y",strtotime($rsstock_invoice['entrydate'])); ?></small>
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
                    <strong><?php echo $rsstock_invoice['officername']; ?></strong><br>
					Food Department Officer,<br>
                    Officer Code - <?php echo $rsstock_invoice['officercode']; ?><br>
                    <?php echo $rsofficerstatecity['city']; ?>, <?php echo $rsofficerstatecity['state']; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $rsstock_invoice['schoolname']; ?></strong><br>
					<?php echo $rsstock_invoice['schooladdress']; ?>,<br>
					<?php echo $rsschoolstatecity['city']; ?>, <?php echo $rsschoolstatecity['state']; ?> <br>
                    PIN code: <?php echo $rsstock_invoice['pincode']; ?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <br>
                  <b>Receipt No.</b>  #<?php echo $rsstock_invoice['0']; ?><br>
                  <b>Total Cost:</b> ₹<?php echo $rsstock_invoice['totalcost']; ?><br>
                  <b>Invoice status:</b> <?php echo $rsstock_invoice['invoice_status']; ?><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered">
                    <thead>
                    <tr>
                      <th>SL No.</th>
                      <th>Item name</th>
                      <th style="text-align: right;">Cost</th>
                      <th style="text-align: right;">Quantity</th>
                      <th style="text-align: right;">Sub Total</th>
                    </tr>
                    </thead>
                    <tbody>
<?php
$slno=1;
$sqlstock = "SELECT stock.*, fooditem.fooditemname, fooditem.measurement FROM stock LEFT JOIN fooditem ON stock.fooditemid=fooditem.fooditemid where stock.stock_invoice_id='$_GET[stock_invoice_id]'";
$qsqlstock = mysqli_query($con,$sqlstock);
echo mysqli_error($con);
while($rsstock = mysqli_fetch_array($qsqlstock))
{
	$percost = $rsstock['tcost']/$rsstock['stockqty'];
?>					
<tr>
  <td><?php echo $slno; ?></td>
  <td><?php echo $rsstock['fooditemname']; ?></td>
  <td style="text-align: right;">₹<?php echo number_format($percost, 2); ?></td>
  <td style="text-align: right;"><?php echo $rsstock['stockqty']; ?> <?php echo $rsstock['measurement']; ?></td>
  <td style="text-align: right;">₹<?php echo $rsstock['tcost']; ?></td>
</tr>
<?php
$slno++;
}
?>			
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                </div>
                <!-- /.col -->
                <div class="col-6">

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%; text-align: right;">Total Amount:</th>
                        <td style="text-align: right;">Rs.<?php echo $rsstock_invoice['totalcost']; ?></td>
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
					<hr>

<?php
if(isset($_SESSION['schoolheadmasterid']))
{
	if($rsstock_invoice['invoice_status'] == "Delivered")
	{
?>
<a href="stockinvoicereceipt.php?stock_invoice_id=<?php echo $_GET['stock_invoice_id']; ?>&status=Received" class="btn btn-default"  onclick='return validatedel()'   ><i class="fas fa-edit"></i> Click here to Receive items</a>
<?php
	}
}
?>
<?php
if(isset($_SESSION['beoadminid']))
{
	if($rsstock_invoice['invoice_status'] == "Received")
	{
?>
<a href="stockinvoicereceipt.php?stock_invoice_id=<?php echo $_GET['stock_invoice_id']; ?>&status=Paid" class="btn btn-default"  onclick='return validatedel()'   ><i class="fas fa-edit"></i> Click here to Pay for Invoice</a>
<?php
	}
}
?>

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

<script>
function validatedel()
{
	if(confirm("Are you sure?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
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
