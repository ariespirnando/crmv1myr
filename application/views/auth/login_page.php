<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">
    <title>CRM SIK</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url().'assets/' ?>assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url().'assets/' ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/' ?>assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/' ?>assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/' ?>assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/' ?>assets/css/forms/switches.css">
    <link href="<?php echo base_url().'assets/' ?>plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/' ?>assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/' ?>plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
    <style>
        .responsive-image {  width: 100%;  height: auto; } 
    </style>

    <style>
        h4.modal-title { color: #000; }
        .modal-content {
            border: none;
            box-shadow: 0px 0px 15px 1px #ebedf2;
            border: 1px solid #bfc9d4;
        }
        .modal-body { text-align: center; }
        .modal-body p {
            color: #3b3f5c;
            font-weight: 600;
            margin-bottom: 0; }
        p span.countdown-holder { color: #e7515a; font-size: 18px; }
        .modal-footer { border: none; }
        .progress {
            width: 50%;
            margin: 0 auto;
            border-radius: 30px;
            height: 10px;
        }
        .modal-backdrop { background-color: #fff; }
        @media (min-width: 576px) { .modal-dialog { max-width: 350px; } }
    </style>

</head>
<body class="form  a-u-reload">
    

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content"> 
                        <h1 class="">Aplikasi <span class="brand-name">CRM</span></h1> 
                        <p class="signup-link"> Sistem Informasi Konsiyasi PT Mayora Lampung Utara</p>
                        <form class="text-left" > 
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username">
                                </div>

                                <div id="password-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                    
                                    <div class="d-sm-flex justify-content-between">
                                        <div class="field-wrapper toggle-pass">
                                             
                                        </div>
                                        <div class="field-wrapper">
                                        <a href="<?php echo base_url().'auth/passrecov'?>">Lupa Password ?</a>
                                        </div> 
                                    </div>
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <?php echo $image?>
                                </div> 

                                <div class="field-wrapper input mb-2 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-codesandbox"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline><polyline points="7.5 19.79 7.5 14.6 3 12"></polyline><polyline points="21 12 16.5 14.6 16.5 19.79"></polyline><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                <input id="captca" name="captca" type="captca" class="form-control" placeholder="Captcha">
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Tampilkan Password</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <span onclick="login()" class="btn btn-primary">Log In</span>  
                                    </div> 
                                </div>

                                 

                                <div class="field-wrapper">
                                    
                                </div>

                            </div>
                        </form>                        
                        <p class="terms-conditions">© 2022 All Rights Reserved | di PT Cipta Niaga Semesta (Mayora Group) Cabang Lampung utara</p> 
                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>

         
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo base_url().'assets/' ?>assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url().'assets/' ?>bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url().'assets/' ?>bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo base_url().'assets/' ?>assets/js/authentication/form-1.js"></script>
    <script src="<?php echo base_url().'assets/' ?>plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?php echo base_url().'assets/' ?>plugins/blockui/jquery.blockUI.min.js"></script>  
    <script src="<?php echo base_url().'assets/' ?>assets/js/authcustom.js"></script>
</body>
</html>
<?php 
if($this->session->userdata('message') <> ''){ 
    echo "<script>
            Snackbar.show({
                text: '".$this->session->userdata('message')."',
                actionTextColor: '#fff',
                backgroundColor: '#e7515a',
                pos: 'top-right'
            });
        </script>"; 
}
?>
<script>

function login(){ 
    var pass = $('#password').val();
    var user = $('#username').val();
    var capc = $('#captca').val(); 
    var time = 2500;
    if(pass!="" && user!=""){  
        if(capc!=""){ 
            var password = pass.trim();
            var username = user.trim();  
            var captca   = capc.trim();   
            $.ajax({
                url: '<?php echo base_url()?>'+window.atob('YXV0aC9sb2dpbg=='),
                type: 'post', 
                dataType: "json",
                data: {
                        "username":username,
                        "password":password,
                        "captca":captca,
                    }, 
                success: function(data,response){
                    if(data.isauth == 1){
                        login_failure3()
                    }else if(data.isauth == 2){
                        login_failure2() 
                    }else{
                        location.replace('<?php echo base_url() ?>'+data.module);
                    } 
                },
                beforeSend: function() { 
                    reload(time); 
                },  
                error: function(){
                    login_failure2()
                },
                timeout: time 
            }) 
        }else{
            login_failure4();
        }



    }else{
        login_failure1();
    }
}
 
</script>
<!-- 
<script src="<?php echo base_url().'assets/' ?>locking_browser.js"></script> -->