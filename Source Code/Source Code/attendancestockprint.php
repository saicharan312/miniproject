<?php
include("header.php");
include("sidebar.php");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<br>
<form method="post" action="">
<div id="divprintme">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Mid Day Meal Report -  <?php echo date("d-M-Y",strtotime($_GET['dt'])); ?> </h3>
        </div>
        <div class="card-body">
<table class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Profile Image</th>
			<th>Student Name</th>
			<th>Class </th>
			<th style='text-align: center;'>Present</th>
			<th style='text-align: center;'>Absent</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$totalpresent =0;
$sqlattendance = "SELECT * FROM `attendance` LEFT JOIN student ON attendance.studentid=student.studentid WHERE student.schoolid='$_GET[schoolid]' AND attendance.attendancedate='$_GET[dt]'";
$qsqlattendance = mysqli_query($con,$sqlattendance);
while($rsattendance = mysqli_fetch_array($qsqlattendance))
{
	$sql ="SELECT ss.*,sc.schoolname FROM student ss , school sc WHERE sc.schoolid = ss.schoolid";
	$sql = $sql . " AND ss.studentid='$rsattendance[studentid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$stid=$rs[0];
		echo "
		<tr>
				<td style='width: 100px;'><img src='".$rs['profileimg']."' width='80px' height='80px'/></td>
				<td>$rs[studentname] <br>(<b>Roll No.</b> $rs[rollno])</td>
				<td>$rs[studentclass]<br> <b>Section</b> $rs[section]</td>
				<td style='text-align: center;vertical-align: middle;'>
				<input type='hidden' name='attendanceid[]' id='attendanceid[]' value='$stid'  style='border: 0px;width: 100%;height: 2em;' >
				<input type='hidden' name='attstatus[]' id='attstatus[]' value='$arrattstatus[$stid]'  style='border: 0px;width: 100%;height: 2em;'   >
					";
if($rsattendance['attendancestatus'] == "Present")
{
	echo " <i class='fa fa-check-circle' aria-hidden='true' style='color: green;'></i> ";
	$totalpresent = $totalpresent + 1;
}				
		echo "
				</td>
				<td style='text-align: center;vertical-align: middle;'>
					 ";
if($rsattendance['attendancestatus'] == "Absent")
{
	echo " <i class='fa fa-check-circle' aria-hidden='true' style='color: red;'></i> ";
}				
		echo " </td>
			</tr>";
	}
}
	?>
	</tbody>
</table>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->
    </section>
	
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">

        <div class="card-header">
          <h3 class="card-title">Todays menu  - <?php echo $today = date("l",strtotime($_GET[dt])); ?></h3>
        </div>
        <div class="card-body">
<!-- ####### Monday Starts Here ############# -->
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>SL No.</th>
			<th>Item Name</th>
			<th>Mid Day Meal Detail</th>
			<th style='text-align: center;'>Spent Qty</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$err=0;
	$slno=1;
	$sql ="SELECT stock.*, fooditem.fooditemname, fooditem.measurement from stock LEFT JOIN fooditem ON fooditem.fooditemid=stock.fooditemid where stock.entrydate='$_GET[dt]' AND stocktype='Spent' AND stock.schoolid='$_GET[schoolid]' ";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqlmiddaymeal = "SELECT * FROM middaymeal WHERE schoolid='$_GET[schoolid]' AND fooditemid='$rs[fooditemid]' AND day='$today'";
		$qsqlmiddaymeal = mysqli_query($con,$sqlmiddaymeal);
		$rsmiddaymeal = mysqli_fetch_array($qsqlmiddaymeal);
			echo "<tr>
				<td>$slno </td>
				<td>$rs[fooditemname] </td>
				<td>$rsmiddaymeal[middaymealdetail] </td>
				<td style='text-align: center;'>$rs[stockqty] $rs[measurement]</td>			
			</tr>";
			$slno = $slno +1;
	}
	?>
	</tbody>
</table>
<!-- ####### Monday Ends Here ############# -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>    

</div>
	
	<!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
			<center><input type="button" name="submit" class="btn btn-primary" id="submit" value="Print Report" onclick="printme('divprintme')" ></center>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
</form>
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
<script>
function confirmalert(countss)
{
	alert("You cannot submit.. "  + countss + " product is out of stock...");
}
function printme(divName)
{
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
</script>