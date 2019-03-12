<?php
	session_start();
	if($_SESSION['status']!="paslogin"){
		header("location:../login/login.php"); 
  }

?>
<!DOCTYPE html>
<html>
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
<?php 
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
			Form Daftar Antrian
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
		<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Masukkan Data Pasien</h3>
            </div>
            <form role="form" action="" method="post" name="form1">
              <div class="box-body">
				<div class="form-group">
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
					<label>
                        <i class="fa fa-calendar"></i>
                        Date:
                    </label>
					<div class="input-group date">
						<div class="input-group-addon">
						</div>
						<?php
						date_default_timezone_set("Asia/Jakarta");
						$now = date('Y-m-d');
                        ?>
						<input type="text" class="form-control pull-right" id="datepicker" name="tanggal" disabled="disabled" value="<?php echo $now?>">
					</div>
				</div>
              </div>
              <div class="box-footer">
                <input type="hidden" name="iddok" value="<?php echo $id?>">
                <div class="pull-left">
                    <?php echo "<a href='pasien.php' class='btn btn-danger'>Batal</a>"?>
                </div>
                <div class="pull-right">
                    <button type="Submit"  id="submit" name="Submit" value="Add" class="btn btn-primary" onclick="myFunction()">Daftar</button>
                </div>
              </div>
              
            </form>
            
            <?php
	        if(isset($_POST['Submit'])) {
                $cek=mysqli_query($mysqli, "SELECT id_pasien FROM antrian WHERE id_pasien='$_POST[idpass]' AND DATE(waktu)=CURDATE()");
                $cekid=mysqli_num_rows($cek);
                if ($cekid > 0){
                    echo "<script type='text/javascript'> alert('Anda sudah terdaftar dalam antrian!');</script>";
                  } else{
                    $idpasien = $_POST['idpass'];
                    $iddokter = $_POST['iddok'];
                    $status = 'Antri';		
                    // Insert user data into table
                    $results = mysqli_query($mysqli, "INSERT INTO antrian(id_pasien,id_dokter,waktu,status) VALUES('$idpasien','$iddokter','$now','$status')");		
                    // Show message when user added
                  }
            }
            $upstats = 'Antri';
            $upstats1 = 'Periksa';
            $upstats2 = 'Selesai';
            $upstats3 = $userData['id'];

            $cAntri = mysqli_query($mysqli, "SELECT COUNT(*) as count FROM antrian WHERE antrian.id_dokter=$id AND DATE(waktu)=CURDATE()");
            $cAntri1 = mysqli_query($mysqli, "SELECT COUNT(*) as count1 FROM antrian WHERE antrian.id_dokter=$id AND antrian.status='$upstats1' AND DATE(waktu)=CURDATE()");
            $cAntri2 = mysqli_query($mysqli, "SELECT COUNT(*) as count2 FROM antrian WHERE antrian.id_dokter=$id AND antrian.status='$upstats2' AND DATE(waktu)=CURDATE()");
            $cAntri3 = mysqli_query($mysqli, "SELECT * FROM antrian WHERE antrian.id_dokter=$id AND DATE(waktu)=CURDATE()");
            $cAntri4 = mysqli_query($mysqli, "SELECT COUNT(*) as count4 FROM antrian WHERE antrian.id_dokter=$id AND antrian.id_pasien='$upstats3' AND DATE(waktu)=CURDATE()");

            $rAntri = mysqli_fetch_assoc($cAntri);  
            $rAntri1 = mysqli_fetch_assoc($cAntri1);
            $rAntri2 = mysqli_fetch_array($cAntri2);
            $rAntri4 = mysqli_fetch_array($cAntri4);

            $array=array();
            while($rAntri3 = mysqli_fetch_array($cAntri3)){
                $coba[]=$rAntri3[1];
                if($coba === $userData['id']){
                    $hasil=$rAntri4['count4'];
                    break;
                }else{
                    $hasil=sizeof($coba);
                }
            }
            ?>
         </div>
	   </div>
	   
	   <div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h2>No. <?php echo $rAntri['count'];?></h2>
				<p>Nomor Antrian Terakhir</p>
			</div>
			<div class="icon">
				<i class="fa fa-user-md"></i>
			</div>
            <div class="small-box-footer"><?php echo $departemen?> <i class="fa fa-hospital-o"></i></div>
		</div>
         <!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h2>No. <?php echo $rAntri1['count1']+$rAntri2['count2'];?></h2>
				<p>Nomor Antrian Yang <br> Sedang Diperiksa</p>
			</div>
			<div class="icon">
				<i class="fa fa-user-md"></i>
			</div>
            <div class="small-box-footer"><?php echo $departemen?> <i class="fa fa-hospital-o"></i></div>
        </div>
        <!-- small box -->
		<div id="myDIV" class="small-box bg-aqua satu" style="display : none;">
			<div class="inner">
				<h2>No. <?php echo $hasil;?></h2>
				<p>Nomor Antrian Anda </p>
			</div>
			<div class="icon">
				<i class="fa fa-user-md"></i>
			</div>
            <div class="small-box-footer">
                <a href=""  onclick="myFunction()">Sembunyikan <i class="fa fa-hospital-o"></i></a>
            </div>
        </div>
        <button id="myBUT" type="button" onclick="myFunction()" class="btn btn-block btn-primary btn-lg">Lihat Antrian Anda</button>
        <br>
        <?php
        echo"
        <a href='booking.php?id=$id'>
        <button type='button' class='btn btn-block btn-primary btn-lg'>BOOKING ANTRIAN</button>
        </a>
        ";
        ?>
        
		</div>
	   </div>
      </div>
	</section>
    <script>
    function myFunction() {
        var x = document.getElementById("myDIV");
        var y = document.getElementById("myBUT");
        if (x.style.display = "none") {
            x.style.display = "block";
            y.style.display = "none";
        }else{
            y.style.display = "block";
            x.style.display = "none";
        }
    }
</script>
</body>
<?php
    }
?>