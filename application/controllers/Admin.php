<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        is_logged_in();
        $this->load->model('Model_role', 'role');
        $this->load->model('Model_book', 'book');
        $this->load->model('Model_invoice', 'invoice');
        $this->load->library('Pdf');
        $this->load->model('report_model');
        
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['total_buku'] = $this->book->countAll();
        $data['total_buyers'] = $this->invoice->countAllBuyers();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
        
    }
    public function dashboardchart()
    {
        $bulan = [
            "1" => "January",
            "2" => "February",
            "3" => "March",
            "4" => "April",
            "5" => "May",
            "6" => "June",
            "7" => "July",
            "8" => "August",
            "9" => "September",
            "10" => "October",
            "11" => "November",
            "12" => "December"
        ];
        $datas = $this->invoice->getDataPerBulan();
        $total_bulan = [];
        $bulan_tersedia = [];
        foreach ($datas as $data) {
            $total_bulan[$data->bulan] = $data->harga;
            $bulan_tersedia[] = $data->bulan; 
        }
        $chart_bulan = [];
        $chart_total = [];
        for ($i=1; $i <= count($bulan) ; $i++) { 
            if(in_array($i, $bulan_tersedia)){
                $chart_total[] = (int)$total_bulan[$i];
            }else{
                $chart_total[] = 0;
            }
            $chart_bulan[] = $bulan[$i];
        }

        $result = [];
        $result['bulan'] = $chart_bulan;
        $result['total'] = $chart_total;
        echo json_encode($result);
    }


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    } else {
        $this->db->insert('user_role', ['role' => $this->input->post('role')]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role added!</div>');
        redirect('admin/role');
        }
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function role_edit($id)
    {
        $data['title'] = 'Edit Role';
        $data['role'] = $this->db->get_where('user_role',  ['id' => $id])->row();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_role', $data);
        $this->load->view('templates/footer');
    }

    public function role_update()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        

        $data = array(
                'role' => $role
                
         );
         //yang ini, tinggal ganti nama tabelnya aja
         $where = ['id' => $id];
        $this->role->update_role($data,'user_role',$where);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your role has been update!</div>');
        redirect('admin/role');
    }

    public function role_delete($id)
    {
        $where = ['id' => $id];
        $this->role->delete_data('user_role',$where);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your role has been delete!</div>');
        redirect('admin/role');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function bookData(){
        $data['title'] = 'Book Data';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['book'] = $this->book->tampil_book();
       
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/bookdata', $data);
        $this->load->view('templates/footer');

        
    }

    public function upload(){
        $id_buku = $this->input->post('id_buku');
        $id_kategori = $this->input->post('id_kategori');
        $judul = $this->input->post('judul');
        $penerbit = $this->input->post('penerbit');
        $pengarang = $this->input->post('pengarang');
        $jml_halaman = $this->input->post('jml_halaman');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $gambar = $_FILES['gambar']['name'];

		if ($gambar = ''){

        }else{
			$nama_baru = date('dmyhis')."_".$_FILES['gambar']['name'];
            $config['upload_path'] = './assets/img/uploads/';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';
            $config['file_name'] = $nama_baru;

			$this->load->library('upload',$config);
			if (!$this->upload->do_upload('gambar')){
						echo "Upload Gagal"; die();
			}else {
			$gambar = $this->upload->data('file_name');
			}
        } 
        $data = array(
                'id_buku' => $id_buku,
                'id_kategori' => $id_kategori,
                'judul' => $judul,
                'penerbit' => $penerbit,
                'pengarang' => $pengarang,
                'jml_halaman' => $jml_halaman,
                'harga' => $harga,
                'stok' => $stok,
                'gambar' => $gambar
         );
    $this->model_book->input_data($data,'tbl_buku');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New book added!</div>');
    redirect('admin/bookdata');
    }
    
    public function edit($id_buku){
        $data['title'] = 'Edit Data';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $where = array('id_buku' => $id_buku);
        $data['book'] = $this->model_book->edit($where,'tbl_buku')->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/book_edit', $data);
        $this->load->view('templates/footer');
    } 

    public function update()
    {
        $id_buku = $this->input->post('id_buku');
        $id_kategori = $this->input->post('id_kategori');
        $judul = $this->input->post('judul');
        $penerbit = $this->input->post('penerbit');
        $pengarang = $this->input->post('pengarang');
        $jml_halaman = $this->input->post('jml_halaman');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $gambar = $_FILES['gambar']['name'];

        $data = array(
            'id_kategori' => $id_kategori,
            'judul' => $judul,
            'penerbit' => $penerbit,
            'pengarang' => $pengarang,
            'jml_halaman' => $jml_halaman,
            'harga' => $harga,
            'stok' => $stok
            
        );
		if ($gambar == ''){

        }else{
            $nama_baru = date('dmyhis')."_".$_FILES['gambar']['name'];
            $config['upload_path'] = './assets/img/uploads/';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';
            $config['file_name'] = $nama_baru;
			$this->load->library('upload',$config);
			if (!$this->upload->do_upload('gambar')){
						echo "Upload Gagal"; die();
			}else {
            $gambar = $this->upload->data('file_name');
            unlink('./assets/img/uploads/'.$this->input->post('gambar_lama'));
            $data['gambar'] = $gambar;
            
			}
        } 
       
    $this->model_book->update_data($data,'tbl_buku',$id_buku);

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your book has been updated!</div>');
    redirect('admin/bookdata');
    
    }

   
    public function delete($id_buku){
       
        $data = $this->model_book->getDataByID($id_buku)->row();
		$nama = './assets/img/uploads/'.$data->gambar;

		if(is_readable($nama) && unlink($nama)){
            $delete = $this->model_book->delete($id_buku);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your book has been delete!</div>');
            redirect('admin/bookdata');
		}else{
			echo "Gagal";
		}
    }

    public function invoice(){
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['invoice'] = $this->model_invoice->tampil_data();

        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/invoice', $data);
        $this->load->view('templates/footer');
        
    }

   

    public function detail($id_invoice){
        $data['title'] = 'Detail Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['invoice'] = $this->model_invoice->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice);
         
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail_invoice', $data);
        $this->load->view('templates/footer');
    }

    public function salesReport()
    {
        $data['report'] = $this->report_model->get_report();
        $this->load->view('admin/sales_report', $data);
    }
    
    public function bookReport()
    {
        $data['report'] = $this->report_model->bookReport();
        $this->load->view('admin/book_report', $data);
    }  



}
