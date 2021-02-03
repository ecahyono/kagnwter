<h2>Data konsumen</h2>

 <table class="table table-bordered">
 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Nama</th>
 			<th>Tanggal Lahir</th>
 			<th>Email</th>
 			<th>Telepon</th>
 			<th>alamat konsumen</th>
 			<th>Aksi</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php $nomor=1;?>
 		<?php $ambil=$koneksi->query("SELECT * FROM konsumen"); ?>
 		<?php while($pecah = $ambil->fetch_assoc()){?>
 		<tr>
 			<td><?php echo$nomor;?></td>
 			<td><?php echo$pecah['nama_konsumen'];?></td>
 			<td><?php echo$pecah['tanggal_lahir'];?></td>
 			<td><?php echo$pecah['email_konsumen'];?></td>
 			<td><?php echo$pecah['telepon_konsumen'];?></td>
 			<td><?php echo$pecah['alamat'];?></td>
 			<td> 
 				<a href="index.php?halaman=hapuskonsumen&id=<?php echo $pecah['id_konsumen'];?>" class="btn-danger btn" onclick="return confirm('Anda Yakin Akan Menghapus')">Hapus</a>
 			</td>
 		</tr>
 		<?php $nomor++;?>
 		<?php }?>
 	</tbody>
 </table>