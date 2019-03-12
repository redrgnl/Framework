<?php 
  if(isset($_SESSION["admlogin"])){
		header("location: ../index.php");
		exit;
	}
    else if(isset($_SESSION["paslogin"])){
		header("location: ../pasien.php");
		exit;
	}
    else if($_SESSION['status']!="admlogin"){
        header("location:../BackEnd/login/login.php");
    }
  include_once("doctor_db.php");
  require 'function.php';
  $departemen = query("SELECT * FROM departemen");
  $result = mysqli_query($mysqli, "SELECT * FROM departemen");
  $user_data = mysqli_fetch_array($result);
?>

<html>
<head>
	<title>Doctor Asistant - Departemen</title>
</head>
 
<body>
<section class="content-header">
	<h1>
		Departemen
		<small>Daftar Departemen</small>
	</h1>
	
	<ol class="breadcrumb">
		<li><a href="index.php?p=home"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Departemen</li>
	</ol>
</section>
<section class="content">
  <div class="row">
      
    <div class="col-md-3">
        <form role="form" action="" method="post" name="form1">
        <?php foreach ($departemen as $row ) : ?>
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-hospital-o"></i></span>
            <div class="box-tools pull-right">
              <input type="hidden" name="depid" value="<?= $row["id"]; ?>">
              <button type="submit" name="Delete" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times text-black" ></i></button>
            </div>
            <div class="info-box-content">
              <span class="info-box-text">Departemen</span>
              <span class="info-box-number"><?= $row["bidang"]; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Doctor Asistant
                  </span>
            </div>
          </div>
        <?php endforeach; ?>
        </form>
    </div>  
    
<?php
if(isset($_POST['Delete'])) {
// include database connection file
include_once("doctor_db.php");
// Get id from URL to delete that user
$id = $_POST['depid'];
// Delete user row from table based on given id
$result = mysqli_query($mysqli, "DELETE FROM departemen WHERE id=$id");
echo "<meta http-equiv='refresh' content='0'>";
}
?>
        		
	<div class="col-md-6">
	  <div class="box box-info box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Masukkan Departemen</h3>
        </div>		
        <form role="form" action="" method="post" name="form1">
		  <div class="box-body">
			<div class="form-group">
				<label for="InputDepartmen">Departemen</label>
				<input type="text" class="form-control" id="InputDepartmen" placeholder="Masukan Departemen" name="departemen" required>
			</div>
		  </div>
          <div class="box-footer">
			<button type="submit"  name="Add" value="Add" class="btn btn-info">Submit</button>
		  </div>
        </form>
      </div>
    </div>
<?php
// Check If form submitted, insert form data into users table.
if(isset($_POST['Add'])) {
$departemen = $_POST['departemen'];
// include database connection file
include_once("doctor_db.php");
// Insert user data into table
$result = mysqli_query($mysqli, "INSERT INTO departemen(bidang) VALUES('$departemen')");
echo "<meta http-equiv='refresh' content='0'>";
}
?>
</div>
</section>
</body>
</html>