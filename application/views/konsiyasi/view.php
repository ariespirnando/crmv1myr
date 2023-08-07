<!--  BEGIN CUSTOM STYLE FILE  -->
<link href="<?php echo base_url().'assets/' ?>assets/css/elements/custom-pagination.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/' ?>assets/css/elements/miscellaneous.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/' ?>assets/css/elements/breadcrumb.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/' ?>assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/' ?>plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
<!--  END CUSTOM STYLE FILE  --> 
<link href="<?php echo base_url().'assets/' ?>plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />


<div class="col-xl-12 col-lg-12 col-sm-12 col-12 layout-spacing"> 
    <div class="widget-content widget-content-area br-6">  
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Konsinyasi</li> 
        </ol> 
    </nav>  
      
     
    <hr>  
 
    <form action="<?php echo base_url().'konsiyasi' ?>" method="post"> 
    <div class="input-group mb-4">
        <input name='search' type="text" class="form-control" placeholder="Cari Data" aria-label="Cari Data" value="<?php echo $search ?>">
        <div class="input-group-append"> 
        <button class="btn btn-outline-warning" type="submit" name='submit' value="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>   
        <?php 
            if($search!=''){
            ?>
                <button class="btn btn-outline-warning" type="submit" name='reset' value="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>   
            <?php
            }
        ?> 
        </div>
    </div>  
    </form>  
        <div class="table-responsive mb-4 mt-4">
            <table class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                    <th class="text-center"> </th>
                        <th>Kode</th> 
                        <th>Nama Consigne</th> 
                        <th>No Hp</th>   
                        <th>Status</th>  
                        <th class="text-center" colspan="3">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = $page+1;
                    foreach($dataconsigne as $d){ 
                ?>
                    <tr>
                        <td class="text-center"><?php echo $no?></td>
                        <td><?php echo $d['kode_consigne']?> </td> 
                        <td><?php echo $d['nama_consigne']?></td>
                        <td><?php echo $d['nohandpone']?></td> 
                        <td><?php echo $d['status']?></td> 
                         
                        <td class="text-center"> 
                            <a href="<?php echo base_url().'konsiyasi/view_produk/'.$d['guid_consigne'] ?>">
                            <span  onclick="view_edit('<?php echo $d['guid_consigne']?>')" class="btn btn-outline-warning"  data-toggle="modal" data-target=".bd-edit-lg4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </span>  
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo base_url().'konsiyasi/add_produk/'.$d['guid_consigne'] ?>">
                            <span  class="btn btn-outline-primary"  data-toggle="modal" data-target=".bd-edit-lg2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                            </span>  
                            </a>
                        </td>  
                    </tr>
                <?php 
                    $no++;
                    }
                ?>  
            </table> 
        </div> 
        <div class="pagination-custom_outline"> 
            <?php echo $pagination; ?> 
        </div>
    </div>
</div>

<?php $this->load->view('consigne/modal_add') ?>


<div class="modal fade bd-edit-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Add Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="clearbody"><div class="loader dual-loader mx-auto"></div></div>
            </div>
        </div>
    </div>
</div>
 

<div class="modal fade bd-edit-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Lihat Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="clearbody2"><div class="loader dual-loader mx-auto"></div></div>
            </div>
            <div class="modal-footer"> 
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Keluar</button> 
            </div>
        </div>
    </div>
</div>
 

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url().'assets/' ?>assets/js/scrollspyNav.js"></script> 
<script src="<?php echo base_url().'assets/' ?>plugins/notification/snackbar/snackbar.min.js"></script>
<script src="<?php echo base_url().'assets/' ?>assets/js/forms/bootstrap_validation/bs_validation_script.js"></script> 
<!-- END PAGE LEVEL SCRIPTS -->

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

<script>
function load_edit(q){
    $.ajax({
        url: '<?php echo base_url()?>konsiyasi/loadedit',
        type: 'post', 
        data: "q="+q, 
        success: function(response){
            $('.clearbody').html(response); 
        }   
    })
} 

function view_edit(q){
    $.ajax({
        url: '<?php echo base_url()?>konsiyasi/loadview',
        type: 'post', 
        data: "q="+q, 
        success: function(response){
            $('.clearbody2').html(response); 
        }   
    })
} 

 
</script>

 

