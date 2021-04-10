<?php 
	//untuk mengambil menu-menu yang sesuai dengan jenisnya
	//kat for kategori
	function sortMenu($kat) {
		$menu = query("SELECT * FROM menu 
						WHERE jenis_menu = '$kat'");
		return $menu;
	}
?>