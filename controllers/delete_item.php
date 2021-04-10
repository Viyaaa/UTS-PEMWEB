<?php
	session_start();
	if($_SESSION['isUserLogin'] == false) {
		header("location: ../index.php");
	}

	$key = $_GET['id'];
 
 	//cek apakah ada barang dalam keranjang
	//var_dump(!empty($_SESSION['cart'])); 

	if($key == "clearAll") {
		unset($_SESSION['cart']);
		header("location: ../views/list_cart.php");
	}

	if(!empty($_SESSION['cart'])){
		foreach ($_SESSION['cart'] as $cart => $value) {
			if($value['id'] == $key){
				unset($_SESSION['cart'][$key]);
				header("location: ../views/list_cart.php");
			}
			if(empty($_SESSION['cart'])){
				unset($_SESSION['cart']);
				header("location: ../views/list_cart.php");
			}
		}
	}

?>