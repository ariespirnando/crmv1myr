<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
            <form enctype='multipart/form-data' class="simple-example was-validated" action="<?php echo base_url().'karyawan/add' ?>" method="post">
                <div class="form-row mb-4">
                    <div class="form-group col-md-8">
                        <label for="inputAddress3">Nama Pegawai</label>
                        <input name="karyawan" type="text" required class="form-control" id="inputState3" placeholder="Nama Pegawai">
                        <div class="invalid-feedback">
                            *Mandatory
                        </div>
                    </div> 

                    <div class="form-group col-md-4">
                        <label for="inputAddress3">NIK Pegawai</label>
                        <input name="nik_karyawan" type="text" required class="form-control" id="inputState3" placeholder="NIK Pegawai">
                        <div class="invalid-feedback">
                            *Mandatory
                        </div>
                    </div>  

                    <div class="form-group col-md-6">
                        <label for="inputState4">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="inputState4" class="custom-select" required> 
                        <option value="">Pilih Jenis Kelamin</option>
                        <?php 
                                $jenis_kelamin = array('Laki-laki','Perempuan');
                                foreach($jenis_kelamin as $s){ 
                                    echo '<option value="'.$s.'">'.$s.'</option>'; 
                                }
                            ?>
                        </select>
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="inputState4">Role</label>
                        <select name="jenis_karyawan" id="inputState4" class="custom-select" required> 
                        <option value="">Pilih Role</option>
                        <?php  
                                foreach($role_in as $s){ 
                                    echo '<option value="'.$s['guid_groups'].'">'.$s['description'].'</option>'; 
                                }
                            ?>
                        </select>
                    </div> 
                    
                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Tempat Kelahiran</label>
                        <input required name="tempat_lahir" type="text" class="form-control" id="inputState3" placeholder="Tempat Kelahiran"> 
                    </div> 

                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Tanggal Kelahiran</label>
                        <input required name="tanggal_lahir" type="date" class="form-control" id="inputState3" placeholder="Tanggal Kelahiran"> 
                    </div> 

                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Pendidikan Terakhir</label>
                        <input required name="pendidikan_terakhir" type="text" class="form-control" id="inputState3" placeholder="Pendidikan Terakhir"> 
                    </div> 

                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Jurusan</label>
                        <input required name="jurusan" type="text" class="form-control" id="inputState3" placeholder="Jurusan"> 
                    </div> 


                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Email</label>
                        <input name="email" type="email" class="form-control" id="inputState3" placeholder="Email"> 
                    </div> 

                    <div class="form-group col-md-6">
                        <label for="inputAddress3">Nomor Handphone</label>
                        <input name="nohandpone" type="text" class="form-control" id="inputState3" placeholder="Nomor Handphone"> 
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
 
