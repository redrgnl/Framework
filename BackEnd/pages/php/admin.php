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
// include database connection file
include_once("doctor_db.php");
 
// Check if form is submitted for user update, then redirect to homepage after update

// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM admin WHERE id=$id");

$cpasien = mysqli_query($mysqli, "SELECT COUNT(*) as count FROM pasien");
$cdokter = mysqli_query($mysqli, "SELECT COUNT(*) as count FROM dokter");

$rdokter = mysqli_fetch_assoc($cdokter);
$rpasien = mysqli_fetch_assoc($cpasien);

while($user_data = mysqli_fetch_array($result))
{
	$username = $user_data['username'];
	$password = $user_data['password'];
}
?>

<?php
    $sql = mysqli_query($mysqli, "SELECT count");
?>

<head>
	<title>Doctor Asistant - Admin</title>
</head>
<body>
	<section class="content-header">
		<h1>
			Admin
			<small>Dashboard</small>
		</h1>
		
		<ol class="breadcrumb">
			<li><a href="index.php?p=home"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Admin</li>
		</ol>
	</section>
    <section class="content">
      <div class="row">
          <!--Profile Image-->
          <div class="col-md-4">
          <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua" style="background: url('dist/img/about.jpg') center center;">
              <h3 class="widget-user-username text-primary">Doctor Asistant</h3>
              <h5 class="widget-user-desc text-black"></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="dist/img/logo.png" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Pasien</h5>
                    <span class="description-text"><?php echo $rpasien['count']?></span>
                  </div>
                </div>
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Dokter</h5>
                    <span class="description-text"><?php echo $rdokter['count']?></span>
                  </div>
                </div>
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header ">Admin</h5>
                    <span class="description-text"><?php echo $username;?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div  class="active tab-pane" id="settings">
                <form role="form" class="form-horizontal" action="" method="post" name="update_user">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="username" value="<?php echo $username;?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo $password;?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
					  <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                      <button type="submit" name="update" value="Update" class="btn btn-info">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
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
          echo "<meta http-equiv='refresh' content='0'>";
	      }
          ?>          
      </div>
    </section>
</body>