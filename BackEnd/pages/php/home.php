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
$dokter = mysqli_query($mysqli, "SELECT dokter.nama, antrian.id_dokter, dokter.departemen FROM antrian, dokter WHERE antrian.id_dokter=dokter.id GROUP BY id_dokter");
// Fetch all users data from database

?>
<head>    
    <title>Doctor Asistant - Home</title>
</head>
<body>
    <section class="content-header">
		<h1>
			Dashboard Antrian
			<small>Antrian Pasien</small>
		</h1>
		
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i> Home</li>
		</ol>
	</section>
    <section class="content">
    <div class="row">
    <?php while ($data = mysqli_fetch_array($dokter)){
    ?>
        <div class="col-md-6">
        	<div class="box box-solid box-primary">
        		<div class="box-header">
        			<?php $iddok= $data["id_dokter"]; ?>
					<h3 class="box-title"><?= $data["departemen"]; ?></h3>
					<div class="pull-right">
                        <h5><?= $data["nama"]; ?></h5>
                    </div>
				</div>
				<div class="box-body">
				<?php
				$result = mysqli_query($mysqli, "SELECT antrian.id AS antid, antrian.status, pasien.nama AS namapasien, antrian.id_pasien
                FROM antrian, pasien
                WHERE antrian.id_dokter=$iddok AND antrian.id_pasien=pasien.id AND DATE(waktu)=CURDATE()");
				?>
              	<table class="table table-bordered"> 
					<tr>
						<th>No</th>
						<th>NAMA PASIEN</th>
						<th>STATUS</th>
						<th>AKSI</th>
					</tr>
			        <?php
				        $no=0;
				        while($data = mysqli_fetch_array($result)){
				        	if ($no <= 50) {
				        		$no+=1;
			        ?>
			        <tr>
			            <td><?php echo $no;?></td>
			            <td><?php echo $data["namapasien"];?></td>
			            <td><?php echo $data["status"];?></td>
			            <td>
                            <form role="form" action="" method="post" name="form1">
                                <input class="hidden" name="idpasant" value="<?php echo $data['antid']?>">
                                <button type='button' class='btn btn-danger' data-toggle="modal" data-target="#modal-danger"
				                    onclick="deleteantrian ('<?php echo $data['antid']?>')">
                                        <i class='fa fa-remove'></i>
				                </button>
                                <button type="submit" name="Update" class="btn btn-warning"><i class="fa fa-stethoscope" ></i></button>
                                <button type="submit" name="Done" class="btn btn-success"><i class="fa fa-check" ></i></button>
                            </form>
			            </td>
			        </tr>
			        <?php
							} 
						}
						
					?>
                    <?php
                    if(isset($_POST['Update']))
	                {	
	                $idup = $_POST['idpasant'];
					$upstats1 = "Periksa";
	                // update user data
	                $results = mysqli_query($mysqli, "UPDATE antrian SET status ='$upstats1' WHERE id=$idup");
                    echo "<meta http-equiv='refresh' content='0'>";
					}
					if(isset($_POST['Done']))
	                {	
	                $idup = $_POST['idpasant'];
					$upstats2 = "Selesai";
	                // update user data
	                $results = mysqli_query($mysqli, "UPDATE antrian SET status ='$upstats2' WHERE id=$idup");
                    echo "<meta http-equiv='refresh' content='0'>";
					}
                    ?>       
				</table>
            	</div>
      		</div>
        </div>
    <?php }?>
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
                    <label for="DeleteAntrian">Hapus Data?</label>
                    <input type="hidden" class="form-control" id="DeleteAntrian" name="id">
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
        $result = mysqli_query($mysqli, "DELETE FROM antrian WHERE id=$id");
        echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>
 </div>
    </section>
</body>
<script type="text/javascript">
    function deleteantrian($delaid){
    $('#DeleteAntrian').val($delaid);
    }
</script>