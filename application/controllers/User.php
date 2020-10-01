<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('pagination');

		if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
			redirect('/');
		}
	}
	function index()
	{
		$config['base_url'] = site_url('User/index'); //site url
		$config['total_rows'] = $this->db->count_all('user'); //total row
		$config['per_page'] = 5;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		// Membuat Style pagination untuk BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = '>>';
		$config['prev_link']        = '<<';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>>></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		//panggil function 
		$data['data'] = $this->User_model->pagination($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		//load view 
		//$data['User'] = $this->User_model->ambil_data();
		$this->load->view('User/user_list', $data);
	}

	function tambah()
	{
		$data = array(
			'username' => set_value('username'),
			'password' => set_value('password'),
			'status' => set_value('status'),
			'button' => 'Tambah',
			'action' => site_url('User/tambah_aksi'),

		);
		$this->load->view('User/user_form', $data);
	}

	function tambah_aksi()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'status' => $this->input->post('status'),
		);
		$this->User_model->tambah_data($data);
		redirect(site_url('User'));
	}
	function delete($id)
	{
		$this->User_model->hapus_data($id);
		redirect(site_url('User'));
	}

	function edit($id)
	{
		$u = $this->User_model->ambil_data_id($id);
		$data = array(
			'username' => set_value('username', $u->username),
			'password' => set_value('password', $u->password),
			'status' => set_value('status', $u->status),
			'button' => 'Simpan',
			'action' => site_url('User/edit_aksi'),

		);
		$this->load->view('User/user_form', $data);
	}
	function edit_aksi()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'status' => $this->input->post('status'),
		);
		$id = $this->input->post('id');
		$this->User_model->edit_data($id, $data);
		redirect(site_url('User'));
	}
}
