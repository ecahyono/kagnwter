<?php
session_start();
$koneksi = new mysqli("localhost","root","","kangen_water");

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) 
{
	echo "<script>alert('keranjang kosong, silahkan belanja dulu');</script>";
	echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php
		$ambil=$koneksi->query("SELECT * FROM konsumen");
		$pecah = $ambil->fetch_assoc();
	?>
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
	</nav>>


<section class="konten">
	<div class="container">
			
		<h1>Keranjang Belanja</h1>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah Beli</th>
					<th>TotalHarga</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>

				<?php $nomor=1; ?>
		 		<?php $total = 0; ?>
				<?php foreach ($_SESSION['keranjang'] as $id_produk=>$jumlah):?>
				<!--menampilkan produk berdasarkan id produk-->
				<?php
				$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga=$pecah["harga_produk"]*$jumlah;
				$total += $subharga;
				?>
				<tr>
					<td><?php echo $nomor;?></td>
					<td><?php echo $pecah["nama_produk"];?></td>
					<td>Rp. <?php echo number_format($pecah["harga_produk"]);?></td>
					<td><?php echo $jumlah;?></td>
					<td>Rp. <?php echo number_format($subharga);?></td>
					<td>
					  	<a href="cart.php?act=plus&amp;id_produk=<?php echo $id_produk; ?>&amp;ref=keranjang.php" class="btn btn-xs btn-success">
					  Tambah</a> 
                		<a href="cart.php?act=min&amp;id_produk=<?php echo $id_produk; ?>&amp;ref=keranjang.php" class="btn btn-xs btn-warning">
                		Kurang</a>
                		<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-xs btn-danger" >Hapus</a> 
					</td>
					 
				</tr>
				<?php $nomor++;?>
				<?php endforeach ?>
				<?php
				if($total == 0){
					echo '<tr style="background-color: #DDD;"><td colspan="4" align="center">Ups, Keranjang kosong!</td></tr></table>';
					echo '<p><div align="right">
							<a href="index.php" class="btn btn-info btn-lg">&laquo; Continue Shopping</a>
						</div></p>';
				} else {
					echo '<tr style="background-color: #DDD;">
							<td colspan="4" align="right">
								<b>Subtotal :</b>
							</td>
							<td align="right">
								<b>Rp. '.number_format($total,2,",",".").'</b>
							</td>
							</td></td><td></td></tr>
							</table>
						<p>
						<div align="right">
							<a href="index.php" class="btn btn-info">&laquo; CONTINUE SHOPPING</a>
							<a href="lanjutkan.php" class="btn btn-success">
								<i class="glyphicon glyphicon-shopping-cart icon-white"></i> CHECK OUT &raquo;
							</a>
						</div>
						</p>
					';
				}
				?>
			</tbody>
		</table>
			 
	</div>
</section>
</body>
</html>