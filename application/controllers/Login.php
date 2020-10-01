<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('fungsidate');
    }

    public function index()
    {
        $tanggal1 = date("Y-m-d");
        $tanggal2 = tgl_indo($tanggal1);
        $this->session->set_userdata('tanggal', $tanggal2);
        $this->load->helper(array('form'));
        $this->load->view('v_login');
    }

    public function logout()
    {
        $this->session->unset_userdata('logined');
        session_destroy();
        redirect('Login', 'refresh');
    }
}
