<section class="content-header">
<?php
// include database connection file
include_once("doctor_db.php");

	if(isset($_POST['update']))
	{	
	$id = $_POST['id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	// update user data
	$result = mysqli_query($mysqli, "UPDATE admin SET username ='$username',password='$password' WHERE id=$id");	
	echo "Update successfully. <a href='index.php?p=admin&id=1'>View Users</a>";
	}
?>
</section>

