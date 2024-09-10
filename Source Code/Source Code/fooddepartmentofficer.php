<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
			$sql ="UPDATE `fooddepartmentofficer` SET `officername`='".$_POST['officername']."', `cityid`='".$_POST['cityid']."', `stateid`='".$_POST['stateid']."',
		`officercode`='".$_POST['officercode']."',`password`='".$_POST['password']."',`status`='".$_POST['status']."' WHERE officerid='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Food department Officer record Updated successfully...');</script>";
			//echo "<script>window.location='category.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{  
		$sql ="INSERT INTO `fooddepartmentofficer` SET `officername`='".$_POST['officername']."', `cityid`='".$_POST['cityid']."', `stateid`='".$_POST['stateid']."',
		`officercode`='".$_POST['officercode']."',`password`='".$_POST['password']."',`status`='".$_POST['status']."' ";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Food department Officer  record inserted successfully...');</script>";
			echo "<script>window.location='fooddepartmentofficer.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM fooddepartmentofficer where officerid='".$_GET['editid']."'";
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
          <h3 class="card-title">Food Department Officer Master</h3>
        </div>
        <div class="card-body">
		
		<div class="row">
	<div class="col-md-3">Officer Name</div>
	<div class="col-md-5">
		<input class="form-control" name="officername" id="officername" value="<?php if(isset($rsedit['officername'])){ echo $rsedit['officername']; } ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errofficername" style="color: red;"></span></div>
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
	<div class="col-md-3">Officer Code</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="officercode" id="officercode" value="<?php if(isset($rsedit['officercode'])) { echo $rsedit['officercode']; } ?>"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errofficercode" style="color: red;"></span></div>
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

	if(document.getElementById("officername").value == "")
	{
		document.getElementById("errofficername").innerHTML="Officer name should not be empty";
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
	if(document.getElementById("officercode").value == "")
	{
		document.getElementById("errofficercode").innerHTML="Officer code should not be empty";
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
