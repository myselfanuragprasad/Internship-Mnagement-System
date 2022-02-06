
<?php
session_start();
// if(isset($_SESSION['username'])){
// 	echo"you are logged out";
// 	header('location:register1.php');
// }
$error = null;

?>
 <?php
  require('header.php');
    ?>

	<title> USER LOGIN</title>
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
 /*.divider-text:after{
 	content: "";
 	position:absolute;
 	width: 100%;
 	border-bottom: 1px solid #ddd;
 	top: 85%;
 	left: 0;
 	z-index: 1;

 }*/
 .btn-facebook{
 	background-color: #405D90!important;
 	color: #fff!important;
 }
 .btn-gmail{
 	background-color: #ea4335!important;
 	color: #fff!important;
 }
 .check input{
	 position: relative;
	 margin-left:20px;
	 margin-top:px;

 }
	</style>
</head>
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

if(isset($_POST['submit']))
{

$email = mysqli_real_escape_string($con, $_POST['useremail']);
$password=  mysqli_real_escape_string($con,$_POST['userpassword']);
$emailquery = "select * from user_master where user_email='$email' ";
$query = mysqli_query($con,$emailquery);

$emailcount = mysqli_num_rows($query);
if($emailcount)
{
	$email_pass = mysqli_fetch_assoc($query);
	$db_pass = $email_pass['user_password'];
	
	$pass_decode = password_verify($password, $db_pass);
	if($pass_decode){
		$_SESSION['ussername'] = $email_pass['user_name'];
		$_SESSION['userid'] = $email_pass['user_id'];
		echo "Login Successful";
		?>
		<script>
			location.replace("index2.php");
		</script>
		<?php
	}else
	echo'<script> alert("Password Incorrect");</script>';
	// echo "Password Incorrect";


}
 else
 echo'<script> alert("Invalid Email");</script>';
	// echo "Invalid Email";


}
$emailErr="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
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
  
  function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }

  ?>

 <?php
  require('navbar.php');
  ?>
   
   <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

	<div class="card bg_light">
		<article class="card-body mx-auto" style="max-width: 400px;">
<h4 class="card-title mt-3 text-center">LOGIN</h4>
<p class="text-center">Continue with your placement journey <i class="fa fa-road"></i></p>
<!-- <p>
	<a href=""class="btn btn-block btn-gmail"> <i class="fa fa-google"></i>Login via Gmail</a>
	<a href=""class="btn btn-block btn-facebook"> <i class="fa fa-google"></i>Login via Facebook</a>
</p> -->
<p class="divider-text" style='font-size: 25px'>
	<i class='fas fa-user-graduate' style='font-size:30px'></i> INTERNSHIP
</p>
<form action=" " method="POST">
	
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-at"></i></span>
		</div>
		<input name="useremail" class="form-control" placeholder="Enter your Email" type="text" required>
		<span class="error"> <?php echo $emailErr;?></span>
	</div>

	<div class="form-group input-group input-group-lg">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class= "fa fa-lock"></i></span>
		</div>
	<input class ="form-control" placeholder="Enter your password" type="password" name="userpassword" id="myInput" value="" required><br><br>
</div>
<div class="check">
		
		
		<input type="checkbox" onclick="myFunction()">Show Password

	</div>

	<div class="form-group">

  <button type="submit" name="submit" class="btn btn-primary btn-block ">Login Now</button></div>
</div>
<p class="text-center">Don't have account? <a href="register3.php">Create Account</a></p>

</form>
</article>
</div>
 			<?php
         require('footer.php');
                ?>  

</body>
</html>
