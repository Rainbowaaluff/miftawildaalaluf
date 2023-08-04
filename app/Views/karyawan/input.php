<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
    <div class="row">
          <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
              </div>
              <!-- /.card-header -->
              <form action="<?php echo $action; ?>" method="post">
              <div class="card-body">
                <?php if (validation_errors()){
                  ?>
                   <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  <?php echo validation_list_errors() ?>
                </div>
                  <?php
                }
                ?>

                <?php
                if(session()->getFlashdata('error')){
                  ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-warning"></i> Error</h5>
                  <?php echo session()->getFlashdata('error'); ?>
                </div>
                  <?php
                }
                ?>

                    <?php echo csrf_field() ?>
                    <?php
                    if(current_url(true)->getSegment(2) =='edit'){
                      ?>
                      <input type="hidden" name="param" id="param" value="<?php echo $edit_data['id_karyawan']; ?>">
                      <?php
                    }
                    ?>
                    <div class="form-group">
                      <label for="id_karyawan">No</label>
                      <input type="text" name="id_karyawan" id="id_member" value="<?php echo empty(set_value('id_karyawan')) ? (empty($edit_data['id_karyawan']) ? "":$edit_data['id_karyawanr']) : set_value('id_karyawan'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" name="nama" id="nama" value="<?php echo empty(set_value('nama')) ? (empty($edit_data['nama']) ? "":$edit_data['nama']) : set_value('nama'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="kode_karyawan">kode karyawan </label>
                      <input type="text" name="kode_karyawan" id="kode_karyawan" value="<?php echo empty(set_value('nis')) ? (empty($edit_data['kode_karyawan']) ? "":$edit_data['kode_karyawan']) : set_value('kode_karyawan'); ?>" class="form-control">
                    </div>
            </div>
            <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i>Simpan</button>
                </div>
              </form>
        </div>
    </div>
</div>
<?php
echo $this->endSection();