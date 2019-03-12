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
// Create database connection using config file
include_once("doctor_db.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM dokter order by nama ASC");

//UNTUK CARI / Search
require 'function.php';
$tampung = query ("SELECT * FROM dokter order by nama ASC ");
//$tampung = menampung query yang ada di function.php
//query = query yang ada di dalam function.php

if (isset($_POST["cari"])){
	$tampung = cariDokter($_POST["keyword"]);
}
?>

<html>
<head>    
    <title>Doctor Asistant - Doctor</title>
</head>
 
<body>
	<section class="content-header">
		<h1>
			Doctor
			<small>Doctor Dashboard</small>
		</h1>
		
		<ol class="breadcrumb">
			<li><a href="index.php?p=home"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Doctor</li>
		</ol>
        
      <form action ="" method = "post">
        <div class="input-group" style="width: 30%;">
          <input type="text" name="keyword" class="form-control" autofocus placeholder="Search..." autocomplete = "off" required>
          <span class="input-group-btn">
                <button type="submit" name="cari" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
	</section>
	
<section class="content">
 <div class="box box-info box-solid">
	<div class="box-header">
		<h3 class="box-title">Tabel Doctor</h3>
		<div class="pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">Tambah</button>
		</div>
	</div>
	<div class="box-body">
		<table id="example" class="table table-bordered table-striped"> 
			<tr>
				<th>NIK</th> 
				<th>SIP</th>
				<th>Nama</th> 
				<th>Tanggal Lahir</th> 
				<th>Jenis Kelamin</th> 
				<th>Alamat</th> 
				<th>Depertemen</th>
				<th>Update</th>
			</tr>
			<?php foreach($tampung as $row):
				//$tampung = mengulang data yang ada di dalam db (function.php)(lihat ke atas)
				//$row = sebagai data yang akan di ambil (di bawah ini)
				?>
			<tr>
					<td><?php echo $row ["nik"];?></td>
					<td><?php echo $row ["sip"];?></td>
					<td><?php echo $row ["nama"];?></td>
					<td><?php echo $row ["tanggal"];?></td>
					<td><?php echo $row ["kelamin"];?></td>
					<td><?php echo $row ["alamat"];?></td>
					<td><?php echo $row ["departemen"];?></td>
					<td>
				    <button type='button' class='btn btn-primary' data-toggle="modal" data-target="#modal-default"
				        onclick="editdokter
                                 ('<?php echo $row['id']?>','<?php echo $row['nik']?>','<?php echo $row['sip']?>','<?php echo $row['nama']?>','<?php echo $row['tanggal']?>','<?php echo $row['kelamin']?>','<?php echo $row['alamat']?>','<?php echo $row['agama']?>','<?php echo $row['status']?>','<?php echo $row['wnegara']?>','<?php echo $row['departemen']?>')">
				        <i class='fa fa-gears'></i>
				    </button>
                    <button type='button' class='btn btn-danger' data-toggle="modal" data-target="#modal-danger"
				        onclick="deletedokter
                                 ('<?php echo $row['id']?>','<?php echo $row['nama']?>')">
                        <i class='fa fa-remove'></i>
				    </button>
					</td>  	
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
 </div>
        <!--Modals Add Dokter-->
        <div class="modal modal-info fade" id="modal-primary">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Masukan Data Dokter</h4>
              </div>
              <div class="modal-body">
                  <?php
                  // mysql select query
                  $query = mysqli_query($mysqli, "SELECT * FROM departemen order by bidang ASC"); //pasien
                  ?>
                  <form autocomplete="off" role="form" action="" method="post" name="form1">
                <div class="form-group">
                  <label for="InputNIK">NIK</label>
                  <input type="text" class="form-control" id="InputNIK" placeholder="Masukan NIK" name="nik" onkeypress="validate(event)" required>
                </div>
				<div class="form-group">
                  <label for="InputSIP">SIP</label>
                  <input type="text" class="form-control" id="InputSIP" placeholder="Masukan SIP" name="sip" required>
                </div>
				<div class="form-group">
                  <label for="InputNama">Nama</label>
                  <input type="text" class="form-control" id="InputNama" placeholder="Masukan Nama" name="nama" required>
                </div>
				<div class="form-group" >
                  <label for="InputTanggal">Tanggal Lahir</label>
				  <div class="input-group date" data-provide="datepicker">
					<input type="text" class="form-control" id="InputTanggal" placeholder="Masukan Tanggal Lahir" name="tanggal" required>
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-th"></span>
					</div>
				  </div>
                </div>
				<div class="form-group">
                  <label for="InputKelamin">Jenis Kelamin</label>
					<select class="form-control select2" id="InputKelamin" name="kelamin" style="width: 100%;" required>
						<option value="">-- Jenis Kelamin --</option>
                        <option>Pria</option>
						<option>Wanita</option>
					</select>
                </div>
				<div class="form-group">
                  <label for="InputAlamat">Alamat</label>
                  <input type="text" class="form-control" id="InputAlamat" placeholder="Masukan Alamat" name="alamat" required>
                </div>
				<div class="form-group">
                  <label for="InputAgama">Agama</label>
					<select class="form-control select2" id="InputAgama" name="agama" style="width: 100%;" required>
                        <option value="">-- Agama --</option>
                        <option>Islam</option>
						<option>Kristen</option>
						<option>Katolik</option>
						<option>Hindu</option>
						<option>Budha</option>
						<option>Konghucu</option>
					</select>
				</div>
				<div class="form-group">
                  <label for="InputStatus">Status</label>
					<select class="form-control select2" id="InputStatus" name="status" style="width: 100%;" required>
						<option value="">-- Status --</option>
                        <option>Nikah</option>
						<option>Belum Nikah</option>
					</select>
                </div>
				<div class="form-group">
                  <label for="InputNegara">Warga Negara</label>
                  <input type="text" class="form-control" id="InputNegara" placeholder="Masukan Warga Negara" name="wnegara" required>
                </div>
				<div class="form-group">
                  <label for="InputDepartmen">Department</label>
					<select class="form-control select2" id="InputDepartemen" name="departemen" style="width: 100%;" required>
						<option value="">-- Departemen --</option>
                        <?php while($row = mysqli_fetch_array($query)):;?>
						<option><?php echo $row[1];?></option>
						<?php endwhile;?>
					</select>
                </div>
              <div class="modal-footer">
                <button type="submit" name="Submit" value="Add" class="btn btn-outline">Save changes</button>
              </div>
            </form>
            <?php
            if(isset($_POST['Submit'])) {
                $cek=mysqli_query($mysqli, "SELECT nik FROM dokter WHERE nik='$_POST[nik]'");
                $cekid=mysqli_num_rows($cek);
                if ($cekid > 0){
                    echo "<script type='text/javascript'> alert('NIK anda sudah terdaftar!');</script>";
                  } else{
                    $nik = $_POST['nik'];
                    $sip = $_POST['sip'];
                    $nama = $_POST['nama'];
                    $tanggal = $_POST['tanggal'];
                    $kelamin = $_POST['kelamin'];
                    $alamat = $_POST['alamat'];
                    $agama = $_POST['agama'];
                    $status = $_POST['status'];
                    $wnegara = $_POST['wnegara'];
                    $departemen = $_POST['departemen'];	
                    $newDate = date("Y-m-d", strtotime($tanggal));		
                    // Insert user data into table
                    $results = mysqli_query($mysqli, "INSERT INTO dokter(nik,sip,nama,tanggal,kelamin,alamat,agama,status,wnegara,departemen) VALUES('$nik','$sip','$nama','$newDate','$kelamin','$alamat','$agama','$status','$wnegara','$departemen')");		
                    // Show message when user added
                    echo "<meta http-equiv='refresh' content='0'>";
                  }
            }
        	?>
        </div>
      </div>
    </div>
  </div>
  <!--Modal Edit Dokter-->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Dokter</h4>
      </div>
      <div class="modal-body">
          <?php
            // mysql select query
            $query = mysqli_query($mysqli, "SELECT * FROM departemen order by bidang ASC"); //pasien
          ?>        
          <form autocomplete="off" role="form" action="" method="post" name="update_user">
                <div class="form-group">
                  <label for="EditDokNIK">NIK</label>
                  <input type="text" class="form-control" id="EditDokNIK" name="nik" value="" onkeypress="validate(event)" required>
                </div>
				<div class="form-group">
                  <label for="EditDokSIP">SIP</label>
                  <input type="text" class="form-control" id="EditDokSIP" name="sip" value="" required>
                </div>
				<div class="form-group">
                  <label for="InputNama">Nama</label>
                  <input type="text" class="form-control" id="EditDokNama" name="nama" value="" required>
                </div>
				<div class="form-group" >
                  <label for="InputTanggal">Tanggal Lahir</label>
				  <div class="input-group date" data-provide="datepicker">
					<input type="text" class="form-control" id="EditDokTanggal" name="tanggal" value="" required>
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-th"></span>
					</div>
				  </div>
                </div>
				<div class="form-group">
                  <label for="InputKelamin">Jenis Kelamin</label>
				  	<select class="form-control select2" id="EditDokKelamin" name="kelamin" style="width: 100%;" required>
						<option value="">-- Jenis Kelamin --</option>
                        <option>Pria</option>
						<option>Wanita</option>
					</select>
                </div>
				<div class="form-group">
                  <label for="InputAlamat">Alamat</label>
                  <input type="text" class="form-control" id="EditDokAlamat" name="alamat" value="" required>
                </div>
				<div class="form-group">
                  <label for="InputAgama">Agama</label>
					<select class="form-control select2" id="EditDokAgama" name="agama" style="width: 100%;" required>
						<option value="">-- Agama --</option>
                        <option>Islam</option>
						<option>Kristen</option>
						<option>Katolik</option>
						<option>Hindu</option>
						<option>Budha</option>
						<option>Konghucu</option>
					</select>
                </div>
				<div class="form-group">
                  <label for="InputStatus">Status</label>
					<select class="form-control select2" id="EditDokStatus" name="status" style="width: 100%;" required>
						<option value="">-- Status --</option>
                        <option>Nikah</option>
						<option>Belum Nikah</option>
					</select>
                </div>
				<div class="form-group">
                  <label for="InputNegara">Warga Negara</label>
                  <input type="text" class="form-control" id="EditDokNegara" name="wnegara" value="" required>
                </div>
				<div class="form-group">
                  <label for="InputDepartmen">Department</label>
					<select class="form-control select2" id="EditDokDepartemen" name="departemen" style="width: 100%;" required>
						<option value="">-- Departemen --</option>
                        <?php while($row = mysqli_fetch_array($query)):;?>
						<option><?php echo $row[1];?></option>
						<?php endwhile;?>
					</select>
                </div>
              <div class="modal-footer">
                <input type="hidden" class="form-control" id="EditDokID" name="id">
                <button type="submit" name="update" value="Update" class="btn btn-primary">Save changes</button>
              </div>
            </form>   
        </div>
    </div>
  </div>
 <?php
    if(isset($_POST['update']))
    {	
	$id = $_POST['id'];
	$nik = $_POST['nik'];
	$sip = $_POST['sip'];
	$nama = $_POST['nama'];
	$tanggal = $_POST['tanggal'];
	$kelamin = $_POST['kelamin'];
	$alamat = $_POST['alamat'];
	$agama = $_POST['agama'];
	$status = $_POST['status'];
	$wnegara = $_POST['wnegara'];
	$departemen = $_POST['departemen'];
    $newDate = date("Y-m-d", strtotime($tanggal));
	// update user data
	$result = mysqli_query($mysqli, "UPDATE dokter SET nik='$nik',sip='$sip',nama='$nama',tanggal='$newDate',kelamin='$kelamin',alamat='$alamat',agama='$agama',status='$status',wnegara='$wnegara' ,departemen='$departemen' WHERE id=$id");   
	echo "<meta http-equiv='refresh' content='0'>";
	}
 ?>
 </div>

 <!--Delete Modal-->
 <div class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Warning</h4>
        </div>
        <div class="modal-body">
            <form autocomplete="off" role="form" action="" method="post" name="delete_user">
                <div class="form-group">
                    <label for="DeleteDokID">Hapus Data?</label>
                    <input type="hidden" class="form-control" id="DeleteDokID" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="delete" value="Delete" class="btn btn-outline">Delete</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    <?php
    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $result = mysqli_query($mysqli, "DELETE FROM dokter WHERE id=$id");
        echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>
 </div>
    
</section>

</body>
<script type="text/javascript">
    function editdokter($did,$dnik,$dsip,$dnama,$dtanggal,$dkelamin,$dalamat,$dagama,$dstatus,$dwnegara,$ddepartemen) {
    $('#EditDokID').val($did);
    $('#EditDokNIK').val($dnik);
    $('#EditDokSIP').val($dsip);
    $('#EditDokNama').val($dnama);
    $('#EditDokTanggal').val($dtanggal);
    $('#EditDokKelamin').val($dkelamin);
    $('#EditDokAlamat').val($dalamat);
    $('#EditDokAgama').val($dagama);
    $('#EditDokStatus').val($dstatus);
    $('#EditDokNegara').val($dwnegara);
    $('#EditDokDepartemen').val($ddepartemen);
    }
    function deletedokter($deldid,$deldnama){
    $('#DeleteDokID').val($deldid);
    $('#DeleteDokNama').val($deldnama);
    }
    
    function validate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
</html>