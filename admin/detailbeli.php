<h2>Detail Pembelian</h2>

<!--<?php 
$ambil=$koneksi->query("SELECT * FROM pembelian JOIN konsumen 
		ON pembelian.id_konsumen=konsumen.id_konsumen 
		WHERE pembelian.id_pembelian='$_GET[id]'");
		$detail = $ambil->fetch_assoc(); 
?>
<pre><?php print_r($detail); ?></pre>
<strong><?php echo $detail['nama_konsumen']; ?></strong><br>

<?php 
	$get_id = $koneksi->query("SELECT * FROM checkout WHERE id_checkout IN (select max(id_checkout) FROM  checkout)");
	
	#("SELECT nama, no_telepon, alamat FROM checkout WHERE id_checkout='$_GET[nama]'");
 	$last_id = $get_id->fetch_assoc(); ?>
   
   <label> <?php echo 'Nama Lengkap : '.$last_id['nama'].''; ?></label><br>
   <label><?php echo 'No Telp :  '.$last_id['no_telepon'].'';?></label><br>
   <label><?php echo 'Alamat :  '.$last_id['alamat'].'' ;?></label><br>-->

 <table class="table table-bordered">
 	<thead>
 		<tr>
 			<th>No</th>
 			<!--<th>nama</th>
 			<th>alamat</th>-->
 			<th>Nama Produk</th>
 			<th>Harga</th>
 			<th>Jumlah</th>
 			<th>Subotal</th>
 		</tr>
 	</thead>
 	<tbody>
 			<?php $nomor=1;?>
 			<!--mengambil koneksi dan mengakses kueri-->
 			<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk 
 			WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
 			<?php while($pecah = $ambil->fetch_assoc()){?>
 			
		<tr>
			<td><?php echo $nomor;?></td>
			<!--<th><?php echo$pecah['nama_konsumen'];?></th>
			<th><?php echo $pecah['alamat'];?></th>-->
			<td><?php echo$pecah['nama_produk'];?></td>
			<td><?php echo$pecah['harga_produk'];?></td>
			<td><?php echo$pecah['jumlah_pembelian_produk'];?></td>
			<td>
				<?php echo$pecah['harga_produk']*$pecah['jumlah_pembelian_produk'];?>	
			</td>
		</tr>
		<?php $nomor++;?>
		<?php } ?> 
 	</tbody>
 </table>