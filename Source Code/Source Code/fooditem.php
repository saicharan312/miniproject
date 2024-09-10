<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	$condition='';
	if(isset($_FILES["itemimg"]["name"]) && $_FILES["itemimg"]["name"] !=''){
		$target_dir = "itemuploads/";
		$target_file = $target_dir . basename($_FILES["itemimg"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "<script>alert('Sorry, your file was not uploaded.');<script>";
		} else {
			if (move_uploaded_file($_FILES["itemimg"]["tmp_name"], $target_file)) {
				$condition=" ,`itemimg` = '$target_file'";
			} else {
				echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
			}
		}
	}
	if(isset($_GET['editid']))
	{
	
		$sql ="UPDATE `fooditem` SET `foodcategoryid`='".$_POST['foodcategoryid']."', `fooditemname`='".$_POST['fooditemname']."',
		`measurement`='".$_POST['measurement']."',`submeasurement`='".$_POST['submeasurement']."',`itemdescription`='".$_POST['itemdescription']."',
		`status`='".$_POST['status']."' $condition WHERE fooditemid='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Food Item record Updated successfully...');</script>";
			//echo "<script>window.location='category.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{  
		$sql ="INSERT INTO fooditem SET `foodcategoryid`='".$_POST['foodcategoryid']."', `fooditemname`='".$_POST['fooditemname']."',
		`measurement`='".$_POST['measurement']."',`submeasurement`='".$_POST['submeasurement']."',`itemdescription`='".$_POST['itemdescription']."',
		`status`='".$_POST['status']."' $condition";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Food Item record inserted successfully...');</script>";
			echo "<script>window.location='fooditem.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	
	$sqledit = "SELECT * FROM fooditem where fooditemid='".$_GET['editid']."'";
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
          <h3 class="card-title">Food Item Master</h3>
        </div>
        <div class="card-body">
		
		<div class="row">
	<div class="col-md-3">Food Item Name</div>
	<div class="col-md-5">
		<input class="form-control" name="fooditemname" id="fooditemname" value="<?php if(isset($rsedit['fooditemname'])){ echo $rsedit['fooditemname']; } ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errfooditemname" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Food Category</div>
	<div class="col-md-5">
	<select name="foodcategoryid" id="foodcategoryid" class="form-control">
	<option value="">Select Food Category</option>
		<?php
			$sqlstudent = "SELECT * FROM foodcategory WHERE status='Active' ";
			$qsqlstudent = mysqli_query($con,$sqlstudent);
			while($rstudent = mysqli_fetch_array($qsqlstudent)){
				$selected ='';
				if(isset($rsedit['foodcategoryid'])  && $rsedit['foodcategoryid']== $rstudent['foodcategoryid']) { $selected ="selected"; }else{ $selected =''; }
				echo "<option value='".$rstudent['foodcategoryid']."'  $selected >".$rstudent['foodcategory']."</option>";
			}

		?>
	</select>	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errfoodcategoryid" style="color: red;"></span></div>
</div>
<br>

<div class="row">
	<div class="col-md-3">Measurement</div>
	<div class="col-md-5">
		<input class="form-control" name="measurement" id="measurement" value="<?php if(isset($rsedit['measurement'])){ echo $rsedit['measurement']; } ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errmeasurement" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Sub Measurement</div>
	<div class="col-md-5">
		<input class="form-control" name="submeasurement" id="submeasurement" value="<?php if(isset($rsedit['submeasurement'])){ echo $rsedit['submeasurement']; } ?>" placeholder="(Write NIL if no sub measurement..)" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errsubmeasurement" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Item Image</div>
	<div class="col-md-5">
		<input type="file" class="form-control" name="itemimg" id="itemimg" value="" />
		<?php if(isset($rsedit['itemimg'])){ echo "<img src='".$rsedit['itemimg']."' class='img-fluid' width='80px' height='80px'/>"; } ?>
			
			</div>
	<div class="col-md-4"><span class="errmsg flash" id="erritemimg" style="color: red;"></span></div>
</div>
<br>
	
<div class="row">
	<div class="col-md-3">Item Description</div>
	<div class="col-md-5">
		<textarea class="form-control" name="itemdescription" id="itemdescription"><?php if(isset($rsedit['itemdescription'])){ echo $rsedit['itemdescription']; } ?></textarea>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="erritemdescription" style="color: red;"></span></div>
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

	if(document.getElementById("fooditemname").value == "")
	{
		document.getElementById("errfooditemname").innerHTML="Food item name should not be empty";
		i=1;
	}

	if(document.getElementById("measurement").value == "")
	{
		document.getElementById("errmeasurement").innerHTML="Measurement should not be empty";
		i=1;
	}
	if(document.getElementById("submeasurement").value == "")
	{
		document.getElementById("errsubmeasurement").innerHTML="Submeasurement should not be empty";
		i=1;
	}
	
	if(document.getElementById("foodcategoryid").value == "")
	{
		document.getElementById("errfoodcategoryid").innerHTML="Kindly select the food category ";
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
