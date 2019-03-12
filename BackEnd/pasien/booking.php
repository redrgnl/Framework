<?php 
    session_start();
    if($_SESSION['status']!="paslogin"){
      header("location:../BackEnd/login/login.php"); 
    }
  include_once("../pages/php/doctor_db.php");
  //looping
  require '../pages/php/function.php';
  $departemen = query("SELECT * FROM departemen");
  
  //get doctor data
  $id = $_GET['id'];
  $rest = mysqli_query($mysqli, "SELECT * FROM dokter WHERE id=$id");
  while($user_data = mysqli_fetch_array($rest))
	{
	$sip = $user_data['sip'];
	$nama = $user_data['nama'];
	$departemen = $user_data['departemen'];
	}
	// mysql select query
  $q = "SELECT * FROM pasien order by nama ASC"; //pasien
  $result = mysqli_query($mysqli, $q);
  $options = "";
  if(isset($_SESSION['nik'])){
    $getNik=getNik($_SESSION['nik']);
    $userData=getUserData($getNik);
?>

<head>    
    <title>Doctor Asistant - Daftar Antrian</title>
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

    <link rel="stylesheet" href="../../BackEnd/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../../BackEnd/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    
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
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href=""><i class="flaticon-pharmacy"></i><span>&nbsp;DOCTOR ASSISTANT</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="../../FrontEnd/index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="../../FrontEnd/index.php#huhu" class="nav-link">Departments</a></li>
                <li class="nav-item"><a href="../../FrontEnd/index.php#haha" class="nav-link">Contact</a></li>
                <li class="nav-item cta active "><a href="../login/logout.php" class="nav-link"><span>Logout</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
	<section class="content-header">
		<h1>
			Form Booking Antrian
			<small>User Registration</small>
		</h1>
		
		<ol class="breadcrumb">
			<li><a href="pasien.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Daftar</li>
		</ol>
	</section>
	<section class="content">		
	 <div class="row">	
	  <div class="col-md-6">
		<div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Masukkan Data Pasien</h3>
            </div>
            <form role="form" action="" method="post" name="form1">
              <div class="box-body">
				<div class="form-group">
                    <input type="hidden" class="form-control" id="AntrianPassID" placeholder="" name="idpass">
					<label for="AntrianNama">Nama Pasien</label>
          <input type="text" class="form-control" id="AntrianPassID" disabled="disabled" placeholder="" value="<?php echo $userData['nama']; ?>">
          <input type="hidden" class="form-control" id="AntrianPassID" placeholder="" name="idpass" value="<?php echo $userData['id']; ?>">
				</div>
				<div class="form-group">
                  <label for="InputSIP">SIP</label>
                  <input type="text" class="form-control" id="InputSIP" disabled="disabled" placeholder="" name="sip" value="<?php echo $sip;?>">
                </div>
				<div class="form-group">
					<label for="InputDokter">Dokter</label>
					<input type="text" class="form-control" id="InputDokter" disabled="disabled" placeholder="" name="dokter" value="<?php echo $nama;?>">
				</div>
				<div class="form-group">
					<label>Date:</label>
					<div class="input-group date">
						<div class="input-group-addon">
						</div>
						<input type="text" name="q" id="q" class="form-control" placeholder="Masukkan Tanggal" data-provide="datepicker" autocomplete="off">
					</div>
				</div>
              </div>
              <div class="box-footer">
                <input type="hidden" name="iddok" value="<?php echo $id?>">
                <div class="pull-left">
                    <?php echo "<a href='daftar_antrianpas.php?id=$id' class='btn btn-danger'>Batal</a>"?>
                </div>
                <div class="pull-right">
                    <button type="submit"  name="Submit" value="Add" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
            <?php //Form Insert Data Antrian
	        if(isset($_POST['Submit'])) {
            $cek=mysqli_query($mysqli, "SELECT id_pasien FROM antrian WHERE id_pasien='$_POST[idpass]' AND DATE(waktu)='$_POST[q]'");
            $cekid=mysqli_num_rows($cek);
            if ($cekid > 0){
                echo "<script type='text/javascript'> alert('Pasien telah terdaftar dalam antrian pada tanggal tersebut!');</script>";
              } else{
                $idpasien = $_POST['idpass'];
                $iddokter = $_POST['iddok'];
                $waktu=$_POST['q'];
                $status = 'Antri';
                // include database connection file
                $results = mysqli_query($mysqli, "INSERT INTO antrian(id_pasien,id_dokter,waktu,status) VALUES('$idpasien','$iddokter','$waktu','$status')");		
                // Show message when user added
                echo "<meta http-equiv='refresh' content='0'>";
              }
    
        }
        	?>
         </div>
	   </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h2><?php echo $departemen;?></h2>
                    <p>User Registration</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                <div class="small-box-footer">Antrian <i class="fa fa-hospital-o"></i></div>
            </div>
        </div>
    </div>
    <?php
  }
    ?>
  </section>
  
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!--AutoNik-->
<script>
    $('#AntrianNama').change(function(){
        var terpilih = $('#AntrianNama').val();
        $('#AntrianPassID').val(terpilih);
        });
    $("#q").datepicker({ 
        format: 'yyyy-mm-dd'
    });
</script>
</body>