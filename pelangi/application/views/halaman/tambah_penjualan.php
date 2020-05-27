<?php 
  echo $css;
  echo $menu;
  ?>
  <div class="container">
      <div class="row">
          <div class="col-md-4"></div>
            <div class="col-md-4">

                    <h1 class="my-4">Form input data <br>
                      <small> Rekap Penjualan</small>
                    </h1>

              <font color="green"><?php echo $this->session->flashdata('pesan'); ?></font>
              <?php echo form_open('daftarpenjualan/add',''); ?>
              <div class="form-group">
                <label for="nama produk">Nama Produk : <?php echo $nama_produk->nama_produk ?> <?php ?></label>
                <input type="hidden" value="<?php echo $nama_produk->kode_produk ?>" name="kode_produk"class="form-control" id="">
                <input type="hidden" value="<?php echo $nama_produk->nama_produk ?>" name="nama_produk"class="form-control" id="">
                <?php echo form_error('name', '<div class="text-danger"><small>', '</small></div>');?>
              </div>

              <div class="form-group row">
                <label for="tahun"  class="col-md-4 col-form-label">Tahun :</label>
                <div class="col-md-8">
                <input type="number" name="tahun"  min="2000"  placeholder="2020" class="form-control" id="tahun">
                <?php echo form_error('email', '<div class="text-danger"><small>', '</small></div>');?>
              </div>
              </div>

              <div class="form-group row">
                <label for="kuantitas"class="col-md-4 col-form-label">Bulan :</label>
                <div class="col-md-8">
                <input type="number" name="bulan"  min="1" max="12" placeholder="10" class="form-control" id="">
                <?php echo form_error('phone', '<div class="text-danger"><small>', '</small></div>');?>
              </div>
              </div>

              <div class="form-group row">
                <label for="kuantitas"class="col-md-4 col-form-label">Kuantitas :</label>
                <div class="col-md-8">
                <input type="number" name="kuantitas" min="1" placeholder="100" class="form-control" id="">
                <?php echo form_error('phone', '<div class="text-danger"><small>', '</small></div>');?>
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