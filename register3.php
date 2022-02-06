<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title> USER ACCOUNT</title>
	<style>
*{ margin: 0; padding: 0; font-family: 'Muli' , sans-serif; box-sizing: border-box;
}
.divider-text{
	position:relative;
	text-align:center;
	margin-top: 15px;
	margin-bottom: 15px ;
}
 .divider-text span {
 	padding: 7px;
 	font-size: 12px;
 	position:relative;
 	z-index: 2;
 }
 .divider-text:{
 	position:absolute;
 	width: 100%;
 	border-bottom: 1px solid #ddd;
 	top: 85%;
 	left: 0;
 }
 .btn-facebook{
 	background-color: #405D90!important;
 	color: #fff!important;
 }
 .btn-gmail{
 	background-color: #ea4335!important;
 	color: #fff!important;
 }
 .name p{
	 position:relative;
	 top:10px;
	 left:60px;
 }
 .btn{
	 width:360px;
 }
.error {color: #FF0000;}
	</style>
</head>
<body>
<?php
require('double.php');
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = mysqli_real_escape_string($con, $_POST['username']);
$phonenumber = mysqli_real_escape_string($con, $_POST['userphone']);
$phonenumbers = mysqli_real_escape_string($con, $_POST['userphonenumber']);
$password=  mysqli_real_escape_string($con,$_POST['userpassword']);
$email = mysqli_real_escape_string($con, $_POST['useremail']);
$passwords= mysqli_real_escape_string($con,$_POST['confirmpassword']);
$session= mysqli_real_escape_string($con,$_POST['session']);
$semester= mysqli_real_escape_string($con,$_POST['semester']);
$gender= mysqli_real_escape_string($con,$_POST['UserGender']);
$branch= mysqli_real_escape_string($con,$_POST['UserBranch']);
$college= mysqli_real_escape_string($con,$_POST['UserCollege']);
}
?>
<?php
$emailErr = $nameErr = $phoneErr = $phonesErr = "";
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["userphone"])) {
	$phoneErr = "Phone Number is required";
	$error = 1;
  } else {
	$phone = test_input($_POST["userphone"]);
	if (strlen($phone) != 10) {
	  $phoneErr = "Invalid phone number";
	  $error = 1;
	}
  }
  if (empty($_POST["userphonenumber"])) {
	$phonesErr = "Phone Number is required";
  } else {
	$phones = test_input($_POST["userphonenumber"]);
	if (strlen($phones) != 10) {
	  $phonesErr = "Invalid phone number";
	}
  }

	if (empty($_POST["username"])) {
	  $nameErr = "Name is required";
	} else {
	  $name = test_input($_POST["username"]);
	  // check if name only contains letters and whitespace
	  if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
		$nameErr = "Invalid name format";
	  }
	}
	if (empty($_POST["useremail"])) {
	  $emailErr = "Email is required";
	} else {
	  $email = test_input($_POST["useremail"]);
	  // check if e-mail address is well-formed
	  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format";
	  }
	}
}
?>
<?php
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }
  ?>
<?php
if(isset($_POST['submit']))
{
$pass = password_hash($password, PASSWORD_BCRYPT);
$passes = password_hash($passwords, PASSWORD_BCRYPT);

$emailquery = "select * from user_master where user_email='$email' ";
$query = mysqli_query($con,$emailquery);

$emailcount = mysqli_num_rows($query);
if($emailcount>0)
{
	echo "email already exists";
}
else{
	if($password === $passwords){
		if ($error == '') {
			# code...
			$insertquery = "insert into user_master( `user_name`, `user_email`, `user_phone`, `user_phones`, `user_password`, `user_cpassword`,`semester`,`session`,`user_gender`,`user_college`,`user_branch`) values('$username','$email', '$phonenumber', '$phonenumbers','$pass', '$passes','$semester','$session','$gender','$college','$branch')";
			
			$iquery = mysqli_query($con, $insertquery);
			if($iquery){
				?>
			<script>
				alert(" Registration Successful! Please login to proceed further");
			</script>
			<?php
			} else {
				?>
				<script>
					alert(" NO Insertion ");
				</script>
				<?php
			}
		}
}else{
?>	<script>
	alert("password are not matching");
</script>
<?php
}
}
}
?>
	<div class="card bg_light">
		<article class="card-body mx-auto" style="max-width: 400px;">
<h4 class="card-title mt-3 text-center">Create Account</h4>
<p class="text-center">Get started with your placement journey <i class="fa fa-road"></i></p>
<!-- <p>
	<a href=""class="btn btn-block btn-gmail"> <i class="fa fa-google"></i>Login via Gmail</a>
	<a href=""class="btn btn-block btn-facebook"> <i class="fa fa-google"></i>Login via Facebook</a>
	</p> -->
<p class="divider-text" style='font-size: 25px'>
	<i class='fas fa-user-graduate' style='font-size:30px'></i> INTERNSHIP
</p>
<form action="" method="POST">
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-user"></i></span>
		</div>
		<input name="username" class="form-control" placeholder="Full Name" type="text" required>
		
		<span class="error">* <?php echo $nameErr;?></span>
	</div>
	<div class="form-group input-group">
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-genderless"></i></span>
		</div>
    <!-- <label for ="UserBranch"  class='font-weight-bold m-0'>Select Branch</label> -->
    <select  class="form-control-plaintext" name="UserGender" value="" required>
      <option value disabled selected>Select Gender</option>
  <?php

      $query = "SELECT * FROM `gender_master` WHERE `gender_status`='ACTIVE'";
      $res= mysqli_query($con, $query);
      while($row = mysqli_fetch_object($res)){
        
        echo"<option value='$row->gender_id'>$row->gender_full_name</option>";
      }
      ?>  
    </select>
	</div>
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-at"></i></span>
		</div>
		<input name="useremail" class="form-control" placeholder="Enter your Email" type="text" >
		<span class="error"> *<?php echo $emailErr;?></span>
	</div>
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-phone-square"></i></span>
		</div>
		<input name="userphone" class="form-control" placeholder="Phone Number 1" type="number" required>
		<span class="error">* <?php echo $phoneErr;?></span>
	</div>
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-whatsapp"></i></span>
		</div>
		<input name="userphonenumber" class="form-control" placeholder="Phone Number 2" type="number" required>
		<span class="error">* <?php echo $phonesErr;?></span>
	</div>
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-lock"></i></span>
		</div>
	<input class ="form-control" placeholder="Enter your password" type="password" name="userpassword" value="" required>
</div>
	
<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-lock"></i></span>
		</div>
		<input class ="form-control" placeholder=" confirm password" type="password" name="confirmpassword" required>
	</div>
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-database"></i></span>
		</div>
		<input class ="form-control" placeholder="Enter Your Current Semester" type="text" name="semester" required>
	</div>
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-calendar"></i></span>
		</div>
		<input class ="form-control" placeholder="Enter Your Session" type="text" name="session" required>
	</div>
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-book"></i></span>
		</div>
    <!-- <label for ="UserBranch"  class='font-weight-bold m-0'>Select Branch</label> -->
    <select  class="form-control-plaintext" name="UserBranch" value=""  required>
      <option>Select Branch</option>
  <?php

      $query = "SELECT * FROM `branch_master` WHERE `branch_status`='ACTIVE'";
      $res= mysqli_query($con, $query);
      while($row = mysqli_fetch_object($res)){
        
        echo"<option value='$row->branch_id'>$row->branch_full_name</option>";
      }
      ?>  
    </select>
	</div>
	<!-- <div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-lock"></i></span>
		</div>
		<input class ="form-control" placeholder="Enter Your Course" type="text" name="course" >
	</div> -->
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-university"></i></span>
		</div>
    <!-- <label for ="UserBranch"  class='font-weight-bold m-0'>Select Branch</label> -->
    <select  class="form-control-plaintext" name="UserCollege" value=""  required>
      <option>Select College</option>
  <?php

      $query = "SELECT * FROM `college_master` WHERE `college_status`='ACTIVE'";
      $res= mysqli_query($con, $query);
      while($row = mysqli_fetch_object($res)){
        
        echo"<option value='$row->college_id'>$row->college_name</option>";
		
      }
      ?>  
    </select>
	</div>
	<br>
	<div class="form-group">
  <button type="submit" name="submit" class="btn btn-primary btn-block ">Create Account</button>
</div>
<br>
<div class="name">
<p class="text-center">Have an account? <a href="login.php">Log In</a></p>
	</div>

</form>
</article>
</div>


</body>
</html>