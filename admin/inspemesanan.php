 <?php 

  include "includes/config.php";

  ob_start();
  session_start();
  if(!isset($_SESSION['admin_id'])) {
    header("location:login.php");
  }
  
  
	if(isset($_POST['Simpan'])) {
		$no_pemesanan = $_REQUEST["inputanpemesanan"];
		$tglpesan = $_REQUEST["inputantglpesan"];
		$namakurir = $_REQUEST["inputankurir"];
		$namabank = $_REQUEST["inputanbank"];
		$metodebayar = $_REQUEST["inputanmetode"];
		mysqli_query($connection, "INSERT INTO pemesanan VALUES ('', '$tglpesan', '$namakurir', '$namabank', '$metodebayar')");


		header("location:pemesanan.php");
	}	
	

	$query1 = mysqli_query($connection, "SELECT * FROM kurir");
	$query2 = mysqli_query($connection, "SELECT * FROM bank");
	$query3 = mysqli_query($connection, "SELECT * FROM metode_bayar");



  ?>


<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Yatta Corporation | Tambah Pemesanan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
		

  <meta charset="utf-8" />
  <title>Multipl jQuery UI Datepicker in a HTML page</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
 
  <link rel="stylesheet" href="/resources/demos/style.css" />
 
  <style>
    .datepicker{
     
    }
  </style>
 
  <script>
  $(function() {
    $( ".datepicker" ).datepicker(
    {
    dateFormat: "yy-mm-dd",
    numberOfMonths: [1, 1],
    }
      );
  });
  </script>		



  </head>
  
  
  
  
  <body>
    <!-- Side Navbar -->
    <?php include "includes/sidebar.php" ?>

    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.php" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span></span><strong class="text-primary">Yatta Corporation</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
 
                <!-- Log out-->
                <li class="nav-item"><a href="logout.php" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
	  
	  <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Data Customer </li>
            <li class="breadcrumb-item active">Pemesanan </li>
			<li class="breadcrumb-item active">Tambah Pemesanan </li>
          </ul>
        </div>
      </div>

          <!-- Forms Section-->
          
			<section class="forms">
				  <form method="POST" enctype="multipart/form-data">
				  <div class="container-fluid">


            <div class="form-group row">
            <label for="datepicker" class="col-sm-3 col-form-label">Tanggal Pemesanan</label>
            <div class="col-sm-6">
              <input type="text" class="datepicker" 
                name="inputantglpesan" placeholder="yyyy-mm-dd" autocomplete="off">
            </div>
            </div>


                    <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Nama Kurir</label>
                      <div class="col-sm-4 mb-3">
                        <select name="inputankurir" class="form-control">
						<option value="NULL">Pilih Kurir</option>
						<?php if (mysqli_num_rows($query1) > 0) {?>
						<?php while($row = mysqli_fetch_array($query1)) {?>
						  <option value="<?php echo $row["kd_kurir"]?>">
						  <?php echo $row["nm_kurir"];?>
						  </option>
						<?php }?>
						<?php }?>
                        </select>
                      </div>
                    </div>
					
                    <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Nama Bank</label>
                      <div class="col-sm-4 mb-3">
                        <select name="inputanbank" class="form-control">
						<option value="NULL">Pilih Bank</option>
						<?php if (mysqli_num_rows($query2) > 0) {?>
						<?php while($row = mysqli_fetch_array($query2)) {?>
						  <option value="<?php echo $row["kd_bank"]?>">
						  <?php echo $row["nm_bank"];?>
						  </option>
						<?php }?>
						<?php }?>
                        </select>
                      </div>
                    </div>
					
                    <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Metode Pembayaran</label>
                      <div class="col-sm-4 mb-3">
                        <select name="inputanmetode" class="form-control">
						<option value="NULL">Pilih Metode Pembayaran</option>
						<?php if (mysqli_num_rows($query3) > 0) {?>
						<?php while($row = mysqli_fetch_array($query3)) {?>
						  <option value="<?php echo $row["kd_mtd_bayar"]?>">
						  <?php echo $row["jns_mtd_bayar"];?>
						  </option>
						<?php }?>
						<?php }?>
                        </select>
                      </div>
                    </div>
			

					   <div class="form-group row">
					  <div class="col-sm-3">
					  </div>
					  <div class="col-sm-9">
						<input type="submit" class="btn btn-primary" value="Simpan" name="Simpan">
						<a href="pemesanan.php" style="margin-left: 10px; text-decoration: none; color: #0f2c7d">Cancel</a>
					  </div>
					  </div>
				</div>
			</form> 

		  </section>



      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Yatta Corp &copy; <?php echo date('Y')?></p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="https://bootstrapious.com/p/bootstrap-4-dashboard" class="external">Bootstrapious</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>

    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/charts-home.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
	
	
<meta charset="utf-8">
<title>jQuery UI Datepicker2 - Default functionality</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
    $(function() {
        $( "#datepicker2" ).datepicker2();
    });
</script>
	
	
  </body>
</html>

    <?php
mysqli_close($connection);
ob_end_flush();
?>