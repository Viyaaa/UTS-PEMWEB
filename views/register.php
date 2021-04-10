<?php
	// session_start();
    require '../core/functions.php';
	
    if(isset($_POST['register'])){
        if(register($_POST)>0){
            echo    "<script>
                        window.location.href = 'login.php';
                    </script>";
        } else {
            echo mysqli_error($conn);
        }
    }

	if(!isset($_SESSION['errorUsername'])){
		$_SESSION['errorUsername'] = false;
	}
	if(!isset($_SESSION['errorEmail'])){
		$_SESSION['errorEmail'] = false;
	}
	if(!isset($_SESSION['errorPassword'])){
		$_SESSION['errorPassword'] = false;
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
		?>
		<link href="assets/css/style.css" rel="stylesheet"/>
		<script src="assets/js/script.js"></script>
	</head>


	<body class="registerPage">
		<div class="wrapper">
			<div class="slide">
				<h4>Register for order our best menu!</h4>
				<form method="post">
					<table>
						<tr>
							<td>
							<label style="color: white;" for="first_name">First Name </label> <br>
							<input type="text" name="first_name" id="first_name" required>
							</td>
							<td>
							<label style="color: white;" for="last_name">Last Name </label> <br>
							<input type="text" name="last_name" id="last_name" required>
							</td>
						</tr>
						<tr>
							<td>
							<label style="color: white;" for="username">Username</label> <br>
							<input type="text" name="username" id="username" minlength="5" required>
							<?php if($_SESSION['errorUsername'] == true){?>
							 <b><label style="color: red; font-style: italic; font-size: 14px;">Username had been taken</label></b>
							<?php } $_SESSION['errorUsername'] = false;?>
							</td>
						</tr>
						<tr>
							<td>
							<label style="color: white;" for="email">Email </label>
							<br>
							<input type="email" name="email" id="email" required>
							<?php if($_SESSION['errorEmail'] == true){?>
							<b><label style="color: red; font-style: italic; font-size: 12px;">Email had been taken</label></b>
							<?php } $_SESSION['errorEmail'] = false;?>
							</td> 
						</tr>
						<tr>
							<td>
							<label style="color: white;" for="password">Password</label> <br>
							<input type="password" name="password" id="password" minlength="5">
							<?php if($_SESSION['errorPassword'] == true){?>
								<b><label style="color: red; font-style: italic; font-size: 12px;"></label></b>
							<?php } ?>
							</td>
							<td>
							<label style="color: white;" for="confirm_password">Confirm Password </label> <br>
							<input type="password" name="confirm_password" id="confirm_password">
							<?php if($_SESSION['errorPassword'] == true){?>
								<b><label style="color: red; font-style: italic; font-size: 12px;">Password not matched</label></b>
							<?php } $_SESSION['errorPassword'] = false;?>
							</td>
						</tr>
						<tr>
							<td>
							<label style="color: white;" for="birth_date">Birth Date </label> <br>
							<input type="date" name="birth_date" id="birth_date" required>
							</td>
							<td>
							<label style="color: white;" for="gender">Gender : </label> <br>
							<input type="radio" id="male" name="gender" value="male" required>
							<label style="color: white;" for="male">Male</label>
							<input type="radio" id="female" name="gender" value="female" required>
							<label style="color: white;" for="female">Female</label>
							</td>
						</tr>
					</table>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary b1" name="register">Register</button>
						<button type="submit" class="btn btn-danger" name="cancel" onClick="window.location='../index.php';">Cancel</button>
						<p>Have an account? <br>
					Login <a href="login.php">here</a>.</p>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>