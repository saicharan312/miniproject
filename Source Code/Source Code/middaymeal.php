<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
				$sql ="UPDATE `middaymeal` SET  `fooditemid`='".$_POST['fooditemid']."',
		`totqty`='".$_POST['totqty']."',`middaymealdetail`='".$_POST['middaymealdetail']."',`status`='".$_POST['status']."' WHERE middaymealid='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Mid Day Meal record Updated successfully...');</script>";
			//echo "<script>window.location='category.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{  
		$sql ="INSERT INTO middaymeal SET schoolid='$_POST[schoolid]', `day`='".$_POST['day']."',`fooditemid`='".$_POST['fooditemid']."',
		`totqty`='".$_POST['totqty']."',`middaymealdetail`='".$_POST['middaymealdetail']."',`status`='".$_POST['status']."' ";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Mid day meal record inserted successfully...');</script>";
			//echo "<script>window.location='middaymeal.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM middaymeal where middaymealid='".$_GET['editid']."'";
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
          <h3 class="card-title">Mid Day Meal Master | <a href="viewmiddaymeal.php?schoolid=<?php echo $_GET[schoolid]; ?>&day=<?php echo $_GET[day]; ?>">Go Back</a></h3> 
        </div>
        <div class="card-body">
	

<div class="row">
	<div class="col-md-3">School</div>
	<div class="col-md-5">
	<select name="schoolid" id="schoolid" class="form-control">
		<?php
			$sqlstudent = "SELECT * FROM school WHERE status='Active' ";
			$qsqlstudent = mysqli_query($con,$sqlstudent);
			while($rstudent = mysqli_fetch_array($qsqlstudent)){
				$selected ='';
				if($_GET['schoolid']== $rstudent['schoolid']) { echo "<option value='".$rstudent['schoolid']."'  selected >".$rstudent['schoolname']."</option>"; }
				
			}

		?>
	</select>	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errschoolid" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Day</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="day" id="day" value="<?php if(isset($rsedit['day'])){ echo $rsedit['day']; } else { echo $_GET['day'];} ?>" readonly />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errday" style="color: red;"></span></div>
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
				echo "<option value='".$rstudent['fooditemid']."'  $selected >".$rstudent['fooditemname']." ( in $rstudent[measurement] ) (or in $rstudent[submeasurement] ) </option>";
			}

		?>
	</select>	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errfooditemid" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Total Quantity</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="totqty" id="totqty" value="<?php if(isset($rsedit['totqty'])){ echo $rsedit['totqty']; } ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errtotqty" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Any Note</div>
	<div class="col-md-5">
		<textarea class="form-control" name="middaymealdetail" id="middaymealdetail"><?php if(isset($rsedit['middaymealdetail'])){ echo $rsedit['middaymealdetail']; } ?></textarea>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errmiddaymealdetail" style="color: red;"></span></div>
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

	if(document.getElementById("day").value == "")
	{
		document.getElementById("errday").innerHTML="Day should not be empty";
		i=1;
	}

	if(document.getElementById("schoolid").value == "")
	{
		document.getElementById("errschoolid").innerHTML="Kindly select the school";
		i=1;
	}
	if(document.getElementById("fooditemid").value == "")
	{
		document.getElementById("errfooditemid").innerHTML="Kindly select the food item";
		i=1;
	}
	
	if(document.getElementById("totqty").value == "")
	{
		document.getElementById("errtotqty").innerHTML="Total Quantity should not be empty";
		i=1;
	}
	if(document.getElementById("middaymealdetail").value == "")
	{
		document.getElementById("errmiddaymealdetail").innerHTML="Mid day meal details should not be empty";
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
