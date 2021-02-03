<?php
    error_reporting(0);
    //koneksi ke database
    $koneksi = new mysqli("localhost","root","","kangen_water");
    #$db = mysql_select_db("kangen_water");
    session_start();
    

    if (!isset($_SESSION['owner'])) 
    {
        echo "<script>alert('Anda harus login');</script>";
        echo "<script>location='login.php';</script>";
        header('location:login.php');
        exit();
    }

?>
<style>
body {
    background-color: lightblue;
}
</style>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>-->
                <a class="navbar-brand" href="index.php">Binary Admin<?php echo strtoupper($_SESSION['owner']);?></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 20px;">&nbsp; <button class="btn btn-danger">
                            <a href="index.php?halaman=logout" class="btn btn-danger">Logout</a> 
                        </button>
</div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				    <li class="text-center">
                        <img src="assets/img/find_user.png" class="user-image img-responsive"/>
				    </li>
                   
                        <li><a href="index.php"><i class="fa fa-dashboard fa-3x"></i>Home</a></li>
                        <li><a href="index.php?halaman=produk"><i class="fa fa-table fa-3x"></i>data Produk</a></li>
                        <li><a href="index.php?halaman=pembelian"><i class="fa fa-table fa-3x"></i>data Pembelian</a></li>
                        <li><a href="index.php?halaman=konsumen"><i class="fa fa-sitemap fa-3x"></i>data konsumen</a></li>
                        <li><a href="index.php?halaman=pendapatan"><i class="glyphicon glyphicon-tasks fa-3x"></i> data pendapatan</a></li>
                        <li><a href="index.php?halaman=datacheckout"><i class="glyphicon glyphicon-folder-open fa-3x"></i> data checkout</a></li>
                       
                         
                </ul> 
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner" > 
                <div>
                    <?php
                        if (isset($_GET['halaman']))
                        {
                            if ($_GET['halaman']=="produk")
                            {
                                include 'produk.php';
                            }
                            elseif ($_GET['halaman']=="pembelian") 
                            {
                                include 'pembelian.php';
                            }
                            elseif ($_GET['halaman']=="konsumen") 
                            {
                                include 'konsumen.php';
                            }
                            elseif ($_GET['halaman']=="detail") 
                            {
                                include 'detailbeli.php';
                            }
                            elseif ($_GET['halaman']=="tambahproduk") 
                            {
                                include 'tambahproduk.php';
                            }
                            elseif ($_GET['halaman']=="hapusproduk") 
                            {
                                include 'hapusproduk.php';
                            }
                            elseif ($_GET['halaman']=="ubahproduk")
                            {
                                include 'ubahproduk.php';
                            }
                            elseif ($_GET['halaman']=="logout") 
                            {
                                include 'logout.php';
                            }elseif ($_GET['halaman']=="hapuskonsumen") 
                            {
                                include 'hapuskonsumen.php';    
                            }elseif ($_GET['halaman']=="datacheckout") 
                            {
                                include 'datacheckout.php';    
                            }elseif ($_GET['halaman']=="pendapatan") 
                            {
                                include 'pendapatan.php';    
                            }
                        } 
                        else
                        {
                            include 'home.php';
                        }
                    ?>
                </div>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script> 
</body>
</html>
