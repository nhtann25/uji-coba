<?php

class Category extends CI_Controller {

	public function nonfiction()
	{
		$data['title'] = 'NonFiction';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nonfiction'] = $this->model_category->nonfiction()->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('category/nonfiction', $data);
        $this->load->view('templates/footer');
    }
    
    public function fiction()
	{
		$data['title'] = 'Fiction';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['fiction'] = $this->model_category->fiction()->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('category/fiction', $data);
        $this->load->view('templates/footer');
    }
    
    public function horror()
	{
		$data['title'] = 'Horror';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['horror'] = $this->model_category->horror()->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('category/horror', $data);
        $this->load->view('templates/footer');
    }
    
    public function romance()
	{
		$data['title'] = 'Romance';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['romance'] = $this->model_category->romance()->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('category/romance', $data);
        $this->load->view('templates/footer');
	}
}


