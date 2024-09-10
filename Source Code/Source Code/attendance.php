<?php
include("header.php");
include("sidebar.php");
$sqlattendance ="SELECT attendance.*, student.schoolid FROM attendance LEFT JOIN student ON attendance.studentid=student.studentid WHERE 0=0";
$sqlattendance = $sqlattendance . " AND student.schoolid='$rsschoolheadmaster[schoolid]' ";
$sqlattendance = $sqlattendance . " AND attendance.attendancedate='$dt'";
$qsql = mysqli_query($con,$sqlattendance);
if(mysqli_num_rows($qsql) >= 1)
{
	echo "<script>alert('Attendance entry already completed..');</script>";
	echo "<script>window.location='headmasterdashboard.php';</script>";
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<br>
    <!-- Main content -->
    <section class="content">
<form method="post" action="attendancestockverification.php">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Attendance entry for <?php echo date("d-M-Y"); ?></h3>
        </div>
        <div class="card-body">
<table id="allrecord"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Image</th>
			<th>Roll No.</th>
			<th>Student Name</th>
			<th>Class </th>
			<th style='text-align: center;'>Present</th>
			<th style='text-align: center;'>Absent</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT ss.*,sc.schoolname FROM student ss , school sc WHERE sc.schoolid = ss.schoolid";
	if(isset($_SESSION['schoolheadmasterid']))
	{
		$sql = $sql . " AND ss.schoolid='$_SESSION[schoolid]'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "
		<tr>
				<td style='width: 100px;'><img src='".$rs['profileimg']."' width='80px' height='80px'/></td>
				<td>$rs[rollno]</td>
				<td>$rs[studentname]</td>
				<td>$rs[studentclass]<br> <b>Section</b> $rs[section]</td>
				<td style='text-align: center;vertical-align: middle;'>
				<input type='hidden' name='attendanceid[]' id='attendanceid[]' value='$rs[0]' >
					<input type='radio' name='attstatus[$rs[0]]' id='attstatus[$rs[0]]' value='Present'  style='border: 0px;width: 100%;height: 2em;' checked >
				</td>
				<td style='text-align: center;vertical-align: middle;'>
					<input type='radio' name='attstatus[$rs[0]]' id='attstatus[$rs[0]]' value='Absent' style='border: 0px;width: 100%;height: 2em;' >
				</td>
			</tr>";
	}
	?>
	</tbody>
</table>
<hr>
<center><input type="submit" name="submit" class="btn btn-info" id="submit" value="Submit Attendance Entry" ></center>
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
$(document).ready(function() {
    $('#allrecord').DataTable( {
        "lengthMenu": [[ -1], [ "All"]]
    } );
} );
</script>