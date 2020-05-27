<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penjualan extends CI_Model {

  
  public function input(){
    $data = array('kode_produk' => $this->input->post('kode_produk') , 
                  'nama_produk'=> $this->input->post('nama_produk'),
                  'tahun'=> $this->input->post('tahun'),
                  'bulan'=> $this->input->post('bulan'),
                  'kuantitas'=> $this->input->post('kuantitas'));
    return $this->db->insert('tb_penjualan',$data);
  }
  public function sudahAda(){
    // var_dump($this->input->post('bulan'));
    $this->db->select('bulan');
    $this->db->where('kode_produk',$this->input->post('kode_produk')); 
    $this->db->where('tahun',$this->input->post('tahun'));
    $this->db->where('bulan',$this->input->post('bulan'));
    return $this->db->get('tb_penjualan');
  }
  public function tampil(){
    $this->db->select('*');
  return $this->db->get('tb_penjualan');
  }

  public function tampilkanBerdasarkanId($tahun){
      // var_dump($this->input->post('kode_produk'));
      $kode_produk = 0;
      if($this->input->post('kode_produk')){
        $kode_produk = $this->input->post('kode_produk');
      }else if($this->session->flashdata('del')){
        $kode_produk = $this->session->flashdata('del');
      }
        $this->db->select('*');
        $this->db->where('kode_produk',$this->input->post('kode_produk'));
        $this->db->where('tahun',$tahun);
        return $this->db->get('tb_penjualan');
    }
  public function tahun_awal(){
    $this->db->distinct();
    $this->db->select('tahun');
    $this->db->where('kode_produk',$this->input->post('kode_produk'));
    $this->db->order_by('tahun',"asc");
    $this->db->limit(1);
      return $this->db->get('tb_penjualan');
  }
  public function tahun_akhir(){
    $this->db->distinct();
    $this->db->select('tahun','bulan');
    $this->db->where('kode_produk',$this->input->post('kode_produk'));
    $this->db->order_by('tahun',"desc");
    $this->db->order_by('bulan',"desc");
    $this->db->limit(1);
      return $this->db->get('tb_penjualan');
  }
    public function tampilkanBerdasarkanTahun(){
      $this->db->distinct();
      $this->db->select('kode_produk,tahun');
        $this->db->where('kode_produk',$this->input->post('kode_produk'));
        return $this->db->get('tb_penjualan');
    }
    public function add_id(){
     
        $this->db->select('nama_produk, kode_produk');
        $this->db->where('kode_produk',$this->input->post('kode_produk'));
        $this->db->distinct();
        return $this->db->get('tb_produk',1);
    }

    public function get_id(){
        
        $this->db->select('nama_produk, kode_produk');
        $this->db->where('kode_produk',$this->uri->segment(3));
        $this->db->distinct();
        return $this->db->get('tb_produk',1);
    }
    
    public function tabel(){
        var_dump($this->input->post('tahun'));
        $this->db->select('*');
        $this->db->where('kode_produk',$this->input->post('tahun'));
        return $this->db->get('tb_penjualan',1);
    }
    
    

  public function delete(){

        $this->db->where('kode_penjualan',$this->uri->segment(3));
        return $this->db->delete('tb_penjualan');

  }

  public function m_edit(){

    $this->db->select('*');
    $this->db->where('kode_penjualan',$this->uri->segment(3));
  return $this->db->get('tb_penjualan');
  
  }

  public function m_update(){

    $data = array('kuantitas'=> $this->input->post('kuantitas'));

        $this->db->where('kode_penjualan',$this->uri->segment(3));
        return $this->db->update('tb_penjualan',$data);

  }
  
  public function query_penjualan($id){
    $this->db->select('*');
    $this->db->where('kode_produk', $id);
    $this->db->order_by('tahun',"asc");
    $this->db->order_by('bulan',"asc");
    return $this->db->get('tb_penjualan');
  }
}

