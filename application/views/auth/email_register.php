<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">
    <title>Aplikasi PJJ | SMA Negeri 2 Bekasi  </title>
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
    <style>
        .responsive-image {  width: 100%;  height: auto; } 
    </style>
</head>
<body class="form">
    

    <div class="form-container">
        <div class="form-form a-u-reload">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content"> 
                        <h1 class="">Aplikasi <span class="brand-name">PJJ</span></h1>
                        <p class="signup-link">SMA Negeri 2 Bekasi</a></p>  
                        <form class="text-left" >
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass"> 
                                    </div>
                                    <div class="field-wrapper">
                                        <a href="<?php echo base_url().'auth/logout' ?>">
                                        <span class="btn btn-danger" value="">Log Out</span>
                                        </a>
                                        <span onclick="validasi()" class="btn btn-primary" value="">Register Email</span> 
                                    </div>
                                    
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

     <!-- BEGIN PAGE LEVEL PLUGINS -->
     <script src="<?php echo base_url().'assets/' ?>assets/js/components/session-timeout/bootstrap-session-timeout.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    
</body>
</html>

<script>
function validasi(){ 
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var email = $('#email').val();  
    var time = 2500;
    if(email.match(mailformat)){
        $.ajax({
            url: '<?php echo base_url()?>'+'auth/addemail',
            type: 'post', 
            dataType: "json",
            data: {
                    "email":email, 
                    "dyx": "<?php echo $dyx ?>", 
                  }, 
            success: function(data,response){
                if(data.ismail == 2){
                    sendemail(email);
                    location.replace('<?php echo base_url() ?>'); 
                }else if(data.ismail == 1){
                    login_failure6();
                }else{
                    login_failure7();
                } 
            },
            beforeSend: function() { 
                reload(time); 
            },  
            error: function(){
                login_failure6()
            },
            timeout: time 
        }) 
    }else{
        login_failure5();
        clearemail();
    }
     
}

function sendemail(email){
    $.ajax({
            url: '<?php echo base_url()?>'+'auth/sendmailemail',
            type: 'post', 
            dataType: "json",
            async : false,
            data: {
                    "email":email, 
                    "itipe":1, 
            },
        }
    );
}

function clearemail(){
    $('#email').val("");
}

Snackbar.show({
    text: 'Email belum terdaftar, silahkan register terlebih dahulu',
    actionTextColor: '#fff',
    backgroundColor: '#e7515a',
    pos: 'top-right'
});  


var SessionTimeout=function() {
    var e=function() {
        $.sessionTimeout( {
            title:"Session Timeout Notification", 
            message:"Your session is about to expire.", 
            keepAliveUrl:"", 
            redirUrl:"<?php echo base_url().'error404/clear' ?>", 
            logoutUrl:"<?php echo base_url().'error404/clear' ?>", 
            warnAfter:900e3,  
            redirAfter:916e3, 
            ignoreUserActivity:!0, 
            countdownMessage:"Redirecting in {timer}.", 
            countdownBar: !0
        }
        )
    };
    return {
            init:function() {
                e()
            }
        }
    } 
    ();
    jQuery(document).ready(function() {
        SessionTimeout.init()
    }
    );

</script>

<script src="<?php echo base_url().'assets/' ?>locking_browser.js"></script>