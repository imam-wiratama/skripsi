<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarproduk extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_produk');

  }

  // List all data
  public function index()
  {
    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
    $data['menu']= $this->load->view('include/menu', $data, TRUE);
     $data['tmp']= $this->m_produk->tampil()->result();
     if(isset($data['tmp'])){
       $this->load->view('halaman/daftar_produk',$data);
     }else if(!isset($data['tmp'])) {
      $this->load->view('halaman/daftar_produk',$data);
     }
  }

  // Add a form item
  public function form_add()
  {    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
    $data['menu']= $this->load->view('include/menu', $data, TRUE);
     $this->load->view('halaman/tambah_produk',$data);
  }
    
    // ada data proses input
  public function add()
  {  $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
    $data['menu']= $this->load->view('include/menu', $data, TRUE);
    if($this->input->post('kode_produk')&&$this->input->post('nama_produk')&&$this->input->post('stok')){
      $sudahAda= (array) $this->m_produk->sudahAda()->row();
      echo " sudah ada :";
      // var_dump($sudahAda); 
      if( isset($sudahAda['kode_produk']) && $sudahAda['kode_produk']  == $this->input->post('kode_produk')){
        ?>
      <script type=text/javascript>
          alert("Data sudah ada");
      </script>
          <?php
              redirect('daftarproduk','refresh');
        }
      if( $this->m_produk->input())
      {
                 $this->session->set_flashdata('pesan','add data succesfuly!');
                 redirect('daftarproduk','refresh');
      }else{
  
                  $this->session->set_flashdata('pesan','ta failed');
                 redirect('daftarproduk','refresh');
  
           }
  
    }else{?>
      <script type=text/javascript>
          alert("Input tidak valid");
      </script>
          <?php
          $this->session->set_flashdata('pesan','tambah data gagal');
          redirect('daftarproduk','refresh');
    }
  }

  public function edit(){
    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
     $data['menu']= $this->load->view('include/menu', $data, TRUE);
    $data['tmp']=$this->m_produk->m_edit()->row();
    $this->load->view('halaman/edit_produk',$data);

 }

 //Update one item
 public function update()
 {
  $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
  $data['menu']= $this->load->view('include/menu', $data, TRUE);
  if($this->input->post('nama_produk')&&$this->input->post('stok')){
    if($this->m_produk->m_update()){
               $this->session->set_flashdata('pesan','Update data succesfuly!');
               redirect('/','refresh');
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
                  redirect('daftarproduk','refresh');
            }
   
   }


   //Delete one item
   public function del()
   {
 
      if($this->m_produk->delete())
      {
                 $this->session->set_flashdata('pesan','Delete data succesfuly!');
                 redirect('daftarproduk','refresh');
      }else{
 
                  $this->session->set_flashdata('pesan','Delete data failed');
                 redirect('daftarproduk','refresh');
 
           }
 
   }
  
   
}

