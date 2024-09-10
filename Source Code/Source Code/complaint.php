<?php
include("header.php");
include("sidebar.php");
if(isset($_POST[submit]))
{
	$complaint_date = date("Y-m-d H:i:s");
	$attachments = rand() . $_FILES["attachments"]["name"];
	move_uploaded_file($_FILES["attachments"]["tmp_name"],"docscomplaint/".$attachments);
	$complainnote = mysqli_real_escape_string($con,$_POST['complaint_note']);
	$sql ="INSERT INTO complaint(schoolid, schoolheadmasterid, beoadminid, complaint_title, complaint_note, attachments, complaint_status,complaint_date) values('$rsschoolheadmaster[schoolid]','$_SESSION[schoolheadmasterid]','0','$_POST[complaint_title]','$complainnote','$attachments','New Complaint','$complaint_date')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		$complaint_id=mysqli_insert_id($con);
		echo "<script>alert('Your complaint sent successfully...');</script>";
		echo "<script>window.location='complaint_record.php?complaint_id=$complaint_id';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM course where courseid='$_GET[editid]'";
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
          <h3 class="card-title">Post Complaint here...</h3>
        </div>
        <div class="card-body">
		
<div class="row">
	<div class="col-md-3">Complaint Title</div>
	<div class="col-md-5">
		<input type="text"  class="form-control" name="complaint_title" id="complaint_title" value="<?php echo $rsedit[complaint_title]; ?>">
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errcomplaint_title" style="color: red;"></span></div>
</div>
<br>		
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
		<input class="form-control"  type="submit" name="submit" id="submit" value="Post Complaint">
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
	
	if(document.getElementById("complaint_title").value == "")
	{
		document.getElementById("errcomplaint_title").innerHTML="Complaint title should not be empty...";
		i=1;
	}  
	
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
