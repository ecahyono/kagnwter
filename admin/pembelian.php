<h2>Data Pembelian</h2>

 <table class="table table-bordered">
 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Nama Konsumen</th>
 			<th>Tanggal</th>
  			<th>Total</th>
  			<th>Aksi</th>
 
 		</tr>
 	</thead>
 	<tbody>
 		<?php $nomor=1;?>
 		<?php $ambil=$koneksi->query("SELECT * FROM pembelian  JOIN konsumen ON pembelian.id_konsumen=konsumen.id_konsumen"); ?>
 		<?php while($pecah = $ambil->fetch_assoc()){?>
 		<tr>
 			<td><?php echo$nomor;?></td>
 			<td><?php echo$pecah['nama_konsumen'];?></td>
 			<td><?php echo$pecah['tanggal_pembelian'];?></td>
 			<td><?php echo$pecah['total_pembelian'];?></td>
 			<td> 
 				<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-info">Detail</a>
 			</td>
 		</tr>
 		<?php $nomor++;?>
 		<?php }?>
 	</tbody>
 </table>