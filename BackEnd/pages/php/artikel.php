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
  //$result = mysqli_query($mysqli, "SELECT * FROM dokter order by nama ASC");
?>

<html>
<head>
  <title>Doctor Asistant - Article</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
 
<body>
	<section class="content-header">
		<h1>
			Health Article
			<small>Tips Kesehatan</small>
		</h1>
		
		<ol class="breadcrumb">
			<li><a href="index.php?p=home"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Article</li>
		</ol>
	</section>
    <section class="content">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Content Article</h3>
            </div>
            <div class="box-body pad">
                <form role="form" name="artikelform" method="post">
                    <input type="text" name="tamjudart" placeholder="Judul Artikel" style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>
                    <br><br>
                    <textarea class="textarea" name="tamart" placeholder="Masukkan Artikel .." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>
                    </textarea>
                    <div class="pull-right">
                        <button type="submit" name="Tambah" class="btn btn-primary">Tambah Artikel</button>
                    </div>
                </form>
                <?php
                if(isset($_POST['Tambah']))
	            {
	            $judul = $_POST['tamjudart'];
                $artikel = $_POST['tamart'];
                    
	            $result = mysqli_query($mysqli, "INSERT INTO artikel (judul,artikel) VALUES ('$judul','$artikel')");
                echo "<meta http-equiv='refresh' content='0'>";
	            }
                ?>  
            </div>
        </div>
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Manajemen Artikel</h3>
            </div>
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped"> 
			         <tr>
				        <th>Judul</th> 
				        <th>Artikel</th>
                        <th>Update</th>
			         </tr>
                     <?php $result = query ("SELECT * FROM artikel")?>
                     <?php foreach($result as $row): ?>
                     <tr>
					    <td><?php echo $row ["judul"];?></td>
                        <td><?php echo substr($row ["artikel"], 0, 20);?></td>
                        <td>
                            <?php echo "<a href='index.php?p=edit_artikel&id=$row[id]'><button type='button' class='btn btn-primary'>
                                    <i class='fa fa-gears'></i></button></a>"?>
                            <button type="submit" name="Delete" class="btn btn-danger"data-toggle="modal" data-target="#modal-danger"
				                onclick="deleteartikel('<?php echo $row['id']?>')"><i class="fa fa-remove"></i>                            
                            </button>
                        </td>
                     </tr>
                     <?php endforeach; ?>
                </table>
            </div>
        </div>
        
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
                    <label for="DeleteArtikel">Hapus Artikel</label>
                    <input type="hidden" class="form-control" id="DeleteArtikel" name="id">
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
        $result = mysqli_query($mysqli, "DELETE FROM artikel WHERE id=$id");
        echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>
 </div>
        
    </section>
</body>
<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="../../bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<script type="text/javascript">
    function deleteartikel($delaid){
    $('#DeleteArtikel').val($delaid);
    }
</script>
</html>