<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM `fooditem` where fooditemid ='".$_GET['delid']."' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Food item record deleted successfully...');</script>";
		echo "<script>window.location='viewfooditem.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<br>
    <!-- Main content -->
    <section class="content">
<form method="post" action="">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Food Item Stock Report</h3>
        </div>
        <div class="card-body">
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Mid day meal Detail</th>
			<th>Available Quantity</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.schoolid='$rsschoolheadmaster[schoolid]' AND cc.status='Active' GROUP BY fi.fooditemid";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqlreceived = "SELECT sum(stockqty) as receivedqty FROM `stock` WHERE fooditemid='$rs[fooditemid]' AND  schoolid='$rsschoolheadmaster[schoolid]' AND (stocktype='Entry') AND (status='Received' || status='Paid' )";
		$qsqlreceived = mysqli_query($con,$sqlreceived);
		echo mysqli_error($con);
		$rsreceived = mysqli_fetch_array($qsqlreceived);
		$receivedqty = $rsreceived['receivedqty'];
		
		$sqlspent = "SELECT sum(stockqty) as spentqty FROM `stock` WHERE fooditemid='$rs[fooditemid]' AND schoolid='$rsschoolheadmaster[schoolid]' AND (stocktype='Spent') AND (status='Received' || status='Paid')";
		$qsqlspent = mysqli_query($con,$sqlspent);
		echo mysqli_error($con);
		$rsspent = mysqli_fetch_array($qsqlspent);
		$spentqty = $rsspent['spentqty'];
		$balqty= $receivedqty - $spentqty;
		
		echo "<tr>
				<td>$rs[fooditemname]</td>
				<td>$rs[middaymealdetail]</td>
				<td> $balqty  $rs[measurement] </td>
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