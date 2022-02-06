<?php
 require_once('double.php');
 session_start();
 date_default_timezone_set("Asia/Calcutta");
?>  
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
  <title> User Page </title>
</head>
<style>
  body {
    height: 100%;
    margin-top:20px;
    justify-content: center;
    align-items:center;
  }
.letter{
   margin-top: 50px;   
}
.ref input{
    border-top-width: 0px;
    border-left-width: 0px;
    border-right-width: 0px;
    border-bottom-width: 0px;     
  }
  .set{
    padding-right: 10px;
  }
  .Date input {
    border-top-width: 0px;
    border-left-width: 0px;
    border-right-width: 0px;
    border-bottom-width: 0px; 
  }
  #cat{
    padding-top: 70px;
  }
  .text-justify {
    padding-right: 5px;
      padding-left:10px;
      text-align: justify;
  }
html{
  margin-top: auto;
  margin-bottom: auto;
  padding-top: auto;
  padding-bottom: auto;
  padding: auto;
  margin: auto;
}
  @media print
  {
  #print-me
  {
    display:none;
  }
}
.main {
  text-align: justify;
}
.container{
  margin: auto;
  padding: auto;
}
</style>
<body>
  <div class="container">
<?php
$date = date('d-m-Y');
?>
<?php
require('double.php');
 $error = $ids ='';
 if(isset($_SESSION['userid']))
 {
$ids = $_SESSION['userid'];
 }
 $intern = $_GET['idm'];
 $app_id = $_GET['internship'];
$showquery = "SELECT * FROM user_master where user_id = '$ids'";
$showdata = mysqli_query($con,$showquery);
$arrdata =mysqli_fetch_object($showdata);
$sqli = "SELECT `refno`, `ref_id` FROM `refrence_master` ORDER BY `ref_id` DESC LIMIT 1";
$ress =mysqli_query($con,$sqli);
$last_id=0;
while($rows= mysqli_fetch_array($ress))
{
  $last_id = explode('/', $rows['refno']);
}
$ref_year = date('y', time());
if(date('m', time())<4)
{
  $ref_year = $ref_year - 1;
}
$old_ref_year  = explode('-',$last_id[2]);
if($old_ref_year[0]!= $ref_year)
{
  $cert_no = 1;
}
else{
  $cert_no = (int)$last_id[3] + 1;
}
$ref_no = "GIIT/INTERN/" . $ref_year .'-' .($ref_year+1) . "/" . $cert_no;

$sql ="INSERT INTO `refrence_master`(`refno`,`user_id`,`intern_id`)VALUES('$ref_no','$ids','$intern')";
// echo $sql; 
mysqli_query($con, $sql) or die(mysqli_error($con));
         $query = "SELECT `internship_transaction_master` .*, `refrence_master` .*,`user_master` .*,
          `company_master`.`company_name`,
          `company_master`.`company_id`,
          `company_person_master`.`company_person_id`,
          `company_person_master`.`company_person_name`,
          `department_master`.`dept_id`, `department_master`.`dept_name`,   
          `city_master`.`city_id`,
          `city_master`.`city_full_name`,    
          `branch_master`.`branch_id`,
          `branch_master`.`branch_full_name`
               
                 -- `duration_master`.`duration_name` 
                     
          FROM
            `internship_transaction_master`,`refrence_master`,`user_master`,
           `company_master`,`company_person_master`,`department_master`,`city_master`,`branch_master`
            WHERE
                -- `internship_master`.`intern_details_id`=`internship_application_master`.`intern_id`
                `internship_transaction_master`.`user_id`=$ids
                AND`user_master`.`user_id`=$ids
                AND `internship_transaction_master`.`app_id` = $app_id 
                AND `user_master`.`user_city` = `city_master`.`city_id`
                AND `user_master`.`user_branch` = `branch_master`.`branch_id`                 
                AND `company_person_master`.`company_person_id` = `internship_transaction_master`.`contact_id` 
                AND `department_master`.`dept_id` = `internship_transaction_master`.`department_id`               
                AND `company_master`.`company_id` = `internship_transaction_master`.`company_id`                                                                    
                ORDER BY
                `internship_transaction_master`.`internshipapp_id` ASC
                 "; 
                $res= mysqli_query($con, $query)or die (mysqli_error($con));
                $row= mysqli_fetch_object($res);
               ?>
          <div class='letter' class='font-weight-bold m-3 pt-5'>
            <!--   <div class='roll'>
              <label for='userroll' class='font-weight-bold m-3 pt-5'>YOUR ROLL: </label>
              <input type='text'  class='font-weight-bold' name='USERROLL'
             value=''  required>
              
              </div>   -->      
                        <div class='Date'>
                        <label for='userid' class='font-weight-bold m-0 pt-0'>Date: </label>
                        <input type='text' readonly class='font-weight-bold' name='DATE'
                       value='<?php echo $date ?>'  required>
                        
                        </div>
                      <div class='ref'>
                        <label for='post' class='font-weight-bold m-0'>Ref:<?php echo $ref_no ?></label>
                        </div>
                        <br>
                        <!--  <div for='get' class='font-weight-bold m-0' id='cate' name='COMPANY PERSON NAME'> -->
                        <h5><?php echo $row->company_person_name ?>,</h5>
                 <!--       </div> -->
                         <div for='get' class='font-weight-bold m-0' id='cate' name='DEPARTMENT NAME'>
                            <h5><?php echo $row->dept_name ?>,</h5>
                            </div>
                       
                           
                          <!--   <div for='get' class='font-weight-bold m-0' id='cate' name='COMPANY NAME'> -->
                            <h5><?php echo $row->company_name ?>,</h5>
                            <!-- </div> -->
                            <!--  <div for='get' class='font-weight-bold m-0' id='cate' name='CITY NAME'> -->
                            <h5><?php echo $row->city_full_name ?></h5>
                      <!--       </div>  -->

               
                  <div for='set' class='font-weight-bold m-0' id='para' name='SUBJECT'>
                   
                      
                  <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sub : Request to provide Internship to our student <b> <?php echo $arrdata->user_name?>,Roll-No:<?php echo $arrdata->user_roll?>,<?php echo $row->branch_full_name?>
                  <?php
                  $print="";
                      if($row->duration == 0)
                        {
                             echo $print;
                           }
                           else
                           {
                            echo ' for &nbsp;';
                            echo $print; 
                            echo $row->duration;
                             echo 'month.';
                          }
                          ?>
                     <br>
                     <br>
                  <div for='enter' class='font-weight-bold m-0' id='sir' name='TEACHER'>
                      <h5> Dear Sir/Madam,</h5>
                  </div>
                            <br>
                    <div class='main text-justify m-0 pt-0' id='lpara' name='descr'>
                        <h5> At the outset, we would like to introduce ourselves as one of the leading college of Jamshedpur <b> GIIT Professional College</b>
                        affiliated to Kolhan University & approved by Dept. of HRD, Govt. of Jharkhand, engaged in
                       imparting graduation level programs in IT, Management & Commerce. 
                        In our efforts to develop
                         skilled Human Resource, we have  introduced part time and full time internship for undergraduate  
                        students. The organization can assign live/ real time project work and official responsibility to
                         trainees as per their streams.
                         <br> 
                         <br> 
                        We request you to provide internship to <?php echo $arrdata->user_name?>, student of <Course Name><?php echo $row->branch_full_name?>, <Sem> Sem-<?php echo $arrdata->semester ?>,  <?php  
                       $print="";
                      if($row->duration == 0)
                        {
                             echo $print;
                           }
                           else
                           {
                            echo ' for &nbsp;';
                            echo $row->duration;
                             echo 'month';
                          }
                            // define($row->duration,"month");                                                  
                         ?>
                             in your organization.</h5>            
                   </div>
                   <br>
                      <div for='get' class='font-weight-bold m-0 pt-0' id='cate' name=''>
                          <h5> Thanking You, </h5>
                          </div>
                          <br>
                      <div for='get' class='font-weight-bold m-0 pt-0' id='cate' name=''>
                      <h5> Sincerely yours </h5>
                      </div>
                      <div for='get' class='font-weight-bold m-0' id='cate' name=''>
                          <h5>For GIIT Professional College </h5>
                          </div>
                     <div for='get' class='font-weight-bold mt-0' id='cat' name=''>
                           <h5>( Dr. Om Prakash )</h5>
                           </div>
                           <div for='get' class='font-weight-bold m-0' id='cate' name=''>
                           <h5> Principal </h5>
                           <div class='btn'>
                                      <button onclick='window.print()' class='btn  btn-primary btn-lg btn-block  mt-3' id='print-me' name='print'>PRINT</button>
                            </div>
</div>
</div>
</div>
  <!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js "
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous ">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js "
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous ">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js "
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM " crossorigin="anonymous ">
</script>
</div>
</body>
</html>