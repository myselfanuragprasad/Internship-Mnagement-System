<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
<?php
require('double.php');
?>
<?php
if (isset($_POST['Add_Details']))
{
   
    move_uploaded_file($_FILES['profileimage']['tmp_name'],"images/".$_FILES['profileimage']['name']);
    $intern_name=$_POST['intern_name'];
    $company_name=$_POST['company_name'];
    $category_name=$_POST['category_name'];
    $duration_id=$_POST['duration_id'];
    $intern_stipend=$_POST['intern_stipend'];
    $intern_apply_by=$_POST['intern_apply_by'];
    $intern_work_detail_1=$_POST['intern_work_detail_1'];
    $intern_work_detail_2=$_POST['intern_work_detail_2'];
    $intern_work_detail_3=$_POST['intern_work_detail_3'];
    $intern_skill_1=$_POST['intern_skill_1'];
    $intern_skill_2=$_POST['intern_skill_2'];
    $intern_skill_3=$_POST['intern_skill_3'];
    $intern_status=$_POST['app_status'];
    $intern_img = $_FILES['profileimage']['name'];

 $query= "INSERT INTO `internship_master` (`intern_name`,`company_id`, `category_id`,`duration_id`, `intern_stipend`, `intern_apply_by`,
  `intern_work_detail_1`, `intern_work_detail_2`, `intern_work_detail_3`,`intern_skill_1`,
  `intern_skill_2`, `intern_skill_3`,`intern_img`,`intern_details_status`) VALUES ('$intern_name','$company_name', '$category_name', '$duration_id', '$intern_stipend', '$intern_apply_by',
  '$intern_work_detail_1', '$intern_work_detail_2','$intern_work_detail_3', '$intern_skill_1',
  '$intern_skill_2', '$intern_skill_3','$intern_img','$intern_status')";
  echo $query;
   $query_run = mysqli_query($con,$query)or die(mysqli_error($con));
   
    if($query_run)
    {
       echo '<script> alert("Data Saved"); </script>'; 
    }
    else {
       echo'<script> alert("Data Not Saved"); </script>';
    }
}
?>


  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2" id="navbar">

<a class="navbar-brand mb-0 h1" href="index.php">
    <i class="fa fa-graduation-cap"></i>
    InternZone
</a>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
    aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>


<div class="collapse navbar-collapse" id="navbarToggler">



    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
        </li>
    </ul>

    <div class="form-inline my-2 my-lg-0">
        
                        <div class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle text-light' href='#' id='navbarDropdown' role='button'
                            data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          
                         <?php
                            if(isset($_SESSION['username'])){
                             echo $_SESSION['username']; 
                            }
                            ?>
                        </a>
                        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                            <p class='text-center font-weight-bold'>User Profile</p>

                            <a class='dropdown-item' href=''>
                                 <i class='fa fa-user mr-1' aria-hidden='true'></i> My Profile
                            </a>
                                
                            <a class='dropdown-item mb-2' href=''>
                                <i class='fa fa-file mr-1' aria-hidden='true'></i> My Applications
                            </a>
                        </div>
                    </div>
    
                    <a href='logout.php' class='btn btn-danger mx-2'>Logout</a>             
                            </div>

</div>

</nav>

<div class="card" style="width: 15rem; height:-20px; margin-left:50px; margin-top:50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="card-body">

            <!-- Title -->
                       
            <h5 class='card-title text-center font-weight-bold'>
                <i class='fa fa-user-circle' aria-hidden='true'></i> 
                   Admin Panel
            </h5>                        

            <hr>

            <!-- Sidebar Content -->
            <div>
                <a href='#' class='card-link text-dark m-1' style="font-size:20px;">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> View Internship Details
                </a>
                <br>
                <a href='company_master.php' class='card-link text-dark m-1' style="font-size:20px;">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> View college
                </a>
                <br>
                <a href='#' class='card-link text-dark m-1' style="font-size:20px;">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> View location
                </a>
                <br>
                <a href='#' class='card-link text-dark m-1' style="font-size:20px;">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> View Company
                </a>
                <br>
                <a href='#' class='card-link text-dark m-1' style="font-size:20px;">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> View Registered user
                </a>
                <br>
                <a href='#' class='card-link text-dark m-1' style="font-size:20px;">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> View Applied Application
                </a>
                <br>
                <a href='#' class='card-link text-dark m-1' style="font-size:20px;">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> View Categories
                </a>

            </div>

            <!-- Sidebar Content End -->

        </div>

    </div>

</div>    
    </div>

  <body data-spy="scroll" data-target="#myScrollspy" data-offset="1">
  <form action="" method="post" enctype="multipart/form-data">
  
<div class="card" style="width: 50rem; height: 68rem; margin-left: 400px; margin-top: -390px; background-color: white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
<h4 style="margin: 20px;"> Add Internship Details <h4>
<hr style="border:0.5px solid black;">
  <div class="card-body">
  <div class="form-row">
      <div class="col-md-6 mb-4">
      <label for="validationServer053"style="font-size: 18px;">Internship Name</label>
      <input type="text" class="form-control" name="intern_name" placeholder="Enter Name"
        required>
      <div class="invalid-feedback">
      </div>
    </div>
 <!-- <div class="form-row"> -->
    <div class="col-md-6 mb-4">
    <label for="UserBranch" style="font-size: 18px;">Company</label>
    <select class="form-control" name="company_name">
    <option value disbale selected>Select Company</option>
    <?php
    $query = "SELECT * FROM `company_master`";
    $res = mysqli_query($con,$query);
    while ($row = mysqli_fetch_object($res)) {
      echo "<option value= '$row->company_id'>$row->company_name</option>";
    }
    ?>
   </select>
      </div>
    <div class="col-md-6 mb-4">
    <label for="UserBranch" style="font-size: 18px;">Category </label>
     <select class="form-control" name="category_name">
     <option value disable selected>Select Category</option>
     <?php
     $query = "SELECT * FROM `category_master`";
     $res = mysqli_query($con,$query);
     while ($row = mysqli_fetch_object($res)) {
       echo "<option value='$row->category_id'>$row->category_name</option>";
       } 
     ?> 
     </select>
     </div>
     <div class="col-md-6 mb-4">
    <label for="intern status" style="font-size: 18px;">Application Status </label>
     <select class="form-control" name="app_status">
     <option value disable selected>Select Application status</option>
     <?php
     $query = "SELECT * FROM `status_master`";
     $res = mysqli_query($con,$query);
     while ($row = mysqli_fetch_object($res)) {
       echo "<option value='$row->status_id'>$row->status_name</option>";
       } 
     ?> 
     </select>
     </div>
  <div class="form-row">
    <!-- <div class="col-md-3 mb-3">
      <label for="validationServer033"style="font-size: 18px;">Enter Start Date</label>
      <input type="date" name="intern_start_date" class="form-control" id="validationServer033" placeholder="dd/mm/yyyy"
        required> </input>
      <div class="invalid-feedback">
      </div>
    </div> -->
    <div class="col-md-4 mb-3">
    <label for="UserBranch" style="font-size: 18px;">Duration</label>
     <select class="form-control" name="duration_id">
     <option value disable selected>Select Duration</option>
     <?php
     $query = "SELECT * FROM `duration_master`";
     $res = mysqli_query($con,$query);
     while ($row = mysqli_fetch_object($res)) {
       echo "<option value='$row->duration_id'>$row->duration_name</option>";
       } 
     ?> 
     </select>
     </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer053"style="font-size: 18px;">Enter Stipend</label>
      <input type="text" class="form-control" name="intern_stipend" placeholder="e.g.1000"
        required> </input>
      <div class="invalid-feedback">
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer063"style="font-size: 18px;">Enter Apply Date</label>
      <input type="date" class="form-control" name="intern_apply_by" placeholder="dd/mm/yyyy"
        required> </input>
      <div class="invalid-feedback">
      </div>
    </div>
  
  <div class="col-md-20 mb-3">
      <label for="validationServer063"style="font-size: 18px;">Enter Internship Details#1</label>
      <input type="text" style="50%; height: 100px;" class="form-control" name="intern_work_detail_1" 
        required> </input>
      <div class="invalid-feedback">
      </div>
      <div class="col-md-20 mb-3">
      <label for="validationServer063"style="font-size: 18px;">Enter Internship Details#2</label>
      <input type="text" style="50%; height: 100px;" class="form-control" name="intern_work_detail_2" 
        required> </input>
      <div class="invalid-feedback">
      </div>
      <div class="col-md-20 mb-3">
      <label for="validationServer063"style="font-size: 18px;">Enter Internship Details#3</label>
      <input type="text" style="50%; height: 100px;" class="form-control" name="intern_work_detail_3" 
        required> </input>
      <div class="invalid-feedback">
      </div>
      <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationServer033"style="font-size: 18px;">Enter Required Skill#1</label>
      <input type="text" style="width: 250px; height: 60px;" class="form-control" name="intern_skill_1" 
        required> </input>
      <div class="invalid-feedback">
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer043" style="font-size: 18px;">Enter Required Skill#2</label>
      <input type="text" style="width: 250px; height: 60px;" class="form-control" name="intern_skill_2" 
        required> </input>
      <div class="invalid-feedback">
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationServer053"style="font-size: 18px;">Enter Required Skill#3</label>
      <input type="text" style="width: 250px; height: 60px;" class="form-control" name="intern_skill_3" 
        required></input>
      <div class="invalid-feedback">
      </div>
    </div>

     <div class='col-md-6 mt-4'>
    <label for='internimg' class='font-weight-light m-0'>Image</label>
    <input type="file" class='form-control-plaintext' name="profileimage" required>
   
  </div>
</div>
  <button  type="submit" name="Add_Details" class="btn btn-block btn-primary">Add Details</button>

</form>
</div>
  </div>
</div>

   
 


    
<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

</body>
</html>