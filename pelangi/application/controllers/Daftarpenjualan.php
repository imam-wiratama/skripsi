<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarpenjualan extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_penjualan');
    $this->load->model('m_produk');

  }

  // List all data
  public function index()
  {
     $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
     $data['menu']= $this->load->view('include/menu', $data, TRUE);
     $data['tmp_penjualan']= $this->m_penjualan->tampil()->result();
     $data['tmp_produk']= $this->m_produk->tampil()->result();
     if(isset($data['tmp_produk'])){
      $this->load->view('halaman/pilihproduk_penjualan',$data);
     }else if(!isset($data['tmp_produk'])){

       $this->load->view('halaman/pilihproduk_penjualan',$data);
     }
  }

  public function pilih_barang(){
    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
    $data['menu']= $this->load->view('include/menu', $data, TRUE);
    $tahunAwal = (array) $this->m_penjualan->tahun_awal()->row();
    if($tahunAwal){
      $data['kode_produk'] = $this->m_penjualan->tampilkanBerdasarkanId($tahunAwal['tahun'])->result();
      $data['tahun'] = $this->m_penjualan->tampilkanBerdasarkanTahun()->result();

    }
    $data['nama_produk'] = $this->m_penjualan->add_id()->row();
    // var_dump( $data['nama_produk']);
    $this->load->view("halaman/daftar_penjualan",$data);
  }
  public function pilih_tahun(){
    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
    $data['menu']= $this->load->view('include/menu', $data, TRUE);
    // var_dump($this->input->post('tahun'));
      $data['kode_produk'] = $this->m_penjualan->tampilkanBerdasarkanId($this->input->post('tahun'))->result();
      $data['nama_produk'] = $this->m_penjualan->add_id()->row();
      $data['tahun'] = $this->m_penjualan->tampilkanBerdasarkanTahun()->result();
      $this->load->view("halaman/daftar_penjualan",$data);
  }

  // Add a form item
  public function form_add()
  { 
    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
    $data['menu']= $this->load->view('include/menu', $data, TRUE);
    $data['nama_produk'] = $this->m_penjualan->get_id()->row();
     $this->load->view('halaman/tambah_penjualan',$data);
  }
    


    // ada data proses input
  public function add()
  {   
    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
    $data['menu']= $this->load->view('include/menu', $data, TRUE);
    if($this->input->post('kode_produk')&&$this->input->post('nama_produk')&&$this->input->post('tahun')&&$this->input->post('bulan')&&$this->input->post('kuantitas')){
      $sudahAda= (array) $this->m_penjualan->sudahAda()->row();
      echo " sudah ada :";
      // var_dump($sudahAda); 
      if( isset($sudahAda['bulan']) && $sudahAda['bulan']  == $this->input->post('bulan')){
        ?>
      <script type=text/javascript>
          alert("Data sudah ada");
      </script>
          <?php
          // redirect('daftarpenjualan ','refresh');
          // var_dump($this->input->post('tahun'));

          $data['kode_produk'] = $this->m_penjualan->tampilkanBerdasarkanId($this->input->post('tahun'))->result();
          $data['nama_produk'] = $this->m_penjualan->add_id()->row();
          $data['tahun'] = $this->m_penjualan->tampilkanBerdasarkanTahun()->result();
          $this->load->view("halaman/daftar_penjualan",$data);
        }
        else{
          if( $this->m_penjualan->input())
          {
        $this->session->set_flashdata('pesan','add data succesfuly!');
        $data['kode_produk'] = $this->m_penjualan->tampilkanBerdasarkanId($this->input->post('tahun'))->result();
        $data['nama_produk'] = $this->m_penjualan->add_id()->row();
        $data['tahun'] = $this->m_penjualan->tampilkanBerdasarkanTahun()->result();
        $this->load->view("halaman/daftar_penjualan",$data);
        // redirect('daftarpenjualan ','refresh');

      }else{
        $this->session->set_flashdata('pesan','add data failed');
        // redirect('daftarpenjualan','refresh');
     
        $this->load->view("halaman/daftar_penjualan",$data);
      }
    }
    }
    else{?>
      <script type=text/javascript>
          alert("Input tidak valid");
      </script>
          <?php
          $this->session->set_flashdata('pesan','tambah data gagal');
          $data['kode_produk'] = $this->m_penjualan->tampilkanBerdasarkanId($this->input->post('tahun'))->result();
          $data['nama_produk'] = $this->m_penjualan->add_id()->row();
          $data['tahun'] = $this->m_penjualan->tampilkanBerdasarkanTahun()->result();
          $this->load->view("halaman/daftar_penjualan",$data);
          // redirect('daftarpenjualan/','refresh');
    }
  }

  public function edit(){
    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
    $data['menu']= $this->load->view('include/menu', $data, TRUE);
    $data['tmp']=$this->m_penjualan->m_edit()->row();
    $this->load->view('halaman/edit_penjualan',$data);

 }

 //Update one item
 public function update()
 {
  $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
  $data['menu']= $this->load->view('include/menu', $data, TRUE);
  if($this->input->post('kuantitas')){
    if($this->m_penjualan->m_update()){
      $this->session->set_flashdata('pesan','Update data succesfuly!');
      redirect('/daftarpenjualan','refresh');
    }else{
      $this->session->set_flashdata('pesan','Update data failed');
      redirect('/','refresh');
    }
  }else{?>
    <script type=text/javascript>
        alert("Input tidak valid");
    </script>
        <?php
    $this->session->set_flashdata('pesan','update data gagal');
    // redirect('daftarpenjualan','refresh');
    
  }
 }


   //Delete one item
   public function del()
   {
      if($this->m_penjualan->delete())
      {
        $this->session->set_flashdata('pesan','Delete data succesfuly!');
        redirect('daftarpenjualan','refresh');
      }else{
        $this->session->set_flashdata('pesan','Delete data failed');
        redirect('daftarpenjualan','refresh');
            }
    }
   

}

