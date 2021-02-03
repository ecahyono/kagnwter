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
	</nav>


		<style>
		option[type=text], select {
		    width: 100%;
		    padding: 12px 20px;
		    margin: 8px 0;
		    display: inline-block;
		    border: 1px solid #ccc;
		    border-radius: 4px;
		    box-sizing: border-box;
		}
		 
		</style>

 				<?php $total = 0; ?>
				<?php foreach ($_SESSION['keranjang'] as $id_produk=>$jumlah):?>
				<!--menampilkan produk berdasarkan id produk-->
				<?php
				$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga=$pecah["harga_produk"]*$jumlah;
				$total += $subharga;
				?>
					<label>Nama Produk :<?php echo $pecah["nama_produk"];?></label><br>
					 
					<label>Harga Produk : Rp. <?php echo number_format($pecah["harga_produk"]);?></label><br>
					 
					<label>Jumlah Barang Yang telah di beli : <?php echo $jumlah;?></label> <br>
				 
					<label>Total Harga : Rp. <?php echo number_format($subharga);?></label><br>
					 		 
				<?php endforeach ?>
				<?php
				if($total){
					echo '<p>Total Pembelian :</b></td><td align="right"><b>Rp. '.number_format($total,2,",",".").'</p>';
				}
				?>
					<h4>Pilih Bank Transfer</h4>
			<select name="jurusan">
		    <option>---- Pilih Bank Transfer ----</option>
		    <?php
		    mysql_connect("localhost", "root", "");
		    mysql_select_db("kangen_water");
		    $sql = mysql_query("SELECT * FROM rekening ORDER BY nama_rekening ASC");
		    if(mysql_num_rows($sql) != 0){
		        while($data = mysql_fetch_assoc($sql)){
		            echo '<option>'.$data['nama_rekening'].'</option>';
		        }
		    }
		    ?>
			</select>

			 
			<?php $ambil=$koneksi->query("SELECT * FROM konsumen"); ?>
 			<?php $pecah = $ambil->fetch_assoc()?>
 			<h3><?php echo $pecah['nama_konsumen'];?></h3>
 			<h3>Alamat Anda : <?php echo$pecah['alamat'];?></h3><br>
 			<h3>No. Telepon :<?php echo$pecah['telepon_konsumen'];?></h3>

 			 
 			<br>
 			<br>
 			<tr>
 					<td>
 			 			<a href="cekout.php?total='.$total.'" class="btn btn-primary"> Ingin Masukan Alamat Baru?</a>
 					</td>
 					<td>
 						<a href="" class="btn btn-primary">Lanjutkan Proses Pembayaran</a>
 					</td>
 			</tr>
 			
</button></body>
</html>