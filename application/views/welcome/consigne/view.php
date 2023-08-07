<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="<?php echo base_url().'assets/' ?>assets/css/elements/breadcrumb.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/' ?>plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url().'assets/' ?>assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />  
<link href="<?php echo base_url().'assets/' ?>plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/' ?>assets/css/elements/alert.css">
<link href="<?php echo base_url().'assets/' ?>assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/' ?>plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />


<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES --> 

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-chart-one"> 
        <div class="widget-content"> 
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
         Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> (<?php echo base64_decode($this->session->userdata('nama_ConsigneSes'))?>)</li>
                </ol> 
            </nav>  
            <br>
            <div class="motifasixpeng">
                <div class="text-center">
                <div class="spinner-grow text-info align-self-center"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-chart-one"> 
        <div class="widget-content"> 
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                 Form Keluhan / Nama Consignee : <?php echo base64_decode($this->session->userdata('nama_ConsigneSes'))?>
            </nav>  
            <hr>
            <br> 
            <form enctype='multipart/form-data' action="<?php echo base_url().'consigne/add' ?>" method="post">
                <div class="form-row mb-4"> 
                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Nomor Handphone</label>
                        <input name="nohandpone" type="text" class="form-control" id="inputState3"  
                        value = "<?php echo base64_decode($this->session->userdata('nohandpone_ConsigneSes'))?>"
                        placeholder="Nomor Handphone"> 
                    </div> 

                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Email</label>
                        <input name="email" type="email" class="form-control" id="inputState3" 
                        placeholder="Email"> 
                    </div>  

                    <div class="form-group col-md-12">
                        <label for="inputAddress3">Keluhan</label>
                        <textarea  name="alamat" class="form-control" id="inputState3"></textarea> 
                    </div>  
                </div>

                <button type="submit" class="btn btn-primary submit-fn">Submit</button>
                <button class="btn btn-default submit-fn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
            </form>
        </div>
    </div>
</div>

  
 

<script>
  

    $.ajax({
        url: '<?php echo base_url()?>consignehome/motifasi',
        type: 'post',   
        async: true, 
        success: function(response){  
            $('.motifasixpeng').html(response);
        },  
    }) 
 

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
</script>