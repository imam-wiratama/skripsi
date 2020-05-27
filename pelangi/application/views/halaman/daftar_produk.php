<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Daftar Produk</title>

	
</head>
<body>
<?php 
  echo $css;
  echo $menu;
  ?>
  <div class="container">
      <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-7">
              <h1 class="">Daftar
                <small>Produk</small>
              </h1>
            </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-7">
              <?php echo anchor('daftarproduk/form_add', '+ Tambah Produk', 'class="btn btn-success btn-sm"'); ?>
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
                      <th scope="col">No</th>
                      <th scope="col">Nama Produk</th>
                      <th scope="col">Stok</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i=1;
                    if(isset($tmp)){
                    foreach ($tmp as $key) { ?>
                    <tr>
                      <td><b><?php echo $i?></b></td>
                      <td><?php echo $key->nama_produk; ?></td>
                      <td><?php echo $key->stok; ?></td>
                      <td>
                        <?php echo anchor('daftarproduk/edit/'.$key->id_produk, 'Edit', 'class="badge btn-warning"');  ?>
                        /
                        <?php echo anchor('daftarproduk/del/'.$key->id_produk, 'Delete',array('class'=>'badge btn-danger', 'onclick'=>"return confirmDialog();"));  ?>
                    </td>
                    </tr>
                  <?php $i++; }
                }else {
                  ?>
                  <tr>
                    <td>Tidak Ada Produk</td>
                  </tr>
                  <?php
                }?>
                      
                    
                  </tbody>
                </table>
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