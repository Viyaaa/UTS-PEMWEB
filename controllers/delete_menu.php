<?php 
	session_start();
	if($_SESSION['isUserLogin'] == false) {
		header("location: ../index.php");
		exit;
	}
	
	require '../core/functions.php';

	$id = $_GET['id'];

	//var_dump($id); //debug

	if(hapusMenu($id) > 0) {
		$_SESSION['delete'] = true;
		echo
			"<script>
				window.location.href = '../views/admin.php';
			</script>";
	} else {
		$_SESSION['delete'] = false;
		echo 
			"<script>
				window.location.href = '../views/admin_addMenu.php';
			</script>";
	} 

 ?>