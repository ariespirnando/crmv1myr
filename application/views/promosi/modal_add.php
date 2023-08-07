<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Tambah Promosi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form enctype='multipart/form-data' action="<?php echo base_url().'promosi/add' ?>" method="post">
                
                <div class="form-row mb-4">
                    <div class="form-group col-md-8">
                        <label for="inputAddress3">Nama Promosi</label>
                        <input name="nama_promosi" size="30" type="text" required class="form-control" id="inputState3" placeholder="Nama Promosi">
                        <div class="invalid-feedback">
                            *Mandatory
                        </div>
                    </div> 

                    <div class="form-group col-md-4">
                        <label for="inputState4">Klasifikasi</label>
                        <select name="clasifikasi" id="inputState4" class="form-control" required> 
                        <option value="">Pilih klasifikasi</option>
                        <?php 
                                $status = array('Internal','Public');
                                foreach($status as $s){ 
                                    echo '<option value="'.$s.'">'.$s.'</option>'; 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputState4">Isi Promosi</label>
                        <textarea name="isi_promosi" id="inputState4" class="form-control"  required></textarea> 
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                 
                <button type="submit" class="btn btn-primary submit-fn">Simpan</button>
                <button class="btn btn-default submit-fn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
            
            </div>
            </form>
        </div>
    </div>
</div>
 
