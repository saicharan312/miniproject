<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{

	$condition='';
	if(isset($_FILES["profileimg"]["name"]) && $_FILES["profileimg"]["name"] !=''){
		$target_dir = "studentuploads/";
		$target_file = $target_dir . basename($_FILES["profileimg"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "<script>alert('Sorry, your file was not uploaded.');<script>";
		} else {
			if (move_uploaded_file($_FILES["profileimg"]["tmp_name"], $target_file)) {
				$condition=" ,`profileimg` = '$target_file'";
			} else {
				echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
			}
		}
	}
		$sql ="UPDATE student SET studentname='".$_POST['studentname']."',rollno='".$_POST['rollno']."',`dateofbirth`='".$_POST['dateofbirth']."',`schoolid`='".$_POST['schoolid']."',`studentclass`='".$_POST['studentclass']."',`section`='".$_POST['section']."',`studentaddress`='".$_POST['studentaddress']."',
		`contactnumber`='".$_POST['contactnumber']."',status='".$_POST['status']."' $condition WHERE studentid='$_SESSION[studentid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Student profile updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
}
?>
<?php
if(isset($_SESSION[studentid]))
{
	//Step 2 : Select statement starts here
	$sqledit ="SELECT * FROM student WHERE studentid='$_SESSION[studentid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	//Step 2 : Select statement ends here
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
          <h3 class="card-title">Student Master</h3>
        </div>
        <div class="card-body">
		
<div class="row">
	<div class="col-md-3">School</div>
	<div class="col-md-5">
	<select name="schoolid" id="schoolid" class="form-control">
		<?php
			$sqlstudent = "SELECT * FROM school WHERE status='Active' ";
			$qsqlstudent = mysqli_query($con,$sqlstudent);
			while($rstudent = mysqli_fetch_array($qsqlstudent))
			{
					if($rsedit['schoolid'] == $rstudent['schoolid'])
					{
						echo "<option value='".$rstudent['schoolid']."'  >".$rstudent['schoolname']."</option>";
					}
			}
		?>
	</select>		
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errschoolid" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Class</div>
	<div class="col-md-5">
		<select  class="form-control" name="studentclass" id="studentclass">
			<?php
			$arr = array("1st Standard","2nd Standard","3rd Standard","4th Standard","5th Standard","6th Standard","7th Standard","8th Standard");
			foreach($arr as $val)
			{
				if($val == $rsedit[studentclass])
				{
				echo "<option value='$val' selected>$val</option>";
				}
			}
			?>
		</select>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstudentclass" style="color: red;"></span></div>
</div>
<br>	
<div class="row">
	<div class="col-md-3">Section</div>
	<div class="col-md-5">
	<input type="text"  class="form-control" name="section" id="section" value="<?php if(isset($rsedit['section'])){ echo $rsedit['section']; } ?>">
	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errsection" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Student Name</div>
	<div class="col-md-5">
		<input type="text"  class="form-control" name="studentname" id="studentname" value="<?php  if(isset($rsedit['studentname'])){ echo $rsedit['studentname']; } ?>">
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstudentname" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Roll Number</div>
	<div class="col-md-5">
		<input type="text"  class="form-control" name="rollno" id="rollno" value="<?php if(isset($rsedit['rollno'])){ echo $rsedit['rollno']; } ?>">
		
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errrollno" style="color: red;"></span></div>
</div>
<br>
	
<div class="row">
	<div class="col-md-3">Date of birth</div>
	<div class="col-md-5">
	<input type="date"  class="form-control" name="dateofbirth" id="dateofbirth" value="<?php if(isset($rsedit['dateofbirth'])){ echo $rsedit['dateofbirth']; } ?>">
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errdateofbirth" style="color: red;"></span></div>
</div>
<br>
<div class="row">	
<div class="col-md-3">Student Image</div>
			<div class="col-md-5">
			<input type="file" name="profileimg" id="profileimg" value="" class="form-control" />
			<?php if(isset($rsedit['profileimg'])){ echo "<img src='".$rsedit['profileimg']."' class='img-fluid' width='80px' height='80px'/>"; } ?>
			</div>
			<div class="col-md-4"><span class="errmsg flash" id="errprofileimg" style="color: red;"></span></div>
		</div>
		<br>
<div class="row">
	<div class="col-md-3">Student Address</div>
	<div class="col-md-5">
		<textarea  class="form-control" name="studentaddress" id="studentaddress" ><?php if(isset( $rsedit['studentaddress'])){ echo $rsedit['studentaddress']; } ?></textarea>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstudentaddress" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Contact Number</div>
	<div class="col-md-5">
		<input type="text"  class="form-control" name="contactnumber" id="contactnumber" value="<?php  if(isset( $rsedit['contactnumber'])){ echo $rsedit['contactnumber']; } ?>">
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errcontactnumber" style="color: red;"></span></div>
</div>
<br>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-5">
		<input class="btn btn-primary btn-block"  type="submit" name="submit" id="submit" value="Update Profile">
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
	if(document.getElementById("studentname").value == "")
	{
		document.getElementById("errstudentname").innerHTML="Student Name should not be empty";
		i=1;
	}
	
	if(document.getElementById("rollno").value == "")
	{
		document.getElementById("errrollno").innerHTML="Roll number should not be empty";
		i=1;
	}
	
	
	if(document.getElementById("password").value.length < 6)
	{
		document.getElementById("errpassword").innerHTML="Password should contain more than 6 characters";
		i=1;
	}
	if(document.getElementById("password").value == "")
	{
		document.getElementById("errpassword").innerHTML="Password code should not be empty";
		i=1;
	}
	if(document.getElementById("confirmpassword").value != document.getElementById("password").value)
	{
		document.getElementById("errconfirmpassword").innerHTML="Password and Confirm password not matching";
		i=1;
	}
	if(document.getElementById("confirmpassword").value == "")
	{
		document.getElementById("errconfirmpassword").innerHTML="Confirm Password  should not be empty";
		i=1;
	}
	if(document.getElementById("studentclass").value == "")
	{
		document.getElementById("errstudentclass").innerHTML="Student class should not be empty";
		i=1;
	}
	if(document.getElementById("dateofbirth").value == "")
	{
		document.getElementById("errdateofbirth").innerHTML="Student Date of birth should not be empty";
		i=1;
	}
	if(document.getElementById("section").value == "")
	{
		document.getElementById("errsection").innerHTML="Student section should not be empty";
		i=1;
	}
	if(document.getElementById("studentaddress").value == "")
	{
		document.getElementById("errstudentaddress").innerHTML="Student address should not be empty";
		i=1;
	}
	if(document.getElementById("contactnumber").value == "")
	{
		document.getElementById("errcontactnumber").innerHTML="Student contact number should not be empty";
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
