<?php
    session_start();
    //koneksi ke database
    $koneksi = new mysqli("localhost","root","","kangen_water");
?>
<!DOCTYPE html>
<html>
<head>
	<title>toko Kangen</title>
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

<!konten>
<section class="konten">
	<div class="container">
		<div class="row">
			<?php $ambil=$koneksi->query("SELECT * FROM produk");?>
			<?php while($perproduk = $ambil->fetch_assoc()){?>  
			<div class="col-sm-6 col-md-4">
				<div class="w3-row-padding w3-padding-16 w3-center" >
					<img src="foto_produk/<?php echo $perproduk['foto_produk'];?>" height="250" width="250">
					<div class="caption">
						<h3><?php echo $perproduk['nama_produk'];?></h3>
						<h5>Rp.<?php echo number_format($perproduk['harga_produk']);?></h5>
						<h5>Stok :<?php echo number_format($perproduk['stok_produk']);?></h5>
						<a href="beli.php?id=<?php echo $perproduk['id_produk'];?>" class="btn btn-primary" name="btn">Beli</a>
								
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>	
</section>
</body>
</html>