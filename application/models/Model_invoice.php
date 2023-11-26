<?php

class Model_invoice extends CI_Model{
    public function index(){
        date_default_timezone_set('Asia/Jakarta');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');

        $invoice = array (
            'nama' => $nama,
            'alamat' => $alamat,
            'tgl_pesan' => date('Y-m-d  H:i:s'),
            'batas_bayar' => date('Y-m-d  H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y')))
        );

        $this->db->insert('tbl_invoice', $invoice);
        $id_invoice = $this->db->insert_id();

        foreach ($this->cart->contents() as $item){
            $data = array (
                'id_invoice' =>$id_invoice,
                'id_buku' =>$item['id'],
                'nama_buku' =>$item['name'],
                'jumlah' =>$item['qty'],
                'harga' =>$item['price'],
            );

            $this->db->insert('tbl_pesanan', $data);

        }

        return TRUE;
    }

    public function tampil_data(){
        $result = $this->db->get('tbl_invoice');
        if($result->num_rows() > 0){
            return $result->result();
        }else {
            return false;
        }
    }

    public function ambil_id_invoice($id_invoice){
        $result = $this->db->where('id_invoice', $id_invoice)->limit(1)->get('tbl_invoice');

        if($result->num_rows() > 0){
            return $result->row();
        }else {
            return false;
        }
    }

    public function ambil_id_pesanan($id_invoice){
        $result = $this->db->where('id_invoice',$id_invoice)->get('tbl_pesanan');

        if($result->num_rows() > 0){
            return $result->result();
        }else {
            return false;
        }
    }

    public function countAllBuyers(){
        $result = $this->db->get('tbl_invoice');
        return $result->num_rows();
    }

    public function getDataPerBulan()
    {
       return $this->db->select('SUM(tbl_pesanan.harga * tbl_pesanan.jumlah) AS harga, month(tbl_invoice.batas_bayar) as bulan')
                ->join('tbl_invoice', 'tbl_invoice.id_invoice = tbl_pesanan.id_invoice')
                ->group_by('MONTH(tbl_invoice.batas_bayar)')
                ->where('YEAR(tbl_invoice.batas_bayar)', date('Y'))
                ->order_by('bulan', 'asc')
                ->get('tbl_pesanan')
                ->result();
        
    }
}

?>