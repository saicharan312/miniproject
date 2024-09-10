<?php
include("header.php");
include("sidebar.php");
if(isset($_POST[submit]))
{
	//Update statement starts here
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE billing_template SET template_title='$_POST[template_title]',category_id='$_POST[category_id]',course_id='$_POST[course_id]',status='$_POST[status]' WHERE billing_template_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Account record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	// Update statement ends here
	// Insert statement starts here
	else
	{
		//##############################################################		
		$sql ="SELECT * FROM employee WHERE emptype IN('Principal','Professor','HOD','Lecturer','Librarian','Computer Instructor','Lab Assistant','Office Peon','Security Man','Cleaner','Others') AND status='Active' ORDER BY employeeid";
		$qsql = mysqli_query($con,$sql);
		$i=0;
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "EMPID" . $_POST["employeeid$rs[0]"];
			$template = serialize(array($_POST['employeeid'][$i],$_POST['salarymonth'],$_POST['salarydate'],$_POST['empname'][$i],$_POST['empcode'][$i],$_POST['emptype'][$i],$_POST['pfno'][$i],$_POST['grade'][$i],$_POST['bankacno'][$i],$_POST['department'][$i],$_POST['dateofjoining'][$i],$_POST['workingdays'][$i],$_POST['dayspayable'][$i],$_POST['earning1'][$i],$_POST['earning2'][$i],$_POST['earning3'][$i],$_POST['earning4'][$i],$_POST['earning5'][$i],$_POST['earning6'][$i],$_POST['earning7'][$i],$_POST['earning1amt'][$i],$_POST['earning2amt'][$i],$_POST['earning3amt'][$i],$_POST['earning4amt'][$i],$_POST['earning5amt'][$i],$_POST['earning6amt'][$i],$_POST['earning7amt'][$i],$_POST['earning8amt'][$i],$_POST['deduction1'][$i],$_POST['deduction2'][$i],$_POST['deduction3'][$i],$_POST['deduction4'][$i],$_POST['deduction5'][$i],$_POST['deduction6'][$i],$_POST['deduction7'][$i],$_POST['deduction8'][$i],$_POST['deduction1amt'][$i],$_POST['deduction2amt'][$i],$_POST['deduction3amt'][$i],$_POST['deduction4amt'][$i],$_POST['deduction5amt'][$i],$_POST['deduction6amt'][$i],$_POST['deduction7amt'][$i],$_POST['deduction8amt'][$i],$_POST['totalearnings'][$i],$_POST['totaldeductions'][$i],$_POST['netpay'][$i]));
			$sqlinsertsal ="INSERT INTO billing_template(template_type, employeeid, template_title, template, category_id, course_id, status) values('Salary','','Monthly Salary','$template','0','0','Active')";
			$qsqlinsertsal = mysqli_query($con,$sqlinsertsal);
			echo mysqli_error($con);
			$i = $i + 1;
		}
			echo "<script>alert('Salary report generated successfully...');</script>";
			//echo "<script>window.location='generatesalary.php?salarymonth=$_POST[salarymonth]';</script>";
		//##############################################################
	}
	// Insert statement ends here
}
?>
<?php
if(isset($_GET[editid]))
{
	//Step 2 : Select statement starts here
	$sqledit ="SELECT * FROM billing_template WHERE billing_template_id='$_GET[editid]'";
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
<form method="GET" action="">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Generate Salary   </h3>
        </div>
        <div class="card-body">
		
	<table id="myTable1"  class="table table-striped table-bordered" >
		<tr>
		    <th style="width: 150px;">Salary Month</th><td><input type="month" name="salarymonth" id="salarymonth" value="<?php echo date("Y-m"); ?>" class="form-control" ></td><th style="width: 150px;">Payment Date</th><td><input type="date" name="salarydate" id="salarydate" value="<?php echo date("Y-m-d"); ?>" class="form-control" ></td>
		</tr>
	</table>
	<hr>
<table id="myTable" >
	<thead><tr><th></th></tr></thead>
	<tbody>
<?php
$sql ="SELECT * FROM employee WHERE emptype IN('Principal','Professor','HOD','Lecturer','Librarian','Computer Instructor','Lab Assistant','Office Peon','Security Man','Cleaner','Others') AND status='Active' ORDER BY employeeid";
	$qsql = mysqli_query($con,$sql);
	$j=0;
	while($rs = mysqli_fetch_array($qsql))
	{
?>
		<tr>
			<td>
	<input type="hidden" name="employeeid[<?php echo $j; ?>]" id="employeeid[<?php echo $rs[employeeid]; ?>]" value="<?php echo $rs[employeeid]; ?>">
		<table id="myTable1"  style="width: 100%;" class="table table-striped table-bordered" >
		<tr>
		    <th style="width: 150px;">Name</th><td><input type="text" name="empname[<?php echo $j; ?>]" id="empname[<?php echo $rs[employeeid]; ?>]" value="<?php echo $rs[empname]; ?>" class="form-control" readonly ></td><th style="width: 150px;">Employee Code</th><td><input type="text" name="empcode[<?php echo $j; ?>]" id="empcode[<?php echo $rs[employeeid]; ?>]" value="<?php echo $rs[empcode]; ?>" class="form-control" readonly ></td>
		</tr>
		<tr>
			<th>Designation</th><td><input type="text" name="emptype[<?php echo $j; ?>]" id="emptype[<?php echo $rs[employeeid]; ?>]" value="<?php echo $rs[emptype]; ?>" class="form-control" readonly ></td><th>PF No</th><td><input type="text" name="pfno[<?php echo $j; ?>]" id="pfno[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td>
		</tr>
		<tr>
			<th>Grade</th><td><input type="text" name="grade[<?php echo $j; ?>]" id="grade[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><th>Bank Acc No</th><td><input type="text" name="bankacno[<?php echo $j; ?>]" id="bankacno[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td>
		</tr>
		<tr>
			<th>Department</th><td><input type="text" name="department[<?php echo $j; ?>]" id="department[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><th>Date of Joining</th><td><input type="date" name="dateofjoining[<?php echo $j; ?>]" id="dateofjoining[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td>
		</tr>
		<tr>
			<th>Working days</th><td><input type="number" name="workingdays[<?php echo $j; ?>]" id="workingdays[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><th>Days Payable</th><td><input type="number" name="dayspayable[<?php echo $j; ?>]" id="dayspayable[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td>
		</tr>
	</table>
	<hr>
	<table id="myTable1"  style="width: 100%;" class="table table-striped table-bordered" >
		<tbody>
			<tr>
				<th>Earnings</th><th style="width: 150px;text-align: right;">Amount</th><th>Deduction</th><th style="width: 150px;text-align: right;">Amount</th>
			</tr>
			<tr>			
				<td><input type="text" name="earning1[<?php echo $j; ?>]" id="earning1[<?php echo $rs[employeeid]; ?>]" value="Basic" class="form-control" readonly ></td><td  style="width: 150px;text-align: right;"><input type="text" name="earning1amt[<?php echo $j; ?>]" id="earning1amt[<?php echo $rs[employeeid]; ?>]" class="form-control" onchange="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)" ></td>
				<td><input type="text" name="deduction1[<?php echo $j; ?>]" id="deduction1[<?php echo $rs[employeeid]; ?>]" value="LOP" class="form-control" readonly ></td><td style="width: 150px;text-align: right;"><input type="text" name="deduction1amt[<?php echo $j; ?>]" id="deduction1amt[<?php echo $rs[employeeid]; ?>]" class="form-control" onchange="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)" ></td>
			</tr>
			<tr>
				<td><input type="text" name="earning2[<?php echo $j; ?>]" id="earning2[<?php echo $rs[employeeid]; ?>]" class="form-control" ></td><td  style="width: 150px;text-align: right;"><input type="text" name="earning2amt[<?php echo $j; ?>]" id="earning2amt[<?php echo $rs[employeeid]; ?>]" class="form-control"  onchange="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)" ></td>
				<td><input type="text" name="deduction2[<?php echo $j; ?>]" id="deduction2[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td style="width: 150px;text-align: right;"><input type="text" name="deduction2amt[<?php echo $j; ?>]" id="deduction2amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)" ></td>
			</tr>
			<tr>
				<td><input type="text" name="earning3[<?php echo $j; ?>]" id="earning3[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td  style="width: 150px;text-align: right;"><input type="text" name="earning3amt[<?php echo $j; ?>]" id="earning3amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" onchange="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)"  ></td>
				<td><input type="text" name="deduction3[<?php echo $j; ?>]" id="deduction3[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td style="width: 150px;text-align: right;"><input type="text" name="deduction3amt[<?php echo $j; ?>]" id="deduction3amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)" ></td>
			</tr>
			<tr>
				<td><input type="text" name="earning4[<?php echo $j; ?>]" id="earning4[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td  style="width: 150px;text-align: right;"><input type="text" name="earning4amt[<?php echo $j; ?>]" id="earning4amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)" ></td>
				<td><input type="text" name="deduction4[<?php echo $j; ?>]" id="deduction4[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td style="width: 150px;text-align: right;"><input type="text" name="deduction4amt[<?php echo $j; ?>]" id="deduction4amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)" ></td>
			</tr>
			<tr>
				<td><input type="text" name="earning5[<?php echo $j; ?>]" id="earning5[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td  style="width: 150px;text-align: right;"><input type="text" name="earning5amt[<?php echo $j; ?>]" id="earning5amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)" ></td>
				<td><input type="text" name="deduction5[<?php echo $j; ?>]" id="deduction5[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td style="width: 150px;text-align: right;"><input type="text" name="deduction5amt[<?php echo $j; ?>]" id="deduction5amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)" ></td>
			</tr>
			<tr>
				<td><input type="text" name="earning6[<?php echo $j; ?>]" id="earning6[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td  style="width: 150px;text-align: right;"><input type="text" name="earning6amt[<?php echo $j; ?>]" id="earning6amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)" ></td>
				<td><input type="text" name="deduction6[<?php echo $j; ?>]" id="deduction6[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td style="width: 150px;text-align: right;"><input type="text" name="deduction6amt[<?php echo $j; ?>]" id="deduction6amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)" ></td>
			</tr>
			<tr>
				<td><input type="text" name="earning7[<?php echo $j; ?>]" id="earning7[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td  style="width: 150px;text-align: right;"><input type="text" name="earning7amt[<?php echo $j; ?>]" id="earning7amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)" ></td>
				<td><input type="text" name="deduction7[<?php echo $j; ?>]" id="deduction7[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td style="width: 150px;text-align: right;"><input type="text" name="deduction7amt[<?php echo $j; ?>]" id="deduction7amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)" ></td>
			</tr>
			<tr>
				<td><input type="text" name="earning8[<?php echo $j; ?>]" id="earning8[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td  style="width: 150px;text-align: right;"><input type="text" name="earning8amt[<?php echo $j; ?>]" id="earning8amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotalearnings(<?php echo $rs[employeeid]; ?>)" ></td>
				<td><input type="text" name="deduction8[<?php echo $j; ?>]" id="deduction8[<?php echo $rs[employeeid]; ?>]" value="" class="form-control" ></td><td style="width: 150px;text-align: right;"><input type="text" name="deduction8amt[<?php echo $j; ?>]" id="deduction8amt[<?php echo $rs[employeeid]; ?>]" value="" class="form-control"  onchange="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)"  onkeyup="calculatetotaldeductions(<?php echo $rs[employeeid]; ?>)" ></td>
			</tr>
			

			
			<tr style="background-color: #d4dee8;">
				<th>Total Earnings</th><td><input type="text" name="totalearnings[<?php echo $j; ?>]" id="totalearnings[<?php echo $rs[employeeid]; ?>]" class="form-control" readonly ></td><th>Total Deduction</th><td><input type="text" name="totaldeductions[<?php echo $j; ?>]" id="totaldeductions[<?php echo $rs[employeeid]; ?>]" class="form-control" readonly ></td>
			</tr>
			<tr>
				<th colspan="4"><center>Net Pay : <span id="idnetpay[<?php echo $rs[employeeid]; ?>]"></span></center><input type="hidden" name="netpay[<?php echo $j; ?>]" id="netpay[<?php echo $rs[employeeid]; ?>]"></th></td>
			</tr>
		</tbody>
	</table>
</td>
</tr>
<?php
$j = $j +1;
	}
?>
	</table>
<hr>
	<center><input type="submit" name="submit" value="Generate Salary Receipt" class="btn btn-info" style="width: 250px;" ></center>
</div>
        <!-- /.card-body -->

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
</body>
</html>
<script src="js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable( {
		"bLengthChange" : false,
		"pageLength": 1
	});
} );
</script>
<script>
function validatedel()
{
	if(confirm("Are you sure want to delete this record?") == true)
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
function calculatetotalearnings(employeeid)
{
	val1 = 0;
	val2 = 0;
	val3 = 0;
	val4 = 0;
	val5 = 0;
	val6 = 0;
	val7 = 0;
	val8 = 0;
	if(parseFloat(document.getElementById("earning1amt[" + employeeid + "]").value) >=1)
	{
		val1 = parseFloat(document.getElementById("earning1amt[" + employeeid + "]").value);
	}
	if(parseFloat(document.getElementById("earning2amt[" + employeeid + "]").value)  >=1)
	{
		val2 = parseFloat(document.getElementById("earning2amt[" + employeeid + "]").value);
	}
	if(parseFloat(document.getElementById("earning3amt[" + employeeid + "]").value ) >=1)
	{
		val3 = parseFloat(document.getElementById("earning3amt[" + employeeid + "]").value);
	}
	if(parseFloat(document.getElementById("earning4amt[" + employeeid + "]").value ) >=1)
	{
		
		val4 = parseFloat(document.getElementById("earning4amt[" + employeeid + "]").value);
	}	
	if(parseFloat(document.getElementById("earning5amt[" + employeeid + "]").value)  >=1)
	{
		val5 = parseFloat(document.getElementById("earning5amt[" + employeeid + "]").value);
	}	
	if(parseFloat(document.getElementById("earning6amt[" + employeeid + "]").value ) >=1)
	{
		val6 = parseFloat(document.getElementById("earning6amt[" + employeeid + "]").value);
	}
	if(parseFloat(document.getElementById("earning7amt[" + employeeid + "]").value) >=1)
	{
		val7 = parseFloat(document.getElementById("earning7amt[" + employeeid + "]").value);
	}
	if(parseFloat(document.getElementById("earning8amt[" + employeeid + "]").value)>=1)
	{
		val8 = parseFloat(document.getElementById("earning8amt[" + employeeid + "]").value);
	}
	document.getElementById("totalearnings[" + employeeid + "]").value =  val1 + val2 + val3 + val4 + val5 + val6 + val7 + val8;
	calculatenetsalary(employeeid);
}
</script>
<script>
function calculatetotaldeductions(employeeid)
{
	//deduction1amt
	val1 = 0;
	val2 = 0;
	val3 = 0;
	val4 = 0;
	val5 = 0;
	val6 = 0;
	val7 = 0;
	val8 = 0;
	if(parseFloat(document.getElementById("deduction1amt[" + employeeid + "]").value) >=1)
	{
		val1 = parseFloat(document.getElementById("deduction1amt[" + employeeid + "]").value);
	}
	if(parseFloat(document.getElementById("deduction2amt[" + employeeid + "]").value)  >=1)
	{
		val2 = parseFloat(document.getElementById("deduction2amt[" + employeeid + "]").value);
	}
	if(parseFloat(document.getElementById("deduction3amt[" + employeeid + "]").value ) >=1)
	{
		val3 = parseFloat(document.getElementById("deduction3amt[" + employeeid + "]").value);
	}
	if(parseFloat(document.getElementById("deduction4amt[" + employeeid + "]").value ) >=1)
	{
		
		val4 = parseFloat(document.getElementById("deduction4amt[" + employeeid + "]").value);
	}	
	if(parseFloat(document.getElementById("deduction5amt[" + employeeid + "]").value)  >=1)
	{
		val5 = parseFloat(document.getElementById("deduction5amt[" + employeeid + "]").value);
	}	
	if(parseFloat(document.getElementById("deduction6amt[" + employeeid + "]").value ) >=1)
	{
		val6 = parseFloat(document.getElementById("deduction6amt[" + employeeid + "]").value);
	}
	if(parseFloat(document.getElementById("deduction7amt[" + employeeid + "]").value) >=1)
	{
		val7 = parseFloat(document.getElementById("deduction7amt[" + employeeid + "]").value);
	}
	if(parseFloat(document.getElementById("deduction8amt[" + employeeid + "]").value)>=1)
	{
		val8 = parseFloat(document.getElementById("deduction8amt[" + employeeid + "]").value);
	}
	document.getElementById("totaldeductions[" + employeeid + "]").value =  val1 + val2 + val3 + val4 + val5 + val6 + val7 + val8;
	calculatenetsalary(employeeid);
}
function calculatenetsalary(employeeid)
{
		document.getElementById("idnetpay[" + employeeid + "]").innerHTML = document.getElementById("totalearnings[" + employeeid + "]").value - document.getElementById("totaldeductions[" + employeeid + "]").value;  
		document.getElementById("netpay[" + employeeid + "]").value = document.getElementById("totalearnings[" + employeeid + "]").value - document.getElementById("totaldeductions[" + employeeid + "]").value; 
}
</script>