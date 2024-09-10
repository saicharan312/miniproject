<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	$condition='';
	if(isset($_FILES["schoolimage"]["name"]) && $_FILES["schoolimage"]["name"] !=''){
		$target_dir = "schooluploads/";
		$target_file = $target_dir . basename($_FILES["schoolimage"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "<script>alert('Sorry, your file was not uploaded.');<script>";
		} else {
			if (move_uploaded_file($_FILES["schoolimage"]["tmp_name"], $target_file)) {
				$condition=" ,`schoolimage` = '$target_file'";
			} else {
				echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
			}
		}
	}
	if(isset($_GET['editid']))
	{
			$sql ="UPDATE `school` SET `schoolname`='".$_POST['schoolname']."', `schooladdress`='".$_POST['schooladdress']."', `cityid`='".$_POST['cityid']."', `stateid`='".$_POST['stateid']."',
		`pincode`='".$_POST['pincode']."',`status`='".$_POST['status']."' $condition WHERE schoolid='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('School record Updated successfully...');</script>";
			//echo "<script>window.location='category.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{  
		$sql ="INSERT INTO `school` SET `schoolname`='".$_POST['schoolname']."', `schooladdress`='".$_POST['schooladdress']."', `cityid`='".$_POST['cityid']."', `stateid`='".$_POST['stateid']."',
		`pincode`='".$_POST['pincode']."',`status`='".$_POST['status']."' $condition   ";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('School record inserted successfully...');</script>";
			echo "<script>window.location='school.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM school where schoolid='".$_GET['editid']."'";
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
          <h3 class="card-title">School  Master</h3>
        </div>
        <div class="card-body">
	
		<div class="row">
	<div class="col-md-3">School Name</div>
	<div class="col-md-5">
	
		<input class="form-control" name="schoolname" id="schoolname" value="<?php if(isset($rsedit['schoolname'])){ echo $rsedit['schoolname']; } ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errschoolname" style="color: red;"></span></div>
</div>
<br>

<div class="row">
	<div class="col-md-3">School Address</div>
	<div class="col-md-5">
	
		<input class="form-control" name="schooladdress" id="schooladdress" value="<?php if(isset($rsedit['schooladdress'])){ echo $rsedit['schooladdress']; } ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errschooladdress" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">State Name</div>
	<div class="col-md-5">
	<select name="stateid" id="stateid" class="form-control" onchange="loadcity(this.value)">
	<option value="">Select state</option>
		<?php
			$sqlstudent = "SELECT * FROM state WHERE status='Active' ";
			$qsqlstudent = mysqli_query($con,$sqlstudent);
			while($rstudent = mysqli_fetch_array($qsqlstudent)){
				$selected ='';
				if(isset($rsedit['stateid'])  && $rsedit['stateid']== $rstudent['stateid']) { $selected ="selected"; }else{ $selected =''; }
				echo "<option value='".$rstudent['stateid']."'  $selected >".$rstudent['state']."</option>";
			}

		?>
	</select>	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstateid" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">City Name</div>
	<div class="col-md-5" id="divcity"><?php include("ajaxcity.php"); ?></div>
	<div class="col-md-4"><span class="errmsg flash" id="errcityid" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Pin Code</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="pincode" id="pincode" value="<?php if(isset($rsedit['pincode'])) { echo $rsedit['pincode']; } ?>"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errpincode" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">School Image</div>
	<div class="col-md-5">
			<input type="file" name="schoolimage" id="schoolimage" value="" class="form-control" />
			<?php if(isset($rsedit['schoolimage'])){ echo "<img src='".$rsedit['schoolimage']."' class='img-fluid' width='80px' height='80px'/>"; } ?>
			
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errpassword" style="color: red;"></span></div>
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

	if(document.getElementById("schoolname").value == "")
	{
		document.getElementById("errschoolname").innerHTML="School name should not be empty";
		i=1;
	}
	if(document.getElementById("schooladdress").value == "")
	{
		document.getElementById("errschooladdress").innerHTML="School address should not be empty";
		i=1;
	}
	
	if(document.getElementById("stateid").value == "")
	{
		document.getElementById("errstateid").innerHTML="Kindly select the state";
		i=1;
	}
	if(document.getElementById("cityid").value == "")
	{
		document.getElementById("errcityid").innerHTML="Kindly select the city";
		i=1;
	}
	if(document.getElementById("pincode").value == "")
	{
		document.getElementById("errpincode").innerHTML="School pincode should not be empty";
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
<script>
function loadcity(stateid)
{
    if (stateid == "") {
        document.getElementById("divcity").innerHTML = "<select name='cityid' id='cityid' class='form-control'><option value=''>Select city</option></select>";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {				
                document.getElementById("divcity").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxcity.php?stateid="+stateid,true);
        xmlhttp.send();
    }
}
</script>
</body>
</html>
