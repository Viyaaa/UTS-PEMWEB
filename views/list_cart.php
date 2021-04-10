<?php  


    session_start();
    
    if(($_SESSION['isUserLogin']) == false) {
		header("Location: ../index.php");
	}


	require '../core/functions.php';
	$deleteURL = "/controllers/delete_item.php";
	$addURL = "/controllers/cart.php";
	
	$_SESSION['alertCart'] = null;

	if(isset($_SESSION["cart"])) {
		$totalMenu = count($_SESSION["cart"]);
	} else {
		$totalMenu = 0;
	}
	
	$temp = 0;
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
	
	<body class="cartPage">
		<!-- Navbar -->
		<div class="header" id="header">
			<nav class="navbar">
				<ul class="nav navbar-nav" style="list-style-type:none;">
					<li><a class="salud" href="#">SALUD<span class="dot">.</span></a>
					<a class="home" href="../index.php">HOME</a>
					<a class="menu" href="../index.php#one">MENU</a>
					<!--<a class="about" href="../index.php#two">ABOUT</a>-->
					<a class="about" href="#" style="text-decoration: underline;">CART (<?php echo $totalMenu; ?>)</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a class="login" href="../controllers/logout.php">LOGOUT</a></li>
				</ul>
			</nav>
		</div>
		
		<div class="container-fluid tableSpace" style="width: 95%;">
		<a style="text-decoration: none; color: #ffffff; font-size:20px;" href="../index.php"><span class="fas fa-arrow-left" ></span> BACK</a><br><br>
		
		<table id="menuTable" class="table table-hover" style="width:100%; font-size: 20px;">
				<thead>
					<tr>
						<th>No.</th>
						<th>Menu</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
						<th></th>
					</tr>
				</thead>
				<tbody style="color:#ffffff; font-size: 16px;">
					<?php 
						if(!empty($_SESSION["cart"])) { ?>
							<?php $i = 1;?>
							<?php foreach ($_SESSION["cart"] as $cart => $val) : ?>
							<tr>
								<td><?php echo $i++;?></td>
								<td><?php echo $val['nama_menu']; ?></td>
								<td><?php echo $val['harga_menu']; ?></td>
								<td>
									<span style="cursor: pointer;" class="fas fa-minus" onclick="window.location.href='<?php echo $addURL; ?>?action=min&id=<?php echo $val['id']; ?>'"></span> &nbsp; &nbsp;
									<?php echo $val['qty']; ?> &nbsp; &nbsp;
									<span style="cursor: pointer;" class="fas fa-plus" onclick="window.location.href='<?php echo $addURL; ?>?action=add&id=<?php echo $val['id']; ?>'"></span>
								</td>
								<td><?php echo number_format($val['harga_menu'] * $val['qty']) ?></td>
								<td><span style="cursor: pointer; color: red; text-align: center;" class="fas fa-close" onclick="window.location.href='<?php echo $deleteURL; ?>?id=<?php echo $val['id']; ?>'"></span></td>
							</tr>
							<?php $temp += $val['harga_menu'] * $val['qty']?>
							<?php endforeach; ?>

							<button onclick="window.location.href='<?php echo $deleteURL; ?>?id=clearAll'" style="float: right; margin-bottom: 15px;" class="btn btn-danger btn-sm">Clear All Item</button>
						
						<?php } 
							else {
								echo "<tr><td></td><td></td>
								<td style='text-align:right;'> No data available </td>
								<td></td><td></td><td></td></tr>";
						}

					?>
				</tbody>
				<tfoot>
					<tr>
						<th>Total</th>
						<th></th>
						<th></th>
						<th></th>
						<th>Rp<?php echo number_format($temp)?></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</body>
</html>