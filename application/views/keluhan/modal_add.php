<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Tambah Consigne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
            <form enctype='multipart/form-data' action="<?php echo base_url().'consigne/add' ?>" method="post">
                <div class="form-row mb-4">
                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Nama Consigne</label>
                        <input  maxlength="30" name="consigne" type="text" required class="form-control" id="inputState3" placeholder="Nama Consigne">
                        <div class="invalid-feedback">
                            *Mandatory
                        </div>
                    </div> 
 
                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Nomor Handphone</label>
                        <input name="nohandpone" type="text" class="form-control" id="inputState3" placeholder="Nomor Handphone"> 
                    </div> 

                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Email</label>
                        <input name="email" type="email" class="form-control" id="inputState3" placeholder="Email"> 
                    </div>  

                    <div class="form-group col-md-12">
                        <label for="inputAddress3">Alamat</label>
                        <textarea  name="alamat" class="form-control" id="inputState3"></textarea> 
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
 
