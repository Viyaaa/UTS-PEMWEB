<?php  
	session_start();
	if(isset($_SESSION['isAdminLogin']) == false) {
		header("Location: login.php");
	}
	require '../core/functions.php';

	$id = $_GET["id"];
	$menu = query("SELECT * FROM menu WHERE id = $id")[0];

	if(isset($_POST["submit"])) {
		if(ubahMenu($_POST) > 0 || $_POST = 0) {
			$_SESSION['edit'] = true;
			echo "
				<script>
					window.location.href = 'admin.php';
				</script>";
		} else{
			$_SESSION['edit'] = true;
			echo "
				<script>
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
		<style type="text/css">
			img {
				width: 100px;
				height: 100px;
			}
		</style>
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
				
				<!-- supaya bisa update menu dengan id yang benar -->
				<input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
				<!-- supaya bias update gambar -->
				<input type="hidden" name="gambarLama" value="<?php echo $menu['gambar_menu']; ?>">
				
				<div class="form-group">
					<label for = "nama_menu">Menu's Name</label>
					<input type="text" name="nama_menu" id="nama_menu" value="<?php echo $menu['nama_menu'] ?>" required>
				</div>
				
				<div class="form-group">
					<label for = "harga_menu">Price</label>
					<input type="text" name="harga_menu" id="harga_menu" value="<?php echo $menu['harga_menu'] ?>" required>
				</div>
				
				<div class="form-group">
					<label for = "deskripsi_menu">Description</label>
					<input type="text" name="deskripsi_menu" id="deskripsi_menu" value="<?php echo $menu['deskripsi_menu'] ?>" required>
				</div>
				
				<div>
					<label for="jenis_menu">Category</label>
					<?php if($menu['jenis_menu'] == "healthy_salad"):?>
						<input type="radio" name="jenis_menu" id="healthy_salad" value="healthy_salad" checked="checked" required>			
						<label for = "healthy_salad">Healthy Salad</label>
					<?php endif ?>
					<?php if($menu['jenis_menu'] !== "healthy_salad"):?>
						<input type="radio" name="jenis_menu" id="healthy_salad" value="healthy_salad" required>			
						<label for = "healthy_salad">Healthy Salad</label>
					<?php endif ?>

					<?php if($menu['jenis_menu'] == "fruit_salad"):?>
						<input type="radio" name="jenis_menu" id="fruit_salad" value="fruit_salad" checked="checked" required>			
						<label for = "fruit_salad">Fruit Salad</label>
					<?php endif ?>
					<?php if($menu['jenis_menu'] !== "fruit_salad"):?>
						<input type="radio" name="jenis_menu" id="fruit_salad" value="fruit_salad" required>			
						<label for = "fruit_salad">Fruit Salad</label>
					<?php endif ?>
					
					<?php if($menu['jenis_menu'] == "pasta_salad"):?>
						<input type="radio" name="jenis_menu" id="pasta_salad" value="pasta_salad" checked="checked" required>			
					<label for = "pasta_salad">Pasta Salad</label>
					<?php endif ?>
					<?php if($menu['jenis_menu'] !== "pasta_salad"):?>
						<input type="radio" name="jenis_menu" id="pasta_salad" value="pasta_salad" required>			
						<label for = "pasta_salad">Pasta Salad</label>
					<?php endif ?>
				</div>
				
				<div class="form-group">
					<label>Image</label>
					<img src="../img/<?php echo $menu['gambar_menu']; ?>">
					<input type="file" name="gambar_menu" id="gambar_menu">
				</div>
				
				<div class="form-group" style="margin-top: 30px;">
					<button type="submit" class="btn btn-primary btn-sm" name="submit">Change</button>
				</div>
			</form>
		</div>
	</body>
</html>