<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Model_book', 'book');
        
    }

    public function index()
    {
        $data['title'] = 'All Products';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['book'] = $this->book->tampil_book();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    public function add_shopping($id_buku){
        
        $book = $this->model_book->find($id_buku);
        $data = array (

        'id' => $book->id_buku,
        'qty' =>1,
        'price' => $book->harga,
        'name' => $book->judul
        
        );

        
        $this->cart->insert($data);
        redirect('dashboard');
    }

    public function detail_cart(){
        $data['title'] = 'Detail Cart';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/cart', $data);
        $this->load->view('templates/footer');

    }

    public function delete_cart(){
        $this->cart->destroy();
        redirect('dashboard/index');
    }

    public function checkout(){
        $data['title'] = 'Checkout';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
       
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/checkout', $data);
        $this->load->view('templates/footer');
        
    }

    public function proses(){
        $data['title'] = 'Proses';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $is_processed = $this->model_invoice->index();
        if($is_processed){
        $this->cart->destroy();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/proses', $data);
        $this->load->view('templates/footer');
        }else {
            echo "failed!";
        }
    }


    public function detail_buku($id_buku){
        $data['title'] = 'Detail Buku';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['book'] = $this->model_book->detail_buku($id_buku);

      
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/detail_buku', $data);
        $this->load->view('templates/footer');
    
    }


}