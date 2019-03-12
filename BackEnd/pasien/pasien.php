<?php
	session_start();
	if($_SESSION['status']!="paslogin"){
		header("location:../login/login.php"); 
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>DoctorAsisstant</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="../css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">

    <link rel="stylesheet" href="../css/aos.css">

    <link rel="stylesheet" href="../css/ionicons.min.css">

    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/icomoon.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/profil.css">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

</head>
<body>
	<?php 

  include_once("../pages/php/doctor_db.php");
  $query = mysqli_query($mysqli, "SELECT * FROM dokter order by nama ASC");
  require ("../pages/php/function.php");
  if(isset($_SESSION['nik'])){
    $getNik=getNik($_SESSION['nik']);
    $userData=getUserData($getNik);
	?>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href=""><i class="flaticon-pharmacy"></i><span>&nbsp;DOCTOR ASSISTANT</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="../../FrontEnd/index.php" class="nav-link">Beranda</a></li>
          <li class="nav-item"><a href="../../FrontEnd/index.php#huhu" class="nav-link">Departemen</a></li>
          <li class="nav-item"><a href="../../FrontEnd/index.php#haha" class="nav-link">Kontak</a></li>
          <li class="nav-item cta active "><a href="../login/logout.php" class="nav-link"><span>Logout</span></a></li>
        </ul>
      </div>
    </div>
  </nav>
    <!-- END nav -->
	
     
<div class = "bg-light">
   <section class="ftco-section contact-section ftco-degree-bg content">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
				    <div class = "haha">
              <h2 >PROFIL</h2>
              <div class = "hihi">
              <ul>
                <li>Nama </li>
                <li>Tanggal Lahir </li>
                <li>No KTP</li>
                <li>Agama</li>
                <li>kelamin</li>
              </ul>
              </div>
              <div class = "hihi">
              <ul>
                <li>: <?php echo $userData['nama']; ?></li>
                <li>: <?php echo $userData['tanggal']; ?></li>
                <li>: <?php echo $userData['nik']; ?></li>
                <li>: <?php echo $userData['agama']; ?></li>
                <li>: <?php echo $userData['kelamin'];?></li>
                
              </ul>
              </div>
				    </div>
            <div class = "huhu">
              <h2 >Daftar antrian</h2>
              <?php foreach ($query as $row) : ?>
                <div class="col-lg-4">
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h2><?= $row["departemen"]; ?></h2>
                      <p><?= $row["nama"]; ?></p>
                      <input type="hidden" name="id" value=<?= $row["id"];?>>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-md"></i>
                    </div>
                    <?php
                    echo "<a href='daftar_antrianpas.php?id=$row[id]' class='small-box-footer'>Form Antrian <i class='fa fa-chevron-circle-right'></i></a>";
                    ?>
                  </div>
                </div>	
              <?php endforeach; ?>  
				    </div>
          </div>
        </div>
      </div>
    </section>
  <script src="../js/main.js"></script>
</div>	
</body>
</html>

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<?php
  }
  ?>