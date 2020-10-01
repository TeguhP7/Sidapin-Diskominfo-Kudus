<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_scan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->model('Inventaris_model');
        $this->load->model('Assets_model');
        $this->load->model('Scanner_model', '', TRUE);
    }


    function profile()
    {
        $qr = $this->input->post('nip_pegawai');
        if ($qr != null) {
            $p = $this->Pegawai_model->ambil_data_scan($qr);
            $data = array(
                'foto' => $p->nama_file,
                'nip_pegawai' => $p->nip_pegawai,
                'nama_pegawai' => $p->nama_pegawai,
                'jabatan' => $p->jabatan,
                'status_p' => $p->status_p,
                'telepon' => $p->telepon,
                'jenis_k' =>  $p->jenis_k,
                'agama' => $p->agama,
                'status' => $p->status,
                'alamat' => $p->alamat,
                'id_peg' => $p->id_peg,
            );
            $this->load->view('v_data_scan', $data);
        } else {
            redirect(base_url('Login'));
        }
    }

    function aset()
    {
        $qr = $this->input->post('kode_aset');
        if ($qr != null) {
            $id_assets = $this->Assets_model->ambil_data_scan($qr)->id_assets;
            $id = $this->Inventaris_model->ambil_data_scan($id_assets)->id;
            $a = $this->Inventaris_model->ambil_data_id($id)->id_peg;
            $b =   $this->Inventaris_model->ambil_data_id($id);
            $p = $this->Assets_model->ambil_data_id($id_assets);
            $data = array(
                'id' => set_value('id', $id),
                'id_peg' => set_value('id_peg', $a),
                'id_assets' => set_value('id_assets', $id_assets),
                'foto' => $p->foto_aset,
                'kode_aset' => $p->kode_aset,
                'nama_aset' => $p->nama_aset,
                'tahun' => $p->tahun,
                'kondisi' => $p->kondisi,
                'pengguna' => $this->Pegawai_model->ambil_data_id($a)->nama_pegawai,
                'ket_lain' => set_value('ket_lain', "$p->ket_lain" . ", " . "$b->ket_lain"),
            );
            $this->load->view('v_data_scan_aset', $data);
        } else {
            redirect(base_url('Login'));
        }
    }

    // function hasilscan()
    // {
    //     $qr = $this->input->post('nip_pegawai');
    //     $t = $this->Scanner_model->scanner($qr);
    //     if ($qr == $t) {
    //         //f ($this->session->userdata('scan') == $qr) {
    //         $p = $this->Pegawai_model->ambil_data_scan($qr);
    //         $data = array(
    //             'foto' => $p->nama_file,
    //             'nip_pegawai' => $p->nip_pegawai,
    //             'nama_pegawai' => $p->nama_pegawai,
    //             'jabatan' => $p->jabatan,
    //             'status_p' => $p->status_p,
    //             'telepon' => $p->telepon,
    //             'jenis_k' =>  $p->jenis_k,
    //             'agama' => $p->agama,
    //             'status' => $p->status,
    //             'alamat' => $p->alamat,
    //             'id_peg' => $p->id_peg,
    //         );
    //         $this->load->view('v_data_scan', $data);
    //     }

    //     $q = $this->input->post('kode_aset');
    //     $s = $this->Scanner_model->scanner($q);
    //     if ($q == $s) {
    //         $id_assets = $this->Assets_model->ambil_data_scan($q)->id_assets;
    //         $id = $this->Inventaris_model->ambil_data_scan($id_assets)->id;
    //         $a = $this->Inventaris_model->ambil_data_id($id)->id_peg;
    //         $b =   $this->Inventaris_model->ambil_data_id($id);
    //         $p = $this->Assets_model->ambil_data_id($id_assets);
    //         $data = array(
    //             'id' => set_value('id', $id),
    //             'id_peg' => set_value('id_peg', $a),
    //             'id_assets' => set_value('id_assets', $id_assets),
    //             'foto' => $p->foto_aset,
    //             'kode_aset' => $p->kode_aset,
    //             'nama_aset' => $p->nama_aset,
    //             'tahun' => $p->tahun,
    //             'kondisi' => $p->kondisi,
    //             'pengguna' => $this->Pegawai_model->ambil_data_id($a)->nama_pegawai,
    //             'ket_lain' => set_value('ket_lain', "$p->ket_lain" . ", " . "$b->ket_lain"),
    //         );
    //         error_reporting(0);
    //         $this->load->view('v_data_scan_aset', $data);
    //     }
    // }
}
