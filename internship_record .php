<?php
session_start();
?>
<?php require('header.php'); 
  ?>   
 <title>INTERNSHIP RECORDS</title>  
<?php
require('double.php');
 $error = $ids= '';
if(isset($_SESSION['userid']))
{
$ids = $_SESSION['userid'];
}
$showquery = "SELECT * FROM user_master where user_id = '$ids'";
$showdata = mysqli_query($con,$showquery);
$arrdata =mysqli_fetch_assoc($showdata); 
if(isset($_POST['submit']))
{
  $team_number = $_POST['teamnumber'];
$end_date =  $_POST['enddate'];
if(empty($teamnumber))
{
$error = "Please enter your team number.";
}
if(empty($enddate))
{
$error = "Please enter the internship End Date.";
}

          $queri ="INSERT INTO `internship_record_master`(`team_member`,`end_date`) VALUES ('$team_number','$end_date')";
          
          $query_run = mysqli_query($con,$queri) or die(mysqli_error($con));

if($query_run)
{
   echo '<script> alert("Data Saved"); </script>';   
}
else {
   echo'<script> alert("Data Not Saved"); </script>'; 
}
}
?>
       <?php                        
 $query = "SELECT `internship_application_master`.*, `internship_master` .*, 
          `department_master`.`dept_name`,
          `company_master`.`company_name`,
          `company_master`.`company_logo_url`,`category_master`.`category_name`,
          `duration_master`.`duration_name`
          FROM
              `internship_application_master`,`internship_master`,`department_master`,`company_master`,`category_master`,`duration_master`
            WHERE
                `internship_master`.`intern_details_id`=`internship_application_master`.`intern_id`
                AND`internship_application_master`.`user_id`= $ids 
                -- AND `refrence_master`.`user_id`= $ids
                AND`company_master`.`company_id`=`internship_master`.`company_id`
                AND `category_master`.`category_id`=`internship_master`.`category_id`
                AND `duration_master`.`duration_id`=`internship_master`.`duration_id`
                ORDER BY
                `internship_master`.`intern_details_id` ASC
                 "; 
                $res= mysqli_query($con, $query)or die (mysqli_error($con)); 
                $row =mysqli_fetch_assoc($res);                                                                                          
?>
    <?php
    require('navbar.php');
    ?> 
<body class="bg-light">
    <div class="container-fluid m-2 p-3">
    </div>
        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3 d-flex align-items-stretch">
        <div class="container-fluid ml-4 p-1 w-75">
        <div class="card w-auto position-static" id="sidebar">
        <div class="card-body">
        <h5 class='card-title text-center font-weight-bold'>
           <?php
        if(isset($_SESSION['userid']))
        {
        echo "<img class='img-circle profile_img' height=30 width=30 src='images/".$arrdata['user_image']."'>";
        }
                    ?>
             <?php
                                    if(isset($_SESSION['username'])){
                                     echo $_SESSION['username']; 
                                    }
                                    ?>
                    </h5>                        
                            <hr>
            <div>
                <a href='' class='card-link text-dark m-1'>
                    <i class="fa fa-user mr-1" aria-hidden="true"></i> My Profile
                </a>
                <br>
                <a href='' class='card-link text-dark m-1'>
                    <i class='fa fa-file mr-1' aria-hidden='true'></i> My Applications
                </a>
            </div>
                                  </div>
    </div>
</div>  
</div>

        <div class="col-sm-12 col-md-8 col-lg-8">
        <div class="container-fluid">
        <div class="card mt-2 p-3" id="registerForm">
        <div class="card-body">
        <h4 class="card-title font-weight-bold">Internship Records</h4>
          <hr>
<form action ='' enctype='multipart/form-data' method='POST'>       
                <div class="form-row">
                     <!-- <div class="col-md-6 mt-6">
        <label for='UserRef' class="font-weight-bold m-0">Reference Number</label>
        <input type="text" name="reference" readonly class="form-control" value="<?php echo $row['refno'];?>" required>
              </div> -->
                    <div class="col-md-6 mt-6">
                            <label for="Studentroll" class="font-weight-bold m-0">Student Roll Number</label>
                                <input type="text" name="studentroll" readonly class="form-control" placeholder="Student Roll Number" value='<?php echo $arrdata['user_roll']; ?>' required>
        </div>
        <div class="col-md-6 mt-0">
                <label for="InternshipName" class="font-weight-bold m-0">Student Name</label>
                <input type="text" name="studentname" readonly class="form-control" placeholder="Enter Student Name" value='<?php echo $arrdata['user_name']; ?>' required>
        </div>
        <div class="col-md-6 mt-4">
                <label for="companyname" class="font-weight-bold m-0">Company Name</label>
                    <input type="text" readonly class="form-control" name="companyname" placeholder="Enter Company Name" value='<?php echo $row['company_name']; ?>' required>
                  </div>
                <div class="col-md-6 mt-4">
                <label for="UserDept" class="font-weight-bold m-0">Department Name</label>
                    <input type="text"readonly class="form-control" name="department" placeholder="Enter Department Name" value='<?php echo $row['dept_name']; ?>' required>
                  </div>
                <div class="col-md-6 mt-4">
                 <label for ='UserDuration' class="font-weight-bold m-0">Duration</label>
                 <br>
                 <input type="datemonth" readonly class="Form control" name="duration" placeholder="Enter Duration" 
                   value='<?php echo $row['duration_name']; ?>' required>
                       </div>
                       <div class=" col-md-6 mt-4">
                        <label for="Status" class="font-weight-bold m-0">Status</label>
                             <br>
                     <input type="text" readonly class='Form-control' name="status" placeholder="Status" 
                   value='<?php echo $row['intern_details_status']; ?>' required>
                </div>
                <div class='col-md-6 mt-4'>
                        <label for='Apply' class='font-weight-bold m-0'>Date Of Apply</label>
                            <input type="text" readonly class='form-control' name='dateofapply' placeholder="Date Of Apply" value='<?php echo $row['app_date']; ?>'>
                </div>
  <br>

                            <div class='col-md-6 mt-4'>
                      <label for='StartDate' class='font-weight-bold m-0'>Start Date</label>
                            <input type="text" readonly class='form-control' name='startdate' placeholder="Start Date" 
                              value='<?php echo $row['intern_start_date']; ?>'>
                            </div>
  <br>
                                   <div class='col-md-6 mt-4'>
                                    <label for='Team' class='font-weight-bold m-0'>Number Of Team Members</label>
                                         <input type="text" name="teamnumber" class="form-control" placeholder="Size of Team" 
                                         required>
                            </div>
    
  <br>
                            <div class='col-md-6 mt-4'>
                                    <label for='EndDate' class='font-weight-bold m-0'>End Date</label>
                                        <input type="date"  class='form-control' name='enddate' placeholder="End Date" 
                                     >
                            </div>
    
  <br>
  <button type="submit" name="submit" value="submit" class="btn  btn-primary btn-lg btn-block  mt-3">SUBMIT</button>
                                            </div>
                                        </div>          
                                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-1">

        </div>
    </div>
    </div>
    <?php
    require('footer.php');
    ?>
</body>
</html>