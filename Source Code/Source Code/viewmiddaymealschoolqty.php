<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM `middaymeal` where middaymealid ='".$_GET['delid']."' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Mid Day Meal record deleted successfully...');</script>";
		echo "<script>window.location='viewmiddaymeal.php?schoolid=$_GET[schoolid]&day=$_GET[day]#$_GET[tab]';</script>";
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
          <h3 class="card-title">View Mid day meal Details</h3>
        </div>
        <div class="card-body">
<table class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>School Image</th>
			<th>School Name</th>
			<th>School Address</th>
			<th>State</th>
			<th>City Name</th>
			<th>PIN Code</th>
			<th>No. of Students</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sqlnostudents = "SELECT * FROM student WHERE schoolid='$_GET[schoolid]'";
	$qsqlnostudents = mysqli_query($con,$sqlnostudents);
	$nostudent = mysqli_num_rows($qsqlnostudents);
	$sql ="SELECT fo.*,cc.city, ss.state FROM school fo,city cc, state ss WHERE cc.cityid = fo.cityid AND fo.stateid = ss.stateid AND cc.stateid = ss.stateid and fo.schoolid='$_GET[schoolid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td><center><img src='".$rs['schoolimage']."' width='80px' height='80px'/></center></td>
			<td>$rs[schoolname]</td>
			<td>$rs[schooladdress]</td>
			<td>$rs[state]</td>
			<td>$rs[city]</td>
			<td>$rs[pincode]</td>
			<td>$nostudent</td>
		</tr>";
	}
	?>
	</tbody>
</table>

<hr>		

<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
			<th>Qty/Week</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid  AND cc.schoolid='$_GET[schoolid]' GROUP BY cc.fooditemid ORDER BY fi.fooditemname";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>";
		echo "<td>$rs[fooditemname]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Monday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		echo "<td>$totqtyrec $rsfi[measurement]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Tuesday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		echo "<td>$totqtyrec $rsfi[measurement]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Wednesday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		echo "<td>$totqtyrec $rsfi[measurement]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Thursday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		echo "<td>$totqtyrec $rsfi[measurement]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Friday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		echo "<td>$totqtyrec $rsfi[measurement]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Saturday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		echo "<td>$totqtyrec $rsfi[measurement]</td>";
		echo "<td>" . $arrqty[$rs[fooditemid]] . " " . $rs[measurement] . " </td>";
		echo "</tr>";
	}
	?>
		
	</tbody>
</table>

<hr>
	 
		
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