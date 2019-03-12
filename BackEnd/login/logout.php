<?php 
// mengaktifkan session
session_start();
$_SESSION=[];
session_unset();
// menghapus semua session
session_destroy();
 
// mengalihkan halaman sambil mengirim pesan logout
header("location:../../FrontEnd/index.php");
exit;
?>