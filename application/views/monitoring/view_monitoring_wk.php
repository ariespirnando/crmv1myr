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
            <li class="breadcrumb-item active"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg><span> Monitoring Pelajaran</span>
            <li class="breadcrumb-item active" aria-current="page"><?php echo ($kode=="i")?"Pelajaran":"History" ?> </li>
         </a></li>  
        </ol> 
    </nav>  
    
     
    <hr>  

    

    <form action="<?php echo base_url().'monitoring/monitoring_wk/'.$kode ?>" method="post"> 
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
    <?php 

    if(empty($datasiswa)){ ?> 
        <style>
            .imgcenter {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 68%;
            }
        </style>
        <img src="<?php echo base_url().'assets/' ?>assets/img/emptydata.png" class="imgcenter"> 
    <?php }else{?>
        <div class="table-responsive mb-4 mt-4">
            <table class="table table-hover" style="width:100%">
                <thead>
                    <tr> 
                        <th class="text-center">#</th>  
                        <th class="text-left">Pelajaran</th>
                        <th class="text-left">Kelas</th> 
                        <th class="text-left">TA</th> 
                        <th class="text-left">Guru Pengampu</th>   
                        <th class="text-center">Laporan Online Class</th>
                        <th class="text-center">Laporan Nilai Tugas</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = $page+1;
                    foreach($datasiswa as $d){ 
                ?>
                    <tr>
                        <td class="text-center"><?php echo $no?></td> 

                        <td class="text-left"><?php echo $d['nama_pelajaran'] ?></td> 
                        
                        <td class="text-left"><?php echo $d['nama_subkelas'].' / '.$d['akronim'].'-'.$d['nama_jurusan'].'' ?></td>

                        <td class="text-left"><?php echo $d['semester'].' / '.$d['nama_tahunajaran'] ?></td>

                        <td class="text-left"><?php echo $d['nama_karyawan'] ?></td> 

                        <td class="text-center">
                            <a href="<?php echo base_url().'laporandownload/laporan_onlinemeet/'.$d['guid_conf_subkelasxpel'] ?>" class="btn btn-outline-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            </a>  
                        </td> 


                        <td class="text-center">
                            <a href="<?php echo base_url().'laporandownload/laporan_nilai/'.$d['guid_conf_subkelasxpel'] ?>" class="btn btn-outline-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
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
        <?php } ?>
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
 

 

