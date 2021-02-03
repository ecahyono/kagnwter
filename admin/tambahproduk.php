 	
<h2>Tambah Produk</h2>
		
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" class="form-control" name="nama_produk" id="nama_produk"> 
	</div> 
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Jumlah Produk</label>
		<input type="number" class="form-control" name="jumlah">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<div class="form-group">
		<label> Pilih Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<button class="btn btn-primary" type="save" value="save" name="save">Simpan</button>
</form>
 <?php
 if(isset($_POST['save']))
 {
 	$nama=$_FILES['foto']['name'];
 	$lokasi=$_FILES['foto']['tmp_name'];
 	move_uploaded_file($lokasi,"../foto_produk/".$nama);
 	$koneksi->query("INSERT INTO produk VALUES('','$_POST[nama_produk]','$_POST[harga]','$_POST[jumlah]','$_POST[deskripsi]','$nama')");

 	echo "<script>alert('produk telah di tambah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
 
}
?>