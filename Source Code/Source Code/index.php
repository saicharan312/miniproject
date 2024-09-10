<?php
session_start();
error_reporting(0);
if(isset($_SESSION['officerid']))
{
 echo "<script>window.location='fooddepartmentdashboard.php';</script>";
}
if(isset($_SESSION['schoolheadmasterid']))
{
 echo "<script>window.location='headmasterdashboard.php';</script>";
}
if(isset($_SESSION['beoadminid']))
{
 echo "<script>window.location='beoadmindashboard.php';</script>";
}
if(isset($_SESSION['studentid']))
{
 echo "<script>window.location='studentdashboard.php';</script>";
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
<body class="hold-transition login-page" style="background-image: url('images/middaymeals.png');height: 50%;background-position: center;background-repeat: no-repeat;background-size: cover;">


<table style="width: 700px;">
	<tr>
		<td>
		<br>
		<br>
		<div class="row">
			<div class="col-md-6">
		<div class="login-box">
		  <!-- /.login-logo -->
		  <div class="card">
			<div class="card-body login-card-body">
			  <p class="login-box-msg"><b>Food Department Officer</b></p>
			  <form action="fooddepartmentlogin.php" method="post">
				<div class="input-group mb-3">
				 <center><img src="images/fooddepartment.png" style="width: 80%; height: 125px;"></center>
				</div>


			  <div class="social-auth-links text-center mb-3">
				<input type="submit" class="btn btn-block btn-primary"
				value=" Login Panel " name="btnlink">
			  </div>

			  </form>
			</div>
			<!-- /.login-card-body -->
		  </div>
		</div>
			
			</div>
				<div class="col-md-6">
		<div class="login-box">
		  <!-- /.login-logo -->
		  <div class="card">
			<div class="card-body login-card-body">
			  <p class="login-box-msg"><b>School header master</b></p>
			  <form action="schoolheadmasterlogin.php" method="post">
				<div class="input-group mb-3">
				 <center><img src="images/schoolmaster.png" style="width: 80%; height: 125px;"></center>
				</div>


			  <div class="social-auth-links text-center mb-3">
				<input type="submit" class="btn btn-block btn-primary"
				value=" Login Panel " name="btnlink">
			  </div>

			  </form>
			</div>
			<!-- /.login-card-body -->
		  </div>
		</div>


			
			</div>
			<div class="col-md-6">

		<div class="login-box">

		  <!-- /.login-logo -->
		  <div class="card">
			<div class="card-body login-card-body">
			  <p class="login-box-msg"><B>BEO Admin...</B></p>

			  <form action="beoadminlogin.php" method="post">
				<div class="input-group mb-3">
				 <center><img src="images/admin.jpg" style="width: 80%; height: 125px;"></center>
				</div>


			  <div class="social-auth-links text-center mb-3">
				<input type="submit" class="btn btn-block btn-primary"
				value=" Login Panel " name="btnlink">
			  </div>
			  <!-- /.social-auth-links -->

			  </form>
			</div>
			<!-- /.login-card-body -->
		  </div>
		</div>
			</div>
			<div class="col-md-6">

		<div class="login-box">

		  <!-- /.login-logo -->
		  <div class="card">
			<div class="card-body login-card-body">
			  <p class="login-box-msg"><B>Student Login...</B></p>

			  <form action="studentlogin.php" method="post">
				<div class="input-group mb-3">
				 <center><img src="images/studentlogin.jpg" style="width: 80%; height: 125px;"></center>
				</div>


			  <div class="social-auth-links text-center mb-3">
				<input type="submit" class="btn btn-block btn-primary"
				value=" Login Panel " name="btnlink">
			  </div>
			  <!-- /.social-auth-links -->

			  </form>
			</div>
			<!-- /.login-card-body -->
		  </div>
		</div>
			</div>
		</div>
		</td>
	</tr>
</table>



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
