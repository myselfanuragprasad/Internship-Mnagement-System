<?php
 require_once('double.php');
 session_start();
 date_default_timezone_set("Asia/Calcutta");
?>  
 <?php
  require('header.php');
    ?>
  <title>Index2</title>
  <style>
.sidenav{
    position:fixed;
    overflow-x:hidden;
    z-index:1;
 }
 .col{
    position:fixed;
    overflow-x:hidden;
    z-index:1;
 }
 .sidenav a{
    text-decoration:none;
    display:block;
}
</style>
<body>
    <?php
require('double.php');
 $error = $ids = '';
 if (isset($_SESSION['userid'])) {
$ids = $_SESSION['userid'];
 }
$showquery = "SELECT * FROM user_master where user_id = '$ids'";

$showdata = mysqli_query($con,$showquery);
$arrdata =mysqli_fetch_assoc($showdata);
?>

<?php
    require('navbar1.php');
?>
    <body class="bg-light"> 

    <div class="container-fluid mt-5 mb-4">
        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3">       
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
            
            <div class="sidenav">
                <a href='styleregister.php' class='card-link text-dark m-1'>
                    <i class="fa fa-user mr-1" aria-hidden="true"></i> My Profile
                </a>
                <br>
                <a href='myapplication.php' class='card-link text-dark m-1'>
                    <i class='fa fa-file mr-1'  aria-hidden='true'></i> My Applications
                </a>
                <br>
                <a href='applynew.php' class='card-link text-dark m-1'>
                    <i class='fa fa-file mr-1'  aria-hidden='true'></i> Internship Progress
                </a>
            </div>
        
    

         
        </div>

    </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="vh90-scroll">
          <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
          Welcome to the Internship Management System <a href="tutorial" class="alert-link" target="_blank"> Please Login  </a>for More Details.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

                         <?php
                $query = "SELECT `internship_master` .*,
          `company_master`.`company_name`,
          `company_master`.`company_logo_url`,`category_master`.`category_name`,
          `duration_master`.`duration_name`
         
          FROM
              `internship_master`,`company_master`,`category_master`,`duration_master`
             
            WHERE

                 `company_master`.`company_id`=`internship_master`.`company_id`
                AND `category_master`.`category_id`=`internship_master`.`category_id`
                AND `duration_master`.`duration_id`=`internship_master`.`duration_id`
                ORDER BY
                `internship_master`.`intern_details_id` ASC
                 
                 ";     

          $res = mysqli_query($con, $query) or die(mysqli_error($con));

          while ($row = mysqli_fetch_object($res)) {
           
    
  echo  "
          <div class='card mb-4 shadow' id='mainCard'>
           <div class='card-body'>


    <div class='media'>
        <div class='media-body'>

        <h4 class='mt-2 text-primary'>$row->company_name</h4>
     <img class='img-circle profile_img' height=60 width=60 src='images/".$row->intern_img."'>
    <h5 class='mt-0 mb-1 text-secondary'>$row->category_name</h5>
    
     <h5 class='mt-2 text-strong'>$row->intern_name
        <span class='badge badge-pill badge-success'>$row->intern_details_status</span>
    </h5>
    

    <table class='table table-sm table-borderless table-responsive-lg mt-3'>

        <thead>
            <tr>
                <th class='text-muted'>
                    <i class='fa fa-play-circle' aria-hidden='true'></i> Interview Date
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
                
            </tr>
        </thead>

        <tbody>
            <tr>
            <td>$row->interview_date</td>
            <td>$row->duration_name</td>
            <td>$row->intern_stipend/Month</td>
            <td>$row->intern_apply_by</td>
            
            </tr>
        </tbody>
    </table>        
    
   
    
    <h5>Skills Required</h5>

    <div class='container-fluid p-2 mb-2'>
          <a href='#' class='badge badge-pill badge-success'>$row->intern_skill_1</a>
          <a href='#' class='badge badge-pill badge-success'>$row->intern_skill_2</a>
            <a href='#' class='badge badge-pill badge-success'>$row->intern_skill_3</a>
        </div> 



</div>
       
    </div>
    ";
    if(isset($_SESSION['userid']))

    {
        echo"
    <a href='internship_details.php?intern_id=$row->intern_details_id' target=`_blank` class='card-link font-weight-bold float-right'>View Details
        <i class='fa fa-angle-right ml-1' aria-hidden='true'></i>
    </a>

                ";
            }
            echo"
</div>

        
                  
       
</div>
                        
                           

";
   
          }
        ?>
        
               

        <?php
         require('footer.php');
                ?>  
</body>
</html>

 <!-- <img src='<img class='img-circle profile_img' height=30 width=30 src='images/'.$arrdata['user_image'].'>';
            alt='Generic placeholder image'> -->