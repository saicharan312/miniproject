<?php
session_start();
error_reporting(0);
if(isset($_SESSION['officerid']))
{
 echo "<script>window.location='fooddepartmentdashboard.php';</script>";
}
if(isset($_SESSION['schoolheadmasterid']))
{
 echo "<script>window.location='schoolheadmasterdashboard.php';</script>";
}
if(isset($_SESSION['beoadminid']))
{
 echo "<script>window.location='beoadmindashboard.php';</script>";
}
if(isset($_SESSION['studentid']))
{
 echo "<script>window.location='studentdashboard.php';</script>";
}
include("database.php");
//  
if(isset($_POST["btnsubmit"]))
{
	$sql = "SELECT * FROM beoadmin WHERE loginid='$_POST[loginid]' AND password='$_POST[loginpassword]' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION['beoadminid']  = $rs['beoadminid'];
		echo "<script>window.location='beoadmindashboard.php';</script>";
	}
	else
	{
		echo "<script>alert('Entered Login credentials not valid..');</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mid Day Meals</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image: url('images/middaymeals.png');background-repeat: no-repeat; background-attachment: fixed; background-size: cover;width: 100%;">

<div class="row">
	<div class="col-md-6">
	<br><br><br><br>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
<img src="images/fooddepartment.png" style="width: 100%;">
    </div>
    <!-- /.login-card-body -->
  </div>
</div>


	
	</div>
		<div class="col-md-6">
	<br><br><br>
	<br><br><br>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><b>BEO ADMIN LOGIN WINDOW</b></p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="loginid" id="loginid" class="form-control" placeholder="Enter Login ID">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="loginpassword" id="loginpassword" class="form-control" placeholder="Enter Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
      <div class="social-auth-links text-center mb-3">
		<input type="submit" class="btn btn-block btn-primary"
        value=" Click here to Login " name="btnsubmit">
      </div>
      <!-- /.social-auth-links -->

      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>


	
	</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
