<?php 
  echo $css;
  echo $menu;
  // print_r($barangTampil);
?>

  <div class="container">
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-7"  style="padding-left:0px;">
      <h1>Laporan Prediksi <small><b>STOK BARANG</b></small></h1>
    </div>
    </div>
    <br><br>
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
          <div class="col-md-8">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nama Produk</th>
                  <th scope="col">Stok</th>
                  <th scope="col">Prediksi Stok</th>
                  <th scope="col">Akurasi</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                $tahun ='';
                $bulan = '';
                for ($i=0; $i < count($barangTampil); $i++) {
                  if(($barangTampil[$i]['bulan']) == 12){ 
                    $tahun = ($barangTampil[$i]['tahun']+1);
                    $bulan = ($barangTampil[$i]['bulan']+1)%12;
                    }else {
                      $tahun = $barangTampil[$i]['tahun'];
                      $bulan = ($barangTampil[$i]['bulan']+1);
                    }
                  if($bulan ==1 ){
                    $bulan = 'Januari';
                  }else if($bulan == 2 ){
                    $bulan = 'Februari';
                  }else if($bulan == 3 ){
                    $bulan = 'Maret';
                  }
                  else if($bulan == 4 ){
                    $bulan = 'April';
                  }
                  else if($bulan == 5 ){
                    $bulan = 'Mei';
                  }
                  else if($bulan == 6 ){
                    $bulan = 'Juni';
                  }
                  else if($bulan == 7 ){
                    $bulan = 'Juli';
                  } else if($bulan == 8 ){
                    $bulan = 'Agustus';
                  }
                  else if($bulan == 9 ){
                    $bulan = 'September';
                  }
                  else if($bulan == 10 ){
                    $bulan = 'Oktober';
                  }
                  else if($bulan == 11 ){
                    $bulan = 'November';
                  }
                  else if($bulan == 12 ){
                    $bulan = 'Desember';
                  }
                    ?>
                <tr>
                  <td><?php echo $barangTampil[$i]['nama_produk']; ?></td>
                  <td style="color:red;"><?php echo $barangTampil[$i]['stok']; ?></td>
                  <?php 
                    if($barangTampil[$i]['dataKurang'] == 1){
                    ?>  <td><?php  echo "<strong> Data histori Kurang" ; ?></td>
                      <?php } else {
                  ?>
                  <td><?php echo "<strong>". round($barangTampil[$i]['prediksiStok'],0)."</strong> (".$bulan." ". $tahun.") "; ?></td>
                      <?php }
                    $status='';
                    if(round($barangTampil[$i]['Mape'],1) < 10){
                      $status='Sangat Baik';
                    } else if(round($barangTampil[$i]['Mape'],1)>= 10 && round($barangTampil[$i]['Mape'],1)< 20){
                      $status='Baik';
                    }else if(round($barangTampil[$i]['Mape'],1)>= 20 && round($barangTampil[$i]['Mape'],1)< 50){
                      $status='Cukup';
                    }else if(round($barangTampil[$i]['Mape'],1)>= 50){
                      $status='Buruk';
                    }
    
                    if($barangTampil[$i]['dataKurang'] == 1){
                        ?> <td> - </td>
                   <?php }else{
                    ?> <td><?php echo (100 - round($barangTampil[$i]['Mape'],1))."% ".$status;?></td> 
                 <?php  }
                 ?> 
                </tr>
              <?php
                }?>
              </tbody>
            </table>
        </div>
      </div>  
  </div>
