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
        <li class="breadcrumb-item"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cast"><path d="M2 16.1A5 5 0 0 1 5.9 20M2 12.05A9 9 0 0 1 9.95 20M2 8V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-6"></path><line x1="2" y1="20" x2="2.01" y2="20"></line></svg> Monitoring Aktifitas</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Pegawai</li>
        </ol> 
    </nav>  
      
     
    <hr>  
 
    <form action="<?php echo base_url().'monitoring/karyawan' ?>" method="post"> 
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
                        
                        <th class="text-center">#</th>
                        <th>Kode Pegawai</th>
                        <th>NIK Pegawai</th> 
                        <th>Nama Pegawai</th> 
                        <th>Jenis Kelamin</th> 
                        <th>Role</th> 
                        <!-- <th>Username</th>  -->
                        <th>Status</th>  
                        <th class="text-center" colspan="2">Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = $page+1;
                    foreach($datakaryawan as $d){ 
                ?>
                    <tr>
                        <td class="text-center"><?php echo $no?></td>
                        <td><?php echo $d['kode_karyawan']?> </td> 
                        <td><?php echo $d['nik_karyawan']?></td>
                        <td><?php echo $d['nama_karyawan']?></td>
                        <td><?php echo $d['jenis_kelamin']?></td>
                        <td><?php echo $d['description']?></td>
                        <!-- <td><?php //echo $d['username']?></td> -->
                        <td><?php echo $d['status']?></td>  
                        <td class="text-center">
                            <span  onclick="view_edit('<?php echo $d['kode_karyawan']?>')" class="btn btn-outline-warning"  data-toggle="modal" data-target=".bd-edit-lg4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                            </span>  
                        </td>
                         
                        <td class="text-center">
                            <span onclick="send_delete('<?php echo $d['kode_karyawan']?>')" class="btn btn-outline-dark"  data-toggle="modal" data-target=".bd-edit-lg3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            </span>   
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

<?php $this->load->view('karyawan/modal_add') ?>

 
<div class="modal fade bd-edit-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Download Aktifitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body"> 
                <form enctype='multipart/form-data' action="<?php echo base_url().'monitoring/daktifitas' ?>" method="post">
                    <div class="form-row mb-4">   
                        <div class="form-group col-md-12">
                        <label for="inputState4">Bulan</label>
                            <select name="bulan" id="inputState4" class="form-control"  required>  
                            <?php 
                                    $status = array('1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni','7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
                                    foreach($status as $s=>$v){ 
                                        echo '<option value="'.$s.'">'.$v.'</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                        <label for="inputState4">Tahun</label>
                            <select name="tahun" id="inputState4" class="form-control"  required>  
                            <?php 
                                    for($i = 1; $i<= 8; $i++ ){
                                        $th = $i+2019;
                                        echo '<option value="'.$th.'">'.$th.'</option>';
                                    }
                                ?>
                            </select>
                        </div> 
                    </div> 
            </div> 
            <div class="modal-footer"> 
                <input type="hidden" class="deletevalue" name="kode_user" value=""/> 
                <button type="submit" onclick="clickclose()" class="btn btn-primary submit-fn">Download</button>
                <button class="btn btn-default submit-fn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
 

<div class="modal fade bd-edit-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">50 Aktivitas Terakhir</h5>
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
        url: '<?php echo base_url()?>karyawan/loadedit',
        type: 'post', 
        data: "q="+q, 
        success: function(response){
            $('.clearbody').html(response); 
        }   
    })
} 

function view_edit(q){
    $.ajax({
        url: '<?php echo base_url()?>monitoring/listaktifitas',
        type: 'post', 
        data: "q="+q, 
        success: function(response){
            $('.clearbody2').html(response); 
        }   
    })
} 

function send_delete(q){
    $('.deletevalue').val(q); 
}
function reset_pw(q){
    $('.resetvalue').val(q); 
}

function clickclose(){
    $('.close').trigger('click');
}

</script>

 

