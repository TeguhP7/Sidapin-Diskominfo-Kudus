<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_assets extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Assets_model');
        $this->load->library('pagination');

        if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
            redirect('/');
        }
    }

    function index()
    {
        $config['base_url'] = site_url('Data_assets/index'); //site url
        $config['total_rows'] = $this->db->count_all('assets'); //total row
        $config['per_page'] = 5;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Selanjutnya';
        $config['prev_link']        = 'Sebelumnya';
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
        $data['data'] = $this->Assets_model->pagination($config["per_page"], $data['page']);
        $data['pagination'] = $this->pagination->create_links();
        $data['foto_aset'] = $this->db->get_where('assets', 'foto_aset');
        //load view 
        $this->load->view('Assets_v/assets_list', $data);
    }

    // function search()
    // {
    //     // Ambil data NIS yang dikirim via ajax post
    //     $keyword = $this->input->post('keyword');
    //     $search = $this->Assets_model->search($keyword);

    //     // Kita load file view.php sambil mengirim data siswa hasil query function search di SiswaModel
    //     $hasil = $this->load->view('Assets_v/assets_list', array('data' => $search), true);
    //     var_dump($hasil);

    //     // Buat sebuah array
    //     $callback = array(
    //         'hasil' => $hasil, // Set array hasil dengan isi dari view.php yang diload tadi
    //     );
    //     echo json_encode($callback); // konversi varibael $callback menjadi JSON
    // }

    function uploadImage()
    {
        $config['upload_path'] = './assets/images/aset/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['overwrite'] = true;
        $config['max_size']  = '5120';
        $config['remove_space'] = true;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('foto_aset')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => '');
            return $return;
        }
    }

    function download($id)
    {
        $sk = $this->Assets_model->ambil_data_id($id);
        force_download('assets/images/aset/' . $sk->foto_aset, null);
    }

    function tambah()
    {
        $data = array(
            'kode_aset' => set_value('kode_aset'),
            'nama_aset' => set_value('nama_aset'),
            'kondisi' => set_value('kondisi'),
            'tahun' => set_value('tahun'),
            'ket_lain' => set_value('ket_lain'),
            'id_assets' => set_value('id_assets'),
            'button' => 'Tambah',
            'action' => site_url('Data_assets/tambah_aksi'),
        );
        if ($this->input->post('submit')) { // Jika user menekan tombol Submit (Simpan) pada form
            // lakukan upload file dengan memanggil function upload yang ada di GambarModel.php
            $upload = $this->uploadImage();

            if ($upload['result'] == "success") { // Jika proses upload sukses
                // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
                $this->tambah_aksi($upload);

                redirect('Data_assets'); // Redirect kembali ke halaman awal / halaman view data
            } else { // Jika proses upload gagal
                $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
            }
        }

        $this->load->view('Assets_v/assets_form', $data);
    }

    function tambah_aksi()
    {
        $upload = $this->uploadImage();
        $data = array(
            'foto_aset' => $upload['file']['file_name'],
            'kode_aset' => $this->input->post('kode_aset'),
            'nama_aset' => $this->input->post('nama_aset'),
            'kondisi' => $this->input->post('kondisi'),
            'ket_lain' => $this->input->post('ket_lain'),
            'tahun' => $this->input->post('tahun'),
        );
        $this->Assets_model->tambah_data($data);
        redirect(site_url('Data_assets'));
    }
    function delete($id)
    {
        $this->Assets_model->hapus_data($id);
        redirect(site_url('Data_assets'));
    }

    function edit($id)
    {
        $ivs = $this->Assets_model->ambil_data_id($id);
        $data = array(
            'kode_aset' => set_value('kode_aset', $ivs->kode_aset),
            'nama_aset' => set_value('nama_aset', $ivs->nama_aset),
            'kondisi' => set_value('kondisi', $ivs->kondisi),
            'tahun' => set_value('tahun', $ivs->tahun),
            'ket_lain' => set_value('ket_lain', $ivs->ket_lain),
            'id_assets' => set_value('id_assets', $ivs->id_assets),
            'button' => 'Simpan',
            'action' => site_url('Data_assets/edit_aksi'),
        );
        $this->load->view('Assets_v/assets_form', $data);
    }

    function edit_aksi()
    {
        $data = array(
            //'foto_aset' => $upload['file']['file_name'],
            'kode_aset' => $this->input->post('kode_aset'),
            'nama_aset' => $this->input->post('nama_aset'),
            'kondisi' => $this->input->post('kondisi'),
            'tahun' => $this->input->post('tahun'),
            'ket_lain' => $this->input->post('ket_lain'),
            'id_assets' => $this->input->post('id_assets'),
        );
        $upload = $this->uploadImage();
        if ($upload['result'] == "success") {
            $data['foto_aset'] = $upload['file']['file_name'];
            $id = $this->input->post('id_assets');
            $this->Assets_model->edit_data($id, $data);
            redirect(site_url('Data_assets'));
        } else {
            $id = $this->input->post('id_assets');
            $this->Assets_model->edit_data($id, $data);
            redirect(site_url('Data_assets'));
        }
    }
}