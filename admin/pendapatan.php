<h2>Pendapatan</h2>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--pencarian data-->
<input class="form-control" id="myInput" type="text" placeholder="Search..">
<br>
<br>
 	<h4>Deskripsi Produk</h4>
 	<!--TABEL DATA PRODUK-->
  <table class="table table-condensed table-bordered table-striped" >

 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Nama Produk</th>
 			<th>Jumlah Produk</th>
 			<th>Foto</th>
 
 		</tr>
 	</thead>
 	<tbody id="myTable">
 		<?php $nomor=1;?>
 		<?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
 		<?php while($pecah = $ambil->fetch_assoc()){?>
 		<tr>
 			<td><?php echo $nomor;?></td>
 			<td><?php echo$pecah['nama_produk'];?></td>
 			<td><?php echo$pecah['stok_produk'];?></td>
 			<td>
 				<img src="../foto_produk/<?php if (empty($pecah['foto_produk'])){
 					echo('no.jpg');
 				} else {
 					echo$pecah['foto_produk'];
 				}
 				?>" height="100" width="100" >
 			</td>
 		</tr>
 		<?php $nomor++;?>
 		<?php }?>
 	</tbody>
 </table>
 <br>
 <!--TABEL PEMBELIAN-->
<h4>--------------------------------------------------------------------------------------------------------------------------------------------</h4>
  <table class="table table-condensed table-bordered table-striped" >
 	<thead>
 		<tr>
 			<th>No Pembelian</th>
 			<th>No konsumen</th>
 			<th>TOTAL</th>
 			
 		</tr>
 	</thead>
 	
			<?php
			$db_host = 'localhost';
			$db_port = '3306';
			$db_name = 'kangen_water';
			$db_user = 'root';
			$db_pass = '';
			try {
				$pdo = new PDO( 'mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name , $db_user, $db_pass, array(PDO::MYSQL_ATTR_LOCAL_INFILE => 1) );
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				$errMessage = 'Gagal terhubung dengan MySQL' . ' # MYSQL ERROR:' . $e->getMessage();
				die($errMessage);
			}

			$sql = 'SELECT id_pembelian, id_konsumen, SUM(total_pembelian) AS jml_byr 
					FROM `pembelian`
					GROUP BY  id_pembelian, id_konsumen';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();

			function format_ribuan ($nilai){
				return number_format ($nilai, 0, ',', '.');
			}

			// Ubah hasil query menjadi associative array dan simpan kedalam variabel result
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


			$subtotal_plg = $subtotal_thn = $total = 0;
			foreach ($result as $key => $row)
			{
				$subtotal_plg += $row['jml_byr'];
				$subtotal_thn += $row['jml_byr'];
				echo '
	<tr>
		<td>'.$row['id_pembelian'].'</td>
			
		<td>'.$row['id_konsumen'].'</td>
		<td>'.format_ribuan($row['jml_byr']).'</td>
	</tr>';
	
	// SUB TOTAL per id_pelanggan

	$total += $row['jml_byr'];
}

echo '<tr class="total">
		<td></td>
		<td>GRAND TOTAL</td>
		<td> ' . format_ribuan($total) . '</td>
		
	</tr>
	</tbody>
</table>
</body>
</html>';
?>


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