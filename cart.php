<?php
	$koneksi = new mysqli("localhost","root","","kangen_water");
    if (!isset($_SESSION)) {
        session_start();
    }
     
    if (isset($_GET['act']) && isset($_GET['ref'])) {
        $act = $_GET['act'];
        $ref = $_GET['ref'];
             
        if ($act == "plus") {
            if (isset($_GET['id_produk'])) {
                $barang_id = $_GET['id_produk'];
                if (isset($_SESSION['keranjang'][$barang_id])) {
                    $_SESSION['keranjang'][$barang_id] += 1;
                }
            }
        #} elseif ($act == "plus") {
            #if (isset($_GET['id_produk'])) {
             #   $barang_id = $_GET['id_produk'];
              #  if (isset($_SESSION['keranjang'][$barang_id])) {
               #     $_SESSION['keranjang'][$barang_id] += 1;
                #}
           # }
        } elseif ($act == "min") {
            if (isset($_GET['id_produk'])) {
                $barang_id = $_GET['id_produk'];
                if (isset($_SESSION['keranjang'][$barang_id])) {
                    $_SESSION['keranjang'][$barang_id] -= 1;
                }
            }
        }# elseif ($act == "del") {
          #  if (isset($_GET['id_produk'])) {
           #     $barang_id = $_GET['id_produk'];
            #    if (isset($_SESSION['keranjang'][$barang_id])) {
             #       unset($_SESSION['keranjang'][$barang_id]);
              #  }
            #}
        #} #elseif ($act == "clear") {
           # if (isset($_SESSION['items'])) {
            #    foreach ($_SESSION['items'] as $key => $val) {
             #       unset($_SESSION['items'][$key]);
              #  }
               # unset($_SESSION['items']);
           # }
       # } 
         
        header ("location:" . $ref);
    }
?>