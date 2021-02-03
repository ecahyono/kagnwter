<h2>Ubah Produk</h2>
<?php  
	$ambil= $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$pecah= $ambil->fetch_assoc(); 
?>

<form   method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk'];?>">
	</div> 
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk'];?>">
	</div>
	<div class="form-group">
		<label>Jumlah Produk</label>
		<input type="number" class="form-control" name="jumlah" value="<?php echo $pecah['stok_produk'];?>">
	</div>
	<div class="form-group">
		<img src="../foto_produk/<?php echo $pecah['foto_produk'];?>" height="300" width="500">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control" value="<?php echo $pecah['foto_produk'];?>">
	</div> 
	<div>
		<label>Deskripsi Produk</label>
		<textarea name="deskripsi" class="form-control" rows="10"><?php echo $pecah['deskripsi_produk'];?></textarea>
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
	<a href="index.php?halaman=produk" class="btn btn-danger">Batal</a>
</form>

<?php
//JIKA diklik tombol ubah
	if (isset($_POST['ubah'])) 
	{
		$namafoto=$_FILES['foto']['name'];
		$lokasifoto=$_FILES['foto']['tmp_name'];
		//jika foto di ubah
		if (empty($lokasifoto)){
			$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',
			stok_produk='$_POST[jumlah]',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
		}else
		{
			move_uploaded_file($lokasifoto,"../foto_produk/".$namafoto);
			$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',stok_produk='$_POST[jumlah]',
							foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
			
		}
		echo "<script>alert('Data Produk telah diubah');</script>";
		echo "<script>location='index.php?halaman=produk';</script>";
	}
?>