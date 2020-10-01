<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scanner extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->model('Assets_model');
        $this->load->model('Inventaris_model');
    }

    function profile()
    {
        $this->load->view('v_scanner');
    }

    function inven()
    {
        $this->load->view('v_scanner_aset');
    }
}
