 <?php 

  include "includes/config.php";

  ob_start();
  session_start();
  if(!isset($_SESSION['admin_id'])) {
    header("location:login.php");
  }
  
  
$nopemesanan = $_GET['nopemesanan'];

  if(isset($_POST['Tambah'])) {
    $nopemesanan = $_GET['nopemesanan'];
    $idproduk = $_REQUEST["inputonidproduk"];
    $qtypemesanan = $_REQUEST["inputonqtypemesanan"];

	
    mysqli_query($connection, "INSERT INTO detil_produk_pemesanan VALUES ('$nopemesanan', '$idproduk', '$qtypemesanan')");
    header("location:detilpemesanan.php?nopemesanan=$nopemesanan");
  }
	
 $query = mysqli_query($connection, "SELECT * FROM pemesanan WHERE no_pemesanan = '$nopemesanan'");
 $query1 = mysqli_query($connection, "SELECT * FROM produk");
 $query2 = mysqli_query($connection, "SELECT * FROM detil_produk_pemesanan dpp, produk p WHERE dpp.id_produk = p.id_produk");

 $row1 = mysqli_fetch_array($query1);
 $row2 = mysqli_fetch_array($query);
	
 


  ?>


<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Yatta Corporation</title>
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
			<li class="breadcrumb-item active">Detil Pemesanan </li>
          </ul>
        </div>
      </div>

          <!-- Forms Section-->
          
			<section class="forms">
				  <form method="POST" enctype="multipart/form-data">
				  <div class="container-fluid">
					
					 No. Pemesanan  : <?php echo $nopemesanan ?> <br>
					 
					 
					 
					<div class="form-group row">
					  <label for="namaproduk" class="col-sm-3 col-form-label">Nama Produk</label>
					  <div class="col-sm-6">
					  <select name="inputonidproduk" id="namaproduk" class="form-control"  onchange="price()">
						<option value="NULL">Nama Produk</option>
						<?php if (mysqli_num_rows($query1) > 0) {?>
						<?php while($row = mysqli_fetch_array($query1)) {?>
						  <option value="<?php echo $row["id_produk"]?>">
						  <?php echo $row["nm_produk"]?>
						  </option>
						<?php }?>
						<?php }?>
					  </select>
					  </div>
					</div>					 



					  <div class="form-group row">
						<label for="qtypesan" class="col-sm-3 col-form-label">Jumlah Pesanan</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="qtypesan" name="inputonqtypemesanan" placeholder="Inputkan Jumlah Pesanan" required="">
						</div>
					  </div>
			           

					   <div class="form-group row">
					  <div class="col-sm-3">
					  </div>
					  <div class="col-sm-9">
						<input type="submit" class="btn btn-primary" value="Tambah" name="Tambah">
						<a href="pemesanan.php" style="margin-left: 10px; text-decoration: none; color: #0f2c7d">Cancel</a>
            <input type="hidden" name="nopemesanan" value="<?php echo $nopemesanan?>">
					  </div>
					  </div>
				</div>
			</form> 

			<!--Tabel Detil Jenis-->

            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Tabel Detil Pemesanan</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>No. Pemesanan</th>
                          <th>Nama Produk</th>
                          <th>Jumlah Pesanan</th>
						  <th>Action</th>
                        </tr>
                      </thead>
					  
                      <tbody>


                        <?php if(mysqli_num_rows($query2) > 0)  { ?>
                                <?php 
                                $nomor = 1;
                                 while($row = mysqli_fetch_array($query2)) { ?>
                        <tr>
                          <th scope="row"><?php echo $nomor; ?></th>
                          <td><?php echo $row["no_pemesanan"]?></td>
                          <td><?php echo $row["nm_produk"]?></td>
						  <td><?php echo $row["qty_pemesanan"]?></td>
                          <td>
                                <a href="deletedetilpemesanan.php?nopemesananhapus=<?php echo $row['no_pemesanan']?> onclick="return confirm ('Jika Anda menghapus Data ini, maka semua Data di tabel lain yang terhubung dengan Data ini akan ikut terhapus. Apakah Anda Yakin?')"> Delete </a>
                          </td>
                        </tr>

                                <?php $nomor++; } ?>
                               <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

			
		<!--End of Tabel Jenis-->
			
			


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
  </body>
</html>

    <?php
mysqli_close($connection);
ob_end_flush();
?>