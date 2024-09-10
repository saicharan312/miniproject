<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	//fooditemid stockqty tcost totalcost	
	$sql ="INSERT INTO `stock_invoice` SET `officerid`='$rsfooddepartmentofficer[officerid]', `schoolid`='$_GET[schoolid]',`stocktype`='Entry',`entrydate`='$dt',`totalcost`='".$_POST['totalcost']."',`invoice_status`='Delivered' ";
	$qsql = mysqli_query($con,$sql);
	$insid = mysqli_insert_id($con);
	//Stock loop starts here
	$fooditemid = 	$_POST['fooditemid'];
	$stockqty =	$_POST['stockqty'];
	$tcost = 	$_POST['tcost'];
	//echo count($_POST[fooditemid]);
	for($i=0; $i<count($_POST[fooditemid]); $i++)
	{
		$sql ="INSERT INTO `stock` SET stock_invoice_id='$insid',officerid='$rsfooddepartmentofficer[officerid]',`schoolid`='$_GET[schoolid]', `studentid`='0',`fooditemid`='$fooditemid[$i]', `stocktype`='Entry',`entrydate`='$dt',`stockqty`='$stockqty[$i]',`tcost`='$tcost[$i]',`status`='Delivered' ";
		$qsql = mysqli_query($con,$sql);
	}
	//Stock loop ends here
	echo "<script>window.location='stockinvoicereceipt.php?stock_invoice_id=$insid';</script>";
}
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM `school` where schoolid ='".$_GET['delid']."' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('School record deleted successfully...');</script>";
		echo "<script>window.location='viewschool.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
$sqlnostudents = "SELECT * FROM student WHERE schoolid='$_GET[schoolid]' ";
$qsqlnostudents = mysqli_query($con,$sqlnostudents);
$nostudent = mysqli_num_rows($qsqlnostudents);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
<form method="post" action="" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>School Image</th>
			<th>School Name</th>
			<th>School Address</th>
			<th>State</th>
			<th>City Name</th>
			<th>PIN Code</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql1 ="SELECT fo.*,cc.city, ss.state FROM school fo,city cc, state ss WHERE cc.cityid = fo.cityid AND fo.stateid = ss.stateid AND cc.stateid = ss.stateid AND fo.schoolid='$_GET[schoolid]'";
	$qsql1 = mysqli_query($con,$sql1);
	echo mysqli_error($con);
	while($rs1 = mysqli_fetch_array($qsql1))
	{
		echo "<tr>
				<td><center><img src='".$rs1['schoolimage']."' width='80px' height='80px'/></center></td>
				<td>$rs1[schoolname]</td>
				<td>$rs1[schooladdress]</td>
				<td>$rs1[state]</td>
				<td>$rs1[city]</td>
				<td>$rs1[pincode]</td>
			</tr>";
	}
	?>
	</tbody>
</table>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Add stock</h3>
        </div>
        <div class="card-body">
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Category</th>
			<th>Required Qty/Week</th>
			<th>Supplied Qty</th>
			<th>Total cost</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement,fi.foodcategoryid FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid  AND cc.schoolid='$_GET[schoolid]' GROUP BY cc.fooditemid ORDER BY fi.foodcategoryid";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqlfoodcategory ="SELECT * FROM foodcategory WHERE foodcategoryid = '$rs[foodcategoryid]'";
		$qsqlfoodcategory = mysqli_query($con,$sqlfoodcategory);
		$rsfoodcategory = mysqli_fetch_array($qsqlfoodcategory);
		echo "<tr>";
		echo "<td>$rs[fooditemname]</td>";
		echo "<td>$rsfoodcategory[foodcategory]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Monday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Tuesday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		//echo "<td>$totqtyrec $rsfi[measurement]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Wednesday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		//echo "<td>$totqtyrec $rsfi[measurement]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Thursday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		//echo "<td>$totqtyrec $rsfi[measurement]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Friday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		//echo "<td>$totqtyrec $rsfi[measurement]</td>";
		$totqtyrec=0;
		$sqlfi ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Saturday' AND cc.schoolid='$_GET[schoolid]' AND cc.fooditemid='$rs[fooditemid]'";
		$qsqlfi = mysqli_query($con,$sqlfi);
		echo mysqli_error($con);
		$rsfi = mysqli_fetch_array($qsqlfi);
		$totqtyrec = $rsfi[totqty] * $nostudent;
		$arrqty[$rs[fooditemid]] = $arrqty[$rs[fooditemid]] +  $totqtyrec;
		//echo "<td>$totqtyrec $rsfi[measurement]</td>";
		echo "<td>" . $arrqty[$rs[fooditemid]] . " " . $rs[measurement] . " </td>";
		echo "<td>
		<input type='hidden' name='fooditemid[]'  name='fooditemid[]' value='$rs[fooditemid]' class='form-control' required>
		<input type='text' name='stockqty[]'  name='stockqty[]' class='form-control' required></td>";
		echo "<td><input type='text' name='tcost[]'  name='tcost[]' class='form-control' required onkeyup='calculatetotal()' onchange='calculatetotal()' > </td>";
		echo "</tr>";
	}
	?>
	</tbody>
	<tfoot>
			<th></th>
			<th></th>
			<th></th>
			<th>Total Cost</th>
			<th><input type='text' name='totalcost'  name='totalcost' class='form-control' readonly></th>
	</tfoot>
</table>

        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
	
		
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
<center><input type="submit" name="submit" id="submit" value="Submit stock Entry" class="btn btn-info" ></center>
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
<script>
function calculatetotal()
{
	//Get a list of input fields to sum
	var elements = document.getElementsByName("tcost[]");
	var element_array = Array.prototype.slice.call(elements);

	//Assign the keyup event handler
	for(var i=0; i < element_array.length; i++){
		element_array[i].addEventListener("keyup", sum_values);
	}

	//Function to sum the values and assign it to the last input field
	function sum_values(){
		var tamt = 0;
		var sum = 0;
		for(var i=0; i < element_array.length; i++){
			if(element_array[i].value == "")
			{
				sum += parseInt(0, 10);
			}
			else
			{
				sum += parseInt(element_array[i].value, 10);
			}
		}
		document.getElementsByName("totalcost")[0].value = sum;
	}
}
</script>