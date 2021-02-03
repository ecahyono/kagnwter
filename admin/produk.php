<h3><span class="glyphicon glyphicon-briefcase"></span>Data Produk</h3>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>
<br>
<br>
<input class="form-control" id="myInput" type="text" placeholder="Search..">
<br>
<!--<?php $periksa=mysql_query("select * from produk where stok_produk <=16");while($q=mysql_fetch_array($periksa)){if($q['stok_produk']<=16){?><script>
			$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
		<?php
		//echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama_produk']."</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";	
	}
}
?>-->
<style>
tbody {
    background-color: lightblue;
}
</style>

 <table class="table table-condensed table-bordered table-striped" >

 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Nama Produk</th>
 			<th>Harga</th>
 			<th>Jumlah Produk</th>
 			<th>Foto</th>
 			<th>Aksi</th>
 		</tr>
 	</thead>
 	<tbody id="myTable">
 		<?php $nomor=1;?>
 		<?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
 		<?php while($pecah = $ambil->fetch_assoc()){?>
 		<tr>
 			<td><?php echo $nomor;?></td>
 			<td><?php echo$pecah['nama_produk'];?></td>
 			<td><?php echo$pecah['harga_produk'];?></td>
 			<td><?php echo$pecah['stok_produk'];?></td>
 			<td>
 				<img src="../foto_produk/<?php if (empty($pecah['foto_produk'])){
 					echo('no.jpg');
 				} else {
 					echo$pecah['foto_produk'];
 				}
 				?>" height="100" width="100" >
 			</td>
 			<td> 
 			<center>
 				<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk'];?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Akan Menghapus')">Hapus</a>
 				<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk'];?>" class="btn btn-warning">Ubah</a>
 			</center>
 			</td>
 		</tr>
 		<?php $nomor++;?>
 		<?php }?>
 	</tbody>
 </table>
<script>
	$(document).ready(function(){
	  $("#myInput").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#myTable tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>