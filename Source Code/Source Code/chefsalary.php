<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		
		$sql ="UPDATE `chefsalary` SET `chefid`='".$_POST['chefid']."', `salarymonth`='".$_POST['salarymonth']."-01', `salarydate`='".$_POST['salarydate']."',`salarydetail`='".$_POST['salarydetail']."',`basicsalary`='".$_POST['basicsalary']."',`bonussalary`='".$_POST['bonussalary']."',`deductionsalary`='".$_POST['deductionsalary']."',`status`='Active' WHERE chefsalaryid='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Chef Salary record Updated successfully...');</script>";
			//echo "<script>window.location='category.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{  
		$sql ="INSERT INTO chefsalary SET `chefid`='".$_POST['chefid']."', `salarymonth`='".$_POST['salarymonth']."-01', `salarydate`='".$_POST['salarydate']."',`salarydetail`='".$_POST['salarydetail']."',`basicsalary`='".$_POST['basicsalary']."',`bonussalary`='".$_POST['bonussalary']."',`deductionsalary`='".$_POST['deductionsalary']."',`status`='Active' ";
		
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			$salreceiptid = mysqli_insert_id($con);
			echo "<script>alert('Chef Salary record inserted successfully...');</script>";
			echo "<script>window.location='chefsalaryreceipt.php?salreceiptid=$salreceiptid';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM chefsalary where chefsalaryid='".$_GET['editid']."'";
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
          <h3 class="card-title">Chef Salary Master</h3>
        </div>
        <div class="card-body">
		
	
<div class="row">
	<div class="col-md-3">Chef Name</div>
	<div class="col-md-5">
	<select name="chefid" id="chefid" class="form-control" onchange="loadchefrec(this.value)" >
	<option value="">Select Chef</option>
<?php
$sqlstudent = "SELECT chef.*,school.schoolname,school.stateid,school.cityid FROM chef LEFT JOIN school ON chef.schoolid=school.schoolid WHERE chef.status='Active' ";
$qsqlstudent = mysqli_query($con,$sqlstudent);
while($rstudent = mysqli_fetch_array($qsqlstudent))
{
	//################
	$sqlstate ="SELECT * FROM state where stateid='$rstudent[stateid]'";
	$qsqlstate = mysqli_query($con,$sqlstate);
	echo mysqli_error($con);
	$rsstate = mysqli_fetch_array($qsqlstate);
	//################
	//################
	$sqlcity ="SELECT * FROM city  where cityid='$rstudent[cityid]'";
	$qsqlcity = mysqli_query($con,$sqlcity);
	echo mysqli_error($con);
	$rscity = mysqli_fetch_array($qsqlcity);
	//################
	$selected ='';
	if(isset($rsedit['chefid'])  && $rsedit['chefid']== $rstudent['chefid']) { $selected ="selected"; }else{ $selected =''; }
	echo "<option value='".$rstudent['chefid']."'  $selected >".$rstudent['chefname'] ." (" .$rstudent['schoolname'] . ", " . $rscity['city'] . ", " . $rsstate['state'] .".)</option>";
}
?>
	</select>	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errchefid" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Salary Month</div>
	<div class="col-md-5">
		<input type="month" class="form-control" name="salarymonth" id="salarymonth" value="<?php if(isset($rsedit['salarymonth'])){ echo date("Y-m",strtotime($rsedit['salarymonth'])); } ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errsalarymonth" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Salary Date</div>
	<div class="col-md-5">
		<input type="date" class="form-control" name="salarydate" id="salarydate" value="<?php if(isset($rsedit['salarydate'])){ echo $rsedit['salarydate']; } ?>" min="<?php echo date("Y-m-d"); ?>" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errsalarydate" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Basic Salary</div>
	<div class="col-md-5" id="divsalary"><?php include("ajaxchef.php"); ?></div>
	<div class="col-md-4"><span class="errmsg flash" id="errbasicsalary" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Bonus income</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="bonussalary" id="bonussalary" value="<?php if(isset($rsedit['bonussalary'])){ echo $rsedit['bonussalary']; } ?>" value="0" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errbonussalary" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Any Deductions</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="deductionsalary" id="deductionsalary" value="<?php if(isset($rsedit['deductionsalary'])){ echo $rsedit['deductionsalary']; } ?>" value="0" />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errdeductionsalary" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Salary Detail</div>
	<div class="col-md-5">
		<textarea class="form-control" name="salarydetail" id="salarydetail"><?php if(isset($rsedit['salarydetail'])){ echo $rsedit['salarydetail']; } ?></textarea>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errsalarydetail" style="color: red;"></span></div>
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

	if(document.getElementById("chefid").value == "")
	{
		document.getElementById("errchefid").innerHTML="Kindly select the chef";
		i=1;
	}
	if(document.getElementById("salarymonth").value == "")
	{
		document.getElementById("errsalarymonth").innerHTML="Salary month  should not be empty";
		i=1;
	}
	if(document.getElementById("salarydate").value == "")
	{
		document.getElementById("errsalarydate").innerHTML="Salary date  should not be empty";
		i=1;
	}
	if(document.getElementById("basicsalary").value == "")
	{
		document.getElementById("errbasicsalary").innerHTML="Salary amount  should not be empty";
		i=1;
	}
	if(document.getElementById("salarydetail").value == "")
	{
		document.getElementById("errsalarydetail").innerHTML="Salary detail  should not be empty";
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
function loadchefrec(chefid)
{
    if (chefid == "") 
	{
         document.getElementById("divsalary").innerHTML = '<input type="text" class="form-control" name="basicsalary" id="basicsalary" value="0" readonly />';
        return;
    } 
	else 
	{
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {				
                document.getElementById("divsalary").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxchef.php?chefid="+chefid,true);
        xmlhttp.send();
    }
}
</script>
</body>
</html>
