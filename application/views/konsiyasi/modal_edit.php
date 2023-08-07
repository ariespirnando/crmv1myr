<form enctype='multipart/form-data' action="<?php echo base_url().'consigne/edit' ?>" method="post">
<div class="form-row mb-4"> 
         
        

    <div class="form-group col-md-6">
        <label for="inputAddress3">Nama Consigne</label> 
        <input name='guid_consigne' type="hidden" value="<?php echo $loaddata['guid_consigne'] ?>"/>
        <input name='kode_consigne' type="hidden" value="<?php echo $loaddata['kode_consigne'] ?>"/> 
        <input name="consigne" type="text" required class="form-control" id="inputState3" placeholder="Nama Consigne" value="<?php echo $loaddata['nama_consigne'] ?>">
        <div class="invalid-feedback">
            *Mandatory
        </div>
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
        <label for="inputState4">Status</label>
        <select name="status" id="inputState4"  class="form-control" required> 
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

    <div class="form-group col-md-12">
        <label for="inputAddress3">Alamat</label>
        <textarea  name="alamat" class="form-control" id="inputState3"><?php echo $loaddata['alamat'] ?></textarea> 
    </div> 

    

</div> 
<div class="modal-footer"> 
    <button type="submit" class="btn btn-primary submit-fn">Ubah</button>
    <button class="btn btn-default submit-fn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
            
</div>
</form>