<?php

class Model_category extends CI_Model{
    public function nonfiction(){
       return $this->db->get_where('tbl_buku', array('id_kategori' => '1'));
    }

    public function fiction(){
        return $this->db->get_where('tbl_buku', array('id_kategori' => '2'));
        
     }

     public function horror(){
        return $this->db->get_where('tbl_buku', array('id_kategori' => '3'));
        
     }

     public function romance(){
        return $this->db->get_where('tbl_buku', array('id_kategori' => '4'));
        
     }
}




?>