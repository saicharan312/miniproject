<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		
	$sql ="UPDATE `stock` SET `schoolid`='".$_POST['schoolid']."', `studentid`='".$_POST['studentid']."',`fooditemid`='".$_POST['fooditemid']."',
			`stocktype`='".$_POST['stocktype']."',`entrydate`='".$_POST['entrydate']."',
			`stockqty`='".$_POST['stockqty']."',`description`='".$_POST['description']."',`status`='".$_POST['status']."' WHERE stockid='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Stock record Updated successfully...');</script>";
			//echo "<script>window.location='category.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{  
		$sql ="INSERT INTO `stock` SET `schoolid`='".$_POST['schoolid']."', `studentid`='".$_POST['studentid']."',`fooditemid`='".$_POST['fooditemid']."',
		`stocktype`='".$_POST['stocktype']."',`entrydate`='".$_POST['entrydate']."',
		`stockqty`='".$_POST['stockqty']."',`description`='".$_POST['description']."',`status`='".$_POST['status']."' ";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Stock record inserted successfully...');</script>";
			echo "<script>window.location='stock.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM stock where stockid='".$_GET['editid']."'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Stock Master</h3>
        </div>
        <div class="card-body">
	
		<div class="row">
	<div class="col-md-3">Entry date</div>
	<div class="col-md-5">
		<input type="date" class="form-control" name="entrydate" id="entrydate" value="<?php if(isset($rsedit['entrydate'])){ echo $rsedit['entrydate']; } ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errentrydate" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Stock Type</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="stocktype" id="stocktype" value="<?php if(isset($rsedit['stocktype'])){ echo $rsedit['stocktype']; } ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstocktype" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">School</div>
	<div class="col-md-5">
	<select name="schoolid" id="schoolid" class="form-control">
	<option value="">Select School</option>
		<?php
			$sqlstudent = "SELECT * FROM school WHERE status='Active' ";
			$qsqlstudent = mysqli_query($con,$sqlstudent);
			while($rstudent = mysqli_fetch_array($qsqlstudent)){
				$selected ='';
				if(isset($rsedit['schoolid'])  && $rsedit['schoolid']== $rstudent['schoolid']) { $selected ="selected"; }else{ $selected =''; }
				echo "<option value='".$rstudent['schoolid']."'  $selected >".$rstudent['schoolname']."</option>";
			}

		?>
	</select>	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errschoolid" style="color: red;"></span></div>
</div>
<br>

<div class="row">
	<div class="col-md-3">Student</div>
	<div class="col-md-5">
	<select name="studentid" id="studentid" class="form-control">
	<option value="">Select Student</option>
		<?php
			$sqlstudent = "SELECT * FROM student WHERE status='Active' ";
			$qsqlstudent = mysqli_query($con,$sqlstudent);
			while($rstudent = mysqli_fetch_array($qsqlstudent)){
				$selected ='';
				if(isset($rsedit['studentid'])  && $rsedit['studentid']== $rstudent['studentid']) { $selected ="selected"; }else{ $selected =''; }
				echo "<option value='".$rstudent['studentid']."'  $selected >".$rstudent['studentname']."</option>";
			}

		?>
	</select>	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstudentid" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Food Item</div>
	<div class="col-md-5">
	<select name="fooditemid" id="fooditemid" class="form-control">
	<option value="">Select Food Item</option>
		<?php
			$sqlstudent = "SELECT * FROM fooditem WHERE status='Active' ";
			$qsqlstudent = mysqli_query($con,$sqlstudent);
			while($rstudent = mysqli_fetch_array($qsqlstudent)){
				$selected ='';
				if(isset($rsedit['fooditemid'])  && $rsedit['fooditemid']== $rstudent['fooditemid']) { $selected ="selected"; }else{ $selected =''; }
				echo "<option value='".$rstudent['fooditemid']."'  $selected >".$rstudent['fooditemname']."</option>";
			}

		?>
	</select>	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errfooditemid" style="color: red;"></span></div>
</div>
<br>

<div class="row">
	<div class="col-md-3">Stock Quantity</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="stockqty" id="stockqty" value="<?php if(isset($rsedit['stockqty'])){ echo $rsedit['stockqty']; } ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstockqty" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Description</div>
	<div class="col-md-5">
		<textarea class="form-control" name="description" id="description"><?php if(isset($rsedit['description'])){ echo $rsedit['description']; } ?></textarea>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errdescription" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Status</div>
	<div class="col-md-5">
		<select class="form-control" name="status" id="status">
		<option value="">Select Status</option>
		<?php
		 $arr  = array("Active","Inactive");
		 foreach($arr as $val)
			{
				if($rsedit['status'] == $val)
				{
				echo "<option value='$val' selected>$val</option>";
				}
				else
				{
				echo "<option value='$val'>$val</option>";
				}
			}
		?>
		</select>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstatus" style="color: red;"></span></div>
</div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-5">
		<input class="btn btn-primary"  type="submit" name="submit" id="submit" value="Submit">
	</div>
	<div class="col-md-4"></div>
</div>
        </div>
        <!-- /.card-footer-->
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

<script>
function confirmvalidation()
{
		var i = 0;
	$('.errmsg').html('');

	if(document.getElementById("entrydate").value == "")
	{
		document.getElementById("errentrydate").innerHTML="Entrydate should not be empty";
		i=1;
	}
	if(document.getElementById("stocktype").value == "")
	{
		document.getElementById("errstocktype").innerHTML="Stock Type should not be empty";
		i=1;
	}
	

	if(document.getElementById("schoolid").value == "")
	{
		document.getElementById("errschoolid").innerHTML="Kindly select the school";
		i=1;
	}
	if(document.getElementById("studentid").value == "")
	{
		document.getElementById("errstudentid").innerHTML="Kindly select the student";
		i=1;
	}

	if(document.getElementById("fooditemid").value == "")
	{
		document.getElementById("errfooditemid").innerHTML="Kindly select the food item";
		i=1;
	}
	
	if(document.getElementById("stockqty").value == "")
	{
		document.getElementById("errstockqty").innerHTML="Stock Quantity should not be empty";
		i=1;
	}
	if(document.getElementById("description").value == "")
	{
		document.getElementById("errdescription").innerHTML="Description should not be empty";
		i=1;
	}
		
	if(document.getElementById("status").value == "")
	{
		document.getElementById("errstatus").innerHTML="Kindly select the status";
		i=1;
	}
	 
	if(i == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
</body>
</html>
