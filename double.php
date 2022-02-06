<?php
// session_start();
error_reporting(0);
$server = "localhost";
$user = "root";
$password = "";
$db = "project_database";
$con = mysqli_connect($server,$user,$password,$db);
if(isset($_POST['id'])){
	 $id=$_POST['id'];
  $query=mysqli_query($con,"select * from state_master where country_id='$id' ");
  while($row=mysqli_fetch_array($query)){
    $id=$row['state_id'];
    $state=$row['state_full_name'];
    echo"<option value='$id'>$state</option>";
  }
}
if(isset($_POST['stateId'])){
	 $id=$_POST['stateId'];
  $query=mysqli_query($con,"select * from city_master where state_id='$id' ");
  while($row=mysqli_fetch_array($query)){
    $id=$row['city_id'];
    $city=$row['city_full_name'];
    echo"<option value='$id'>$city</option>";
  }
}
if(isset($_POST['cityId'])){
  $id=$_POST['cityId'];
 $query=mysqli_query($con,"select * from area_master where city_id='$id' ");
 while($row=mysqli_fetch_array($query)){
   $id=$row['area_id'];
   $area=$row['area_full_name'];
   echo"<option value='$id'>$area</option>";
 }
}
// if(isset($_POST['companyId'])){
//   $id=$_POST['companyId'];
//  $query=mysqli_query($con,"select * from category_master where company_id='$id' ");
//  while($row=mysqli_fetch_array($query)){
//    $id=$row['category_id'];
//    $category=$row['category_name'];
//    echo"<option value='$id'>$category</option>";
//  }
// }

// if(isset($_POST['categoryId'])){
//   $id=$_POST['categoryId'];
//  $query=mysqli_query($con,"select * from department_master where category_id='$id' ");
//  while($row=mysqli_fetch_array($query)){
//    $id=$row['dept_id'];
//    $dept=$row['dept_name'];
//    echo"<option value='$id'>$dept</option>";
//  }
// }
if(isset($_POST['dept']))
{
  $id=$_POST['dept'];
$query=mysqli_query($con,"select * from company_person_master where dept_id='$id' ");
  while($row=mysqli_fetch_array($query)){
   $id=$row['company_person_id'];
   $company=$row['company_person_name'];
   echo"<option value='$id'>$company</option>";
 }
}
 // {$query = "UPDATE `user_master` SET user_image= '$pic',user_roll='$userroll',user_email='$useremail', user_country='$usercountry', user_state='$userstate', user_area='$userarea' , user_city='$usercity' where user_id=$ids ";
    //     echo $query;
    //  $res = mysqli_query($con, $query);
if(isset($_POST['summary']))
{
  $FROM=$_POST['summary'];
  $id = $_POST['user'];
  $idn = $_POST['intern'];
   $sql="UPDATE `internship_application_master`SET`internship_summary`='$FROM' WHERE `user_id`=$id AND `intern_id`=$idn";
  //  echo $sql;
  $comp = mysqli_query($con,$sql) or die(mysqli_error($con));
  if($comp)
  {
    echo'success';
  }
   else{
     echo'failure';
  }
}
if(isset($_POST['intern_work_des']))
{
  $work=$_POST['intern_work_des'];
  $userid=$_POST['user_id'];
  $internid=$_POST['intern_id'];
  $internstart=$_POST['intern_start_date'];
  $internend=$_POST['intern_end_date'];
  $weeks=$_POST['week'];
  $query1="UPDATE `internship_application_master` SET `intern_end_date`='$internend',`intern_start_date`='$internstart' where `user_id`='$userid' AND `intern_id`='$internid'";
  $query2="UPDATE `week_transaction` SET `intern_work_description`='$work' where `user_id`='$userid' AND `intern_id`='$internid' AND `week_id`='$weeks'";
  // echo $query1;
  // echo $query2;
  $query_run =  mysqli_query($con,$query1)or die(mysqli_error($con));
  $query_runs =   mysqli_query($con,$query2)or die(mysqli_error($con));
//    echo $query1;
  if($query_run||$query_runs)
  {
      echo 'success';
  }
  else { 
      echo'failure';
  }
}
if(isset($_POST['weekdetails']))
{
  $idweek=$_POST['weekdetails'];
  $iduser=$_POST['iduser'];
  $idintern=$_POST['intern'];
  $query = "INSERT INTO `week_transaction`(`week_name`,`user_id`,`intern_id`) VALUES ('$idweek','$iduser','$idintern')";        
  $res = mysqli_query($con, $query)or die(mysql_error($con));
   if ($res) {
      echo 'success';
        } else {
            echo'failure';
        }
    }
// if($_FILES['profileimage']['name'] !='')
// {
//   $filename = $_FILES['profileimage']['name'];
//   $extension =pathinfo($filename,PATHINFO_EXTENSION);
//   $valid_extensions = array("jpg","jpeg"."png","gif");
//   if(in_array($extension, $valid_extensions))
//   {
//     $new_name= rand()."." .$extension;
//     $path = "images/".$new_name;
//     if(move_uploaded_file($_FILES['file']['temp_name'], $path))
//     {
//       echo'<img src="'.$path.'" /><br><br>
//       <button data-path="'.$path.'" id="delete_btn">Delete</button>';
//     }else{
//       echo '<script>alert("invalid file format")</script>';    
//     }
//   }
// }else{
//   echo '<script>alert("Please select file")</script>';
// }

?>


