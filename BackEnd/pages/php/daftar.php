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
  $dokter = query("SELECT * FROM dokter");
?>
<head>    
    <title>Doctor Asistant - Daftar</title>
</head>
<body>
	<section class="content-header">
		<h1>
			Daftar Antrian
			<small>Daftar Dokter</small>
		</h1>
		
		<ol class="breadcrumb">
			<li><a href="index.php?p=home"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Daftar</li>
		</ol>
	</section>
	<section class="content">	
    <?php foreach ($dokter as $row) : ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
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
            echo "<a href='index.php?p=daftar_antrian&id=$row[id]' class='small-box-footer'>Form Antrian <i class='fa fa-chevron-circle-right'></i></a>";
			?>
		  </div>
        </div>	
    <?php endforeach; ?>    
	 <div class="row">	
	  <div class="col-md-6">
	   </div>
	  </div>
	</section>
</body>