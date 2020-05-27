<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk extends CI_Model {

  
  public function input(){
    $data = array('kode_produk' => $this->input->post('kode_produk') , 
                  'nama_produk'=> $this->input->post('nama_produk'),
                  'stok'=> $this->input->post('stok'));
    return $this->db->insert('tb_produk',$data);
  }
  public function sudahAda(){
    // var_dump($this->input->post('kode_produk'));
    $this->db->select('kode_produk');
    $this->db->where('kode_produk',$this->input->post('kode_produk')); 
    return $this->db->get('tb_produk');
  }
  public function tampil(){
    $this->db->select('*');
  return $this->db->get('tb_produk');
  }

  public function delete(){

        $this->db->where('id_produk',$this->uri->segment(3));
        return $this->db->delete('tb_produk');

  }

  public function m_edit(){

    $this->db->select('*');
    $this->db->where('id_produk',$this->uri->segment(3));
  return $this->db->get('tb_produk');
  
  }

  public function m_update(){

    $data = array(
                  'nama_produk'=> $this->input->post('nama_produk'),
                  'stok'=> $this->input->post('stok'));

        $this->db->where('id_produk',$this->uri->segment(3));
        return $this->db->update('tb_produk',$data);

  }

}

