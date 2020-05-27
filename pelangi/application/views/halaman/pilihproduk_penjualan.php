<?php 
  echo $css;
  echo $menu;
  ?>
  <?php if(isset($tmp_produk)){
    ?>
  <div class="container">
    <div class="col-md-4"></div>
      <div class="col-md-4">
        <h1 class="">Pilih
          <small>Barang</small>
        </h1>
        <font color="green"><?php echo $this->session->flashdata('pesan'); ?></font>
        <?php echo form_open('daftarpenjualan/pilih_barang',''); ?>
        <div class="form-group">
        <select name="kode_produk" class="form-control form-control-lg">
        <?php 
          foreach($tmp_produk as $key){
            ?>
          <option value="<?php echo $key->kode_produk ?>"><?php  echo $key->nama_produk; ?></option>
        <?php  }
          ?>
        </select>
          <?php echo form_error('name', '<div class="text-danger"><small>', '</small></div>');?>
        </div>
        <div class="row">
          <div class="col-md-5"></div>
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      <?php echo form_close(); ?>
      </div>
  </div>
            <?php }else {

              ?>
              <div class="container">
    <div class="col-md-4"></div>
      <div class="col-md-5">
        <h1 class=""style="padding-left:10px;">Tidak ada Barang
        </h1> 
      </div>
  </div>
              
              <?php
            } ?>