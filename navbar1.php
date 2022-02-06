
<style>
    body{
        scroll-behavior: smooth;
    }
    .navbar{
        display:flex;
        align-items: center;
        position: sticky;
        top: 0;
        transition:1s ease;
    }
        .container{
        background-size: cover;
        background-attachment: fixed;
    }
    .white{
        background: white;
    }
</style>
<body>
<script>
$(window).on('scroll',function(){
    if($(window).scrollTop()){
        $('nav').addClass('white');
    }
    else{
        $('nav').removeClass('white');
    }
})

</script>


<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark p-2" id="navbar">
        <a class="navbar-brand mb-0 h1" href="index.php">
            <i class="fa fa-graduation-cap"></i>
            InternZone
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarToggler">

           
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a href="index2.php" class="nav-link">Home</a>
                </li>
            </ul>

            <div class="form-inline my-2 my-lg-0">
                <?php
                if(isset($_SESSION['userid']))
                {
                    ?>          
                                <div class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle text-light' href='#' id='navbarDropdown' role='button'
                                    data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <?php
                }
                ?>
                            <?php
                            if(isset($_SESSION['userid']))
                            {
                             $img = empty($arrdata['user_image']) ? 'default.png' : $arrdata['user_image'];
echo "<img class='img-circle profile_img' height=30 width=30 src='images/".$img."'>";
                            }
                            ?>
                                    <?php
                                    if(isset($_SESSION['username'])){
                                     echo $_SESSION['username']; 
                                    }
                                    ?>
                                </a>
                                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                   
                                <p class='text-center font-weight-bold'>User Profile</p>

                                    <a class='dropdown-item' href='styleregister.php'>
                                         <i class='fa fa-user mr-1' aria-hidden='true'></i> My Profile
                                    </a>
        
           
                                     <a class='dropdown-item mb-2' href='myapplication.php'>
                                        <i class='fa fa-file mr-1' aria-hidden='true'></i> My Applications
                                    </a>                   
                            </div>
                            </div>
                            <?php
                                if (!isset($_SESSION['userid'])) {
                                    echo "<a href='login.php' class='btn btn-danger mx-0'>Login</a>

                                            <a href='register3.php' class='btn btn-danger mx-2'>Register</a>";             
                                } else {
                                    echo "<a href='logout1.php' class='btn btn-danger mx-2'>Logout</a> ";             
                                    
                                }   
                            ?>
                                    </div>     
                                    </div>

        </div>

    </nav>
