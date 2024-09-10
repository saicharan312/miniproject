  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
<?php
if(isset($_SESSION['officerid']))
{
?>
    <a href="fooddepartmentdashboard.php" class="brand-link">
<?php
}
if(isset($_SESSION['schoolheadmasterid']))
{
?>
    <a href="schoolheadmasterdashboard.php" class="brand-link">
<?php
}
if(isset($_SESSION['beoadminid']))
{
?>
    <a href="beoadmindashboard.php" class="brand-link">
<?php
}
if(isset($_SESSION['studentid']))
{
?>
    <a href="studentdashboard.php" class="brand-link">
<?php
}
?>
      <img src="dist/img/ietracker.png"
           alt="Income expense tracker"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MidDay meals</span>
    </a>
<?php
if(isset($_SESSION['officerid']))
{
?>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php 
		  if($rsfooddepartmentofficer['img'] == "")
		  {
			  echo "images/defaultimg.png";
		  }
		  else if(!file_exists("imgprofile/" . $rsfooddepartmentofficer['img']))
		  {
			  echo "images/defaultimg.png";
		  }
		  else
		  {
		  echo "imgprofile/" . $rsfooddepartmentofficer['img']; 
		  }
		  ?>" class="img-circle elevation-2" alt="<?php echo $rsfooddepartmentofficer['officername']; ?>">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $rsfooddepartmentofficer['officername']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               <br /> with font-awesome or any other icon font library -->
			   
          <li class="nav-item has-treeview">
            <a href="fooddepartmentdashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Officer Dashboard
              </p>
            </a>
          </li>
<!----stock head master--->
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Stock
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="selectschooltoaddstock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Stock Entry</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="viewstock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Stock Entry</p>
                </a>
              </li>
            </ul>
          </li>
		  <!----end stock--->
		  
		  
<!----attendance head master--->

<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
             Attendance Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             <!-- <li class="nav-item">
                <a href="attendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Attendance Report</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="viewattendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Attendance Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewstudentattendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Attendance Report</p>
                </a>
              </li>
            </ul>
          </li>
		 <!----stock details head master---> 
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
             Stock Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">		  
			  <!--<li class="nav-item">
                <a href="schoolwisestock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>-->
			  <li class="nav-item">
                <a href="viewstock.php?status=Received" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entry Receipt - Received</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="viewstock.php?status=Delivered" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entry Receipt - Delivered</p>
                </a>
              </li>
            </ul>
          </li>
		  
		  
		  <!----Complaint details head master--->
		  
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Complaint
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--<li class="nav-item">
                <a href="complaint.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add complaint</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="viewcomplaint.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View complaints</p>
                </a>
              </li>
            </ul>
          </li>
		  
		</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
<?php
}
if(isset($_SESSION['schoolheadmasterid']))
{
?>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <center><img src="<?php 
		  if($rsschoolheadmaster['headmasterimg'] == "")
		  {
			  echo "images/defaultimg.png";
		  }
		  else if(!file_exists($rsschoolheadmaster['headmasterimg']))
		  {
			  echo "images/defaultimg.png";
		  }
		  else
		  {
		  echo $rsschoolheadmaster['headmasterimg']; 
		  }
		  ?>" class="img-circle elevation-2" alt="<?php echo $rsschoolheadmaster['headmastername']; ?>" style="width: 100px;height: 100px;"><br>
		<a href="headmasterdashboard.php" class="d-block"><?php echo $rsschoolheadmaster['headmastername']; ?></a></center>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               <br /> with font-awesome or any other icon font library -->
			   
          <li class="nav-item has-treeview">
            <a href="headmasterdashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Headmaster Dashboard
              </p>
            </a>
          </li>
		  
		  
		  		
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
             Attendance Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="attendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Attendance Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewattendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Attendance Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewstudentattendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Attendance Report</p>
                </a>
              </li>
            </ul>
          </li>
				   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
             Mid Day Meals
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
			 
			  <li class="nav-item">
                <a href="myschoolmenu.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu List</p>
                </a>
              </li>			  
			  <li class="nav-item">
                <a href="middaymealmenureport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Weekly Menu List</p>
                </a>
              </li>
			  
            </ul>
          </li>
		  
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
             Stock Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">		  
			  <li class="nav-item">
                <a href="schoolwisestock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="viewstock.php?status=Received" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entry Receipt - Received</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="viewstock.php?status=Delivered" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entry Receipt - Delivered</p>
                </a>
              </li>
            </ul>
          </li>
		
		<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
				Student
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="student.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add student</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewstudent.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View student</p>
                </a>
              </li>
            </ul>
          </li>

		  
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Chef
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="chef.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Chef</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewchef.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Chef</p>
                </a>
              </li>
            </ul>
          </li>
		
						  		
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Chef Salary Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="viewchefsalary.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Chef Salary Report</p>
                </a>
              </li>
            </ul>
          </li>
		  
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Complaint
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="complaint.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add complaint</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewcomplaint.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View complaints</p>
                </a>
              </li>
            </ul>
          </li>
		
		
<?php
/*			  
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Invoice
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="viewinvoice.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Invoice</p>
                </a>
              </li>
            </ul>
          </li>
		  
		  	  
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Transaction
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="viewaccount.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View transaction</p>
                </a>
              </li>
            </ul>
          </li>
		  
		  
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
             Student Account
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="studentprofile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="studentchangepassword.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>
*/
?>		
		  </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
<?php
}
if(isset($_SESSION['beoadminid']))
{
?>
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               <br /> with font-awesome or any other icon font library -->
			   
          <li class="nav-item has-treeview">
            <a href="beoadmindashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
		  
		
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
             View Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="viewattendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Attendance Report</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="viewstudentattendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student-wise Attendance</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="viewchefsalary.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Chef Salary Report</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="viewstudent.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Student Report</p>
                </a>
              </li>
            </ul>
          </li>

		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
             Mid Day Meals
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
			
              <li class="nav-item">
                <a href="viewschoolmiddaymeal.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>MidDay Meal Menu list</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewmiddaymealqtyperschool.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>MidDay Meal Menu Report</p>
                </a>
              </li>
			  <?php
			  /*
              <li class="nav-item">
                <a href="middaymeal.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Mid Day Meals</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="viewmiddaymeal.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Mid Day Meals</p>
                </a>
              </li>
			  */
			  ?>
			  
            </ul>
          </li>
		
		<!--Stock check-->	  
		<!--<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Stock
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="selectschooltoaddstock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Stock Entry</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="viewstock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Stock Entry</p>
                </a>
              </li>
            </ul>
          </li>-->
		
		
		
		<!--end of stock-->
								  
		<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
					Food Item
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="fooditem.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Food Item</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewfooditem.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Food Item</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Food Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewcategory.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Food Category</p>
                </a>
              </li>              
			  
            </ul>
          </li>
		  	
		  		
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Chef
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
			  
			  <li class="nav-item">
                <a href="chef.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Chef</p>
                </a>
              </li>
			  
			  <li class="nav-item">
                <a href="viewchef.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Chef</p>
                </a>
              </li>
			  
			  <li class="nav-item">
                <a href="chefsalary.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Chef Salary</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="viewchefsalary.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Chef Salary Report</p>
                </a>
              </li>
			  
            </ul>
          </li>
				
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Complaint
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="viewcomplaint.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View complaint</p>
                </a>
              </li>
            </ul>
          </li>
		
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            School Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="school.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add School</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="viewschool.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View School</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="schoolheadmaster.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add School headmaster</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewschoolheadmaster.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View School headmaster</p>
                </a>
              </li>
            </ul>
          </li>
				
		  
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Food Dept Officer
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="fooddepartmentofficer.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Food Dept Officer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewfooddepartmentofficer.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Food Dept Officer</p>
                </a>
              </li>

			  <li class="nav-item">
                <a href="viewstock.php?status=Delivered" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entry Receipt - Delivered</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="viewstock.php?status=Received" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entry Receipt - Received</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="viewstock.php?status=Paid" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entry Receipt - Paid</p>
                </a>
              </li>
            </ul>
          </li>
								
				  		
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
             BEO Admin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="beoadmin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add BEO Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewbeoadmin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View BEO Admin</p>
                </a>
              </li>
            </ul>
          </li>
										  		
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
            Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

			  <li class="nav-item">
                <a href="city.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add City</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewcity.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View City</p>
                </a>
              </li>
			  
			  <li class="nav-item">
                <a href="state.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add state</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewstate.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View state</p>
                </a>
              </li>
			  
            </ul>
          </li>
		
		
		  </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
<?php
}
if(isset($_SESSION['studentid']))
{
?>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php 
		  if($rsstudent['profileimg'] == "")
		  {
			  echo "images/defaultimg.png";
		  }
		  else if(!file_exists($rsstudent['profileimg']))
		  {
			  echo "images/defaultimg.png";
		  }
		  else
		  {
		  echo $rsstudent['profileimg']; 
		  }
		  ?>" class="img-circle elevation-2" alt="<?php echo $rsstudent['studentname']; ?>">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $rsstudent['studentname']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               <br /> with font-awesome or any other icon font library -->
			   
          <li class="nav-item has-treeview">
            <a href="studentdashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Student Dashboard
              </p>
            </a>
          </li>



		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
				Attendance Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="viewstudentattendancereport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Attendance Report</p>
                </a>
              </li>
            </ul>
          </li>
		  

		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
             Student Account
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="studentprofile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="studentchangepassword.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>
		  
		</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
<?php
}
?>
  </aside>