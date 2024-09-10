<?php
include("header.php");
include("sidebar.php");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
<form method="post" action="">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Stock Details</h3>
        </div>
        <div class="card-body">
<table id="myTable"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Receipt No. </th>
			<th>Food Department Officer </th>
			<th>School</th>
			<th>Entry Date</th>
			<th>Total Cost</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
$sqlstock_invoice = "SELECT stock_invoice.*, fooddepartmentofficer.officername,fooddepartmentofficer.stateid as fdostateid,fooddepartmentofficer.cityid as fdocityid, fooddepartmentofficer.officercode, school.schoolname,school.schooladdress,school.stateid as schoolstateid, school.cityid as schoolcityid, school.pincode FROM `stock_invoice` LEFT JOIN fooddepartmentofficer ON stock_invoice.officerid=fooddepartmentofficer.officerid LEFT JOIN school school ON school.schoolid=stock_invoice.schoolid WHERE stock_invoice.invoice_status!=''";
if(isset($_SESSION['officerid']))
{
	$sqlstock_invoice = $sqlstock_invoice . " AND stock_invoice.officerid='$_SESSION[officerid]' ";
}
else if(isset($_SESSION['schoolheadmasterid']))
{
	$sqlstock_invoice = $sqlstock_invoice . " AND stock_invoice.schoolid='$rsschoolheadmaster[schoolid]' ";
	if($_GET['status'] == "Received")
	{
		$sqlstock_invoice = $sqlstock_invoice . " AND ( stock_invoice.invoice_status='$_GET[status]' || stock_invoice.invoice_status='Paid' )";
	}
	else
	{
		$sqlstock_invoice = $sqlstock_invoice . " AND ( stock_invoice.invoice_status='$_GET[status]')";
	}
}
else if(isset($_SESSION['beoadminid']))
{
	$sqlstock_invoice = $sqlstock_invoice . " AND  stock_invoice.invoice_status='$_GET[status]' ";
}
$qsqlstock_invoice = mysqli_query($con,$sqlstock_invoice);
echo mysqli_error($con);
	while($rsstock_invoice = mysqli_fetch_array($qsqlstock_invoice))
	{
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
		echo "<tr>
		<td>$rsstock_invoice[0]</td>
		<td>";
?>
<strong><?php echo $rsstock_invoice['officername']; ?></strong><br>
					Food Department Officer,<br>
                    Officer Code - <?php echo $rsstock_invoice['officercode']; ?><br>
                    <?php echo $rsofficerstatecity['city']; ?>, <?php echo $rsofficerstatecity['state']; ?>
<?php
		echo "</td>
		<td>";
?>
<strong><?php echo $rsstock_invoice['schoolname']; ?></strong><br>
					<?php echo $rsstock_invoice['schooladdress']; ?>,<br>
					<?php echo $rsschoolstatecity['city']; ?>, <?php echo $rsschoolstatecity['state']; ?> <br>
                    PIN code: <?php echo $rsstock_invoice['pincode']; ?>
<?php
		echo "</td>
				<td>" . date("d-M-Y",strtotime($rsstock_invoice['entrydate'])) . "</td>
				<td>Rs. $rsstock_invoice[totalcost]</td>
				<td>$rsstock_invoice[invoice_status]</td>
				<td><a href='stockinvoicereceipt.php?stock_invoice_id=$rsstock_invoice[0]' class='btn btn-info' target='_blank'>Receipt</a> </td>
			</tr>";
	}
	?>
	</tbody>
</table>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->
</form>
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
<script src="js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
function validatedel()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>