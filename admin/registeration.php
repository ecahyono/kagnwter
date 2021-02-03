<?php
 
//skripkoneksi
$koneksi= new mysqli("localhost","root","","kangen_water");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>register owner</title>\
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row text-center  ">
        <div class="col-md-12">
                <br /><br />
                <h2>Register owner</h2>       
  <br />
        </div>
    </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>   Register Yourself </strong>  
                    </div>
                    <div class="panel-body">
                        <form action="" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="Username" id="email" required> 
                                </div> 
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" id="pass" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label>Ulangi Password</label>
                                    <input type="password" class="form-control" name="password" id="pass2"><br><br>
 
                            <button class="btn btn-primary" type="submit"   name="save">Simpan</button>
                            <button type="reset" class="btn btn-danger">Reset</button> 
                            <hr />
                            Already Registered ?  <a href="login.php" >Login here</a>
                        </form>
                        <script type="text/javascript">
                            window.onload = function () {
                                document.getElementById("pass").onchange = validatePassword;
                                document.getElementById("pass2").onchange = validatePassword;
                            }
                            function validatePassword(){
                                var pass2=document.getElementById("pass").value;
                                var pass1=document.getElementById("pass2").value;
                                if(pass1!=pass2)
                                    document.getElementById("pass2").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
                                else
                                    document.getElementById("pass2").setCustomValidity('');
                            }
                        </script>
                    </div>
                </div>           
            </div>
        </div>
</div>

    <?php
        if (isset($_POST['save']))
        {
            $koneksi->query("INSERT INTO login_owner VALUES ('','$_POST[Username]','$_POST[password]','$_POST[nama_lengkap]')");

            echo "<script>alert('data telah disimpan silahkan login');</script>";
            echo "<script>location='login.php';</script>";
        }
    ?>
</body>
</html>
