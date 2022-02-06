<?php
session_start();
// if(isset($_SESSION['username'])){
//  echo"you are logged out";
//  header('location:register1.php');
// }
$error = null;
require_once('double.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Work Details </title>
   <?php
  require('header.php');
    ?>
       <script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>       
    <style>
#work input{
    height: 300px;
}
/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 400px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}
/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}
/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}
/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}
@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
.btn button{
  margin-top: 20px;
  color:white;
  background: #1ab8d4;
  border:none;
}
 </style>
</head>
<body>
<body class="bg-light">
 <?php
    $error = $ids ='';
    if(isset($_SESSION['userid']))
    {
  $ids = $_SESSION['userid'];
    }
$showquery = "SELECT * FROM user_master where user_id = '$ids'";
$showdata = mysqli_query($con,$showquery);
$arrdata =mysqli_fetch_assoc($showdata);
          $week_id = $_GET['week_id'];
          $query = "SELECT `internship_application_master` .*,`week_transaction`.*        
          
          FROM
              `internship_application_master`,`week_transaction`   
            WHERE
                `week_transaction`.`week_id`=$week_id
                AND`internship_application_master`.`user_id`=`week_transaction`.`user_id`
                AND`internship_application_master`.`intern_id`=`week_transaction`.`intern_id`
               ORDER BY
                `internship_application_master`.`app_id` ASC                 
                 ";
                //  echo $query;
                 $res= mysqli_query($con, $query)or die(mysqli_error($con));
                 $row = mysqli_fetch_object($res);
                 ?>
                  <?php
    require('navbar.php');
?>
            <div class='container-fluid mt-4 mb-3'>
              <div class='row'>
                  <div class='col-sm-12 col-md-2 col-lg-2'>
                      <div class='advertisement-right d-none d-md-block'>    
                      </div>
                  </div>
                 <div class='col-sm-12 col-md-8 col-lg-8'>
                   <div class='container-fluid'>
                    <div class='card mt-2 p-3' id='applicationform'>
                      <div class='card-body'>
                        <h4 class='card-title font-weight-bold'> WORK DESCRIPTION </h4>
                        <hr>
                        <form action = 'work_details.php' enctype='multipart/form-data' method='POST'>
                            <div class='form-row'>
                      <div class=' col-md-6 mt-4'>
                          <label for='Duration' class='font-weight-bold m-0'>Week Name</label>
                               <br>
                          <input type='text'  class='Form control-plaintext' name='week_name'
                          value='<?php echo $row->week_name ?>'>
                      </div>
                </div>            
                <div class='form-row' id='work'>
                       <div class='col-md-12 mt-5 '>
                          <label for='text' class='font-weight-bold m-0'> WORK DESCRIPTION </label>
                           <input type='text' class='form-control' name='intern_work_des' value='<?php echo $row->intern_work_description ?>'> 
                          </input>
                         
                      </div>
                  </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
   <?php
         require('footer.php');
                ?>  
</body>
</html>