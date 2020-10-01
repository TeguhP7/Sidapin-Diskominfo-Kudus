<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cek_data_scan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->model('Inventaris_model');
        $this->load->model('Assets_model');
        $this->load->model('Scanner_model', '', TRUE);
    }


    function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nip_pegawai', 'nip_pegawai', 'trim|required|callback_check_database');
        $this->form_validation->set_rules('kode_aset', 'kode_aset', 'trim|');

        if ($this->form_validation->run()) {
            // if ($this->session->userdata('scan') == $nip_pegawai) {
            //     redirect('Data_scan/profile');
            // }
            // if ($this->session->userdata('scan') == 'kode_aset') {
            //     redirect('Data_scan/aset');
            // }
            redirect('Data_scan/hasilscan');
        } else {
            //Berhasil Login
            $this->form_validation->set_message('check_database', 'Maaf data scan tidak ditemukan!');
        }
    }

    function check_database($scan)
    {
        $scan = $this->input->post('nip_pegawai');
        //query the database
        $result = $this->Scanner_model->scanner($scan);
        var_dump($result);
        if ($result != null) {
            return $result;
        } else {
            // echo ('<script>window.alert("Username atau password yang Anda masukkan salah!");
            // window.location="Login";
            // </script>');
            $this->form_validation->set_message('check_database', 'Maaf data scan tidak ditemukan!');
            return false;
        }
    }
}
