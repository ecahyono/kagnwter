<h2>Data Checkout</h2>
<!--membuat tabel-->
 <table class="table table-bordered"> 
 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Nama</th>
 			<th>tanggal</th>
 			<th>alamat</th>
 			<th>Telepon</th>
 			<th>bukti pembayaran</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php $nomor=1;?>
 		<!--mengkoneksi dan mengakses kuery-->
 		<?php $ambil=$koneksi->query("SELECT * FROM checkout"); ?>
 		<?php while($pecah = $ambil->fetch_assoc()){?>
 		<tr>
 			<!--menampilkan data perbaris-->
 			<td><?php echo$nomor;?></td>
 			<td><?php echo$pecah['nama'];?></td>
 			<td><?php echo$pecah['tanggal'];?></td>
 			<td><?php echo$pecah['alamat'];?></td>
 			<td><?php echo$pecah['no_telepon'];?></td>
 			<td><img src="http://localhost/tokokangen/bukti_pembayaran/<?php echo $pecah['bukti_pembayaran'];?>" height="100" width="100" >
 			</td>
 			 
 			
 		</tr>
 		<?php $nomor++;?>
 		<?php }?>
 	</tbody>
 </table>