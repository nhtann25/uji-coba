<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_book extends CI_Model
{
    public function tampil_book(){
        $this->db->select("tbl_buku.*, tbl_kategori.kategori" )
         ->from("tbl_buku")
         ->join("tbl_kategori", "tbl_kategori.id_kategori = tbl_buku.id_kategori");
        return $result = $this->db->get()->result_array();
    }

    public function input_data($data,$table){
        $this->db->insert($table,$data);
    }

    public function edit($where,$table){
        return $this->db->get_where($table, $where);
    }

    public function delete($id_buku){
        $this->db->where('id_buku', $id_buku);
        return $this->db->delete('tbl_buku');
    }

    public function getDataByID($id_buku){
        return $this->db->get_where('tbl_buku', array('id_buku'=>$id_buku));
    }

    public function find($id_buku){
        $result = $this->db->where('id_buku', $id_buku)
                            ->limit(1)
                            ->get('tbl_buku');
        if($result->num_rows() > 0){
            return $result->row();

        }else{
            return array();
        }
    }

    public function detail_buku($id_buku){
        $result = $this->db->where('id_buku', $id_buku)->get('tbl_buku');
        if($result->num_rows() > 0){
            return $result->result();
        }else {
            return false;
        }
    }

    public function update_data($data,$table,$id){
        $where = ['id_buku' => $id];
        $this->db->update($table,$data,$where);
    }

    public function countAll(){
        $result = $this->db->get('tbl_buku');
        return $result->num_rows();
    }


}

?>