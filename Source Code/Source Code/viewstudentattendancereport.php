<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM `attendance` where attendanceid ='".$_GET['delid']."' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Attendance record deleted successfully...');</script>";
		echo "<script>window.location='viewattendance.php';</script>";
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
<form method="get" action="">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Attendance Report</h3>
        </div>
        <div class="card-body">
		
<div class="row">
<?php
if(isset($_GET[studentid]))
{
	echo "<INPUT type='hidden' name='studentid' id='studentid' value='$_GET[studentid]' >";
}
?>
	<div class="col-md-6">
		Select month:
		<input type="month" name="selectedmonth" id="selectedmonth" value="<?php echo $_GET['selectedmonth']; ?>" max="<?php echo date("Y-m"); ?>" class="form-control" required>
	</div>
	<div class="col-md-6">
		&nbsp;<br>
		<input type="submit" name="btnsearch" id="btnsearch" class="btn btn-primary" style="width: 100%;">
	</div>
</div>
<hr>
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Profile Image</th>
			<th>Student Name</th>
			<th>School</th>
			<th>Roll No</th>
			<th>Class </th>
			<th>Section </th>
			<th>DOB</th>
			<th>Address </th>
			<th>Contact No </th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT ss.*,sc.schoolname FROM student ss , school sc WHERE sc.schoolid = ss.schoolid";
	if(isset($_SESSION['studentid']))
	{
		$stid = $_SESSION['studentid'];
		$sql = $sql . " AND ss.studentid='$_SESSION[studentid]'";
	}
	else
	{
		$stid = $_GET['studentid'];
		$sql = $sql . " AND ss.studentid='$_GET[studentid]'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		
		echo "<tr>
				<td><img src='".$rs['profileimg']."' width='80px' height='80px'/></td>
				<td>$rs[studentname]</td>
				<td>$rs[schoolname]</td>
				<td>$rs[rollno]</td>
				<td>$rs[studentclass]</td>
				<td>$rs[section]</td>
				<td>" . date("d-M-Y",strtotime($rs[dateofbirth])) ."</td>
				<td>$rs[studentaddress]</td>
				<td>$rs[contactnumber]</td>
			</tr>";
	}
	?>
	</tbody>
</table>
	
<hr>
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Attendance Date</th>
			<th>Present</th>
			<th>Absent</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$totalpresent =0; $totalabsent=0;
	$sql ="SELECT attendance.*, student.schoolid FROM attendance LEFT JOIN student ON attendance.studentid=student.studentid WHERE attendance.studentid='$stid'";
	$sql= $sql . " AND attendance.attendancedate BETWEEN '$_GET[selectedmonth]-01' AND '$_GET[selectedmonth]-31' ";
	$sql = $sql . " GROUP by attendance.attendancedate ORDER BY attendance.attendancedate ";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
				<td> " . date("d-M-Y",strtotime($rs[attendancedate])) . "</td>
				<td>";
if($rs['attendancestatus'] == "Present")
{
	echo " <i class='fa fa-check-circle' aria-hidden='true' style='color: green;'></i> ";
	$totalpresent = $totalpresent + 1;
}					
			echo "</td>
				<td>";
if($rs['attendancestatus'] == "Absent")
{
	echo " <i class='fa fa-check-circle' aria-hidden='true' style='color: red;'></i> ";
	$totalabsent = $totalabsent + 1;
}				
	echo "</td>
			</tr>";
	}
	?>
	</tbody>
	<tfoot>
		<tr>
			<th>Total</th>
			<th><?php echo $totalpresent; ?></th>
			<th><?php echo $totalabsent; ?></th>
		</tr>
	</tfoot>
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