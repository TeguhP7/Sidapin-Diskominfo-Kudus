<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VerifyLogin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_login', '', TRUE);
	}


	function index()
	{
		// $this->load->model('user_login');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required|callback_check_database');

		if ($this->form_validation->run() == FALSE) {
			// Validasi Gagal, Arahkan Kembali Ke Login
			$this->load->view('v_login');
		} else {
			//Berhasil Login
			redirect('Home', 'refresh');
		}
	}

	function check_database($password)
	{
		// $this->load->model('user_login');
		$username = $this->input->post('username');

		//query the database
		$result = $this->User_login->login($username, $password);

		if ($result) {
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = array(
					'username' => $row->username

				);
				$this->session->set_userdata('logined', $sess_array);
				$this->session->set_userdata('username', $row->username);
				$this->session->set_userdata('status', $row->status);
			}
			return TRUE;
		} else {
			// echo ('<script>window.alert("Username atau password yang Anda masukkan salah!");
			// window.location="Login";
			// </script>');
			$this->form_validation->set_message('check_database', 'Username atau password yang Anda masukkan salah!');
			return false;
		}
	}
}
