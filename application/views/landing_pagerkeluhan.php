<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CRM V1</title>
    <!-- plugin css for this page -->
    <link
      rel="stylesheet"
      href="<?php echo base_url().'assets/landing_page/' ?>assets/vendors/mdi/css/materialdesignicons.min.css"
    />
    <link rel="stylesheet" href="<?php echo base_url().'assets/landing_page/' ?>assets/vendors/aos/dist/aos.css/aos.css" />
    <link
      rel="stylesheet"
      href="<?php echo base_url().'assets/landing_page/' ?>assets/vendors/owl.carousel/dist/assets/owl.carousel.min.css"
    />
    <link
      rel="stylesheet"
      href="<?php echo base_url().'assets/landing_page/' ?>assets/vendors/owl.carousel/dist/assets/owl.theme.default.min.css"
    />
    <!-- End plugin css for this page -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url().'assets/' ?>assets/img/favicon.ico"/>
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/landing_page/' ?>assets/css/style.css">
    <!-- endinject -->

		<link href="<?php echo base_url().'assets/' ?>plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <div class="container-scroller">
      <div class="main-panel">
        <header id="header">
          <div class="container">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="d-flex justify-content-between align-items-center navbar-top">
                 
                <div>
                  <a class="navbar-brand" href="#"
                    ><img src="<?php echo base_url().'assets/landing_page/' ?>assets/images/logo2.png" alt=""
                  /></a>
                </div>
                <div class="d-flex">
                  <ul class="navbar-right"> 
                    <li>
                      <a href="<?php echo base_url()."/landingpage/keluhan"?>">KELUHAN</a>
                    </li>
					<li>
                      <a href="<?php echo base_url()."auth"?>">LOGIN</a>
                    </li>
                  </ul> 
                </div>
              </div> 
            </nav>

            <!-- partial -->
          </div>
        </header>
        <div class="container">
          <br>
          <div class="editors-news">
            <div class="row">
              <div class="col-lg-4">
                <div class="d-flex position-relative float-left">
                  <h3 class="section-title">Keluhan Konsinyasi</h3>
                </div>
              </div>
            </div>
            <div class="row"> 
							<div class="col-md-12">
								<div class="card"> 
									<div class="card-body">
										<form action="<?php echo base_url()."/landingpage/rkeluhanAdd?"?> " method="post">
											<div class="form-group">
												<input name="tiket" type="email" class="form-control" placeholder="tiker" readonly required autofocus value="<?php echo $tiket ?>">
											</div>
											<div class="form-group">
												<textarea name="keterangan" id="" cols="30" rows="10" class="form-control" placeholder="Tulis isi laporan disini..." required></textarea>
											</div> 
											<button type="submit" class="btn btn-primary">KIRIM PENGADUAN</button>
										</form>
									</div>
								</div> 
						</div>
          </div> 
        </div>
        <!-- main-panel ends -->
        <!-- container-scroller ends -->

        <!-- partial:partials/_footer.html -->
        <footer>
          <div class="container"> 
            <div class="row">
              <div class="col-sm-12">
                <div class="d-flex justify-content-between">
                  <img src="<?php echo base_url().'assets/landing_page/' ?>assets/images/logo2.png" class="footer-logo" alt="" />

                  <div class="d-flex justify-content-end footer-social">
                    <h5 class="m-0 font-weight-600 mr-3 d-none d-lg-flex">Ikuti Kami</h5>
                    <ul class="social-media">
                      <li>
                        <a href="#">
                          <i class="mdi mdi-instagram"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="mdi mdi-facebook"></i>
                        </a>
                      </li> 
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div
                  class="d-lg-flex justify-content-between align-items-center border-top mt-5 footer-bottom"
                >
                   
                  <p class="font-weight-medium">
                    © 2022 PT Cipta Niaga Semesta (Mayora Group) Cabang Lampung Utara
                  </p>
                </div>
              </div>
            </div>
          </div>
        </footer>

        <!-- partial -->
      </div>
    </div>
    <!-- inject:js -->
    <script src="<?php echo base_url().'assets/landing_page/' ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="<?php echo base_url().'assets/landing_page/' ?>assets/vendors/owl.carousel/dist/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="<?php echo base_url().'assets/landing_page/' ?>assets/js/demo.js"></script>
    <!-- End custom js for this page-->

		<script src="<?php echo base_url().'assets/' ?>plugins/notification/snackbar/snackbar.min.js"></script>
  </body>
</html>

<?php 
if($this->session->userdata('message') <> ''){ 
    if($this->session->userdata('info')==1){
        echo "<script>
                    Snackbar.show({
                        text: '".$this->session->userdata('message')."',
                        actionTextColor: '#fff',
                        backgroundColor: '#8dbf42'
                    });
                </script>";
    }else{
        echo "<script>
                    Snackbar.show({
                        text: '".$this->session->userdata('message')."',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a'
                    });
                </script>";
    } 
}
?>
