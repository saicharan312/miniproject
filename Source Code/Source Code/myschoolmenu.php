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
          <h3 class="card-title">View Mid day meal Details</h3>
        </div>
        <div class="card-body">
	

          <div>
		  
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-Monday-tab" data-toggle="pill" href="#custom-tabs-one-Monday" role="tab" aria-controls="custom-tabs-one-Monday" aria-selected="true">Monday</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-Tuesday-tab" data-toggle="pill" href="#custom-tabs-one-Tuesday" role="tab" aria-controls="custom-tabs-one-Tuesday" aria-selected="false">Tuesday</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-Wednesday-tab" data-toggle="pill" href="#custom-tabs-one-Wednesday" role="tab" aria-controls="custom-tabs-one-Wednesday" aria-selected="false">Wednesday</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-Thursday-tab" data-toggle="pill" href="#custom-tabs-one-Thursday" role="tab" aria-controls="custom-tabs-one-Thursday" aria-selected="false">Thursday</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-Friday-tab" data-toggle="pill" href="#custom-tabs-one-Friday" role="tab" aria-controls="custom-tabs-one-Friday" aria-selected="false">Friday</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-Saturday-tab" data-toggle="pill" href="#custom-tabs-one-Saturday" role="tab" aria-controls="custom-tabs-one-Saturday" aria-selected="false">Saturday</a>
                  </li>				  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-Monday" role="tabpanel" aria-labelledby="custom-tabs-one-Monday-tab">
<!-- ####### Monday Starts Here ############# -->
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Mid day meal Detail</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Monday' AND cc.schoolid='$rsschoolheadmaster[schoolid]'";
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
				//echo $typq = $rs['totqty'] * 1 ;
				//$tqtyl = $typq . " " . $rs['submeasurement'];
				//$tqtyl = str_replace("0.","",$rs['totqty'] - floor($rs['totqty'])) . " " . $rs['submeasurement'];
				
				 $tqtyl =  str_replace("0.","",$rs['totqty']) . " " . $rs['submeasurement'];
			}
		}
		else
		{
		$tqtyl = $rs['totqty'] . " " . $rs['measurement'];
		}
		echo "<tr>
				<td>$rs[fooditemname]</td>
				<td>$tqtyl</td>
				<td>$rs[middaymealdetail]</td>
				<td>$rs[status]</td>
				
			</tr>";
	}
	?>
	</tbody>
</table>
<!-- ####### Monday Ends Here ############# -->

                  </div>
                  
				  <div class="tab-pane fade" id="custom-tabs-one-Tuesday" role="tabpanel" aria-labelledby="custom-tabs-one-Tuesday-tab">
<!-- ####### Tuesday Starts Here ############# -->
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Mid day meal Detail</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Tuesday' AND cc.schoolid='$rsschoolheadmaster[schoolid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$tqtyl = $rs['totqty'] . " " . $rs['measurement'];
		echo "<tr>
				<td>$rs[fooditemname]</td>
				<td>$tqtyl</td>
				<td>$rs[middaymealdetail]</td>
				<td>$rs[status]</td>
				
			</tr>";
	}
	?>
	</tbody>
</table>

<!-- ####### Tuesday Ends Here ############# -->
                  </div>
				                    
				  <div class="tab-pane fade" id="custom-tabs-one-Wednesday" role="tabpanel" aria-labelledby="custom-tabs-one-Wednesday-tab">
<!-- ####### Wednesday Starts Here ############# -->
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Mid day meal Detail</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Wednesday' AND cc.schoolid='$rsschoolheadmaster[schoolid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$tqtyl = $rs['totqty'] . " " . $rs['measurement'];
		echo "<tr>
				<td>$rs[fooditemname]</td>
				<td>$tqtyl</td>
				<td>$rs[middaymealdetail]</td>
				<td>$rs[status]</td>
				
			</tr>";
	}
	?>
	</tbody>
</table>

<!-- ####### Wednesday Ends Here ############# -->
                  </div>
				  				                    
				  <div class="tab-pane fade" id="custom-tabs-one-Thursday" role="tabpanel" aria-labelledby="custom-tabs-one-Thursday-tab">
<!-- ####### Thursday Starts Here ############# -->
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Mid day meal Detail</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Thursday' AND cc.schoolid='$rsschoolheadmaster[schoolid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$tqtyl = $rs['totqty'] . " " . $rs['measurement'];
		echo "<tr>
				<td>$rs[fooditemname]</td>
				<td>$tqtyl</td>
				<td>$rs[middaymealdetail]</td>
				<td>$rs[status]</td>
				
			</tr>";
	}
	?>
	</tbody>
</table>

<!-- ####### Thursday Ends Here ############# -->
                  </div>
				  				  				                    
				  <div class="tab-pane fade" id="custom-tabs-one-Friday" role="tabpanel" aria-labelledby="custom-tabs-one-Friday-tab">
  <!-- ####### Friday Starts Here ############# -->
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Mid day meal Detail</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Friday' AND cc.schoolid='$rsschoolheadmaster[schoolid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$tqtyl = $rs['totqty'] . " " . $rs['measurement'];
		echo "<tr>
				<td>$rs[fooditemname]</td>
				<td>$tqtyl</td>
				<td>$rs[middaymealdetail]</td>
				<td>$rs[status]</td>
				
			</tr>";
	}
	?>
	</tbody>
</table>

<!-- ####### Friday Ends Here ############# --> 
                  </div>
				  				  				  				                    
				  <div class="tab-pane fade" id="custom-tabs-one-Saturday" role="tabpanel" aria-labelledby="custom-tabs-one-Saturday-tab">
<!-- ####### Saturday Starts Here ############# -->
<table  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Mid day meal Detail</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT cc.*,fi.fooditemname,fi.measurement,fi.submeasurement FROM middaymeal cc,fooditem fi  WHERE cc.fooditemid = fi.fooditemid AND cc.day='Saturday' AND cc.schoolid='$rsschoolheadmaster[schoolid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$tqtyl = $rs['totqty'] . " " . $rs['measurement'];
		echo "<tr>
				<td>$rs[fooditemname]</td>
				<td>$tqtyl</td>
				<td>$rs[middaymealdetail]</td>
				<td>$rs[status]</td>
				
			</tr>";
	}
	?>
	</tbody>
</table>

<!-- ####### Saturday Ends Here ############# --> 
                  </div>
				  
                </div>
              </div>
              <!-- /.card -->
            </div>
         
		 </div>

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