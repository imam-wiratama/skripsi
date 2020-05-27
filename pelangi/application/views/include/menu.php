<?php echo $css;?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"  style="padding-top: 20px;">
        <div class="navbar navbar-inverse">
          <ul style="padding-left: 10%;">
            <li><?php echo anchor('home/', 'Home', 'class=""');?></li>
            <li><?php echo anchor('daftarproduk/', 'Daftar Produk', 'class=""');?></li>
            <li><?php echo anchor('daftarpenjualan/', 'Rekapitulasi', 'class=""');?></li>
            <li><?php echo anchor('laporanprediksi/', 'Laporan Prediksi', 'class=""');?></li>
            <li><?php echo anchor('bantuan/', 'Bantuan', 'class=""');?></li>
          </ul>
        </div>
    </div>
  </div>
</div>
<style>

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #fff;
}

.active {
  background-color: #4CAF50;
}
</style>