<?php
 session_start();
 date_default_timezone_set("Asia/Calcutta");
?>  

<?php
    require('header.php');
    ?>

    <title>Internship Details</title>
<body>
<?php
require('double.php');
 $error = $ids = '';
 if(isset($_SESSION['userid']))
 {
$ids = $_SESSION['userid'];
}
$showquery = "SELECT * FROM user_master where user_id = '$ids'";
$showdata = mysqli_query($con,$showquery);
$arrdata =mysqli_fetch_assoc($showdata);
 

if(isset($_POST['Submit']))
{
 
 $date= date('Y-m-d H:i:s');
 $internid = $_POST['intern_id'];
 $companyid = $_POST['company_id'];
 $categoryid = $_POST['category_id'];
 $durationid = $_POST['duration_id'];
 $intern_id = $_GET['intern_id'];
 $username = $_POST['user_name'];
 $userphone = $_POST['user_phone'];
 $useremail = $_POST['user_email'];
 $usercollege = $_POST['user_college'];
 $appstatus = $_POST['app_status'];

  $querys = "SELECT `app_id` FROM `internship_application_master` WHERE `intern_id`=$intern_id AND `user_id`=$ids";
              // echo $querys;    
          $query_runs = mysqli_query($con, $querys) or die('1---'.mysqli_error($con));
          if (mysqli_num_rows($query_runs) > 0) {
           echo '<script> alert("You have already applied for this internship!"); </script>'; 
              
          }

else {
          $queri ="INSERT INTO `internship_application_master`(`user_id`, `intern_id`,`app_date`,`company_id`,`category_id`,`duration_id`,`user_name`,`user_email`,`user_phone`,`user_college`,`app_status`) VALUES ('$ids','$internid','$date','$companyid','$categoryid','$durationid','$username','$useremail','$userphone','$usercollege','$appstatus')";
            //  echo $queri;
          $query_run = mysqli_query($con, $queri) or die(mysqli_error($con));
            
if($query_run)
{
   echo '<script> alert("Applied Successfully!!"); </script>'; 
   
}

else {
   echo'<script> alert("Data Not Saved"); </script>'; 
}
}
}

?>
  <?php
  require('navbar.php');
  ?>
       
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" ro
        le="document">

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">

        <form action="login.php" method="POST">

            <div class="form-group">
                <label for="email">
                    <p class="font-weight-bold mb-0">Email</p>
                </label>
                <div class="input-group mt-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa fa-at" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input type="text" name="userNameInput" class="form-control" placeholder="Enter Email">
                </div>
            </div>

            <div class="form-group">
                <label for="password">
                    <p class="font-weight-bold mb-0">Password</p>
                </label>
                <div class="input-group mt-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input type="password" name="userPwdInput" id="userPwdInput" class="form-control"
                        placeholder="Enter Password">
                </div>
            </div>

            <div class="form-check mt-0">
                <input class="form-check-input showPwd" type="checkbox" onclick="showpassword()">
                <label class="form-check-label" for="userPwdInput">
                    Show Password
                </label>
            </div>
            <button type="submit" name="loginBtn" class="btn btn-primary btn-block mt-3">Login</button>

            <p class="text-muted text-center p-2">New User ?
                <a href="register3.php" class="card-link text-primary">Register Here</a>
            </p>

        </form>

    </div>

</div>

        </div>

    </div>
<body class="bg-light">

    <div class="container-fluid m-2 p-3">
      
    </div>
    <div class="row">

        <div class="col-lg-1"></div>

        <div class="col-sm-12 col-md-8 col-lg-10">            
           <?php
            $intern_id = $_GET['intern_id'];
          $query = "SELECT `internship_master` .*,`user_master` .*,
          `company_master`.`company_name`,`company_master`.`company_about`,
           `category_master`.`category_id`,
          `company_master`.`company_url`,`category_master`.`category_name`,
          `duration_master`.`duration_name`,`status_master` .*
          
          FROM
              `internship_master`,`user_master`,`college_master`,`company_master`,`category_master`,`duration_master`,`status_master`
              
            WHERE
                
                `company_master`.`company_id`=`internship_master`.`company_id`
                AND `category_master`.`category_id`=`internship_master`.`category_id`
                AND `duration_master`.`duration_id`=`internship_master`.`duration_id`
                AND`internship_master`.`intern_details_id`=$intern_id
                AND`internship_master`.`intern_details_status`=`status_master`.`status_id`
                AND`user_master`.`user_id`=$ids

                ORDER BY
                `intern_details_id` LIMIT 1
                 
                 ";

          $res = mysqli_query($con, $query) or die(mysqli_error($con));

          while ($row = mysqli_fetch_object($res)) {
            $description = substr($row->company_about, 0, 500);
            $company_id = $row->company_id;
            $category_id = $row->category_id ;
            $duration_id = $row->duration_id;
            $username = $row->user_name;
            $userphone = $row->user_phone;
            $useremail = $row->user_email;
            $usercollege = $row->user_college;
            $appstatus = $row->status_name;

        

echo  "
<div class='container-fluid'>

    <div class='card p-3 ' id='mainCard'>
        <div class='card-body'>

            <div class='media'>
                <div class='media-body'>

                 <h4 class='mt-2 text-warning'>$row->company_name</h4>
                <h4 class='mt-2 text-strong'>Internship-$row->intern_name
    <span class='badge badge-pill badge-success'>$row->intern_details_status</span>
</h4>
                <h5 class='mt-0 mb-1'>$row->category_name</h5>
                <h5 class='mt-0 mb-1'>$row->college_name</h5>
        <table class='table table-sm table-borderless table-responsive-md mt-3'>
                    
            <thead>
                <tr>
                    <th class='text-muted'>
                        <i class='fa fa-play-circle' aria-hidden='true'</i> Interview Date
                    </th>
                    <th class='text-muted'>
                        <i class='fa fa-calendar' aria-hidden='true'></i> Duration
                    </th>
                    <th class='text-muted'>
                        <i class='fa fa-money' aria-hidden='true'></i> Stipend
                    </th>
                    <th class='text-muted'>
                        <i class='fa fa-clock-o' aria-hidden='true'></i> Apply By
                    </th>
                     <th class='text-muted'>
                        <i class='fa fa-clock-o' aria-hidden='true'></i> Apply Status
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>$row->interview_date</td>
                <td>$row->duration_name</td>
                <td>$row->intern_stipend/Month</td>
                <td>$row->intern_apply_by</td>
                <td>$row->status_name</td>
                </tr>
            </tbody>
        </table>
    </div>
        <img class='img-circle profile_img' height=60 width=60 src='images/".$row->intern_img."'>
        </div>
        <h5>About $row->company_name</h5>

        <a href='$row->company_url' class='card-link'>$row->company_url
            <i class='fa fa-external-link' aria-hidden='true'></i>
        </a>

        <p class='text-justify text-muted'>
           $description
        </p>

        <h5>About the work from home job/internship</h5>

        <p class='text-justify text-muted mt-0'>
        Selected intern's day-to-day responsibilities include:
            <ol class='text-muted'>
                <li>$row->intern_work_detail_1</li>
               <li>$row->intern_work_detail_2</li>
               <li>$row->intern_work_detail_3</li>
            </ol>
        </p>
        <h5>Who Can Apply</h5>

        <p class='text-muted'>
            Only those candidates can apply who:
            <ol class='text-muted'>
            <li>Are available for full time (in-office) internship.</li>
                <li>Can start from <b> $row->intern_apply_by</b></li>
                <li>Are available for duration of <b>$row->duration_name.</b></li>
               
                <li>Have relevant skills and interests</li>
            </ol>
        </p>

        <h5>Skills Required</h5>

            <div class='container-fluid p-2 mb-2'>
                <a href='#' class='badge badge-pill badge-success'>$row->intern_skill_1</a>
                <a href='#' class='badge badge-pill badge-success'>$row->intern_skill_2</a>
                <a href='#' class='badge badge-pill badge-success'>$row->intern_skill_3</a>
            </div>   

        <h5>Other requirements</h5>

        <ol class='text-muted'>
            <li>Must have a laptop with internet connectivity</li>
        </ol>

        <hr>
        
         <form action = '' enctype='multipart/form-data' method='POST'>
            
             <input type='hidden' name='intern_id' value='$intern_id'> 
             <input type='hidden' name='company_id' value='$company_id'> 
             <input type='hidden' name='category_id' value='$category_id'> 
             <input type='hidden' name='duration_id' value='$duration_id'> 
             <input type='hidden' name='user_name' value='$username'> 
             <input type='hidden' name='user_phone' value='$userphone'>
             <input type='hidden' name='user_email' value='$useremail'>  
             <input type='hidden' name='user_college' value='$usercollege'>  
             <input type='hidden' name='app_status' value='$appstatus'>  
           <button class='btn btn-primary btn-block' type='submit' name='Submit' href='index2.php'>
                                         Apply Now
                                    </button> 

                                    
                             </form>
                             </div>
                           
                            </div>
        
                        </div>
                        ";
                }
    ?>
                    
            <div class="col-lg-1"></div>

        </div>

    </div>

    <div class="mt-5 bg-light p-2 text-center text-muted font-monospace sticky-bottom">
    <div class="mt-2 mb-5">
        <hr>
        <p class="m-0">Copyright <span class="fa fa-copyright"></span> UserZone</p>
        <a href="#" class="m-0 card-link text-muted"><small> Privacy Policy | </small></a>
        <a href="#" class="m-0 card-link text-muted"><small>  Terms & Conditions </small></a>
        <p class="m-2"><span class="fa fa-graduation-cap"></span></p>
    </div>
</div>
<?php
require('footer.php');
?>


</body>
</html>


 