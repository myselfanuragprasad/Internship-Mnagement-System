<?php
session_start();
?>  

<?php
require('header.php');
?>
<title>MY APPLICATION</title>

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

?>
    <?php
  require('navbar.php');
  ?>
   
<body class="bg-light">

    <div class="container-fluid mt-4 mb-3">
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

            
            <div>
                <a href='styleregister.php' class='card-link text-dark m-1'>
                    <i class="fa fa-user mr-1" aria-hidden="true"></i> My Profile
                </a>
                <br>
                <a href='myapplication.php' class='card-link text-dark m-1'>
                    <i class='fa fa-file mr-1'  aria-hidden='true'></i> My Applications
                </a>
                <br>
                <a href='internship_record.php' class='card-link text-dark m-1'>
                    <i class='fa fa-file mr-1'  aria-hidden='true'></i> Internship Record
                </a>
                <br>
                <a href='applynew.php' class='card-link text-dark m-1'>
                    <i class='fa fa-file mr-1'  aria-hidden='true'></i> Letter Issue
                </a>
                <br>
                <a href='applynew.php' class='card-link text-dark m-1'>
                    <i class='fa fa-file mr-1'  aria-hidden='true'></i> Intermship Progress
                </a>
            </div>

         
        </div>

    </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="vh90-scroll">
                        <?php
     $query = "SELECT `internship_application_master`.*, `internship_master` .*,
     `company_master`.`company_name`,
     `company_master`.`company_id`,
     `category_master`.`category_id`,
     `company_master`.`company_logo_url`,`category_master`.`category_name`,
     `duration_master`.`duration_name`, `duration_master`.`duration_id`

    
     FROM
         `internship_application_master`,`internship_master`,`company_master`,`category_master`,`duration_master`
        
       WHERE
           `internship_master`.`intern_details_id`=`internship_application_master`.`intern_id`AND
           `internship_application_master`.`user_id`= $ids AND
            `company_master`.`company_id`=`internship_application_master`.`company_id`
           AND `category_master`.`category_id`=`internship_application_master`.`category_id`
           AND `duration_master`.`duration_id`=`internship_application_master`.`duration_id`

           
           ORDER BY
           `internship_application_master`.`app_id` ASC

            
            "; 
 
          $res = mysqli_query($con, $query) or die(mysqli_error($con));

          while ($row = mysqli_fetch_object($res)) {
           
echo  "
 <div id='vacancy-container'>
    <div class='card mb-4  vacancyCard' vacancy-id='109'>
            <div class='card-header text-info font-weight-bold'>
                <div class='row'>
                    <div class='col-8 text-wrap'>
                      $row->company_name
                        <span class='badge badge-pill badge-warning'>New</span>
                    </div>
                   

                 </div> 
            </div>

              <div class='card mb-0 ' id='mainCard'>
        <div class='card-body'>

        <div class='media'>
            <div class='media-body'>
        <h4 class='mt-0 mb-1 '>$row->category_name</h4>
        
         <h6 class='mt-2 text-strong'>$row->intern_name
            <span class='badge badge-pill badge-success'>$row->app_status</span>
        </h6>


        <table class='table table-sm table-borderless table-responsive-lg mt-3'>

            <thead>
                <tr>
                    <th class='text-muted'>
                        <i class='fa fa-play-circle' aria-hidden='true'></i> Start Date
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
                <td>$row->intern_start_date</td>
                <td>$row->duration_name</td>
                <td>$row->intern_stipend/Month</td>
                <td>$row->app_date</td>
                
                </tr>
            </tbody>
        </table>

    


    </div>
    <img  class='img-circle profile_img' height=60 width=60 src='images/".$row->intern_img."'>
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
        <div class='card-footer p-0'>
                                <small class='mr-2 p-1 text-muted float-right'>Post date | Sep 03, 2021</small>
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
