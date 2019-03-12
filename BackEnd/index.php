<?php 
	session_start();
	
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
	
	include_once("pages/php/doctor_db.php");
	$result = mysqli_query($mysqli, "SELECT * FROM admin");
	while($user_data = mysqli_fetch_array($result))
		{
			$username = $user_data['username'];
		}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- icon-->
  <link rel="icon" type="image/png" href="dist/img/logo.png"/>
  <!-- Pagination -->
  <link rel="stylesheet" href="dist/css/simplePagination.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-stethoscope"></i></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Doctor</b>Asistant</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/logo-o.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $username;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="background: url('dist/img/about.jpg') center center;">
                <img src="dist/img/logo-o.png" class="img-circle" alt="User Image">
                <p style="color: #3c8dbc; text-shadow: 0 0 15px #;" >
                  <?php echo $username;?>
                  <small>Admin</small>
                </p>
              </li>              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="index.php?p=admin&id=1" class="btn btn-info btn-flat">Admin</a>
                </div>
                <div class="pull-right">
                  <a href="login/logout.php" class="btn btn-info btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><i class="fa fa-dashboard"></i> &ensp; Dashboard</li>
		    <li><a href="index.php?p=home"><i class="fa fa-television"></i> <span>Halaman Utama</span></a></li>
			<li><a href="index.php?p=daftar"><i class="fa fa-user-plus"></i> <span>Daftar Antrian</span></a></li>
            <li><a href="index.php?p=pasien"><i class="fa fa-wheelchair"></i> <span> Daftar Pasien</span></a></li>
        	<li><a href="index.php?p=history"><i class="fa fa-newspaper-o"></i> <span>Riwayat Antrian</span></a></li>
          
		<li class="header"><i class="fa fa-users"></i> &ensp; Administration</li>
            <li><a href="index.php?p=doctor"><i class="fa fa-heartbeat"></i> <span>Daftar Dokter</span></a></li>
            <li><a href="index.php?p=departemen"><i class="fa fa-hospital-o"></i> <span>Departemen</span></a></li>
            <li><a href="index.php?p=artikel"><i class="fa fa-map"></i> <span>Artikel Kesehatan</span></a></li>
		            
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div id="konten">
    	<?php
		$pages_dir = 'pages/php';
		if(!empty($_GET['p'])){
			$pages = scandir($pages_dir, 0);
			unset($pages[0], $pages[1]);
 
			$p = $_GET['p'];
			if(in_array($p.'.php', $pages)){
				include($pages_dir.'/'.$p.'.php');
			} else {
				echo 'Halaman tidak ditemukan! :(';
			}
		} else {
			include($pages_dir.'/home.php');
		}
		?>
    </div>
	
  </div>
    
  <!-- /.content-wrapper -->
  <footer class="main-footer">   
    <strong>Rebuild 2018 <a href="#">Doctor Asistant</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Pagination -->
<script src="dist/js/jquery.simplePagination.js"></script>
<!--AutoNik-->
<script>
    $('#AntrianNama').change(function(){
        var terpilih = $('#AntrianNama').val();
        $('#AntrianPassID').val(terpilih);
        });
    
    $('#BookingNama').change(function(){
        var terpilih = $('#BookingNama').val();
        $('#BookingPassID').val(terpilih);
        });
    
    $("#q").datepicker({ 
        format: 'yyyy-mm-dd'
    });
</script>
</body>
</html>