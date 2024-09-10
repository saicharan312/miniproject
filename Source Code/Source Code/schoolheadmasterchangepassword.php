<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
		$sql ="UPDATE `schoolheadmaster` SET `password`='".$_POST['npassword']."'  WHERE schoolheadmasterid='$_SESSION[schoolheadmasterid]' AND password='$_POST[opassword]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('School Head Master password Updated successfully...');</script>";
			//echo "<script>window.location='category.php';</script>";
		}
		else
		{
			echo "<script>alert('Failed to update password...');</script>";
		}
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
	<div class="col-md-3">Old Password</div>
	<div class="col-md-5">
		<input type="password" class="form-control" name="opassword" id="opassword"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errpassword" style="color: red;"></span></div>
</div>
<br>


<div class="row">
	<div class="col-md-3">Password</div>
	<div class="col-md-5">
		<input type="password" class="form-control" name="npassword" id="npassword"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errpassword" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Confirm Password</div>
	<div class="col-md-5">
		<input type="password" class="form-control" name="confirmpassword" id="confirmpassword"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errconfirmpassword" style="color: red;"></span></div>
</div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-5">
		<input class="btn btn-primary"  type="submit" name="submit" id="submit" value="Change Password">
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
