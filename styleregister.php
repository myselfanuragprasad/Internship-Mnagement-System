  <?php
session_start();
?>

<?php
  require('header.php');
?>

<title>USER UPDATE</title>
<script src="ajaxfile.js"></script>
<style>
#preview{
  border:1px solid orange;
  padding:10px;
  display:none;
}
  </style>

<body>
  
  <?php
require('double.php');
 $error = $ids ='';
 if(isset($_SESSION['userid']))
 {
$ids = $_SESSION['userid'];
 }
$showquery = "SELECT * FROM user_master where user_id = '$ids'";
$showdata = mysqli_query($con,$showquery);
$arrdata =mysqli_fetch_assoc($showdata); 

if(isset($_POST['Update']))
{

 move_uploaded_file($_FILES['profileimage']['tmp_name'],"images/".$_FILES['profileimage']['name']);                                                                                                                                                                                                    

$useremail = mysqli_real_escape_string($con, $_POST['UserEmail']);    
$phonenumber = mysqli_real_escape_string($con, $_POST['UserPhone']);
$usercountry = mysqli_real_escape_string($con, $_POST['UserCountry']);
$userstate = mysqli_real_escape_string($con, $_POST['UserState']);
$usercity = mysqli_real_escape_string($con, $_POST['UserCity']);
$userarea = mysqli_real_escape_string($con, $_POST['UserArea']);
$userroll = mysqli_real_escape_string($con, $_POST['UserRoll']);
$userdob = mysqli_real_escape_string($con, $_POST['UserDob']);
$pic = $_FILES['profileimage']['name'];
if(empty($useremail) || !filter_var($useremail, FILTER_VALIDATE_EMAIL))
$error = "Please enter your valid email";

if(empty($phonenumber) || strlen($phonenumber) != 10)
$error = "Please enter a valid phone number";

if(empty($usercountry))
$error = "Please enter your country name";

if(empty($usercity))
$error = "Please enter your city name";

if(empty($userarea))
$error = "Please enter your area name";

if($error == '')
{
  $query = "UPDATE `user_master` SET user_image= '$pic',user_roll='$userroll',user_email='$useremail', user_country='$usercountry', user_state='$userstate', user_area='$userarea' , user_city='$usercity',user_dob='$userdob' where user_id=$ids ";
  
  //  echo $query;
$res = mysqli_query($con, $query);
  ?>
   <script>   alert("Updated Suessfully!");
 </script>
  <?php
 }
   else {
    ?>
     <script>
     alert("There is some error.Please try again later");
  </script>
 <?php  
 } 
   } 
 ?> 

    <?php
  require('navbar.php');
  ?>
   <?php
              
                 $query = "SELECT `user_master`.*, 
                 `gender_master`.`gender_full_name`,
                 `gender_master`.`gender_id`,
                 `branch_master`.`branch_id`,
                 `branch_master`.`branch_full_name`,
                 `college_master`.`college_name`,
                 `college_master`.`college_id`
 
                 FROM
                     `user_master`,`gender_master`,`branch_master`,`college_master`
                    
                   WHERE
                       `user_master`.`user_id`= $ids AND
                       `gender_master`.`gender_id`=`user_master`.`user_gender`AND
                        `branch_master`.`branch_id`=`user_master`.`user_branch`AND
                        `college_master`.`college_id`=`user_master`.`user_college`

                       ORDER BY
                       `user_master`.`user_id` ASC
       
                        
                        "; 
                        // echo $query;
                      
          $ress = mysqli_query($con, $query) or die(mysqli_error($con));

           $rows = mysqli_fetch_object($ress);
           // $company = $row->company_id;
           // $category = $row->category_id;
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
                <a href='myapplication.php' class='card-link text-dark m-1'>
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

        <h4 class="card-title font-weight-bold">Your Profile</h4>
          <?php
          if($error!='')
          echo "$error";                      
          ?>
          <?php
          if(isset($_SESSION['userid']))
          {
          echo "<img class='img-circle profile_img' height=60 width=60 src='images/".$arrdata['user_image']."'>";
          }
          ?>
          <!-- <hr> -->
                                          
        <!-- <label for='userid' class="font-weight-bold m-0">User Id</label> -->
        <input type="hidden" name="userid" id="userId" readonly class="form-control-plaintext"
        value='<?php echo $arrdata['user_id']; ?>'>
                                        
        <hr>



 <form action = '' enctype='multipart/form-data' method='POST' id="submit_form"> 
<div>
<div class="form-row">
<div class=" col-md-6 mt-4">
<label for="UserName" class="font-weight-bold m-0">NAME</label>
     <br>
<input type="text" readonly class="Form control-plaintext" name="UserName" id="username"
value='<?php echo $arrdata['user_name']; ?>' required>
</div>



    <div class="col-md-6 mt-4">
            <label for="UserDob"  class="font-weight-bold m-0">Date Of Birth</label>
            <?php
             if(isset($_SESSION['userid']))
             {
               ?>
                   
                <input type="date"  class="form-control-plaintext" name="UserDob" value='<?php echo $arrdata['user_dob']; ?>'>
                <?php
             }
             ?>

              </div>
              <div class=" col-md-6 mt-4">
                <label for="UserGender" class="font-weight-bold m-0">GENDER</label>
                     <br>
             <input type="text" readonly class="Form control-plaintext" name="UserGender"
          value='<?php echo $rows->gender_full_name ?>' required>
        </div>

               <div class=" col-md-6 mt-4">
                <label for="UserRoll" class="font-weight-bold m-0">Roll</label>
                     <br>
             <input type="number"  class="Form control-plaintext" name="UserRoll"
          value='<?php echo $arrdata['user_roll']; ?>' required>
        </div>
        <div class='col-md-6 mt-4'>
                <label for='UserEmail' class='font-weight-bold m-0'>E-mail</label>
                <?php
             if(isset($_SESSION['userid']))
             {
               ?>
                    <input type='text' readonly class='form-control-plaintext' name='UserEmail' id="email"
                    value='<?php echo $arrdata['user_email']; ?>'>
                    <?php
             }
             ?>
        </div>
     
        <div class=" col-md-6 mt-4">

    <label for="UserPhone"  class='font-weight-bold m-0'>Phone Number</label>
    <div class="input-group">
     <div class="input-group-prepend">
    <span class="input-group-text">+91</span>
    </div>
  <input type="number" readonly class="Form control-plaintext" name="UserPhone" id="phone"
     value="<?php echo $arrdata['user_phone']; ?>"  required>
    </div>
        </div>
      <div class="col-md-6 mt-4">
    <label for ="UserCountry" class='font-weight-bold m-0'>Select Country</label>

    <select  readonly class="form-control-plaintext" name="UserCountry" id="country" value="" required>
     
      <option value disabled selected>Select Country</option>
  <?php
      $query = "SELECT * FROM `country_master` WHERE `country_status`='ACTIVE'";
      $res= mysqli_query($con, $query);
      while($row = mysqli_fetch_object($res)){
        $selected = '';
        if ($row->country_id == $arrdata['user_country']) {
          $selected = 'selected';
        }
        echo"<option value='$row->country_id' $selected>$row->country_full_name</option>";
      }
      ?>  
    </select>
  </div>
                                        
     <div class="col-md-6 mt-4">
    <label for ="UserState" class='font-weight-bold m-0'>Select State</label>

    <select class="form-control-plaintext" name="UserState" id="state" value="" required>
     
      <option value disabled selected>Select State</option>
  <?php
      $query = "SELECT * FROM `state_master` WHERE `state_status`='ACTIVE'";
      $res= mysqli_query($con, $query);
      while($row = mysqli_fetch_object($res)){
        $selected = '';
        if ($row->state_id == $arrdata['user_state']) {
          $selected = 'selected';
        }
        echo"<option value='$row->state_id' $selected>$row->state_full_name</option>";
      }
      ?>  
    </select>
  </div>
     <div class="col-md-6 mt-4">
    <label for ="UserCity" class='font-weight-bold m-0'>Select City</label>
    <select class="form-control-plaintext" name="UserCity" id="city" value=""  required>
      <option value disabled selected>Select City</option>
  <?php
      $query = "SELECT * FROM `city_master` WHERE `city_status`='ACTIVE'";
      $res= mysqli_query($con, $query);


      while($row = mysqli_fetch_object($res)){
         $selected = '';
        if ($row->city_id == $arrdata['user_city']) {
          $selected = 'selected';
        }

        echo"<option value='$row->city_id' $selected>$row->city_full_name</option>";
      }
      ?>  
    </select>
  </div>
  <div class="col-md-6 mt-4">
    <label for ="UserArea" class='font-weight-bold m-0'>Select Area</label>
    <select class="form-control-plaintext" name="UserArea" id="area" value="" required>
      <option value disabled selected>Select Area</option>
  <?php
      $query = "SELECT * FROM `area_master` WHERE `area_status`='ACTIVE'";
      $res= mysqli_query($con, $query);
      while($row = mysqli_fetch_object($res)){
         $selected = '';
        if ($row->area_id == $arrdata['user_area']) {
          $selected = 'selected';
        }
        echo"<option value='$row->area_id' $selected>$row->area_full_name</option>";
      }
      ?>  
    </select>
  </div>
  <div class=" col-md-6 mt-4">
                <label for="Usercollege" class="font-weight-bold m-0">COLLEGE</label>
                     <br>
             <input type="text" readonly class="Form control-plaintext" name="UserCollege"
          value='<?php echo $rows->college_name ?>' required>
        </div>
  
        <div class=" col-md-6 mt-4">
                <label for="Userbranch" class="font-weight-bold m-0">BRANCH</label>
                     <br>
             <input type="text" readonly class="Form control-plaintext" name="UserBranch"
          value='<?php echo $rows->branch_full_name ?>' required>
        </div>
   <div class='col-md-6 mt-4'>
    <label for='Userimage' class='font-weight-bold m-0'>Image</label>
    <input type="file" class='form-control-plaintext' name="profileimage" id="image" value='<?php echo $rows->user_image ?>'>
   
  </div>
  <!-- <button type="submit" name="Upload" value="UPLOAD DATA" id="f-upload" class="btn  btn-success btn-small mt-2" style="padding-top:2px;">UPLOAD FILE</button>
  <br> -->
  <button type="submit" name="Update" value="UPDATE DATA" id="save" class="btn  btn-primary btn-lg btn-block  mt-3">UPDATE DATA</button>


                                            </div>
                
                                        </div>
 </form>
 <br>

 <div id="preview">
   <h3>Image preview</h3>
   <div id="image_preview"></div>
    </div>
                                                
    </div>
                                
                    </div>

                </div>

            </div>

        </div>

       

        <div class="col-sm-12 col-md-4 col-lg-1"></div>

    </div>

    


    </div>

   
<!-- 
    <div class="mt-5 bg-light p-2 text-center text-muted font-monospace sticky-bottom">
    <div class="mt-2 mb-5">
        <hr>
        <p class="m-0">Copyright <span class="fa fa-copyright"></span> InternZone</p>
        <a href="#" class="m-0 card-link text-muted"><small> Privacy Policy | </small></a>
        <a href="#" class="m-0 card-link text-muted"><small>  Terms & Conditions </small></a>
        <p class="m-2"><span class="fa fa-graduation-cap"></span></p>
    </div>
</div> -->

<?php
  require('footer.php');
?>
</body>
</html>