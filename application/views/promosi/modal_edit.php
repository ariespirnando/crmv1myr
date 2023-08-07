<form enctype='multipart/form-data'  action="<?php echo base_url().'promosi/edit' ?>" method="post">
<div class="form-row mb-4"> 
           
        <div class="form-group col-md-8">
            <label for="inputAddress3">Nama Promosi</label>
            <input name='guid_promosi' type="hidden" value="<?php echo $loaddata['guid_promosi'] ?>"/>
            <input name='nama_promosi_bef' type="hidden" value="<?php echo $loaddata['nama_promosi'] ?>"/> 
            <input name="nama_promosi" size="30" type="text" required class="form-control" id="inputState3" placeholder="Nama Promosi" value="<?php echo $loaddata['nama_promosi'] ?>">
            <div class="invalid-feedback">
                *Mandatory
            </div>
        </div> 

        <div class="form-group col-md-4">
            <label for="inputState4">Klasifikasi</label>
            <select name="clasifikasi" id="inputState4" class="form-control"  required> 
            <option value="">Pilih klasifikasi</option>
            <?php 
                    $status = array('Internal','Public');
                    foreach($status as $s){ 
                        if($s==$loaddata['clasifikasi']){
                            echo '<option selected value="'.$s.'">'.$s.'</option>';
                        }else{
                            echo '<option value="'.$s.'">'.$s.'</option>';
                        } 
                    }
                ?>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="inputState4">Isi Promosi</label>
            <textarea name="isi_promosi" id="inputState4" class="form-control"   required><?php echo $loaddata['isi_promosi'] ?></textarea> 
        </div>

        <div class="form-group col-md-6">
            <label for="inputState4">Status</label>
            <select name="status" id="inputState4" class="form-control"  required> 
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
 

</div>
<div class="modal-footer"> 
    <button type="submit" class="btn btn-primary submit-fn">Ubah</button>
    <button class="btn btn-default submit-fn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
            
</div>
</form>