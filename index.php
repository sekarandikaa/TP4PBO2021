<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Buku.class.php");

// Membuat objek dari kelas task
$obuku = new Buku($db_host, $db_user, $db_password, $db_name);
$obuku->open();

// Memanggil method getBuku di kelas Task
$obuku->getBuku();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

//Menambahkan data buku
if (isset($_POST['add'])){

	$obuku->addData($_POST);

	header("Location: index.php");
}

while (list($id, $tjudul, $tpenulis, $tgenre, $tjenis, $thalaman, $ttahun, $tstatus) = $obuku->getResult()) {
	// Tampilan jika status buku nya sudah dibaca
	if($tstatus == "Sudah Dibaca"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tjudul . "</td>
		<td>" . $tpenulis . "</td>
		<td>" . $tgenre . "</td>
		<td>" . $tjenis . "</td>
		<td>" . $thalaman . "</td>
		<td>" . $ttahun . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}
	
	// Tampilan jika status buku nya belum dibaca
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tjudul . "</td>
		<td>" . $tpenulis . "</td>
		<td>" . $tgenre . "</td>
		<td>" . $tjenis . "</td>
		<td>" . $thalaman . "</td>
		<td>" . $ttahun . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-info' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Dibaca</a></button>
		</td>
		</tr>";
		$no++;
	}
}
//menghapus data buku
if(isset($_GET['id_hapus'])){
	$id_buku = $_GET['id_hapus'];

	$obuku->deleteBuku($id_buku);

	unset($_GET['id_hapus']);

	header("Location: index.php");
}
//mengupdate status data
if(isset($_GET['id_status'])){
	$id_buku = $_GET['id_status'];

	$obuku->updateStatus($id_buku);

	unset($_GET['id_status']);

	header("Location: index.php");
}

// Menutup koneksi database
$obuku->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();