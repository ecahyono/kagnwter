<?php
 
//skripkoneksi
$koneksi= new mysqli("localhost","root","","kangen_water");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>register konsumen</title>\
    <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row text-center  ">
        <div class="col-md-12">
                <br /><br />
                <h2>Register konsumen</h2>       
  <br />
        </div>
    </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>  Daftarkan diri Anda </strong>  
                    </div>
                    <div class="panel-body">
                        <form action="" method="post">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email_konsumen" id="email" required> 
                                </div> 
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password_konsumen" id="pass">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama_konsumen" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="alamat" required>
                                </div>
                                <div class="form-group">
                                    <label>Nomer telepon</label>
                                    <input type="number" class="form-control" name="telepon_konsumen" required>
                                </div>
                                <div class="form-group">
                                    <label> Ulangi Password</label>
                                    <input type="password" class="form-control" name="ulangipassword" id="pass2">
                                </div>
                            <button class="btn btn-primary" type="submit"   name="save">Simpan</button>
                            <button type="reset" class="btn btn-danger">Reset</button> 
                            <hr />
                            Sudah Punya Akun?  <a href="login.php" >Login Disini</a>
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
            $koneksi->query("INSERT INTO konsumen VALUES ('','$_POST[email_konsumen]','$_POST[password_konsumen]','$_POST[nama_konsumen]','$_POST[alamat]','$_POST[telepon_konsumen]')");

            echo "<script>alert('data telah disimpan silahkan login');</script>";
            echo "<script>location='login.php';</script>";
        }
    ?>
</body>
</html>
