<?php
include("header.php");
include("sidebar.php");
//attendanceid attstatus
$arrattendanceid = $_POST['attendanceid'];
$arrattstatus = $_POST['attstatus'];
$arrfooditemid = $_POST['fooditemid'];
$arrspent = $_POST['spent'];
if(isset($_POST['submitentry']))
{
	for($i=0;$i<count($arrattendanceid);$i++)
	{
		$sql = "INSERT INTO attendance(studentid,attendancedate,attendancestatus) VALUES('$arrattendanceid[$i]','$dt','$arrattstatus[$i]')";
		$qsql = mysqli_query($con,$sql);
	}
	for($i=0;$i<count($arrfooditemid);$i++)
	{
		$sql = "INSERT INTO stock(schoolid,fooditemid,stocktype,entrydate,stockqty,status) VALUES('$rsschoolheadmaster[schoolid]','$arrfooditemid[$i]','Spent','$dt','$arrspent[$i]','Paid')";
		$qsql = mysqli_query($con,$sql);
	}
	echo "<script>alert('Attendance entry submitted successfully...');</script>";
	echo "<script>window.location='attendancestockprint.php?dt=$dt&schoolid=$rsschoolheadmaster[schoolid]';</script>";
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<br>
<form method="post" action="">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Attendance entry for <?php echo date("d-M-Y"); ?> </h3>
        </div>
        <div class="card-body">
<table id="allrecord"  class="table table-striped table-bordered" >
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
for($i=0;$i<count($arrattendanceid);$i++)
{
	$sql ="SELECT ss.*,sc.schoolname FROM student ss , school sc WHERE sc.schoolid = ss.schoolid";
	$sql = $sql . " AND ss.studentid='$arrattendanceid[$i]'";
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
if($arrattstatus[$stid] == "Present")
{
	echo " <i class='fa fa-check-circle' aria-hidden='true' style='color: green;'></i> ";
	$totalpresent = $totalpresent + 1;
}				
		echo "
				</td>
				<td style='text-align: center;vertical-align: middle;'>
					 ";
if($arrattstatus[$stid] == "Absent")
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
          <h3 class="card-title">Todays menu  - <?php echo $today = date("l"); ?></h3>
        </div>
        <div class="card-body">
<!-- ####### Monday Starts Here ############# -->
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Mid day meal Detail</th>
			<th style='text-align: center;'>Required <br>Qty/Student</th>
			<th style='text-align: center;'>Available Qty</th>
			<th style='text-align: center;'>Spent Qty</th>
			<th style='text-align: center;'>Balance Qty</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$err=0;
	$sql ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='$today' AND cc.schoolid='$rsschoolheadmaster[schoolid]' AND cc.status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs['totqty'] < 1)
		{
			if($rs['submeasurement'] == "NIL")
			{
			$tqtyl = $rs['totqty'] . " " . $rs['measurement'];
			}
			else
			{
			$tqtyl =  str_replace("0.","",$rs['totqty']) . " " . $rs['submeasurement'];
			}
		}
		else
		{
			$tqtyl = $rs['totqty'] . " " . $rs['measurement'];
		}
		
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
		
		$balqty = $receivedqty - $spentqty;
		
		$spent = $totalpresent * $rs['totqty'];
		
		$bal = $balqty - $spent;
		
		if($bal <= 0)
		{			
			echo "<tr style='color: red;'>
				<th>$rs[fooditemname] </th>
				<th>$rs[middaymealdetail]</th>
				<th style='text-align: center;'>$tqtyl</th>
				<th style='text-align: center;'>$balqty $rs[measurement]</th>
				<th style='text-align: center;'>$spent $rs[measurement]</th>
				<th style='text-align: center;'>$bal $rs[measurement]</th>				
			</tr>";
			$err = $err + 1;
		}
		else
		{
			echo "<tr>
				<td>$rs[fooditemname] </td>
				<td>$rs[middaymealdetail]</td>
				<td style='text-align: center;'>$tqtyl</td>
				<td style='text-align: center;'>$balqty $rs[measurement]</td>
				<td style='text-align: center;'>$spent $rs[measurement]";
			echo "<input type='hidden' name='fooditemid[]' id='fooditemid[]' value='$rs[fooditemid]' >";
			echo "<input type='hidden' name='spent[]' id='spent[]' value='$spent' >";
			echo "</td>
				<td style='text-align: center;'>$bal $rs[measurement]</td>				
			</tr>";
		}
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
	
	<!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
		<?php
		if($err > 0)
		{
		?>
			<center><input type="button" name="submit" class="btn btn-secondary" id="submit" value="Stock Out Shortage" onclick="confirmalert('<?php echo $err; ?>')" ></center>
		<?php
		}
		else
		{
		?>
			<center><input type="submit" name="submitentry" class="btn btn-info" id="submitentry" value="Submit Attendance Entry" ></center>
		<?php
		}
		?>
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
</script>