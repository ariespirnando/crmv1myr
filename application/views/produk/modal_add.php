<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
            <form enctype='multipart/form-data' class="simple-example was-validated" action="<?php echo base_url().'produk/add' ?>" method="post">
                <div class="form-row mb-4"> 
                    <div class="form-group col-md-8">
                        <label for="inputAddress3">Nama Produk</label>
                        <input name="produk" type="text" required class="form-control" id="inputState3" placeholder="Nama Produk">
                        <div class="invalid-feedback">
                            *Mandatory
                        </div>
                    </div> 

                    <div class="form-group col-md-4">
                        <label for="inputAddress3">Akronim</label>
                        <input name="kodeproduk" type="text" required class="form-control" id="inputState3" placeholder="Akronim">
                        <div class="invalid-feedback">
                            *Mandatory
                        </div>
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
 
