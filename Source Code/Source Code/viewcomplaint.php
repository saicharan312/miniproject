<?php
include("header.php");
include("sidebar.php");
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
          <h3 class="card-title">View  Complaints</h3>
        </div>
        <div class="card-body">
<table id="myTable"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Complaint No.</th>
<?php
if(isset($_SESSION[beoadminid]))
{
echo "<th>Complainer</th>";
}
?>			
			<th>Complaint date</th>
			<th>Complaint Title</th>
			<th>Complaint Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM complaint WHERE reply_complaint_id='0' ";
	if(isset($_SESSION[schoolheadmasterid]))
	{
	$sql = $sql . " AND schoolheadmasterid='$_SESSION[schoolheadmasterid]'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
//######		
$sqlhmaster = "SELECT schoolheadmaster.*, school.schoolname, school.schooladdress, school.pincode, state.state, city.city FROM schoolheadmaster LEFT JOIN school ON schoolheadmaster.schoolid=school.schoolid LEFT JOIN state ON state.stateid=school.stateid LEFT JOIN city ON city.cityid=school.cityid WHERE schoolheadmaster.schoolheadmasterid='$rs[schoolheadmasterid]'";
$qsqlhmaster = mysqli_query($con,$sqlhmaster);
$rshmaster = mysqli_fetch_array($qsqlhmaster);
//######
		echo "<tr>";
		echo "<td>$rs[complaint_id]</td>";
if(isset($_SESSION[beoadminid]))
{		
		echo "<td>";
?>
<b><?php echo $rshmaster['headmastername']; ?></b><br><?php echo $rshmaster['schoolname']; ?><br><?php echo $rshmaster['schooladdress']; ?>, <?php echo $rshmaster['city']; ?>, <?php echo $rshmaster['state']; ?> - <?php echo $rshmaster['pincode']; ?>		
<?php
		echo "</td>";
}
		echo "<td>" . date("d-M-Y H:i A",strtotime($rs[complaint_date])) . "</td>";
		echo "<td>$rs[complaint_title]</td>";
		echo "<td>$rs[complaint_status]</td>";
		echo "<td style='width:70px;'><a href='complaint_record.php?complaint_id=$rs[0]' class='btn btn-warning' target='_blank'>View</a></td>";
		echo "</tr>";
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