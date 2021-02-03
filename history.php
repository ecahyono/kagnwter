<?php
    session_start();
    //koneksi ke database
    $koneksi = new mysqli("localhost","root","","kangen_water");
?>	
<html>
<head>
	<title>toko Kanagen</title>
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
		<h3>History belanja</h3>
		<style>
		option[type=text], select {
		    width: 100%;
		    padding: 12px 20px;
		    margin: 8px 0;
		    display: inline-block;
		    border: 1px solid #ccc;
		    border-radius: 4px;
		    box-sizing: border-box;
		}
		 
		</style>			
			<?php if(isset($_SESSION["konsumen"])): ?>
			<h4>History belanja <?php echo$_SESSION['nama_konsumen'] ?></h4>
			<?php endif ?>
			<select name="jurusan">
		    <option>---- Pilih Tanggal pembelian Anda ----</option>
		    <?php
		    mysql_connect("localhost", "root", "");
		    mysql_select_db("kangen_water");
		    $sql = mysql_query("SELECT * FROM pembelian ORDER BY tanggal_pembelian ASC");
		    if(mysql_num_rows($sql) != 0){
		        while($data = mysql_fetch_assoc($sql)){
		            echo '<option>'.$data['tanggal_pembelian'].'</option>';
		        }
		    }
		    ?>
			</select>
</body>
</html>