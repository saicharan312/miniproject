<?php
include("database.php");
$sqlstudent = "SELECT * FROM chef WHERE chefid='$_GET[chefid]' ";
if(isset($_GET[stateid]))
{
$sqlstudent = $sqlstudent . " and stateid='$_GET[stateid]' ";
}
$qsqlstudent = mysqli_query($con,$sqlstudent);
echo mysqli_error($con);
$rschefsalary = mysqli_fetch_array($qsqlstudent);
?>
<input type="text" class="form-control" name="basicsalary" id="basicsalary" value="<?php if(isset($rsedit['basicsalary'])){ echo $rsedit['basicsalary']; }else { echo $rschefsalary[chefsalary]; } ?>" readonly />