<?php

	$ambil = $koneksi->query("SELECT * FROM konsumen WHERE id_komsumen = '$_GET[id]'");
 
	$koneksi->query("DELETE FROM konsumen WHERE id_konsumen= '$_GET[id]'");

	echo "<script>alert(' terhapus');</script>";
	echo "<script>location='index.php?halaman=konsumen';</script>";
?>