<?php 
	session_start();

	//menghancurkan session['konsumen']
	session_destroy();

	echo "<script>alert('anda telah logout');</script>";
	echo "<script>location='index.html';</script>";
 ?>