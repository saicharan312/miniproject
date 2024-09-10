<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	$condition='';
	if(isset($_FILES["headmasterimg"]["name"]) && $_FILES["headmasterimg"]["name"] !=''){
		$target_dir = "headmasteruploads/";
		$target_file = $target_dir . basename($_FILES["headmasterimg"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "<script>alert('Sorry, your file was not uploaded.');<script>";
		} else {
			if (move_uploaded_file($_FILES["headmasterimg"]["tmp_name"], $target_file)) {
				$condition=" ,`headmasterimg` = '$target_file'";
			} else {
				echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
			}
		}
	}
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE `schoolheadmaster` SET `headmastername`='".$_POST['headmastername']."',`schoolid`='".$_POST['schoolid']."',
		`headmastercode`='".$_POST['headmastercode']."',`password`='".$_POST['password']."',`status`='".$_POST['status']."' $condition WHERE schoolheadmasterid='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('School Head Master record Updated successfully...');</script>";
			//echo "<script>window.location='category.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{  
		$sql ="INSERT INTO schoolheadmaster  SET `headmastername`='".$_POST['headmastername']."',`schoolid`='".$_POST['schoolid']."',
		`headmastercode`='".$_POST['headmastercode']."',`password`='".$_POST['password']."' ,`status`='".$_POST['status']."'  $condition ";
		
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('School Head Master record inserted successfully...');</script>";
			echo "<script>window.location='schoolheadmaster.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM schoolheadmaster where schoolheadmasterid='".$_GET['editid']."'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()"  enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">School Head Master</h3>
        </div>
        <div class="card-body">
		

<div class="row">
	<div class="col-md-3">Head Master Name</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="headmastername" id="headmastername" value="<?php if(isset($rsedit['headmastername'])) { echo $rsedit['headmastername']; } ?>"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errheadmastername" style="color: red;"></span></div>
</div>
<br>

<div class="row">
	<div class="col-md-3">School</div>
	<div class="col-md-5">
	<select name="schoolid" id="schoolid" class="form-control">
	<option value="">Select school</option>
		<?php
			$sqlstudent = "SELECT * FROM school WHERE status='Active' ";
			$qsqlstudent = mysqli_query($con,$sqlstudent);
			while($rstudent = mysqli_fetch_array($qsqlstudent)){
					//################
					$sqlstate ="SELECT * FROM state where stateid='$rstudent[stateid]'";
					$qsqlstate = mysqli_query($con,$sqlstate);
					echo mysqli_error($con);
					$rsstate = mysqli_fetch_array($qsqlstate);
					//################
					//################
					$sqlcity ="SELECT * FROM city  where cityid='$rstudent[cityid]'";
					$qsqlcity = mysqli_query($con,$sqlcity);
					echo mysqli_error($con);
					$rscity = mysqli_fetch_array($qsqlcity);
					//################
				if(isset($rsedit['schoolid']) && $rsedit['schoolid'] == $rstudent['schoolid']) { $selected ="selected"; }else{ $selected =''; }
				echo "<option value='".$rstudent['schoolid']."' $selected >".$rstudent['schoolname'].", " . $rscity['city'] . ", " . $rsstate['state'] ."</option>";
			}

		?>
	</select>		
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errschoolid" style="color: red;"></span></div>
</div>
<br>
<div class="row">
			<div class="col-md-3">Head Master Image</div>
			<div class="col-md-5">
			<input type="file" name="headmasterimg" id="headmasterimg" value="" class="form-control" />
			<?php if(isset($rsedit['headmasterimg'])){ echo "<img src='".$rsedit['headmasterimg']."' class='img-fluid' width='80px' height='80px'/>"; } ?>
			</div>
			<div class="col-md-4"><span class="errmsg flash" id="errheadmasterimg" style="color: red;"></span></div>
		</div>
		<br>
<div class="row">
	<div class="col-md-3">Head Master code</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="headmastercode" id="headmastercode" value="<?php if(isset($rsedit['headmastercode'])) { echo $rsedit['headmastercode']; } ?>"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errheadmastercode" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Password</div>
	<div class="col-md-5">
		<input type="password" class="form-control" name="password" id="password" value="<?php if(isset($rsedit['password'])) { echo $rsedit['password']; } ?>"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errpassword" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Confirm Password</div>
	<div class="col-md-5">
		<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" value="<?php if(isset($rsedit['password'])) { echo $rsedit['password']; } ?>"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errconfirmpassword" style="color: red;"></span></div>
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
	if(document.getElementById("headmastername").value == "")
	{
		document.getElementById("errheadmastername").innerHTML="Head master name should not be empty";
		i=1;
	}
	
	if(document.getElementById("headmastercode").value == "")
	{
		document.getElementById("errheadmastercode").innerHTML="Head Master Code should not be empty";
		i=1;
	}
	
	
	if(document.getElementById("schoolid").value == "")
	{
		document.getElementById("errschoolid").innerHTML="Kindly select school ";
		i=1;
	}

	if(document.getElementById("password").value == "")
	{
		document.getElementById("errpassword").innerHTML="Password should not be empty";
		i=1;
	}
	if(document.getElementById("confirmpassword").value == "")
	{
		document.getElementById("errconfirmpassword").innerHTML="Confirm Password should not be empty";
		i=1;
	}

	if(document.getElementById("password").value != document.getElementById("confirmpassword").value)
	{
		document.getElementById("errconfirmpassword").innerHTML=" Confirm Password should match the password";
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
