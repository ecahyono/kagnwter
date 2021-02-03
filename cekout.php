<?php
    session_start();
    //koneksi ke database
    $koneksi = new mysqli("localhost","root","","kangen_water");
    //jka tidak ada session pelanggan atau belum login maka di larikan ke login.php
    if (!isset($_SESSION["konsumen"])) 
    {
    	echo "<script>alert('silahkan login terlebih dahulu');</script>";
		echo "<script>location='login.php';</script>";
    }
?>
 
<!DOCTYPE html>
<html>
<head>
	<title>cekout</title>
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
				<?php $total = 0; ?>
				<?php if(@$_SESSION['keranjang']):
				foreach ($_SESSION['keranjang'] as $id_produk=>$jumlah):?>
				<!--..menampilkan produk berdasarkan id produk>-->
				<?php
				$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga=$pecah["harga_produk"]*$jumlah;
				$total += $subharga;
				?>
				<?php endforeach;
				endif; ?>				
 <!--form inputan untuk konsumen -->

 	<div class="container"> 
    <div class="col-lg-7">  
      <div class="page-header">
      <h2>
      	<?php
				if($total){
					echo '<tr style="background-color: #DDD;">
						<td colspan="4" align="right">
							<b>Total Belanja Anda :</b></td><td align="right"><b>Rp. '.number_format($total,2,",",".").'</b>
						</td>
						  </tr>';
				}
				?>
			<?php
				
			?>


		</h2> 
        <h2> 
        	
        </h2>
        <br> 
       	<p></p>
       	<?php  
			$ambil= $koneksi->query("SELECT * FROM konsumen");
			$pecah= $ambil->fetch_array(); 
		?>
	        <form action="" method="post" enctype="multipart/form-data"> 
	          <div class="form-group"> 
	            <label id="label">Nama Lengkap</label><br> 
	            <input type="text" class="form-control" name="nama" required data-fv-notempty-message="Tidak boleh kosong" value="<?php echo$pecah['nama_konsumen']; ?>">
	          </div> 
	          <div class="form-group"> 
	            <label id="label">Alamat</label><br> 
	            <textarea class="form-control" name="alamat" rows="10" required data-fv-notempty-message="Tidak boleh kosong"><?php echo$pecah['alamat'];?></textarea>
	          </div> 
	            <div class="form-group"> 
	            <label id="label">Nomer Telepon</label><br> 
	            <input type="text" name="no_telepon" placeholder="No Telepon" class="form-control" required data-fv-notempty-message="Tidak boleh kosong" value="<?php echo$pecah['telepon_konsumen'];?>"> 
	          </div> 
	           
	          <div class="form-group"> 
	            <label id="label">Tanggal Lahir</label> 
	            <input class="form-control tanggal" id="date" name="tanggal" placeholder="YYYY/MM/DD" type="date" value="<?php echo$pecah['tanggal_lahir']; ?>" /> 
	          </div> 
	         
	          <div class="form-group"> 
	            <label id="label">Bukti Pembayaran</label> 
	            <input type="file" class="form-control"  name="foto"  required data-fv-notempty-message="Tidak boleh kosong"> 
	          </div> 

	          <div class="form-group"> 
	            <input type="submit" class="btn btn-primary" name="save" value="Save"> 
	            <button type="reset" class="btn btn-danger">Reset</button> 
	          </div> 
	        </form> 
      </div> 
    </div> 
  </div> 
		 
<?php
 if(isset($_POST['save']))
 {
 	$nama=$_FILES['foto']['name'];
 	$lokasi=$_FILES['foto']['tmp_name'];
 	move_uploaded_file($lokasi,"bukti_pembayaran/".$nama);
 	$koneksi->query("INSERT INTO checkout VALUES('','$_POST[nama]','$_POST[alamat]','$_POST[no_telepon]','$nama','$_POST[tanggal]')");
 	$user_id = $_SESSION[id_konsumen];
 	$tgl = date('Y-m-d');
 	$koneksi->query("INSERT INTO pembelian VALUES('','$user_id','$tgl','$total')");
 	$get_id = $koneksi->query("SELECT max(id_checkout) as max FROM checkout")->fetch_assoc();
 	$last_id = $get_id[max];
 	$get_id2 = $koneksi->query("SELECT max(id_pembelian) as pem FROM pembelian")->fetch_assoc();
 	$last_id2 = $get_id2[pem];


 	$_SESSION["konsumen"] = $akun;
 	foreach ($_SESSION['keranjang'] as $id_produk=>$jumlah):
	 	$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
		$pecah = $ambil->fetch_assoc();
		$subharga=$pecah["harga_produk"]*$jumlah;
		$total += $subharga;
		$product_id = $pecah["id_produk"];
 		$koneksi->query("INSERT INTO pembelian_produk VALUES('','$last_id','$last_id2','$product_id','$jumlah')");
 	endforeach;

 	echo "<script>alert('data telah di simpan ');</script>";
	echo "<script>location='invoice.php';</script>";
 
}
?>
 
</body>
</html>
