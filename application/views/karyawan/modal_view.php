<form enctype='multipart/form-data' class="simple-example was-validated" action="<?php echo base_url().'karyawan/edit' ?>" method="post">
<div class="form-row mb-4"> 
         
        

    <div class="form-group col-md-8">
        <label for="inputAddress3">Nama Pegawai</label> 
        <input name='guid_karyawan' type="hidden" value="<?php echo $loaddata['guid_karyawan'] ?>"/>
        <input name='nik_karyawan_bef' type="hidden" value="<?php echo $loaddata['nik_karyawan'] ?>"/> 
        <input disabled name="karyawan" type="text" required class="form-control" id="inputState3" placeholder="Nama Karyawan" value="<?php echo $loaddata['nama_karyawan'] ?>">
        <div class="invalid-feedback">
            *Mandatory
        </div>
    </div>  

    <div class="form-group col-md-4">
        <label for="inputAddress3">Nik Pegawai</label>  
        <input disabled name="nik_karyawan" type="text" required class="form-control" id="inputState3" placeholder="NIK Karyawan" value="<?php echo $loaddata['nik_karyawan'] ?>">
        <div class="invalid-feedback">
            *Mandatory
        </div>
    </div>  

    <div class="form-group col-md-6">
        <label for="inputState4">Jenis Kelamin</label>
        <select disabled name="jenis_kelamin" id="inputState4" class="custom-select" required> 
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

    
    <div class="form-group col-md-6">
        <label for="inputState4">Role</label>
        <select disabled name="jenis_karyawan" id="inputState4" class="custom-select" required> 
        <option value="">Pilih Role</option>
        <?php  
            foreach($role_in as $s){ 
                if($s['guid_groups']==$loaddata['guid_groups']){
                    echo '<option selected value="'.$s['guid_groups'].'">'.$s['description'].'</option>'; 
                }else{
                    echo '<option value="'.$s['guid_groups'].'">'.$s['description'].'</option>'; 
                }
            }
        ?>
        </select>
    </div> 

    <div class="form-group col-md-6">
        <label for="inputAddress3">Tempat Kelahiran</label>
        <input disabled required name="tempat_lahir" type="text" class="form-control" id="inputState3" placeholder="Tempat Kelahiran" value="<?php echo $loaddata['tempat_lahir'] ?>"> 
    </div> 

    <div class="form-group col-md-6">
        <label for="inputAddress3">Tanggal Kelahiran</label>
        <input disabled required name="tanggal_lahir" type="date" class="form-control" id="inputState3" placeholder="Tanggal Kelahiran" value="<?php echo $loaddata['tanggal_lahir'] ?>"> 
    </div> 

    <div class="form-group col-md-6">
        <label for="inputAddress3">Pendidikan Terakhir</label>
        <input disabled required name="pendidikan_terakhir" type="text" class="form-control" id="inputState3" placeholder="Pendidikan Terakhir" value="<?php echo $loaddata['pendidikan_terakhir'] ?>"> 
    </div> 

    <div class="form-group col-md-6">
        <label for="inputAddress3">Jurusan</label>
        <input disabled required name="jurusan" type="text" class="form-control" id="inputState3" placeholder="Jurusan" value="<?php echo $loaddata['jurusan'] ?>"> 
    </div> 

    <div class="form-group col-md-6">
        <label for="inputAddress3">Email</label>
        <input disabled name="email" type="email" class="form-control" id="inputState3" placeholder="Email" value="<?php echo $loaddata['email'] ?>">
    </div> 

    <div class="form-group col-md-6">
        <label for="inputAddress3">Nomor Handphone</label>
        <input disabled name="nohandpone" type="text" class="form-control" id="inputState3" placeholder="Nomor Handphone" value="<?php echo $loaddata['nohandpone'] ?>">
    </div> 

    <div class="form-group col-md-12">
        <label for="inputAddress3">Alamat</label>
        <textarea  disabled name="alamat" class="form-control" id="inputState3"><?php echo $loaddata['alamat'] ?></textarea> 
    </div> 

    <div class="form-group col-md-6">
        <label for="inputState4">Status</label>
        <select disabled name="status" id="inputState4" class="custom-select" required> 
        <option value="">Pilih Status</option>
        <?php 
                $status = array('Active','Non Active');
                foreach($status as $s){
                    if($s==$loaddata['status']){
                        echo '<option selected value="'.$s.'">'.$s.'</option>';
                    }else{
                        echo '<option value="'.$s.'">'.$s.'</option>';
                    }
                }
            ?>
        </select>
    </div> 
</div>  
</form>