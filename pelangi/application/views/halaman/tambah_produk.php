<?php 
  echo $css;
  echo $menu;
  ?>

  <div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
                <h1 class="my-4">Form input data
                  <small>Produk</small>
                </h1>

         
          <?php echo form_open('daftarproduk/add',''); ?>
          <div class="form-group row">
          <label for="KodeProduk" class="col-md-4 col-form-label"  style="padding-top:5px;">Kode Produk :</label>
            <div class="col-md-8">
              <input type="text" name="kode_produk" placeholder="12345678"class="form-control">
            </div>
            <?php echo form_error('kode_produk', '<div class="text-danger"><small>', '</small></div>');?>
          </div>

          <div class="form-group row">
            <label for="NamaProduk" class="col-md-4 col-form-label" style="padding-top:5px;">Nama Produk :</label>
            <div class="col-md-8">
            <input type="text" name="nama_produk"  placeholder="Nama Produk" class="form-control" id="n=NamaProduk">
            </div>
            <?php echo form_error('namaproduk', '<div class="text-danger"><small>', '</small></div>');?>
          </div>

          <div class="form-group row">
            <label for="Stok" class="col-md-4 col-form-label" style="padding-top:5px;">Stok       :</label>
            <div class="col-md-8">
            <input type="number" name="stok"  min="1" placeholder="100"  class="form-control" id="stok">
            <?php echo form_error('stok', '<div class="text-danger"><small>', '</small></div>');?>
          </div>
          </div>
          <div class="row">
          <div class="col-md-6"></div>
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        <?php echo form_close(); ?>
        </div>

    </div>
  </div>