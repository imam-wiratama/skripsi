<?php 
  echo $css;
  echo $menu;
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
              <h1 class="my-4">Form Edit Data <br>
          <small>Rekap Penjualan</small> </h1>
          <font color="green"><?php echo $this->session->flashdata('pesan'); ?></font>
<?php echo form_open('daftarpenjualan/update/'.$tmp->kode_penjualan,''); ?>

<div class="form-group row">
<label for="kodeproduk" class="col-sm-4 col-form-label">Kode Produk :</label>
<div class="col-sm-8">
<input type="text" name="kode_produk" readonly class="form-control-plaintext" placeholder="1234567"  value="<?php echo $tmp->kode_produk; ?>">
<?php echo form_error('name', '<div class="text-danger"><small>', '</small></div>');?>
</div>
</div>

<div class="form-group row">
<label for="tahun" class="col-sm-4 col-form-label">Tahun : </label>
<div class="col-sm-8">
<input type="text" name="nama_produk"  readonly class="form-control-plaintext" min="2000" placeholder="2020" value="<?php echo $tmp->tahun; ?>">
<?php echo form_error('nama_produk', '<div class="text-danger"><small>', '</small></div>');?>
</div>
</div>

<div class="form-group row">
<label for="bulan" class="col-sm-4 col-form-label">Bulan : </label>
<div class="col-sm-8">
<input type="text" name="stok" readonly class="form-control-plaintext" min="1" max="12" placeholder="10" value="<?php echo $tmp->bulan; ?>">
<?php echo form_error('stok', '<div class="text-danger"><small>', '</small></div>');?>
</div>
</div>

<div class="form-group row">
<label for="Kuantitas"  class="col-sm-4 col-form-label">Kuantitas : </label>
<div class="col-sm-8">
<input type="text" name="kuantitas" class="form-control"  min="1"  placeholder="100" value="<?php echo $tmp->kuantitas; ?>">
<?php echo form_error('stok', '<div class="text-danger"><small>', '</small></div>');?>
</div>
</div>
<div class="row">
          <div class="col-md-6"></div>
      <button type="submit" class="btn btn-primary">Update</button>
      </div>
<?php echo form_close(); ?>

        </h1>
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




