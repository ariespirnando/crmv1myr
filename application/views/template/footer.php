    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo base_url().'assets/' ?>assets/js/components/session-timeout/bootstrap-session-timeout.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
     
    
    <!-- <script> 
    $(document).ready(function() { 
        var width  = $(window).width(); 
        if(width>=1000){
            $('.clickok').trigger('click');
        } 
    })
    </script> -->
    
    <script> 
    var unloadHandler = function(e){
        $.ajax({
            url: '<?php echo base_url()?>error404/clear', 
            async: true,
            type: 'post'
        })
    };
    window.unload = unloadHandler;


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

</body>
<!-- <script src="<?php echo base_url().'assets/' ?>locking_browser.js"></script> -->
</html>