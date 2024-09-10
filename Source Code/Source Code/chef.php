<?php
include("header.php");
include("sidebar.php");
if(!isset($_GET['editid']))
{
	if(isset($_SESSION[schoolheadmasterid]))
	{
		$sqlcountchef ="SELECT * FROM chef  WHERE schoolid='$rsschoolheadmaster[schoolid]'";
		$qsqlcountchef = mysqli_query($con,$sqlcountchef);
		$countchef = mysqli_num_rows($qsqlcountchef);
		echo mysqli_error($con);
		if($countchef >=2)
		{
			echo "<script>alert('Maximum 2 chefs can be added...');</script>";
			echo "<script>window.location='viewchef.php';</script>";
		}
	}
}
if(isset($_POST['submit']))
{
	$condition='';
	if(isset($_FILES["chefimg"]["name"]) && $_FILES["chefimg"]["name"] !=''){
		$target_dir = "chefuploads/";
		$target_file = $target_dir . basename($_FILES["chefimg"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "<script>alert('Sorry, your file was not uploaded.');<script>";
		} else {
			if (move_uploaded_file($_FILES["chefimg"]["tmp_name"], $target_file)) {
				$condition=" ,`chefimg` = '$target_file'";
			} else {
				echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
			}
		}
	}
	
	if(isset($_GET['editid']))
	{		
		$sql ="UPDATE `chef` SET `chefname` = '".$_POST['chefname']."' , `schoolid`='".$_POST['schoolid']."',`cooktype`='".$_POST['cooktype']."',
		`status`='".$_POST['status']."' , `chefsalary` = '".$_POST['chefsalary']."', `chefprofile`= '".$_POST['chefprofile']."', `bankaccountdetail`= '".$_POST['bankaccountdetail']."' $condition
		  WHERE chefid='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Chef record Updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{  
		$sql ="INSERT INTO `chef` SET `chefname` = '".$_POST['chefname']."' , `schoolid`='".$_POST['schoolid']."',`cooktype`='".$_POST['cooktype']."',
		`status`='".$_POST['status']."' , `chefsalary` = '".$_POST['chefsalary']."', `chefprofile`= '".$_POST['chefprofile']."', `bankaccountdetail`= '".$_POST['bankaccountdetail']."' $condition ";
		
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Chef record inserted successfully...');</script>";
			echo "<script>window.location='chef.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM chef where chefid='".$_GET['editid']."'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Chef Master</h3>
        </div>
        <div class="card-body">
		<div class="row">
			<div class="col-md-3">Chef Name</div>
			<div class="col-md-5">
			<input type="text" name="chefname" id="chefname" value="<?php if(isset($rsedit['chefname'])){ echo $rsedit['chefname']; } ?>" class="form-control" />
			</div>
			<div class="col-md-4"><span class="errmsg flash" id="errchefname" style="color: red;"></span></div>
		</div>
		<br>

<?php
	if(isset($_SESSION[schoolheadmasterid]))
	{
		echo "<input type='hidden' name='schoolid' id='schoolid' value='$rsschoolheadmaster[schoolid]'><span class='errmsg flash' id='errschoolid' style='color: red;'></span>";
	}
	else
	{
?>
<div class="row">
	<div class="col-md-3">School</div>
	<div class="col-md-5">
	<select name="schoolid" id="schoolid" class="form-control">
	<option value="">Select school</option>
		<?php
			$sqlstudent = "SELECT school.*, city.city, state.state FROM school LEFT JOIN state on state.stateid=school.stateid left join city ON city.cityid=school.cityid WHERE school.status='Active' ";
			$qsqlstudent = mysqli_query($con,$sqlstudent);
			while($rstudent = mysqli_fetch_array($qsqlstudent)){
				if(isset($rsedit['schoolid']) && $rsedit['schoolid'] == $rstudent['schoolid']) { $selected ="selected"; }else{ $selected =''; }
				echo "<option value='".$rstudent['schoolid']."' $selected >".$rstudent['schoolname'].", ".$rstudent['city'].", ".$rstudent['state']."</option>";
			}

		?>
	</select>		
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errschoolid" style="color: red;"></span></div>
</div>
<br>
<?php
	}
?>
<div class="row">
			<div class="col-md-3">Cook Type</div>
			<div class="col-md-5">
			<select name="cooktype" id="cooktype" class="form-control">
				<option value=''>Select Cook Type</option>
				<?php
					$arr  = array("Cook","Helper");
					foreach($arr as $val)
					{
						if($val == $rsedit[cooktype])
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
			<div class="col-md-4"><span class="errmsg flash" id="errcooktype" style="color: red;"></span></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-3">Chef Image</div>
			<div class="col-md-5">
			<input type="file" name="chefimg" id="chefimg" value="" class="form-control" />
			<?php if(isset($rsedit['chefimg'])){ echo "<img src='".$rsedit['chefimg']."' class='img-fluid' width='80px' height='80px'/>"; } ?>
			</div>
			<div class="col-md-4"><span class="errmsg flash" id="errchefimg" style="color: red;"></span></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-3">Chef Salary</div>
			<div class="col-md-5">
			<input type="text" name="chefsalary" id="chefsalary" value="<?php if(isset($rsedit['chefsalary'])){ echo $rsedit['chefsalary']; } else { echo ""; } ?>" class="form-control" 
<?php
	if(isset($_SESSION[schoolheadmasterid]))
	{
		echo "readonly";
	}
?>		
			/>
<?php
if(isset($_SESSION[schoolheadmasterid]))
	{
		echo "<span style='color: red;'>BEO Admin will update chef Salary.</span>";
	}
?>	
			</div>
			<div class="col-md-4"><span class="errmsg flash" id="errchefsalary" style="color: red;"></span></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-3">Chef Profile</div>
			<div class="col-md-5">
			<textarea name="chefprofile" id="chefprofile" class="form-control"><?php if(isset($rsedit['chefprofile'])){ echo $rsedit['chefprofile']; } ?></textarea>
			</div>
			<div class="col-md-4"><span class="errmsg flash" id="errchefprofile" style="color: red;"></span></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-3">Bank Account details</div>
			<div class="col-md-5">
			<textarea name="bankaccountdetail" id="bankaccountdetail"  class="form-control"><?php if(isset($rsedit['bankaccountdetail'])){ echo $rsedit['bankaccountdetail']; } ?></textarea>
			</div>
			<div class="col-md-4"><span class="errmsg flash" id="errbankaccountdetail" style="color: red;"></span></div>
		</div>
		<br>

<div class="row">
	<div class="col-md-3">Status</div>
	<div class="col-md-5">
<?php
if(isset($_SESSION[schoolheadmasterid]))
{
?>
<input type="text" name="status" id="status" value="<?php 
if(isset($_GET['editid']))
{
	echo $rsedit['status'];
}
else
{
	echo "Pending";
}
?>" class="form-control" <?php
	if(isset($_SESSION[schoolheadmasterid]))
	{
		echo "readonly";
	}
?>	 />
<?php
}
else
{	
?>
		<select class="form-control" name="status" id="status">
		<option value=''>Select status</option>
		<?php
		$arr  = array("Active","Inactive");
		foreach($arr as $val)
		{
			if(isset($rsedit['status']) && $rsedit['status'] == $val)
			{
			echo $val."<option value='$val' selected>$val</option>";
			}
			else
			{
			echo "<option value='$val'>$val</option>";
			}
		}
		?>
		</select>
<?php
}
?>
<?php
	if(isset($_SESSION[schoolheadmasterid]))
	{
		if(!isset($_GET['editid']))
		{	
		echo "<span style='color: red;'>BEO Admin will verify Chef account..</span>";
		}
	}
?>	
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
	if(document.getElementById("chefname").value == "")
	{
		document.getElementById("errchefname").innerHTML="Chef name should not be empty";
		i=1;
	}
	
	if(document.getElementById("schoolid").value == "")
	{
		document.getElementById("errschoolid").innerHTML="Kindly select school ";
		i=1;
	}
	if(document.getElementById("cooktype").value == "")
	{
		document.getElementById("errcooktype").innerHTML="Cook Type should not be empty";
		i=1;
	}
	if(document.getElementById("chefprofile").value == "")
	{
		document.getElementById("errchefprofile").innerHTML="Chef profile should not be empty";
		i=1;
	}
	if(document.getElementById("bankaccountdetail").value == "")
	{
		document.getElementById("errbankaccountdetail").innerHTML="Chef bank account detail should not be empty";
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
