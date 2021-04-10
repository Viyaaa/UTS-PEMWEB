<?php 

	//koneksi ke database
	$conn = mysqli_connect("localhost", "id16382821_localhost", "KitaKentang3.", "id16382821_salud");

	function query($query) {
		global $conn;
		
		$result = mysqli_query($conn, $query);
		$rows = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	function tambahMenu($data) {
		//var_dump($data); //debug
		global $conn;
		
		
		$nama_menu = htmlspecialchars($data["nama_menu"]);
		$jenis_menu = $data["jenis_menu"];
		$harga_menu = htmlspecialchars($data["harga_menu"]);
		$deskripsi_menu = htmlspecialchars($data["deskripsi_menu"]);

		//upload gambar
		$gambar_menu = uploadGambar();
		if( !$gambar_menu ) {
			return false;
		}

		$query = "INSERT INTO menu(id, nama_menu, jenis_menu, harga_menu, deskripsi_menu, gambar_menu) 
					VALUES (DEFAULT, 
							'$nama_menu', 
							'$jenis_menu', 
							'$harga_menu', 
							'$deskripsi_menu', 
							'$gambar_menu')";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	function uploadGambar() {
		$namaGambar = $_FILES['gambar_menu']['name'];
		$sizeGambar = $_FILES['gambar_menu']['size'];
		$error = $_FILES['gambar_menu']['error'];
		$temp = $_FILES['gambar_menu']['tmp_name'];

		//cek apakah gambar ada diupload
		if($error === 4) {
			echo "<script>
					alert('Silahkan masukkan gambar!');
					</script>";
			return false;
		}

		//cek apakah yang diupload gambar atau bukan
		$validasiGambar = ['jpg', 'jpeg', 'png'];
		$ekstensiGambar = explode('.', $namaGambar);
		//mengambil nama terakhir yang paling belakang setelah delimiter
		$ekstensiGambar = strtolower(end($ekstensiGambar)); 
		if(!in_array($ekstensiGambar, $validasiGambar)) {
			echo "<script>
					alert('Yang diupload bukan gambar!');
					</script>";
			return false;
		}

		//cek jika size kebesaran
		if($sizeGambar > 3000000) {
			echo "<script>
					alert('Ukuran gambar terlalu besar!');
					</script>";
			return false;
		}

		//masukkan gambar
		//melakukan generate nama gambar baru
		$randomNamaGambar = uniqid();
		$randomNamaGambar .= '.';
		$randomNamaGambar .= $ekstensiGambar; 

		move_uploaded_file($temp, '../img/' . $randomNamaGambar);

		return $randomNamaGambar;
	}

	function hapusMenu($id) {
		//var_dump($id); //debug
		global $conn;

		$query = "DELETE FROM menu
					WHERE id = '$id'";

		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubahMenu($data) {
		global $conn;

		$id = $data["id"];
		$nama_menu = htmlspecialchars($data["nama_menu"]);
		$jenis_menu = $data["jenis_menu"];
		$harga_menu = htmlspecialchars($data["harga_menu"]);
		$deskripsi_menu = htmlspecialchars($data["deskripsi_menu"]);
		$gambarLama = $data['gambarLama'];

		//apakah upload gambar baru atau tidak
		if($_FILES['gambar_menu']['error'] === 4) {
			$gambar_menu = $gambarLama;
		} else {
			//jika gambar baru di upload
			$gambar_menu = uploadGambar();
		}

		$query = "UPDATE menu 
				  SET 	nama_menu = '$nama_menu',
						jenis_menu = '$jenis_menu', 
						harga_menu = '$harga_menu', 
						deskripsi_menu = '$deskripsi_menu', 
						gambar_menu = '$gambar_menu'
					WHERE id = $id;
					";

		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);

	}

	function register($data){
		session_start();
        global $conn;
		$_SESSION['errorUsername'] = false;
       	$first_name = strtolower(stripslashes($data["first_name"]));
        $last_name = strtolower(stripslashes($data["last_name"]));
        $username = strtolower(stripslashes($data["username"]));
        $email = strtolower(stripslashes($data["email"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $confirm_password = mysqli_real_escape_string($conn, $data["confirm_password"]);
        $birth_date = $data["birth_date"];
        $gender = $data["gender"];

		//confirmation username check
		$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
		if(mysqli_fetch_assoc($result)) {
			$_SESSION['errorUsername'] = true;
			return false;
		} 

		$result2 = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
		if(mysqli_fetch_assoc($result2)) {
			$_SESSION['errorEmail'] = true;
			return false;
		}

		//confirmation pw check
		if($password != $confirm_password) {
			$_SESSION['errorPassword'] = true;
			return false;
		} 

		//encrypt pw
		$password = password_hash($password, PASSWORD_DEFAULT);

		//md5 hash
		//$Password = md5($Password);

		mysqli_query($conn, "INSERT INTO user VALUES('$first_name', '$last_name', '$username', '$email', '$password', '$birth_date', '$gender');");
		

		return mysqli_affected_rows($conn);

	}


 ?>