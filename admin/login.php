<?php
session_start();
//skripkoneksi
$koneksi= new mysqli("localhost","root","","kangen_water");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> Login</h2>
                 <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong> Login </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" name="user" />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control"  name="password" />
                                        </div>
                                  
                                    <button class="btn btn-primary" name="login">Login</button>
                                    <hr />
                                    Not register ? <a href="registeration.php" >click here </a> 
                                    </form>
                                    <?php
                                    if(isset($_POST['login']))
                                    {
                                        $ambil = $koneksi->query("SELECT * FROM login_owner WHERE username='$_POST[user]' AND password ='$_POST[password]'");
                                        $yangcocok = $ambil->num_rows;
                                        if ($yangcocok==1) 
                                        {
                                          $_SESSION['owner']=$ambil->fetch_assoc();
                                          echo "<script>alert('Login Berhasil');</script>";
                                          echo "<script>location='index.php';</script>";
                                          #echo "<div class='alert alert-info'>login sukses</div>";
                                          #echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                                          
                                        }else 
                                        {
                                          echo "<script>alert('Login gagal silahkan masukan data dengan benar atau daftar');</script>";
                                          echo "<script>location='login.php';</script>";
                                          #echo "<div class='alert alert-dangen'>login gagal</div>";
                                          #echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                         
                                         
                                        }
                                    }
                                    ?>
                            </div>
                           
                        </div>
                    </div>  
                  
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
