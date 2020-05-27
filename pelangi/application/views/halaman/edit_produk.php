<?php 
  echo $css;
  echo $menu;
  ?>
<div class="container">
  <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
      <h1 class="my-4">Form Edit data
                  <small>Produk</small>
                </h1>
      <font color="green"><?php echo $this->session->flashdata('pesan'); ?></font>
      <?php echo form_open('daftarproduk/update/'.$tmp->id_produk,''); ?>

      <div class="form-group row">
      <label for="KodeProduk" class="col-sm-4 col-form-label">Kode Produk :</label>
      <!-- <input type="text" name="kode_produk" class="form-control" disabled value="<?php echo $tmp->kode_produk; ?>"> -->
      <div class="col-sm-8">
      <input type="text" readonly class="form-control-plaintext" id="KodeProduk" value="<?php echo $tmp->kode_produk; ?>">
      <?php echo form_error('name', '<div class="text-danger"><small>', '</small></div>');?>
      </div>
      </div>

      <div class="form-group row">
      <label for="NamaProduk" class="col-md-4 col-form-label" style="padding-top:5px;">Nama Produk :</label>
      <div class="col-md-8">
      <input type="text" name="nama_produk" class="form-control" value="<?php echo $tmp->nama_produk; ?>">
      </div>
      <?php echo form_error('nama_produk', '<div class="text-danger"><small>', '</small></div>');?>
      </div>

      <div class="form-group row">
      <label for="stok" class="col-md-4 col-form-label" style="padding-top:5px;">Stok : </label>
      <div class="col-md-8">
      <input type="number" name="stok" class="form-control" min="1" value="<?php echo $tmp->stok; ?>">
      </div>
      <?php echo form_error('stok', '<div class="text-danger"><small>', '</small></div>');?>
      </div>
      <div class="row">
          <div class="col-md-6"></div>
      <button type="submit" class="btn btn-primary">Update</button>
      </div>
      <?php echo form_close(); ?>

      </div>
  </div>
</div>
<style>
input[readonly]{
  background-color:transparent;
  border: 0;
  font-size: 1em;
}
</style>



