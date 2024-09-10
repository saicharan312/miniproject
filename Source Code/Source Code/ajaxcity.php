<?php
include("database.php");
?>
<select name="cityid" id="cityid" class="form-control">
	<option value="" >Select City</option>
	<?php
		$sqlstudent = "SELECT * FROM city WHERE status='Active' ";
		if(isset($_GET['stateid']))
		{
			$sqlstudent = $sqlstudent . " and stateid='$_GET[stateid]' ";
		}
		$qsqlstudent = mysqli_query($con,$sqlstudent);
		while($rstudent = mysqli_fetch_array($qsqlstudent))
		{
				if($rsedit['cityid']== $rstudent['cityid']) 
				{
				echo "<option value='".$rstudent['cityid']."'  selected >".$rstudent['city']."</option>";
				}
				else
				{
					echo "<option value='".$rstudent['cityid']."'  >".$rstudent['city']."</option>";
				}
			
		}
	?>
</select>