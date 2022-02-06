<?php
session_start();
?>
   <?php
  require('header.php');
  require('double.php');
    ?> 
    <title>TRANSACTION FORM</title>
    <script src="ajaxfile.js"></script>
<body>
  <?php
$idt = $_GET['id'];
$ids = $_SESSION['userid'];
$queery ="SELECT `refrence_master` .*
FROM
`refrence_master`
WHERE
 `refrence_master`.`user_id`=$ids 
AND `refrence_master`.`intern_id`=$idt 
ORDER BY
`refrence_master`.`ref_id` 
";
$reas=  mysqli_query($con, $queery)or die (mysqli_error($con)); 
if (mysqli_num_rows($reas) > 0) {
  
  header("location:applynew.php?success=false");
   }      
  ?>
<?php
require('double.php');
 $error = $ids ='';
 if(isset($_SESSION['userid']))
 {
$ids = $_SESSION['userid'];
 }
$showquery = "SELECT * FROM user_master where user_id = '$ids'";
// $ask  = "SELECT* FROM apply_master";
// $risk = mysqli_query($con,$ask);
// $help =mysqli_fetch_assoc($risk);
$showdata = mysqli_query($con,$showquery);
$arrdata =mysqli_fetch_assoc($showdata);

// $show = "SELECT * FROM internship_application_master where intern_id = $idt";
// $shows = mysqli_query($con, $show);
// $arr = mysqli_fetch_object($shows);

$idt = $_GET['id'];
if(isset($_POST['Submit']))
{
 
  $duration = mysqli_real_escape_string($con, $_POST['Duration']);
  $department = mysqli_real_escape_string($con, $_POST['DepartmentName']);
  $contact = mysqli_real_escape_string($con, $_POST['ContactName']); 
  $company = mysqli_real_escape_string($con, $_POST['CompanyName']); 
  $category = mysqli_real_escape_string($con, $_POST['CategoryName']); 
  $app_id = $_POST['internship_id'];
  if(empty($duration))
  {
    $error = "Please enter your Duration.";
  }
  if(empty($contact))
  {
    $error = "Please enter your Contact Person Name.";
  }
  if(empty($department))
  {
    $error = "Please enter your Department.";
  }
  if(empty($startdate))
  {
    $error = "Please enter your Intern Start Date.";
  } 
  $queri ="INSERT INTO `internship_transaction_master`(`duration`,`user_id`,`app_id`,`company_id`
          ,`category_id`,`department_id`,`contact_id`) VALUES ('$duration','$ids','$app_id','$company','$category','$department','$contact')";
  // $querys="UPDATE `internship_transaction_master` set department_id='$department' where user_id=$ids";        
        //  echo $queri;
        //  echo $querys;
        
        $query_run = mysqli_query($con,$queri) or die(mysqli_error($con));
        // $query_rumm = mysqli_error($con,$querys) or die(mysqli_error($con));
        if($query_run)
        {
      
         
          // echo '<script> alert("Data Saved"); </script>'; 
          header("location: letter3.php?internship=$app_id&idm=$idt");
        }
        
        else {
          echo'<script> alert("Data Not Saved"); </script>'; 
        }
      }
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
                <a href='styleregister.php' class='card-link text-dark m-1'>
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
             <?php
                 $idt = $_GET['id'];
                 $query = "SELECT `internship_application_master`.*,`user_master`.*,  
                 `company_master`.`company_name`,
                 `company_master`.`company_id`,
                 `branch_master`.`branch_full_name`,
                 `city_master`.`city_id`,
                 `city_master`.`city_full_name`,
                 `branch_master`.`branch_id`,
                 `category_master`.`category_id`,
                 `company_master`.`company_logo_url`,`category_master`.`category_name`
                 FROM
                `internship_application_master`,`user_master`,`company_master`,`city_master`,`branch_master`,`category_master`
                   WHERE
                   `internship_application_master`.`app_id`= $idt AND
                    `user_master`.`user_id`= $ids AND
                    `branch_master`.`branch_id`=`user_master`.`user_branch`AND
                    `city_master`.`city_id`=`user_master`.`user_city`AND
                    `company_master`.`company_id`=`internship_application_master`.`company_id`AND
                    `category_master`.`category_id`=`internship_application_master`.`category_id`
                       ORDER BY
                       `internship_application_master`.`app_id` ASC
                        "; 
                      //  echo $query;
          $res = mysqli_query($con, $query) or die(mysqli_error($con));
           $row = mysqli_fetch_object($res);
           // $company = $row->company_id;
           // $category = $row->category_id;
           ?>    
        <div class="container-fluid">
        <div class="card mt-2 p-3" id="applicationform">
        <div class="card-body">
        <h4 class="card-title font-weight-bold">STEP 1</h4>
        <hr>      
<form action = '' enctype='multipart/form-data' method='POST'>
    <div class="form-row">
     <div class=" col-md-6 mt-4">
        <label for="companyname" readonly class="font-weight-bold m-0">COMPANY NAME</label>
                <select readonly class="form-control-plaintext" name="CompanyName" value=''>
                 <?php
         $querys = "SELECT * FROM `company_master` WHERE `company_status`='ACTIVE'";
                 $ress= mysqli_query($con, $querys);
             while($rows = mysqli_fetch_object($ress)){
               $selected = '';
            if ($rows->company_id == $row->company_id) {
                $selected = 'selected';
                 }
                echo"<option value='$rows->company_id' $selected>$rows->company_name</option>";
                 }
              ?>  
              </select>                  
        </div>
       <div class=" col-md-6 mt-4">
                <label for="Category" class="font-weight-bold m-0">CATEGORY NAME</label>
                <select readonly class="form-control-plaintext" name="CategoryName" value=''>
                <option value disabled selected><?php echo $row->category_name ?></option>
                 <?php
         $querys = "SELECT * FROM `category_master` WHERE `category_status`='ACTIVE'";
                 $ress= mysqli_query($con, $querys);
             while($rows = mysqli_fetch_object($ress)){
               $selected = '';
            if ($rows->category_id == $row->category_id) {
               $selected = 'selected';
                 }
                echo"<option value='$rows->category_id' $selected>$rows->category_name</option>";
                 }
              ?>  
            </select>        
        </div>
        <div class="col-md-6 mt-4">
                <label for="deptname" class="font-weight-bold m-0">DEPARTMENT NAME</label>
                <select class="form-control-plaintext" name="DepartmentName" id="dept" value='' required>
                <option value disabled selected>Select Department</option>
                 <?php
         $querys = "SELECT * FROM `department_master` WHERE `dept_status`='ACTIVE'";
                 $ress= mysqli_query($con, $querys);
             while($rows = mysqli_fetch_object($ress)){
               $selected = '';
            if ($rows->dept_id == $arrdata['dept_id']) {
               $selected = 'selected';
                 }
                echo"<option value='$rows->dept_id' $selected>$rows->dept_name</option>";
                 }
              ?>  
              </select>   
                
        </div>              
        <div class="col-md-6 mt-4">
                <label for="contactpersonname" class="font-weight-bold m-0">CONTACT PERSON NAME</label>
                <select class="form-control-plaintext" name="ContactName" value='' id="contact"  required>
                <option value disabled selected>Select Contact Person Name</option>
                 <?php
         $querys = "SELECT * FROM `company_person_master` WHERE `company_person_status`='ACTIVE'";
                 $ress= mysqli_query($con, $querys);
             while($rows= mysqli_fetch_object($ress)){
               $selected = '';
            if ($rows->company_person_id == $arrdata['contact_id']) {
               $selected = 'selected';
                 }
                echo"<option value='$rows->company_person_id' $selected>$rows->company_person_name</option>";
                 }
              ?>  
              </select>   
        </div>
       <div class=" col-md-6 mt-4">
        <label for="Duration" class="font-weight-bold m-0">DURATION</label>
                     <br>
        <input type="text" class="Form control-plaintext" name="Duration"
        value=''>
        </div>

        <!-- <div class="col-md-6 mt-4">
                <label for="startdate" class="font-weight-bold m-0">START DATE</label>
                    <input type="date" class="form-control-plaintext" name="StartDate" value='' required>
        </div> -->
        <br>             
        <div class="col-md-6 mt-4">
                <label for="cityname" class="font-weight-bold m-0">Your City</label>
                    <input type="text" readonly class="form-control-plaintext" name="CityName" value='<?php echo $row->city_full_name ?>'>
        </div>
        <br>
        <div class="col-md-6 mt-4">
                <label for="coursename" class="font-weight-bold m-0">Your Session</label>
          
                    <input type="text" readonly class="form-control-plaintext" name="session" value='<?php echo $arrdata['session']; ?>'>
        </div>
        <br>
         <div class="col-md-6 mt-4">
                <label for="coursename" class="font-weight-bold m-0"> Your Course</label>
          
                    <input type="text" readonly class="form-control-plaintext" name="CourseName" value='<?php echo $row->branch_full_name ?>'>
        </div>
        <br>
         <div class="col-md-6 mt-4">
                <label for="semester" class="font-weight-bold m-0">Your Semester</label>
              
                    <input type="number" readonly class="form-control-plaintext" name="Semester" value='<?php echo $arrdata['semester']; ?>'>
        </div>
        <br>
        <input type="hidden" name="internship_id" value='<?=$idt?>'>
  <button type="submit" name="Submit" value="SUBMIT DATA" class="btn  btn-primary btn-lg btn-block  mt-3 ">SUBMIT DATA</button>
                                        </div>
                                        </div>          
                                    </form>        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-1"></div>
    </div>
    </div>   
 <?php
         require('footer.php');
                ?>  
</body>
</html>