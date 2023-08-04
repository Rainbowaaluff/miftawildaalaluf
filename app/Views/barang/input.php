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
                      <input type="hidden" name="param" id="param" value="<?php echo $edit_data['jenis_barang']; ?>">
                      <?php
                    }
                    ?>
                    <div class="form-group">
                      <label for="jenis_barang">jenis Barang</label>
                      <input type="text" name="jenis_barang" id="jenis_barang" value="<?php echo empty(set_value('jenis_barang')) ? (empty($edit_data['jenis_barang']) ? "":$edit_data['jenis_barang']) : set_value('jenis_barang'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="nama_barang">nama barang</label>
                      <input type="text" name="nama_barang" id="nama_barang" value="<?php echo empty(set_value('nama_barang')) ? (empty($edit_data['nama_barang']) ? "":$edit_data['nama_barang']) : set_value('nama_barang'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="item_barang">kode barang</label>
                      <input type="text" name="kode_barang" id="kode_barang" value="<?php echo empty(set_value('kode_barang')) ? (empty($edit_data['kode_barang']) ? "":$edit_data['kode_barang']) : set_value('kode_barang'); ?>" class="form-control">
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