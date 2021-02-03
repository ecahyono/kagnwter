<?php
    session_start();
    //koneksi ke database
    $koneksi = new mysqli("localhost","root","","kangen_water");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Konsumen</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
			<!--navbar-->
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="index.html">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<!--jika sudah login maka yg muncul di navbar adalah link logout-->
					<?php if(isset($_SESSION["konsumen"])): ?>
						<li><a href="logout.php" onclick="return confirm('Anda Yakin Akan Logout')">logout "<?php echo strtoupper($_SESSION['nama_konsumen']); ?>"</a></li>
					<?php else: ?>						
						<li><a href="login.php">login</a></li>
					<?php endif ?>
				<li><a href="cekout.php">cekout</a></li>
				 
					<?php if(isset($_SESSION["konsumen"])): ?>
						<li><a href="history.php">History Belanja anda</a></li>
					<?php endif ?>
				</ul>
		</div>
	</nav>
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
	                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	                       	<input type="text" class="form-control" name="email" placeholder="email" />
	                    </div>
	                    <div class="form-group input-group">
	                        <span class="input-group-addon"><i class="glyphicon glyphicon-wrench"  ></i></span>
	                        <input type="password" class="form-control"  name="password" placeholder="password" />
	                    </div>              
	                    <button class="btn btn-primary" name="login">Login</button>
	                    <hr />
	                    Belum Punya akun? <a href="registeration.php" >Daftar Disini </a> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php  
	//jika tombil login di tekan
if (isset($_POST["login"])) 
{
	$email =$_POST["email"];
	$password=$_POST["password"];
	//lakukan query cek akun di table pelanggan db kangen water
	$ambil = $koneksi->query("SELECT * FROM konsumen WHERE email_konsumen='$email' AND password_konsumen='$password'");	
	//hitung akun yg diambil
	$akunyangcocok = $ambil->num_rows;
	//jika 1 akun cocok maka dia akan login
		if ($akunyangcocok==1) 
			{
				//anda berhasil login
				//mendapatkan akun dalam bentuk array
				$akun = $ambil->fetch_assoc();
				//simpan di session konsumen
				$_SESSION["konsumen"] = $akun;
				$_SESSION[nama_konsumen]	= $akun[nama_konsumen];
				$_SESSION[id_konsumen]	= $akun[id_konsumen];
				echo "<script>alert('Anda sukses login, selamat datang ".$_SESSION['id']."');</script>";
				echo "<script>location='cekout.php';</script>";	
			}else {
				//anda gagal login
				echo "<script>alert('anda gagal login silahkan cek akun anda atau daftarkan akun anda');</script>";
				echo "<script>location='login.php';</script>";	
			}

}
?>           
</body>
</html>
