<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM `chef` where chefid ='".$_GET['delid']."' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Chef record deleted successfully...');</script>";
		echo "<script>window.location='viewchef.php';</script>";
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

    <!-- Main content -->
    <section class="content">
<form method="post" action="">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Chef Details</h3>
        </div>
        <div class="card-body">
<table id="myTable"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Chef Name</th>
			<th>School</th>
			<th>Cook Type</th>
			<th>Image</th>
			<th>Salary</th>
			<th>Profile</th>
			<th>Bank Account detail</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT aa.*,ss.schoolname FROM chef aa ,school ss WHERE aa.schoolid = ss.schoolid ";
	if(isset($_SESSION[schoolheadmasterid]))
	{
		$sql = $sql . " AND aa.schoolid='$rsschoolheadmaster[schoolid]'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
				<td>$rs[chefname]</td>
				<td>$rs[schoolname]</td>
				<td>$rs[cooktype]</td>
				<td><img src='".$rs['chefimg']."' width='80px' height='80px'/></td>
				<td>₹$rs[chefsalary]</td>
				<td>$rs[chefprofile]</td>
				<td>$rs[bankaccountdetail]</td>
				<td>$rs[status]</td>
				<td><a href='chef.php?editid=$rs[0]' class='btn btn-info'>Edit</a> | <a href='viewchef.php?delid=$rs[0]' onclick='return validatedel()'  class='btn btn-danger' >Delete</a></td>
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