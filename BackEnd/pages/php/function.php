<?php 
require 'doctor_db.php';
	function query($query){
		global $mysqli;
		$result = mysqli_query($mysqli, $query);
		$rows = [];
		while( $row =mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		return $rows;
		}
	
	function getUserData($id){
		global $mysqli;
		$array=array();
		$query=mysqli_query($mysqli, "SELECT * FROM pasien WHERE nik=".$id);
		while($row=mysqli_fetch_assoc($query)){
			$array['id']=$row['id'];
			$array['nik']=$row['nik'];
			$array['nama']=$row['nama'];
			$array['agama']=$row['agama'];
			$array['kelamin']=$row['kelamin'];
			$array['tanggal']=$row['tanggal'];
		}
		return $array;
	}
	function getNik($username){
		global $mysqli;
		$query=mysqli_query($mysqli, "SELECT * FROM pasien WHERE nik='".$username."'");
		while($row=mysqli_fetch_assoc($query)){
			return $row['nik'];
		}
	}
	
		
	function cariDokter ($keyword){
		$query = "SELECT * FROM dokter
					WHERE
					nik LIKE '%$keyword%' OR
					nama LIKE '%$keyword%' OR
					sip LIKE '%$keyword%'
					";
		return query($query);
	}
	
		function cariPasien ($keyword){
		$query = "SELECT * FROM pasien
					WHERE
					nik LIKE '%$keyword%' OR
					nama LIKE '%$keyword%'
					";
		return query($query);
	}
	
		function cariHistory ($keyword){
		$query =  "SELECT antrian.waktu as time, pasien.nik as nikPasien, pasien.nama as namaPasien, dokter.nama as namaDokter
				   FROM antrian, dokter, pasien
				   WHERE antrian.id_pasien=pasien.id and antrian.id_dokter=dokter.id and antrian.waktu like '%$keyword%'
				   ";
		return query($query);
	}
		
?>