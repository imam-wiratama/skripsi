<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {


  public function ambil(){
    $this->db->select('*');
  return $this->db->get('tb_laporan');
  }
  public function barang($kode_produk){
    // $this->db->select('*');
    // $this->db->like('kode_produk', $kode_produk);
    // return $this->db->get('tb_penjualan');
   
    $this->db->select('*');
    $this->db->where('kode_produk',$kode_produk);
    $this->db->order_by('tahun',"desc");
    $this->db->order_by('bulan',"desc");
    $this->db->limit(1);
      return $this->db->get('tb_penjualan');
  }

  public function input($kode_produk, $kode_penjualan, $stok_minim){
    $data = array('kode_produk' => $kode_produk , 
    'kode_penjualan'=> $kode_penjualan,
    'stok_minim'=>$stok_minim );
return $this->db->insert('tb_laporan',$data);
  }
  public function alter($kode_produk,$kode_penjualan,$stok_minim){
    $data = array('kode_penjualan' => $kode_penjualan,
                  'stok_minim'=> $stok_minim);

    $this->db->where('kode_produk',$kode_produk);
    return $this->db->update('tb_laporan',$data);
  }
  
}

