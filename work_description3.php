<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
// if(isset($_SESSION['username'])){
//  echo"you are logged out";
//  header('location:register1.php');
// }
$error = null;
require_once('double.php');
?>
 <?php
  require('header.php');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Work Description </title>
    <script type="text/javascript" src="ajaxfile.js"></script>
       <script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>        
    <style>
#work textarea{
    height:300px;
}
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
#col-md-6 mt-4{
    border:0px;
}
.company input{
    border-top-width: 0px;
    border-left-width: 0px;
    border-right-width: 0px;
    border-bottom-width: 0px;    
}
.internship input{
    border-top-width: 0px;
    border-left-width: 0px;
    border-right-width: 0px;
    border-bottom-width: 0px;    
}
.department input{
    border-top-width: 0px;
    border-left-width: 0px;
    border-right-width: 0px;
    border-bottom-width: 0px;    
}
.start input{
    border-top-width: 0px;
    border-left-width: 0px;
    border-right-width: 0px;
    border-bottom-width: 0px;     
}
#contact button{
    position:absolute;
    left:520px;
}
/* #sum{
    box-sizing:border-box;
} */
 </style> 
</head>
<body>
    <?php  
    $date=date('d-m-y');
    ?>
<?php
    $error = $ids ='';
    if(isset($_SESSION['userid']))
    {
     $ids = $_SESSION['userid'];
    }
$showquery = "SELECT * FROM user_master where user_id = '$ids'";
$showdata = mysqli_query($con,$showquery);
$arrdata =mysqli_fetch_assoc($showdata);
 $idt = $_GET['idd']; 
//  echo $ids;
   $queryi = "SELECT `internship_application_master`.*,`company_master`.*,`internship_master`.*,`duration_master`.*,`company_person_master` .*,`internship_transaction_master` .*,`department_master` .*        
          FROM
              `internship_application_master`,`company_master`,`internship_master`,`duration_master`,`company_person_master`,`internship_transaction_master`,`department_master`
            WHERE
                `internship_application_master`.`user_id`=$ids
                AND`internship_application_master`.`intern_id`=$idt
                -- AND`internship_master`.`user_id`=$ids
                AND`internship_master`.`intern_details_id`=`internship_application_master`.`intern_id`
                AND`duration_master`.`duration_id`=`internship_master`.`duration_id`
                -- AND`internship_transaction_master`.`department_id`=`department_master`.`dept_id`
                 AND`internship_transaction_master`.`user_id`=$ids
                 AND`internship_transaction_master`.`contact_id`=`company_person_master`.`company_person_id`
                 AND`internship_transaction_master`.`department_id`=`department_master`.`dept_id`
                AND`internship_application_master`.`company_id`=`company_master`.`company_id`
               ORDER BY
                `internship_application_master`.`app_id` ASC                 
                 ";
                    // echo $queryi;
                 $ress= mysqli_query($con, $queryi)or die(mysqli_error($con));
                 $rows = mysqli_fetch_array($ress) ;
                 ?>  
                 <!-- update coding within php starts from here is copied to sublime.html -->
 <?php
  require('navbar.php');
?>
<body class="bg-light">
    <div class="container-fluid mt-5-2 mb-4">
    </div>
        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3 d-flex align-items-stretch">
        <div class="container-fluid ml-4 p-1 w-75">
        <div class="card w-auto position-static" id="sidebar">
        <div class="card-body">                                       
        <h5 class='card-title text-center font-weight-bold'>    
      <?php
        echo "<img class='img-circle profile_img' height=30 width=30 src='images/".$arrdata['user_image']."'>";
                                            ?>
                                     <?php
                                    if(isset($_SESSION['username'])){
                                     echo $_SESSION['username']; 
                                    }
                                    ?>
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
        <?php 
       $wquery =" SELECT `week_transaction`.*
        FROM
        `week_transaction`
        WHERE
        `week_transaction`.`user_id`=$ids
        AND`week_transaction`.`intern_id`=$idt
        ORDER BY
        `week_transaction`.`week_name` DESC Limit 1";        
      $resn= mysqli_query($con, $wquery)or die(mysqli_error($con));
      if(mysqli_num_rows($resn) > 0)
      {
          $rown = mysqli_fetch_array($resn) ;
        $lastid = $rown['week_name'];
        $week= $lastid + 1;
    }
    else{
        $week = 1;   
    }
    ?> 
    <!-- week added coding query was here -->
               <table class="table table-bordered">                   
              <?php 
                  $sql = "SELECT `week_transaction` .*,`internship_application_master` .*
              FROM  
                  `week_transaction`,`internship_application_master`
                  WHERE
                  `internship_application_master`.`intern_id`=`week_transaction`.`intern_id`
                  AND `internship_application_master`.`user_id`=`week_transaction`.`user_id`
                  AND`week_transaction`.`user_id`=$ids
                  AND`week_transaction`.`intern_id`=$idt
                   ORDER BY
                  `week_transaction`.`week_id`";
                  $result = mysqli_query($con, $sql);
                  $week_id = 0;
                  while($row = mysqli_fetch_object($result))
                  {
                      $week_id = $week_id + 1;
                      echo "  <tr>
                                  <div class='btn'>
                                 <a href='work_details1.php?week_id= $row->week_id' class='card-link text-muted m-0' target='_blank'>week $row->week_name </a>
                                 </div>
                              </tr>
                          ";   
                  } 
              ?>   
               <button type="button" class="btn btn-primary mt-3" id="sum" data-toggle="modal" data-target="#exampleModal">
                Add Week
          </button>                    
              </table>  
              <!-- add btn -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Week</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <!-- add weekj modal popup -->
        <!-- <div id="week-modal" class="modal fade" role="dialog"> -->
        <div class="modal-body"+>
             <!-- <form action = '' enctype='multipart/form-data' method='POST'> -->
                <div class="form-row">
                    <!-- Enter Week Name -->
           <div class="col-md-12">
                        <label for="Week_name">Enter Week Name</label>
                        <div class="input-group-prepend">
                        <span class="input-group-text">week</span>
                        <input type="number" min="1" id="week_name" name="weekname" class="form-control" placeholder="" value='<?php echo $week ?>' required="">
                        <input type="hidden" id="w-user-id" name="username" class="form-control" value='<?php echo $ids ?>'>
                        <input type="hidden" id="w-intern-id" name="internname" class="form-control" value='<?php echo $idt ?>'>
                    </div>
                </div>
                    <div class="col text-center" style="box-sizing:border-box;">
                        <button type="button" value="submit data" name="Submit" id="submitbtn" class="btn btn-success mt-3">
                            Add Week
                        </button>
                    </div>
                </div>
                
            <!-- </form> -->
            </div>
            </div>
            </div>
            </div>  
    </div>
</div>  
</div>
            
<?php
$weekquery = "select * from week_transaction where user_id='$ids'AND intern_id='$idt' ";
$query = mysqli_query($con,$weekquery);
$weekcount = mysqli_num_rows($query);
if($weekcount == 0)
{
	echo '<script> alert("Please Add Week To Continue.."); </script>'; 
}
else
{
?>
        <div class="col-sm-12 col-md-8 col-lg-8">
        <div class="container-fluid">
        <div class="card mt-2 p-3" id="applicationform">
        <div class="card-body">
        <h4 class="card-title font-weight-bold"> WORK DESCRIPTION </h4>
        <hr>                                       
        <label for='internid' class="font-weight-bold m-0">Intern Id</label>
        <input type="number" name="internid" id="b-intern-id" readonly class="form-control-plaintext"
        value='<?php echo $idt ?>'>
        <input type="hidden" name="userid" id="b-user-id" readonly class="form-control-plaintext"
        value='<?php echo $ids ?>'>
        <hr>
        <!-- <form action = '' enctype='multipart/form-data' method='POST'> -->
        <div class="form-row">  
        <div class="col-md-6 mt-4">
        <div class="company">
                <label for="company name" class="font-weight-bold m-0">COMPANY NAME</label>
                     <br>
                 <input type="text"  readonly class="Form control-plaintext" id="b-company-name" name="company_name"
                value='<?php echo $rows['company_name'];?>'>
             </div> 
                </div>
              <div class="col-md-6 mt-4">
              <div class="internship">
                <label for="internship name" class="font-weight-bold m-0">INTERNSHIP NAME</label>
                     <br>
                 <input type="text"  readonly class="Form control-plaintext" id="b-intern-name" name="internship_name"
                value='<?php echo $rows['intern_name'];?>'>
                </div>
             </div>
             <div class="col-md-6 mt-4">
             <div class="department">
                <label for="department name" class="font-weight-bold m-0">DEPARTMENT NAME</label>
                <br>
                 <input type="text" readonly class="Form-control-plaintext" id="b-dept-name" name="department_name"
                value='<?php echo $rows['dept_name'];?>'>
                </div>
             </div> 
            <div class="col-md-6 mt-4">
                <div class="start">
                <label for="start" class="font-weight-bold m-0">START DATE</label>
                     <br>
                 <input type="date"  class="datepicker" id="b-start-date" name="start_date"
                value='<?php echo $rows['intern_start_date']?>'>
                </div>
             </div>       
            <div class="col-md-6 mt-4">
               <label for="end" class="font-weight-bold m-0">END DATE</label>
                     <br>
                 <input type="date" class="datepicker" id="b-end-date" name="end_date"
                    value='<?php echo $rows['intern_end_date']?>'>
             </div>
                <div class=" col-md-6 mt-4">
                <label for="Duration" class="font-weight-bold m-0">DURATION</label>
                     <br>
                <input type="text"  readonly class="Form control-plaintext" id="b-calculate" name="duration"
                value='<?php echo $rows['duration_name']?>'>
            </div>    
            <div class="col-md-4 mb-4">
            <label for="UserWeek" class="font-weight-bold m-2">Week </label>
            <select class="form-control" id="UserWeek" name="weeksname">
            <option value disable selected>Select Week</option>
            <?php
             $query = "SELECT  `week_transaction` .*
             FROM `week_transaction`
              WHERE
               `intern_id`=$idt
               AND `user_id`=$ids
                ORDER BY
                `week_transaction`.`week_id`
              ";
             $res =  mysqli_query($con,$query);
             while ($row = mysqli_fetch_object($res)) {
               echo "<option value='$row->week_id'>$row->week_name</option>";
               } 
             ?> 
             </select>
     </div>
         </div>
            <div class="sample mt-3">
            <button class="popup" onclick="myFunction()">Click to Sample
        <span class="popuptext h-9 w-9" id="myPopup">You have to write about the work done in first week <br> of internship.
                 I was given training to handle documentation of requirement.
                  <br>
                 I learn how to fill 
                 I have learn
                  <br>
                 A.
                  <br> 
                 B.
                  <br>
                 C.    </span>
            </button>
            </div> 
         <div class="sample mt-3">
<button type="button" name="addbtn"  data-toggle="modal" data-target="#contact-modal" class="btn  btn-primary">Summary</button>
        <div class="form-row" id="work">
             <div class="col-md-12 mt-5 ">
                <label for="text" class="font-weight-bold m-0"> WORK DESCRIPTION </label>
                 <textarea type="text" class="form-control" id="text" name="intern_work_des" 
                 placeholder="You have to write about the work done in first week of internship.
                 I was given training to handle documentation of requirement.
                 I learn how to fill a form for recruitment.
                 I have learn
                 A. 
                 B.
                 C.    " 
                ></textarea>              
            </div>
        </div>      
      <button type="button" name="addbtn" id="submitdata" class="btn btn-primary btn-lg btn-block mt-3">SUBMIT DATA</button>
      <?php
               $squery="SELECT `internship_application_master`.*
               FROM `internship_application_master`
               WHERE
               `internship_application_master`.`user_id`=$ids
               AND `internship_application_master`.`intern_id`=$idt
               ORDER BY
                `internship_application_master`.`app_id` ASC     
               ";
                $rsum=mysqli_query($con,$squery)or die(mysqli_error($con));
                $rom=mysqli_fetch_object($rsum);
               ?>
        <div id="contact-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal">x</a>
                            <h3>Summary Page</h3>
                         </div>
                     <div class="modal-body">
                           <input type="hidden" name="myId" id="s-user-id" readonly class="form-control-plaintext" value='<?php echo $ids; ?>'>
                           <input type="hidden" name="myIntern" id="s-intern-id" readonly class="form-control-plaintext" value='<?php echo $idt;?>'>                       
                         <div class="form-group">
                            <label for="summary">SUMMARY</label>
                           <textarea type="text" name="mySummary" id="s-summary"  class="form-control" rows="5"><?php echo $rom->internship_summary ?></textarea>
                       </div>                       
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="submitSummary">Submit</button>
                    </div> 
            
            </div>








<?php
}
?>
               <?php
            require('footer.php');
            ?>
</body>
</html>