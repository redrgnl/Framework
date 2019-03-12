<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'connection.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$admin = mysqli_query($connect,"select * from admin where username='$username' and password='$password'");
$pasien = mysqli_query($connect,"select * from pasien where nik='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$checkadm = mysqli_num_rows($admin);
$checkpas = mysqli_num_rows($pasien);
if($checkadm > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "admlogin";
	$_SESSION['login']= true;

	header("location:../index.php");
}
else if($checkpas > 0){
	$_SESSION['nik'] = $username;
	$_SESSION['status'] = "paslogin";
	$_SESSION['login']= true;
	
	header("location:../pasien/pasien.php");
}else{
	header("location:login.php");
}

?>