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
  $tampung = query ("SELECT antrian.waktu as time, pasien.nik as nikPasien, pasien.nama as namaPasien, dokter.nama as namaDokter 
                     FROM antrian, dokter, pasien
                     WHERE antrian.id_pasien=pasien.id and antrian.id_dokter=dokter.id and antrian.waktu='2008-07-31'");

  if (isset($_POST["cari"])){
	$tampung = cariHistory($_POST["q"]);
  }
?>

<html>
<head>
	<title>Doctor Asistant - History</title>
</head>
 
<body>
	<section class="content-header">
		<h1>
			History
			<small>Riwayat Pendaftaran Pasien</small>
		</h1>
		
		<ol class="breadcrumb">
			<li><a href="index.php?p=home"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">History</li>
		</ol>
	</section>
    
	<section class="content">
        <form action="" method="post">
        <div class="input-group" style="width: 30%;">
          <input type="text" name="q" id="q" class="form-control" placeholder="Masukkan Tanggal" data-provide="datepicker" autocomplete="off" required>
            <span class="input-group-btn">
                <button type="submit" name="cari" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
        </form>
        <br>
		<div class="box box-success box-solid">
			<div class="box-header">
					<h3 class="box-title">History</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-striped">
				  <tr>
                    <th>Tanggal</th>
					<th>NIK</th>
					<th>Nama</th>
					<th>Dokter</th>
                  </tr>
                    <?php foreach($tampung as $row):?>
                  <tr>
                    <td><?php echo $row ["time"];?></td>
					<td><?php echo $row ["nikPasien"];?></td>
					<td><?php echo $row ["namaPasien"];?></td>
					<td><?php echo $row ["namaDokter"];?></td>
                  </tr>
                    <?php endforeach; ?>
				</table>
			</div>
		</div>
	</section>
</body>
</html>