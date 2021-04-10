<?php  
	require '../core/functions.php';
		session_start();
	//cek apakah ada user yang login
	if(($_SESSION['isUserLogin'] == false)) {
		header("Location: ../index.php");
		exit;
	} 
	$id = $_GET["id"];
	$data = query("SELECT * FROM menu WHERE id = $id")[0];
    
    if(isset($_SESSION["cart"][$id])){
        $qty = ($_SESSION["cart"][$id]["qty"]) + 1;
    } else{
        $qty = 1;
    }
    
     if(isset($_GET["action"])) {
	        if($_GET["action"] == "min") {
                if($_SESSION["cart"][$id]["qty"] == 0 || $_SESSION ["cart"][$id] < 0) {
            	   $qty = 0;
                }
	        }
     }

    
    $_SESSION["cart"][$id] = 
	[
		"id"		=> $id,
		"nama_menu",
		"harga_menu",
		"qty" => $qty,
	];

	if(!in_array($id, $_SESSION["cart"][$id])) {
		$qty = 1;
	} 
	else {
	    if(isset($_GET["action"])) {
	        if($_GET["action"] == "min") {
	            if($_SESSION["cart"][$id]["qty"] <= 0) {
	                $qty = 1;
	            }
	            else{
	                $qty = ($_SESSION["cart"][$id]["qty"])-2;
	            }
	        }
	        
	        if($_SESSION["cart"][$id]["qty"] == 0 || $_SESSION ["cart"][$id] < 0) {
	            $qty = 0;
	        }
	       // else {
	       //     $qty = ($_SESSION["cart"][$id]["qty"]);
	       // }
	    }
	}

	

	$_SESSION["cart"][$id] = 
	[
		"id"		=> $id,
		"nama_menu" => $data['nama_menu'],
		"harga_menu" => $data['harga_menu'],
		"qty" => $qty,
	];

    if(isset($_GET["action"])) {
    	if($_GET['action']== "add" || $_GET['action'] == "min") {
    		header("location: ../views/list_cart.php");
    	} 
    } else {
		$_SESSION['alertCart'] = true;
		header("location: ../index.php#one");
	}
?>