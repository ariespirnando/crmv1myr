<form enctype='multipart/form-data' class="simple-example was-validated" action="<?php echo base_url().'produk/edit' ?>" method="post">
    <div class="form-row mb-4"> 
         
        

        <div class="form-group col-md-8">
            <label for="inputAddress3">Nama Produk</label> 
            <input name='guid_produk' type="hidden" value="<?php echo $loaddata['guid_produk'] ?>"/>
            <input name='kode_produk_bef' type="hidden" value="<?php echo $loaddata['akronim'] ?>"/> 
            <input name="produk" type="text" required class="form-control" id="inputState3" placeholder="Nama Produk" value="<?php echo $loaddata['nama_produk'] ?>">
            <div class="invalid-feedback">
                *Mandatory
            </div>
        </div>  

        <div class="form-group col-md-4">
            <label for="inputAddress3">Akronim</label>  
            <input name="kodeproduk" type="text" required class="form-control" id="inputState3" placeholder="Akronim" value="<?php echo $loaddata['akronim'] ?>">
            <div class="invalid-feedback">
                *Mandatory
            </div>
        </div>  

        <div class="form-group col-md-6">
            <label for="inputState4">Status</label>
            <select name="status" id="inputState4" class="custom-select" required> 
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