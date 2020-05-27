<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Daftar Penjualan</title>

</head>
<body>
<?php 
  echo $css;
  echo $menu;
  ?>

  <div class="container">
    <div class="row">
        <div class="col-md-4"></div>
         <div class="col-md-8" style="padding-left: 40px;">
            <h1 class="">Informasi
              <small>Rekapitulasi <br> <b>
              <?php echo $nama_produk->nama_produk  ?></small>
              </b>
            </h1>
          </div>
        <font color="green"><?php echo $this->session->flashdata('pesan'); ?></font>

        <?php echo form_open('daftarpenjualan/pilih_tahun',''); ?>
        <div class="form-group row">
          <div class="col-md-2"></div>
          <div class="col-md-2" style="padding-top:6px;padding-right: 0px;height: 6px;width: 45px;">
              Tahun
          </div>
          <div class="col-md-2" style="padding-right: 0px;width: 125px;">
              <select name="tahun" class="form-control form-control-lg" style="padding-right: 0px;width: 122px;padding-left: 0px;">
              <?php 
                foreach($tahun as $key){
            ?>
                <option value="<?php echo $key->tahun ?>"><?php  echo $key->tahun; ?></option>
              <?php  }
                ?>
              </select>
              <input type="hidden" value="<?php echo $nama_produk->kode_produk ?>" name="kode_produk"class="form-control" id="">
        </div>
        <div class="col-md-2" style="padding-right:50px;">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
      </div>
      <?php echo form_close(); ?>

      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-7">
      <?php 
      echo anchor('daftarpenjualan/form_add/'.$nama_produk->kode_produk, '+ Tambah Produk', 'class="btn btn-success btn-sm"'); ?>
         </div>
          <div class="col-md-1">
              <?php echo anchor('home/', 'Kembali', 'class="btn btn-primary btn-sm"'); ?>
          </div>
        </div>
      </div>
      <br>
      <div class="container">
            <div class="row">
      <font color="green"><?php echo $this->session->flashdata('pesan'); ?></font>
      <div class="col-md-2"></div>
     <div class="col-md-8">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Tahun</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Bulan</th>
            <th scope="col">Kuantitas</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php  
          $i=1;
          if(isset($kode_produk)){
        
          foreach ($kode_produk as $key) {
              ?>
          <tr>
            <td><b><?php echo $key->tahun;?></b></td>
            <td><?php echo $key->nama_produk; ?></td>
            <td><?php echo $key->bulan; ?></td>
            <td><?php echo $key->kuantitas; ?></td>
            <td>
              <?php
               echo anchor('daftarpenjualan/edit/'.$key->kode_penjualan, 'Edit', 'class="badge btn-warning"');  ?>
              /
              <?php echo anchor('daftarpenjualan/del/'.$key->kode_penjualan, 'Delete',array('class'=>'badge btn-danger', 'onclick'=>"return confirmDialog();"));  ?>
          </td>
          </tr>
        <?php $i++;
          }
          }?>
        
        </tbody>
      </table>
      </div>
     </div>
     </div>
    </div>
  </div>


<script type="text/javascript">
function confirmDialog() {
  var x=confirm("Yakin akan di hapus?")
  if (x) {
    return true;
  } else {
    return false;
  } }
</script>

</body>
</html>

