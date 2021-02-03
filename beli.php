<?php
session_start();
//mendapatkan id_produk dari url
$id_produk = $_GET['id'];



//jika produk sudh ada di krnjng maka +1
if(isset($_SESSION['keranjang'][$id_produk])) 
	{
		$_SESSION['keranjang'][$id_produk]+=1;	
	}
	//selain itu produk dibeli 1
	else
	{
		$_SESSION['keranjang'][$id_produk]=1;	
	}

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
?>