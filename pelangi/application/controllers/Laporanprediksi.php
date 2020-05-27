<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan { 
      
  var $kode_produk; 
  var $kode_penjualan; 
  var $stok_minim;
    
  function __construct( $par1, $par2, $par3 )  
  { 
      $this->kode_produk = $par1; 
      $this->kode_penjualan = $par2; 
      $this->stok_minim = $par3; 
  } 
} 
class Prediksi { 
    
  var $nama_produk;
  var $stok;
  var $prediksiStok; 
  var $Mape; 
  var $tahun;
  var $bulan;
  var $dataKurang;
 
    
  function __construct( $par1, $par2, $par3, $par4, $par5, $par6, $par7 )  
  { 
    
      $this->nama_produk = $par1; 
      $this->stok = $par2; 
      $this->prediksiStok = $par3; 
      $this->Mape = $par4; 
      $this->tahun = $par5; 
      $this->bulan = $par6; 
      $this->dataKurang = $par7; 
      
  } 
} 


class parameterAlpha{
  public $alpha;
  public $mape;
  public function __construct($alpha, $mape)
  {
      $this->alpha = $alpha;
      $this->mape   = $mape;
  }
  public function get_alpha()
  {
      return $this->alpha;
  }
  public function set_alpha($alpha)
  {
      $this->alpha = $alpha;
  }
  public function get_mape()
  {
      return $this->mape;
  }
  public function set_mape($mape)
  {
      $this->mape = $mape;
  }
}

class Laporanprediksi extends CI_Controller {


  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_laporan');
    $this->load->model('m_produk');
    $this->load->model('m_penjualan');

  }

  public function index()
  { 
    //Set Variable
    $laporan = array();
    $stok_awal = array();
    $banyakLaporan = array();
    $flagTampil= 0;
    $data['barangTampil']= array();
    // Ambil data 
    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
    $data['menu']= $this->load->view('include/menu', $data, TRUE);  
    $data['tmp']= $this->m_laporan->ambil()->row();
    $data['tb_laporan']= $this->m_laporan->ambil()->result();
    $data['tb_produk']= $this->m_produk->tampil()->result();
    $data['tb_penjualan']= $this->m_penjualan->tampil()->result();
    $tmpProduk  =$data['tb_produk'];
    $tmpPenjualan  =$data['tb_penjualan'];
    $tmpLaporan  =$data['tb_laporan'];
    //-----------------------------------------------------------------------
    for ($idx = 0; $idx < count($tmpProduk); $idx++) {//membuat laporan
      $barang =  $this->m_laporan->barang($tmpProduk[$idx]->kode_produk)->row(); // ambil barang ke tabel penjualan berdasarkan kode_produk
      if(isset($barang)){    // hitung stok_awal dan cek data produk dari penjualan ada atau tidak?      
        $stok_awal = $tmpProduk[$idx]->stok + $barang->kuantitas;
        $stok_minimum = round(($stok_awal * 0.2), 0);// batas bawah atau stok minim 20%
        $laporan = new Laporan($tmpProduk[$idx]->kode_produk,$barang->kode_penjualan, $stok_minimum);
        $banyakLaporan[] = (array) $laporan;
      }
    }
    if(isset($data['tmp'])==null){// simpan hasil stok minimum kedalam tb_laporan
     
      for ($counter = 0; $counter < count($banyakLaporan); $counter++) {
      $this->m_laporan->input($banyakLaporan[$counter]['kode_produk'],$banyakLaporan[$counter]['kode_penjualan'],$banyakLaporan[$counter]['stok_minim']);
      }
      // echo "tb laporan kosong"; saat table kosong melakukan perhitungan stok awal dan stok minim lalu di lanjutkan perhitungan prediksi
      $this->load->view('halaman/laporan_prediksi',$data);
      redirect('laporanprediksi','refresh');
    }else if(isset($data['tmp'])){ // tabel laporan sudah terisi
     
    //pengecekan untuk stok minim sudah ada dilaporan atau belum
    $cek =$this->m_laporan->ambil()->result();
    if(count($cek) == count($banyakLaporan)){
      for ($counter = 0; $counter < count($banyakLaporan); $counter++) {
        if($cek[$counter]->kode_produk == $banyakLaporan[$counter]['kode_produk']){
          //disini alter atau update
          $this->m_laporan->alter($cek[$counter]->kode_produk,  $banyakLaporan[$counter]['kode_penjualan'], $banyakLaporan[$counter]['stok_minim']);
        }
        else if($cek[$counter]->kode_produk != $banyakLaporan[$counter]['kode_produk']) { //kalau blm terdaftar di tabel laporan
          $this->m_laporan->input($banyakLaporan[$counter]['kode_produk'],$banyakLaporan[$counter]['kode_penjualan'],$banyakLaporan[$counter]['stok_minim']);
        }
      }
    }else if(count($cek) <= count($banyakLaporan)) {
      for ($counter = 0; $counter < count($cek); $counter++) {
      // $cek =$this->m_laporan->ambil()->result();
          for ($c = 0; $c < count($banyakLaporan); $c++) {
          if($cek[$counter]->kode_produk == $banyakLaporan[$c]['kode_produk']){
            //disini alter
            $this->m_laporan->alter($cek[$counter]->kode_produk,  $banyakLaporan[$c]['kode_penjualan'], $banyakLaporan[$c]['stok_minim']);
      
          } 
          else if($cek[$counter]->kode_produk != $banyakLaporan[$c]['kode_produk']) { //kalau blm terdaftar di tabel laporan
            $this->m_laporan->input($banyakLaporan[$c]['kode_produk'],$banyakLaporan[$c]['kode_penjualan'],$banyakLaporan[$c]['stok_minim']);
          }
        }
      } 
    }
    
    for ($idx = 0; $idx < count($banyakLaporan); $idx++) {//memproses data tb_laporan dengan tb_produk untuk hitung prediksi dengan membandingkan kode produk di tabel laporan
      if($banyakLaporan[$idx]['kode_produk'] == $tmpProduk[$idx]->kode_produk){
        if($banyakLaporan[$idx]['stok_minim'] >= $tmpProduk[$idx]->stok){  // stok_minim >= stok_produk?                                                                           
        
          $data['barangTampil'][] = $this->hitung_prediksi($tmpProduk[$idx]->kode_produk,$tmpProduk[$idx]->nama_produk,$tmpProduk[$idx]->stok);
        }
      }
    }
      $this->load->view('halaman/laporan_prediksi',$data);
     }
  }

  public function hitung_prediksi($id,$nama_barang,$stok){
    
    $penjualan =    $this->m_penjualan->query_penjualan($id)->result();
    $penjualanAkhir = (array) $this->m_laporan->barang($id)->row();
    // var_dump($penjualanAkhir);
    $barang = array();
    $objek=array();
                                                                                                                
    for($i=0 ; $i< count($penjualan); $i++){
      if($penjualan[$i]->kode_produk == $id){
        $barang[$i] = $penjualan[$i]->kuantitas;
      }
    }
   // mencari mape terkecil
   $objek=$this->mencari_mape_terkecil($barang,$nama_barang,$stok, $penjualanAkhir);
   return $objek;                                                                                                                       
  }
   
  public function mencari_mape_terkecil($barang,$nama_barang, $stok, $penjualanAkhir){
    $alpha = 0.0;
    $minMape = array();
    $tempMape;
    $arrayObjek= array();
    $objek = array();
    for($index=0; $index<9 ; $index++){
      $flagTampil = 0;
      $alpha = $alpha + 0.1;
      $tempMape=$this->double_exponential_smoothing($barang,$alpha,$flagTampil);
      // echo "Nama barang : " .$nama_barang." dengan mape : ".$tempMape." alpha : ".$alpha." <br/>";// meliat mape dan alphas
      $arrayObjek[] = new parameterAlpha($alpha,$tempMape);
      $tes= (array) $arrayObjek;
    }
    $convert2array = array_column($tes, 'mape');
    $min = min($convert2array);
     foreach($tes as $key){
      if($key->mape == $min){
        $flagTampil=1;
        $tempPrediksi=$this->double_exponential_smoothing($barang,$key->alpha,$flagTampil);
        $convertArray= (array) $tempPrediksi;
        // echo "alpha : ". $key->alpha ."  Nama barang : ".$nama_barang. "<br/>";
        $objek = (array) new Prediksi($nama_barang,$stok,$convertArray[0],$convertArray[1],$penjualanAkhir['tahun'],$penjualanAkhir['bulan'],$convertArray[2]);
       return $objek;
      }
    }
  }

  public function double_exponential_smoothing($barang,$alpha,$flagTampil){
  // melakukan smoothing pertama
     $dataKurang = 0;
     $penghalusanPertama = array();
     for($i=0; $i<count($barang); $i++){
        if($i==0){
            $penghalusanPertama[$i]= $barang[$i];
        }else{
            $penghalusanPertama[$i]= ($alpha * $barang[$i]) + ((1 -$alpha) * $penghalusanPertama[$i-1]);
        }
     }
    //  echo "<br></br>penghalusan pertama : ";
    //  print_r($penghalusanPertama);                                                                                                                        
 // melakukan smoothing kedua
    $penghalusanKedua = array();
    for($i=0; $i<count($barang); $i++){
    if($i==0){
        $penghalusanKedua[$i]= $penghalusanPertama[$i]; // initialisasi
    }else{
        $penghalusanKedua[$i]= ($alpha * $penghalusanPertama[$i]) + ((1 -$alpha) * $penghalusanKedua[$i-1]);
    }
    }
    // echo "<br></br>penghalusan kedua : ";
    // print_r($penghalusanKedua);          
    
 // melakukan perhitungan konstanta a atau pemulusan total
    $konstanta = array();
    for($i=0; $i<count($barang); $i++){
      $konstanta[$i] = (2 * $penghalusanPertama[$i]) - $penghalusanKedua[$i];
    }
    // echo "<br></br>besar konstanta : ";
    // print_r($konstanta);                                                                                                              

 // melakukan perhitungan besarnya slope b atau tren
    $slope = array();
    for($i=0; $i<count($barang); $i++){
      if($i==0){
        if(isset($barang[($i+1)]) && isset($barang[($i+2)]) && isset($barang[($i+3)])){
          $slope[$i] = (($barang[($i+1)] - $barang[$i]) + ($barang[($i+3)] - $barang[($i+2)])) / 2; //initialisasi
        }else {
          $slope[$i] = ($alpha / (1 - $alpha )) * ($penghalusanPertama[$i] - $penghalusanKedua[$i]);
        }
      }else {
        $slope[$i] = ($alpha / (1 - $alpha )) * ($penghalusanPertama[$i] - $penghalusanKedua[$i]);
      }
    }
    // echo "<br></br>hasil slope : ";
    // print_r($slope);                                                                                                                          
 // a + b atau forecast untuk mencari mape
    $AnB = array();
    for($i=0; $i<count($barang); $i++){
        if($i==0){
            $AnB[$i] = 0; // initialisasi
        }else{
            $AnB[$i] = floatval($konstanta[$i-1] + $slope[$i-1]); //menghitung nilai peramalan untuk mape.
        }
    }
    // echo "<br></br> A + B : ";
    // print_r($AnB);
 // periode yang di prediksikan kedepan atau hasil peramalan periode kedepan ft + m
    $prediksi;
    $dataKemuka = count($barang) + 1;
    $dataTerakhir = count($barang);
    $M = $dataKemuka - count($barang);
    $prediksi = $konstanta[$dataTerakhir-1] + ($slope[$dataTerakhir-1]*$M);                                                                                                                
    $prediksi2 = array();
    for($i=0; $i<count($barang); $i++){
      $prediksi2[$i] = $konstanta[$dataTerakhir-1] + ($slope[$dataTerakhir-1]* ($i+1));
    }

    //mape
    $mape = array();
    $totalMape = 0;
    $minMape;
    for($i=1; $i<count($barang); $i++){
      $mape[$i] = ((abs($barang[$i] - $AnB[$i])) / ($barang[$i])) * (100);
      // echo " -> MAPE : ".round($mape[$i],1)."%";
      $totalMape = $totalMape + $mape[$i];
    }
    $angkaNol =  count($barang)-1;
    if($angkaNol == 0){
      $minMape = ($totalMape)/(count($barang));  
      $dataKurang=1;
    }else{
      $minMape = ($totalMape)/(count($barang)-1);
    }
    // echo"<br></br>mape".$totalMape;
    for($i=0; $i<count($barang); $i++){
      // echo "  Prediksi Periode data " .(count($barang)+($i+1)) . " = " . ($prediksi2[$i]);
    }   
    // echo " total mape : ".(($minMape))."%";
    if($flagTampil == 1){
      $objek = (object)[
        $prediksi,
        $minMape,
        $dataKurang,
      ];
      return $objek;
    } 
  return $minMape;
  }
}

