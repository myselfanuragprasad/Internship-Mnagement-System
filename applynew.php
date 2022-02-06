
<?php
session_start();
// if(isset($_SESSION['username'])){
//  echo"you are logged out";
//  header('location:register1.php');
// }
$error = null;
?>

<?php
  require('header.php');
?>

    <title>USER APPLY</title>  
<style>
*{
    margin: 0;
    padding:  0;
    box-sizing: border-box;
}
html,body
{
    font-size: 14px;
}
/*body
{
    padding: 40px 10px;
}*/
.title{
    border-collapse: collapse;
    width: 100%;
    margin: 10px auto 0;
    font-size: 1.5rem;
    color: #4a788b;
}
table{
    border-collapse: collapse;
    width: 98%;
    margin: 10px auto;
    font-size: 1rem;
    color: #4a788b;
    border-radius: 10px;
}
table thead{
    background-color: #d9f0fc;
}
table th,
table td{
border: 1px solid #6fcfff;
padding:6px 35px;

}
@media screen and (max-width: 639px)
{
    .title{
        text-align: left;
    }
    .smart-table thead{
        dispaly:  none;
    }
    .smart-table tr,
    .smart-table td{

        display: block;
    }

}
</style>
<body>
    <?php
    if (isset($_GET['success'])) {
        # code...
    $run =$_GET['success'];
    if($run == 'false')
    {
        echo '<script> alert("You have Already applied for the letter"); </script>'; 
    }
}
?>

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
?>
<?php
    require('navbar.php');
?>
    
<body class="bg-light">

    <div class="container-fluid m-2 p-3">

    </div>

        <div class="row">

        <div class="col-sm-12 col-md-10 col-lg-3  d-flex align-items-stretch">
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
        <div class="col-sm-10 col-md-8 col-lg-9">

        <div class="container-fluid">

        <div class="card mt-2 p-3" id="applicationform">
        <div class="card-bodys">

        <h4 class="card-title font-weight-bold">Internship Progress</h4>
         
          <hr>
          <table class="smart-table">
    <thead>
        
        <tr>
            <th>Intern-Id</th>
            <th>Internship-Name</th>
            <th>Company-Name</th>
            <th>Application-Date</th>
            <th>Application-status</th>
            <th>Work Progress</th>
        </tr>
        <tbody>
          <?php
	                            
 $query = "SELECT `internship_application_master`.*, `internship_master` .*,
          `company_master`.`company_name`,
          `company_master`.`company_logo_url`,`category_master`.`category_name`,
          `duration_master`.`duration_name`,`status_master` .*
       
         
          FROM
              `internship_application_master`,`internship_master`,`company_master`,`category_master`,`duration_master`,`status_master`
             
            WHERE
              `internship_application_master`.`user_id`= $ids 
              AND  `internship_master`.`intern_details_id`=`internship_application_master`.`intern_id`
             AND    `company_master`.`company_id`=`internship_master`.`company_id`
             AND`internship_application_master`.`app_status`=`status_master`.`status_name`
                AND `category_master`.`category_id`=`internship_master`.`category_id`
                AND `duration_master`.`duration_id`=`internship_master`.`duration_id`  
                
                ORDER BY
                `internship_master`.`intern_details_id` ASC

                 
                 "; 
                

                $res= mysqli_query($con, $query)or die (mysqli_error($con)); 
                                   
             while($row = mysqli_fetch_array($res)){
        ?>
        <tr>
                <td data-col-title="Inern-ID"><?php echo $row['intern_id']; ?></td>
              <td data-col-title="Inernship-ID"><?php echo $row['intern_name']; ?></td>
               <td data-col-title="Company-Name"> <?php echo $row['company_name']; ?>
               
                                   </td>
                                   
                <td data-col-title="Application-Date"><?php echo $row['app_date']; ?></td>
                
                    <td data-col-title="Application-status"><a class="btn btn-primary btn-block" type="submit" name="submit" href='transactionform.php?id=<?php echo $row['app_id'];?>'>                                                                                                          
                    GET LETTER 
               </a>
               <td data-col-title="Progress"><a class="btn btn-primary btn-block" type="submit" name="submits" href='work_description3.php?idd=<?php echo $row['intern_id'];?>'>
                                        PROGRESS
                                    </a>             

              </tr>
            <?php
            }
    ?>

          </tbody>
      </thead>
  </table>
             <?php
         require('footer.php');
                ?>  
    </body>
    </html>
                                             

                        
                                 