<!--  BEGIN CUSTOM STYLE FILE  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/' ?>plugins/dropify/dropify.min.css">
<link href="<?php echo base_url().'assets/' ?>assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/' ?>plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <form id="general-info" class="section general-info"  enctype='multipart/form-data' action="<?php echo base_url().'useraccount/updatesiswa' ?>" method="post">
        <div class="info">
            <h6 class="">General Information</h6>
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <div class="row">
                        <div class="col-xl-2 col-lg-12 col-md-4">
                            <div class="upload mt-4 pr-md-4">
                                <img style="width: 80%" src="<?php echo base_url().'assets/' ?>assets/img/user.png" > 
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4"> 
                            <div class="form">
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputAddress3">Nama Siswa</label> 
                                    <input name='guid_siswa' type="hidden" value="<?php echo $loaddata['guid_siswa'] ?>"/>
                                    <input name='kode_siswa' type="hidden" value="<?php echo $loaddata['kode_siswa'] ?>"/>
                                    <input name='nik_siswa_bef' type="hidden" value="<?php echo $loaddata['nik_siswa'] ?>"/> 
                                    <input name="siswa" type="text" required class="form-control" id="inputState3" placeholder="Nama Siswa" value="<?php echo $loaddata['nama_siswa'] ?>">
                                    
                                </div>  

                                <div class="form-group col-md-6">
                                    <label for="inputAddress3">No Induk</label>  
                                    <input readonly name="nik_siswa" type="text" required class="form-control" id="inputState3" placeholder="No Induk" value="<?php echo $loaddata['nik_siswa'] ?>">
                                    
                                </div>  

                                <div class="form-group col-md-6">
                                    <label for="inputAddress3">Tempat Kelahiran</label>
                                    <input required name="tempat_lahir" type="text" class="form-control" id="inputState3" placeholder="Tempat Kelahiran" value="<?php echo $loaddata['tempat_lahir'] ?>"> 
                                </div> 

                                <div class="form-group col-md-6">
                                    <label for="inputAddress3">Tanggal Kelahiran</label>
                                    <input required name="tanggal_lahir" type="date" class="form-control" id="inputState3" placeholder="Tanggal Kelahiran" value="<?php echo $loaddata['tanggal_lahir'] ?>"> 
                                </div> 

                                <div class="form-group col-md-6">
                                    <label for="inputAddress3">Nomor Handphone</label>
                                    <input name="nohandpone" type="text" class="form-control" id="inputState3" placeholder="Nomor Handphone" value="<?php echo $loaddata['nohandpone'] ?>">
                                </div> 

                                <div class="form-group col-md-6">
                                    <label for="inputAddress3">Email</label>
                                    <input name="email" type="email" class="form-control" id="inputState3" placeholder="Email"  value="<?php echo $loaddata['email'] ?>"> 
                                    <input name="email_bef" type="hidden" class="form-control" id="inputState3" placeholder="Email"  value="<?php echo $loaddata['email'] ?>"> 
                                </div> 

                                <div class="form-group col-md-6">
                                    <label for="inputState4">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="inputState4"  class="form-control" required> 
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <?php 
                                            $jenis_kelamin = array('Laki-laki','Perempuan');
                                            foreach($jenis_kelamin as $s){
                                                if($s==$loaddata['jenis_kelamin']){
                                                    echo '<option selected value="'.$s.'">'.$s.'</option>';
                                                }else{
                                                    echo '<option value="'.$s.'">'.$s.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="profession">Alamat</label>
                                    <textarea class="form-control mb-4" name="alamat" id="inputState3" ><?php echo $loaddata['alamat'] ?></textarea> 
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary submit-fn">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <form id="general-info" class="section general-info" enctype='multipart/form-data' action="<?php echo base_url().'useraccount/updatepw' ?>" method="post">
        <div class="info">
            <h6 class="">Security Information</h6>
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <div class="row">
                        <div class="col-xl-2 col-lg-12 col-md-4">
                            <div class="upload mt-4 pr-md-4">
                                <img style="width: 80%" src="<?php echo base_url().'assets/' ?>assets/img/security.png" > 
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                            <div class="form">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress3">USERNAME</label> 
                                        <input name='guid_user' type="hidden" value="<?php echo $loaddata['guid_user'] ?>"/>
                                        <input name='kode_user' type="hidden" value="<?php echo $loaddata['kode_siswa'] ?>"/>   
                                        <input readonly name="username" type="text" required class="form-control" id="inputState3" placeholder="" value="<?php echo $loaddata['username'] ?>"> 
                                    </div>  
 
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress3">Password Lama</label>  
                                        <input name="passwordlama" type="password" required class="form-control" id="inputState3"> 
                                    </div>  

                                    <div class="form-group col-md-6">
                                        <label for="inputAddress3">Password Baru</label>  
                                        <input name="passwordbaru" type="password" required class="form-control" id="inputState3"> 
                                    </div>   
                                </div> 
                                <button type="submit" class="btn btn-primary submit-fn">Ubah</button>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!--  BEGIN CUSTOM SCRIPTS FILE  -->

<script src="<?php echo base_url().'assets/' ?>plugins/dropify/dropify.min.js"></script>
<script src="<?php echo base_url().'assets/' ?>plugins/blockui/jquery.blockUI.min.js"></script> 
<script src="<?php echo base_url().'assets/' ?>assets/js/users/account-settings.js"></script>
<script src="<?php echo base_url().'assets/' ?>plugins/notification/snackbar/snackbar.min.js"></script>
<!--  END CUSTOM SCRIPTS FILE  -->

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