<?php
include("header.php");
include("sidebar.php");
if(isset($_POST[submit]))
{
	if(isset($_SESSION[schoolheadmasterid]))
	{
		$replyby = "Headmaster Reply";
	}
	if(isset($_SESSION[beoadminid]))
	{
		$replyby = "Admin Reply";
	}
	$complaint_date = date("Y-m-d H:i:s");
	$attachments = rand() . $_FILES["attachments"]["name"];
	move_uploaded_file($_FILES["attachments"]["tmp_name"],"docscomplaint/".$attachments);
	$complainnote = mysqli_real_escape_string($con,$_POST['complaint_note']);
	$sql ="INSERT INTO complaint(schoolid, schoolheadmasterid, beoadminid, complaint_title, complaint_note, attachments, complaint_status,complaint_date,reply_complaint_id) values('$rsschoolheadmaster[schoolid]','$_SESSION[schoolheadmasterid]','$_SESSION[beoadminid]','$_POST[complaint_title]','$complainnote','$attachments','$replyby','$complaint_date','$_GET[complaint_id]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1)
	{
		$sql = "UPDATE complaint SET complaint_status='$replyby' WHERE complaint_id='$_GET[complaint_id]'";
		mysqli_query($con,$sql);
		echo "<script>alert('Your complaint Reply sent successfully...');</script>";
		echo "<script>window.location='complaint_record.php?complaint_id=$_GET[complaint_id]';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
$sqlcomplaint = "SELECT * FROM complaint where complaint_id='$_GET[complaint_id]'";
$qsqlcomplaint = mysqli_query($con,$sqlcomplaint);
$rscomplaint = mysqli_fetch_array($qsqlcomplaint);
$sqlhmaster = "SELECT schoolheadmaster.*, school.schoolname, school.schooladdress, school.pincode, state.state, city.city FROM schoolheadmaster LEFT JOIN school ON schoolheadmaster.schoolid=school.schoolid LEFT JOIN state ON state.stateid=school.stateid LEFT JOIN city ON city.cityid=school.cityid WHERE schoolheadmaster.schoolheadmasterid='$rscomplaint[schoolheadmasterid]'";
$qsqlhmaster = mysqli_query($con,$sqlhmaster);
$rshmaster = mysqli_fetch_array($qsqlhmaster);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<br>	
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Complaint Detail...</h3>
        </div>
        <div class="card-body">
		
<div class="row">
	<div class="col-md-12">
	
<table class="table table-bordered">
	<tr>
		<th style="width: 200px;">Complaint No.</th><td>
		<?php echo $rscomplaint[0]; ?>
		</td>
	</tr>	<tr>
		<th style="width: 200px;">Complaint Date:</th><td>
		<?php echo date("d-M-Y h:i A",strtotime($rscomplaint['complaint_date'])); ?>
		</td>
	</tr>	<tr>
		<th style="width: 200px;">School:</th><td>
		
		<?php echo $rshmaster['schoolname']; ?><br><?php echo $rshmaster['schooladdress']; ?>, <?php echo $rshmaster['city']; ?>, <?php echo $rshmaster['state']; ?> - <?php echo $rshmaster['pincode']; ?>
		</td>
	</tr>	
	<tr>
		<th style="width: 200px;">Complainer:</th><td><?php echo $rshmaster['headmastername']; ?> [ <?php echo $rshmaster['headmastercode']; ?> ]
		</td>
	</tr>	
	<tr>
		<th style="width: 200px;">Complaint Subject:</th><td><?php echo $rscomplaint['complaint_title']; ?></td>
	</tr>
	<tr>
		<th>Complaint Description:</th><td><?php echo $rscomplaint['complaint_note']; ?></td>
	</tr>
<?php
if(file_exists("docscomplaint/$rscomplaint[attachments]"))
{
?>	
	<tr>
		<th>Complaint Document:</th><td><a href="docscomplaint/<?php echo $rscomplaint[attachments]; ?>" class="btn btn-info" target="_blank"><?php echo $rscomplaint[attachments]; ?></a></td>
	</tr>
<?php
}
?>	
	<tr>
		<th>Complaint status:</th><td><?php echo $rscomplaint['complaint_status']; ?></td>
	</tr>
</table>
	</div>
</div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
</form>
    </section>
    <!-- /.content -->
	
	    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Complaint Response...</h3>
        </div>
        <div class="card-body">
		
<div class="row">
	<div class="col-md-12">
<?php
 $sqlcomplaintreply = "SELECT * FROM `complaint` WHERE reply_complaint_id='$_GET[complaint_id]' ORDER BY complaint_id ASC";
$qsqlcomplaintreply = mysqli_query($con,$sqlcomplaintreply);
while($rscomplaintreply = mysqli_fetch_array($qsqlcomplaintreply))
{
	//Headmaster
	$sqlhmasterreply = "SELECT schoolheadmaster.*, school.schoolname, school.schooladdress, school.pincode, state.state, city.city FROM schoolheadmaster LEFT JOIN school ON schoolheadmaster.schoolid=school.schoolid LEFT JOIN state ON state.stateid=school.stateid LEFT JOIN city ON city.cityid=school.cityid WHERE schoolheadmaster.schoolheadmasterid='$rscomplaintreply[schoolheadmasterid]'";
	$qsqlhmasterreply = mysqli_query($con,$sqlhmasterreply);
	$rshmasterreply = mysqli_fetch_array($qsqlhmasterreply);
	//Admin
	$sqladminreply = "SELECT * FROM beoadmin WHERE beoadminid='$rscomplaintreply[beoadminid]'";
	$qsqladminreply = mysqli_query($con,$sqladminreply);
	$rsadminreply = mysqli_fetch_array($qsqladminreply);
?>	
	<table class="table table-bordered">
		<?php
		if(mysqli_num_rows($qsqlhmasterreply) == 1)
		{
		?>
		<tr>
			<th style="width: 200px;">Complainer Reply:</th><td><?php echo $rshmasterreply['headmastername']; ?> [ <?php echo $rshmasterreply['headmastercode']; ?> ]
			</td>
		</tr>
		<?php
		}
		if(mysqli_num_rows($qsqladminreply) == 1)
		{
		?>
		<tr>
			<th style="width: 200px;color:red;">BEO Admin Reply:</th><td><?php echo $rsadminreply['adminname']; ?> (<?php echo $rsadminreply['loginid']; ?>)
			</td>
		</tr>
		<?php
		}
		?>		
		<tr>
			<th style="width: 200px;">Reply Date:</th><td><?php echo date("d-M-Y h:i A",strtotime($rscomplaintreply['complaint_date'])); ?>
			</td>
		</tr>
		<tr>
			<th style="width: 200px;">Message:</th><td>
			<?php echo $rscomplaintreply['complaint_note']; ?>
			<?php
if(file_exists("docscomplaint/$rscomplaintreply[attachments]"))
{
?>	
	<tr>
		<th>Attachments:</th><td><a href="docscomplaint/<?php echo $rscomplaintreply[attachments]; ?>" class="btn btn-info" target="_blank"><?php echo $rscomplaintreply[attachments]; ?></a></td>
	</tr>
<?php
}
?>
			</td>
		</tr>
	</table><hr>
<?php
}
?>
	</div>
</div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
</form>
    </section>
    <!-- /.content -->

    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Send Complaint Reply.....</h3>
        </div>
        <div class="card-body">
				
<div class="row">
	<div class="col-md-3">Complaint Description</div>
	<div class="col-md-5">
		<textarea class="form-control" name="complaint_note" id="complaint_note"><?php echo $rsedit[complaint_note]; ?></textarea>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errcomplaint_note" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Attachments</div>
	<div class="col-md-5">
		<input type="file"  class="form-control" name="attachments" id="attachments" value="<?php echo $rsedit[attachments]; ?>">
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errattachments" style="color: red;"></span></div>
</div>
<br>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-5">
		<input class="form-control"  type="submit" name="submit" id="submit" value="Reply">
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
	
	if(document.getElementById("complaint_note").value == "")
	{
		document.getElementById("errcomplaint_note").innerHTML="Complaint description should not be empty";
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
