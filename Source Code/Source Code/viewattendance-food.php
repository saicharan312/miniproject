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

    <!-- Main content -->
    <section class="content">
<form method="get" action="">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Attendance Details</h3>
        </div>
        <div class="card-body">
		
<div class="row">
<?php
if(isset($_SESSION['officerid']))
{
?>
	<div class="col-md-6">
		Select School
		<select name="schoolid" id="schoolid" class="form-control" required>
			<option value="">Select School</option>
			<?php
				$sqlstudent = "SELECT school.*,state.state,city.city FROM `school` LEFT JOIN state ON school.stateid=state.stateid LEFT JOIN city ON city.cityid=school.cityid WHERE school.status='Active'";
				$qsqlstudent = mysqli_query($con,$sqlstudent);
				while($rstudent = mysqli_fetch_array($qsqlstudent))
				{
					if($_GET['schoolid'] == $rstudent['schoolid'])
					{
						echo "<option value='".$rstudent['schoolid']."' selected >".$rstudent['schoolname'] .", " . $rstudent['state'].", " . $rstudent['city']."</option>";
					}
					else
					{
						echo "<option value='".$rstudent['schoolid']."'  >".$rstudent['schoolname'] .", " . $rstudent['state'].", " . $rstudent['city']."</option>";
					}
				}
			?>
		</select>
	</div>
<?php
}
?>	
	<div class="col-md-3">
		Select month:
		<input type="month" name="selectedmonth" id="selectedmonth" value="<?php echo $_GET['selectedmonth']; ?>" max="<?php echo date("Y-m"); ?>" class="form-control" required>
	</div>
	<div class="col-md-3">
		&nbsp;<br>
		<input type="submit" name="btnsearch" id="btnsearch" class="btn btn-primary" style="width: 100%;">
	</div>
</div>
<hr>
	
<table id="myTable"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Attendance Date</th>
			<th>Present</th>
			<th>Absent</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT attendance.*, student.schoolid FROM attendance LEFT JOIN student ON attendance.studentid=student.studentid WHERE 0=0";
	if(isset($_SESSION['schoolheadmasterid']))
	{
	$sql = $sql . " AND student.schoolid='$rsschoolheadmaster[schoolid]' ";
	}
	else
	{
	$sql = $sql . " AND student.schoolid='$_GET[schoolid]' ";
	}
	$sql= $sql . " AND attendance.attendancedate BETWEEN '$_GET[selectedmonth]-01' AND '$_GET[selectedmonth]-31' ";
	$sql = $sql . " GROUP by attendance.attendancedate ORDER BY attendance.attendancedate ";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqlPresentattendance = "SELECT attendance.*, student.schoolid FROM attendance LEFT JOIN student ON attendance.studentid=student.studentid WHERE  student.schoolid='$rs[schoolid]' AND attendance.attendancestatus='Present' AND attendance.attendancedate = '$rs[attendancedate]' ";
		$qsqlPresentattendance = mysqli_query($con,$sqlPresentattendance);
		$sqlAbsentattendance = "SELECT attendance.*, student.schoolid FROM attendance LEFT JOIN student ON attendance.studentid=student.studentid WHERE  student.schoolid='$rs[schoolid]' AND attendance.attendancestatus='Absent'  AND   attendance.attendancedate = '$rs[attendancedate]' ";
		$qsqlAbsentattendance = mysqli_query($con,$sqlAbsentattendance);
		echo "<tr>
				<td> " . date("d-M-Y",strtotime($rs[attendancedate])) . "</td>
				<td>" . mysqli_num_rows($qsqlPresentattendance) . "</td>
				<td>" . mysqli_num_rows($qsqlAbsentattendance) . "</td>
				<td><a href='attendancestockprint.php?dt=$rs[attendancedate]&schoolid=$rs[schoolid]' class='btn btn-info' target='_blank'>View More</a> </td>
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