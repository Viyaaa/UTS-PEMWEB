<?php  
	session_start();
	if(isset($_SESSION['isAdminLogin']) == false) {
		header("Location: login.php");
	}
	
	require '../core/functions.php';

	if(isset($_POST['submit'])) {
		//var_dump($_POST['jenis_menu']); 
		// var_dump($_FILES);
		// die; //debug

		if(tambahMenu($_POST) > 0) {
			$_SESSION['addMenu'] = true;
			echo "<script>
				window.location.href = 'admin.php';
				</script>";
		} else{
			$_SESSION['addMenu'] = false;
			echo "<script>
			window.location.href = 'admin.php';
			</script>";
		}
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>SALUD.</title>
		<?php 
			require_once 'assets.php';
			require_once 'styling.php';
		?>
		<link href="assets/css/style.css" rel="stylesheet"/>
		<script src="assets/js/script.js"></script>
	</head>
	
	<body class="adminPage">
		<!-- Navbar -->
		<div class="header" id="header">
			<nav class="navbar">
				<ul class="nav navbar-nav" style="list-style-type:none;">
					<li><a class="salud" href="#">SALUD<span class="dot">.</span></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a class="login" href="../controllers/logout.php">LOGOUT</a></li>
				</ul>
			</nav>
		</div>
		
		<div class="container-fluid formSpace" style="width: 95%;">
			<form method="post" enctype="multipart/form-data">
				<a href="admin.php"><span class="fas fa-arrow-left"></span> BACK</a><br><br>
				
				<div class="form-group">
					<label for = "nama_menu">Menu's Name</label>
					<input type="text" name="nama_menu" id="nama_menu" required>
				</div>
				<div class="form-group">
					<label for = "harga_menu">Price</label>
					<input type="text" name="harga_menu" id="harga_menu" required>
				</div>
				<div class="form-group">
					<label for = "deskripsi_menu">Description</label>
					<input type="text" name="deskripsi_menu" id="deskripsi_menu" required>
				</div>
				<div>
					<label for="jenis_menu">Category</label>
					<input type="radio" name="jenis_menu" id="healthy_salad" value="healthy_salad" required>			
					<label for = "healthy_salad">Healthy Salad</label>

					<input type="radio" name="jenis_menu" id="fruit_salad" value="fruit_salad">			
					<label for = "fruit_salad">Fruit Salad</label>

					<input type="radio" name="jenis_menu" id="pasta_salad" value="pasta_salad">			
					<label for = "pasta_salad">Pasta Salad</label>
				</div>
				<div class="form-group">
					<label>Image</label>
					<input type="file" name="gambar_menu" id="gambar_menu" required>
				</div>
				
				<div class="form-group" style="margin-top: 30px;">
					<button type="submit" class="btn btn-primary btn-sm" name="submit">Input</button>
				</div>
			</form>
		</div>
	</body>
</html>