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
  //looping
  require 'function.php';
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
	
  // php select option value from database
  $query = mysqli_query($mysqli, "SELECT * FROM pasien order by nama ASC"); //pasien  
?>

<head>    
    <title>Doctor Asistant - Daftar Antrian</title>
</head>
<body>
	<section class="content-header">
		<h1>
			Form Booking Antrian
			<small>User Registration</small>
		</h1>
		
		<ol class="breadcrumb">
			<li><a href="index.php?p=home"><i class="fa fa-dashboard"></i> Home</a></li>
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
            <form role="form" action="" method="post" id="bookingform">
              <div class="box-body">
				<div class="form-group">
                    <input type="hidden" class="form-control" id="BookingPassID" placeholder="" name="idpass">
					<label for="BookingNama">Nama Pasien</label>
					<select class="form-control select2" id="BookingNama" name="nama" style="width: 100%" required>
                        <option value="">-- Pilih Pasien --</option>
                        <?php
                        while($row = mysqli_fetch_array($query)):;
                        ?>
						<option value="<?php echo $row[0]?>"><?php echo $row[3];?></option>
						<?php endwhile;?>
					</select>
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
						<i class="fa fa-calendar"></i>
						</div>
						<input type="text" name="q" id="q" class="form-control" placeholder="Masukkan Tanggal" data-provide="datepicker" autocomplete="off" required>
					</div>
				</div>
              </div>
              <div class="box-footer">
                <input type="hidden" name="iddok" value="<?php echo $id?>">
                <div class="pull-left">
                    <a href="index.php?p=daftar" class="btn btn-danger">Batal</a>
                </div>
                <div class="pull-right">
                    <button type="submit"  name="Submit" value="Add" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
			<?php //Form Insert Data Antrian
			if(isset($_POST['Submit'])) {
                $cek=mysqli_query($mysqli, "SELECT id_pasien FROM antrian WHERE id_pasien='$_POST[idpass]' AND DATE(waktu)=CURDATE()");
                $cekid=mysqli_num_rows($cek);
                if ($cekid > 0){
                    echo "<script type='text/javascript'> alert('Pasien sudah terdaftar dalam antrian pada hari tersebut!');</script>";
                  } else{
                    $idpasien = $_POST['idpass'];
					$iddokter = $_POST['iddok'];
					$tanggal = $_POST['q'];
                    $status = 'Antri';		
                    // Insert user data into table
					$results = mysqli_query($mysqli, "INSERT INTO antrian(id_pasien,id_dokter,waktu,status) VALUES('$idpasien','$iddokter','$tanggal','$status')");
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
			<?php
			echo "<a href='index.php?p=daftar_antrian&id=$id' class='small-box-footer'>Daftar Antrian <i class='fa fa-hospital-o'></i></a>"
			?>
			</div>
		</div>
	  </div>
	</section>
</body>
<script>

</script>