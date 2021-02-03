<?php

 session_start();
 $koneksi = new mysqli("localhost","root","","kangen_water");
?>
<?php
session_destroy();
?>
 
<!DOCTYPE html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  body{background:#efefef;font-family:arial;}
  #wrapshopcart{width:70%;margin:3em auto;padding:30px;background:#fff;box-shadow:0 0 15px #ddd;}
  h1{margin:0;padding:0;font-size:2.5em;font-weight:bold;}
  p{font-size:1em;margin:0;}
  table{margin:2em 0 0 0; border:1px solid #eee;width:100%; border-collapse: separate;border-spacing:0;}
  table th{background:#fafafa; border:none; padding:20px ; font-weight:normal;text-align:left;}
  table td{background:#fff; border:none; padding:12px  20px; font-weight:normal;text-align:left; border-top:1px solid #eee;}
  table tr.total td{font-size:1.5em;}
  .btnsubmit{display:inline-block;padding:10px;border:1px solid #ddd;background:#eee;color:#000;text-decoration:none;margin:2em 0;}
  form{margin:2em 0 0 0;}
  label{display:inline-block;width:auto;}
  input[type=text]{border:1px solid #bbb;padding:10px;width:30em;}
  textarea{border:1px solid #bbb;padding:10px;width:30em;height:5em;vertical-align:text-top;margin:0.3em 0 0 0;}
  .submitbtn{font-size:1.5em;display:inline-block;padding:10px;border:1px solid #ddd;background:#eee;color:#000;text-decoration:none;margin:0.5em 0 0 8em;};
   
  </style>
 </head>
  
 <body>
 	<div id="wrapshopcart">
  <strong><h4>Terimakasih Telah Berbelanja di pZonna Water</h4></strong>
  <h3>Produk</h3>
  <?php foreach ($_SESSION['keranjang'] as $id_produk=>$jumlah):?>
  <?php	
  $ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
  $pecah = $ambil->fetch_array();
	?>
  <h5><?php echo $pecah['nama_produk']?> </h5>
  <?php endforeach ?>
  <h3>Akan dikirim ke: </h3>

 
  <?php
  $get_id = $koneksi->query("SELECT * FROM checkout WHERE id_checkout IN (select max(id_checkout) FROM  checkout)");
 	$last_id = $get_id->fetch_assoc(); 
 	?>
   <label> <?php echo 'Nama Lengkap : '.$last_id['nama'].''; ?></label>
 	<br>
   <label><?php echo 'No Telp :  '.$last_id['no_telepon'].'';?></label>
 	<br>
   <label><?php echo 'Alamat :  '.$last_id['alamat'].'' ;?></label>
 	<br>
    
   <h3>Total Belanja Anda : </h3>
				<?php $total = 0; ?>
				<?php foreach ($_SESSION['keranjang'] as $id_produk=>$jumlah):?>
				<!--..menampilkan produk berdasarkan id produk>-->
				<?php
				$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga=$pecah["harga_produk"]*$jumlah;
				$total += $subharga;
				?>
				<?php endforeach ?>
				<?php
				if($total){
					echo '<tr style="background-color: #DDD;">
						<td colspan="4" align="right">
							<b>Total :</b></td><td align="right"><b>Rp. '.number_format($total,2,",",".").'</b>
						</td>
						  </tr>';
				}
				?>
				<br>
				<br>
				<p>"Barang Anda Sedang Dalam Proses Pengiriman"</p>
        
   
 </body>
</html>