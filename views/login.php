<?php
	session_start();

	require '../core/functions.php';
    if(isset($_POST["login"])) {
		// SQL Injection
        $username = mysqli_real_escape_string($conn,$_POST["username"]);
        $password = mysqli_real_escape_string($conn,$_POST["password"]);
        $result = mysqli_query($conn, "SELECT * FROM  user WHERE username = '$username'");

		$sessionCaptcha = $_SESSION['captcha'];
		$formCaptcha = $_POST['captcha'];

        //email check
        //hitung ada brp baris yg dikembalikan dri query
        if(mysqli_num_rows($result) === 1) {
			if($sessionCaptcha != $formCaptcha){
				$CaptchaError = true;
			}

			//pw check
			$row = mysqli_fetch_assoc($result);
			if(password_verify($password, $row["password"]) == true && $sessionCaptcha == $formCaptcha) {
				if($username == 'admin'){
					$_SESSION['isAdminLogin'] = true;
					header("Location: admin.php");
					exit;
				}else{
					$_SESSION['isUserLogin'] = true;
					$_SESSION['username'] = $username;
					header("Location: ../index.php");
					exit;
				}
			} 
        } 

		if(mysqli_num_rows($result) !== 1 || password_verify($password, $row["password"]) == false){
			$error = true;
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
		?>
		<link href="assets/css/style.css" rel="stylesheet"/>
		<script src="assets/js/script.js"></script>
		
		<!-- reCaptcha -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script sre="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/bootstrap.min.js"></script>
	</head>
	
	<body class="loginPage">
				
		<div class="wrapper">
			<div class="slide">
				<h1>LOGIN</h1>
				<form method="post">
					<div class="form-group">
						<label for="username">Username</label><br>
						<input type="text" name="username" id="username" size="40" required>
					</div>
			
					<div class="form-group">
						<label for="password">Password</label><br>
						<input type="password" name="password" id="password" size="40" required>
						<?php if(isset($error)):?>
						<br><a style="color: #f70d1a; font-style: italic; text-align:right;"><b>Wrong Username or Password.</b></a>
						<?php endif; ?>
					</div>

					<div class="form-group">
						<label for="captcha">reCaptcha</label><br>
						<input type="text" name="captcha" size="20" required> <img src="../core/captcha.php"><br>
						<a href="" id="cl">Click to refresh</a>
						<?php if(isset($CaptchaError)):?>
						<br><a style="color: #f70d1a; font-style: italic;"><b>Invalid reCaptcha.</a></p>
						<?php endif; ?>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary b1" name="login">Login</button>
						<button type="submit" class="btn btn-danger" name="cancel" onClick="window.location='../index.php';">Cancel</button>
						<p>Don't have an account? <br>
					Register <a href="register.php">here</a>.</p>
					</div>
				</form>
			</div>
		</div>

		<script>
			$(document).ready(function(){
				$("#cl").on('click', function(){
					location.reload();
				});
			});
		</script>
	</body>
</html>