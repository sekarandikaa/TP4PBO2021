<?php 

class Buku extends DB{
	
	// Mengambil data
	function getBuku(){
		// Query mysql select data ke tb_baca_buku
		$query = "SELECT * FROM tb_baca_buku";

		// Mengeksekusi query
		return $this->execute($query);
	}
	
	//Menambahkan data buku
	function addData($data){
		$tjudul = $data['tjudul'];
		$tpenulis = $data['tpenulis'];
		$tgenre = $data['tgenre'];
		$tjenis = $data['tjenis'];
		$thalaman = $data['thalaman'];
		$ttahun = $data['ttahun'];
		$tstatus = "Belum Dibaca";

		$query = "INSERT INTO tb_baca_buku (judul, penulis, halaman, tahun, genre, jenis, status) VALUES ('$tjudul', '$tpenulis', '$thalaman', '$ttahun', '$tgenre', '$tjenis', '$tstatus')";

		return $this->execute($query);
	}
	//Menghapus data
	function deleteBuku($id_buku){

		$query = "DELETE FROM tb_baca_buku where id = '$id_buku'";

		return $this->execute($query);
	}
	//Mengupdate data status 
	function updateStatus($id_status){
		$query = "UPDATE tb_baca_buku SET status='Sudah Dibaca' where id = '$id_status'";

		return $this->execute($query);
	}


}



?>
