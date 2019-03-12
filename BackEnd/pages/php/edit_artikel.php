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
  $id = $_GET['id'];
  $result = mysqli_query($mysqli, "SELECT * FROM artikel WHERE id=$id");
  while($data = mysqli_fetch_array($result))
  {
	$judul = $data['judul'];
	$artikel = $data['artikel'];
  }
?>

<html>
<head>
  <title>Doctor Asistant - Edit Article</title>
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
			Edit Artikel Kesehatan
			<small>Tips Kesehatan</small>
		</h1>
		
		<ol class="breadcrumb">
			<li><a href="index.php?p=home"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Edit Article</li>
		</ol>
	</section>
    <section class="content">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Content Article</h3>
            </div>
            <div class="box-body pad">
                <form role="form" name="artikelform" method="post">
                    <input type="text" name="edjudart" placeholder="Judul Artikel" style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required value="<?php echo $judul?>">
                    <br><br>
                    <textarea class="textarea" name="edart" placeholder="Masukkan Artikel .." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required><?php echo $artikel?>
                    </textarea>
                    <div class="pull-right">
                        <input type="hidden" value="<?php echo $_GET['id']?>" name="eid">
                        <button type="submit" name="update" class="btn btn-primary">Edit Artikel</button>
                    </div>
                </form>
                <?php
                    if(isset($_POST['update']))
	                {	
                    $id = $_POST['eid'];
	                $judul = $_POST['edjudart'];
                    $artikel = $_POST['edart'];
	                // update user data
                    $result = mysqli_query($mysqli, "UPDATE artikel SET judul ='$judul', artikel='$artikel' WHERE id=$id");
                    echo "<meta http-equiv='refresh' content='0'>";
                    echo "<script type='text/javascript'> 
                    alert('Artikel telah di edit');
                    window.location.href = 'index.php?p=artikel'
                    </script>";
	                }
                ?>
            </div>
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
</html>