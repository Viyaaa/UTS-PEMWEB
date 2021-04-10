<?php
	session_start();

	if(isset($_SESSION['isAdminLogin']) == false) {
		header("Location: login.php");
	}

	if(!isset($_SESSION['addMenu'])){
		$_SESSION['addMenu'] = false;
	}
	if(!isset($_SESSION['edit'])){
		$_SESSION['edit'] = false;
	}
	if(!isset($_SESSION['delete'])){
		$_SESSION['delete'] = false;
	}
	
	require '../core/functions.php';
	require '../controllers/category_menu.php'; //mengambil menu berdasarkan sortingan
	$menu = query("SELECT * FROM menu");

	// if(isset($_GET['kategori'])) {
	// 	$namaKategori = $_GET['kategori'];
	// 	$sortedMenu = sortMenu($_GET['kategori']);

	// 	$sortedMenu = [] ? [] : $sortedMenu;
	// } else {
	// 	$hidden = "none";
	// }
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
				height: 100px;
				width: 100px;
			}	
			.alert {
				width: 30%;
				height: auto;
				padding: 0px;
			}
		</style>
		
		<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove(); 
				});
			}, 5000);
		</script>
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
			
			<center>
			<?php if($_SESSION['addMenu'] == true):?>
				<div class="alert alert-success" role="alert">
					<strong style="color: green;">Success!</strong> Menu has been added.
				</div>
			<?php endif; $_SESSION['addMenu'] = false;?>
			
			<?php if($_SESSION['edit'] == true):?>
				<div class="alert alert-warning" role="alert">
					<strong style="color: #dbd116;">Success!</strong> Menu has been edited.
				</div>
			<?php endif; $_SESSION['edit'] = false ?>

			<?php if($_SESSION['delete'] == true):?>
				<div class="alert alert-danger" role="alert">
					<strong style="color: red;">Success!</strong> Menu has been deleted.
				</div>
			<?php endif; $_SESSION['delete'] = false;?>
			</center>
		</div>
		
		<div class="container-fluid tableSpace" style="width: 95%;">
			<button class="tMenu btn btn-info btn-sm" style="float: right;" onClick="window.location='admin_addMenu.php';"><span class="fas fa-plus"></span> Menu</button>
			
			<br><br><br>
			
			<!-- Table -->
			<table id="menuTable" class="table table-hover" style="width:100%; font-size: 20px;">
				<thead>
					<tr>
						<th>No.</th>
						<th>Menu's Name</th>
						<th>Category</th>
						<th>Price</th>
						<th>Description</th>
						<th>Image</th>
						<th style="width: 100px;">Action</th>
					</tr>
				</thead>
				<tbody style="color:#ffffff; font-size: 16px;">
					<?php $i = 1; ?>
					<?php foreach ($menu as $menu) : ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $menu["nama_menu"]; ?></td>
						<td><?php echo $menu["jenis_menu"]; ?></td>
						<td><?php echo $menu["harga_menu"]; ?></td>
						<td><?php echo $menu["deskripsi_menu"]; ?></td>
						<td>
							<img src="../img/<?php echo $menu['gambar_menu']; ?>">
						</td>
						<td>
							<button class="btn btn-warning btn-sm" onClick="window.location=
							'admin_editMenu.php?id=<?php echo $menu['id']; ?>';"><span class="fas fa-pen"></span></button>
							<button style="padding:10px;" class="btn btn-danger btn-sm" onClick="window.location='../controllers/delete_menu.php?id=<?php echo $menu['id']; ?>';"><span style="font-size:16px;" class="fas fa-close"></span></button>
						</td>
					</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</body>
</html>