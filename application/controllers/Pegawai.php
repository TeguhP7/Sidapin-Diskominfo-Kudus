<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model');
		$this->load->library('pagination');

		if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
			redirect('/');
		}
	}
	function index()
	{
		$config['base_url'] = site_url('Pegawai/index'); //site url
		$config['total_rows'] = $this->db->count_all('pegawai'); //total row
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
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		//panggil function 
		$data['data'] = $this->Pegawai_model->pagination($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		$data['nama_file'] = $this->db->get_where('pegawai', 'nama_file');

		//$data['Pegawai'] = $this->Pegawai_model->ambil_data();
		$this->load->view('Pegawai/pegawai_list', $data);
	}

	function search()
	{
		// Search text
		$keyword = (trim($this->input->post('keyword', true))) ? trim($this->input->post('keyword', true)) : '';
		if ($this->input->post('keyword') != NULL) {
			$this->session->set_userdata(array("search" => $keyword));
		} else {
			if ($this->session->userdata('search') != NULL) {
				$keyword = $this->session->userdata('search');
			}
		}

		$config['base_url'] = site_url('Pegawai/search'); //site url
		$config['total_rows'] = $this->Pegawai_model->count_search($keyword); //total row
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
		$data['data'] = $this->Pegawai_model->search($keyword, $config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		$data['keyword'] =  set_value('keyword', $keyword);

		$this->load->view('Pegawai/pegawai_list', $data);
	}

	function unset_search()
	{
		$this->session->unset_userdata('search');
		redirect('Pegawai');
	}


	function uploadImage()
	{
		$config['upload_path'] = './assets/images/pegawai/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['overwrite'] = true;
		$config['max_size']  = '5120';
		$config['remove_space'] = true;
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		if ($this->upload->do_upload('input_foto')) { // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		} else {
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => '');
			return $return;
		}
	}


	function tambah()
	{
		$data = array(
			'id_peg' => set_value('id_peg'),
			'nip_pegawai' => set_value('nip_pegawai'),
			'nama_pegawai' => set_value('nama_pegawai'),
			'jabatan' => set_value('jabatan'),
			'telepon' => set_value('telepon'),
			'status_p' => set_value('status_p'),
			'alamat' => set_value('alamat'),
			'jenis_k' =>  set_value('jenis_k'),
			'agama' => set_value('agama'),
			'status' => set_value('status'),
			'input_foto' => set_value('input_foto'),
			'small' => '',
			'cancel' => 'Pegawai',
			'button' => 'Tambah',
			'action' => site_url('Pegawai/tambah_aksi'),
		);
		if ($this->input->post('submit')) { // Jika user menekan tombol Submit (Simpan) pada form
			// lakukan upload file dengan memanggil function upload yang ada di GambarModel.php
			$upload = $this->uploadImage();

			if ($upload['result'] == "success") { // Jika proses upload sukses
				// Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
				$this->tambah_aksi($upload);

				redirect('Pegawai'); // Redirect kembali ke halaman awal / halaman view data
			} else { // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		$this->load->view('Pegawai/pegawai_form', $data);
	}

	function tambah_aksi()
	{
		$upload = $this->uploadImage();
		$data = array(
			'nama_file' => $upload['file']['file_name'],
			// 'ukuran' => $upload['file']['file_size'],
			'nip_pegawai' => $this->input->post('nip_pegawai'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jabatan' => $this->input->post('jabatan'),
			'telepon' => $this->input->post('telepon'),
			'status_p' => $this->input->post('status_p'),
			'alamat' => $this->input->post('alamat'),
			'jenis_k' =>  $this->input->post('jenis_k'),
			'agama' => $this->input->post('agama'),
			'status' => $this->input->post('status'),
		);
		$this->Pegawai_model->tambah_data($data);
		redirect(site_url('Pegawai'));
	}

	function delete($id)
	{
		$this->Pegawai_model->hapus_data($id);
		redirect(site_url('Pegawai'));
	}

	function edit($id)
	{
		$kry = $this->Pegawai_model->ambil_data_id($id);
		$data = array(
			'nama_pegawai' => set_value('nama_pegawai', $kry->nama_pegawai),
			'jabatan' => set_value('jabatan', $kry->jabatan),
			'telepon' => set_value('telepon', $kry->telepon),
			'status_p' => set_value('status_p', $kry->status_p),
			'alamat' => set_value('alamat', $kry->alamat),
			'jenis_k' =>  set_value('jenis_k', $kry->jenis_k),
			'agama' => set_value('agama', $kry->agama),
			'status' => set_value('status', $kry->status),
			'nip_pegawai' => set_value('nip_pegawai', $kry->nip_pegawai),
			'id_peg' => set_value('id_peg', $kry->id_peg),
			'input_foto' => set_value('input_foto', $kry->nama_file),
			'button' => 'Simpan',
			'cancel' => 'Pegawai/profile/' . $id,
			'small' => 'NB: Biarkan kosong jika tidak mengganti foto',
			'action' => site_url('Pegawai/edit_aksi')
		);

		$this->load->view('Pegawai/pegawai_form', $data);
	}

	function edit_aksi()
	{
		$data = array(
			'nip_pegawai' => $this->input->post('nip_pegawai'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jabatan' => $this->input->post('jabatan'),
			'telepon' => $this->input->post('telepon'),
			'status_p' => $this->input->post('status_p'),
			'alamat' => $this->input->post('alamat'),
			'jenis_k' =>  $this->input->post('jenis_k'),
			'agama' => $this->input->post('agama'),
			'status' => $this->input->post('status'),
			//'input_foto' => $this->input->post('input_foto'),
			// 'ukuran' => $upload['file']['file_size'],
			'id_peg' => $this->input->post('id_peg'),
		);
		$upload = $this->uploadImage();
		if ($upload['result'] == "success") {
			$data['nama_file'] = $upload['file']['file_name'];
			$id = $this->input->post('id_peg');
			$this->Pegawai_model->edit_data($id, $data);
			$data['foto'] = $this->Pegawai_model->ambil_data_id($id)->nama_file;
			$this->load->view('v_profile', $data);
		} else {
			$id = $this->input->post('id_peg');
			$this->Pegawai_model->edit_data($id, $data);
			$data['foto'] = $this->Pegawai_model->ambil_data_id($id)->nama_file;
			$this->load->view('v_profile', $data);
		}
	}


	function profile($id)
	{
		$p = $this->Pegawai_model->ambil_data_id($id);
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
		$kode = $p->nip_pegawai;
		require_once("assets/phpqrcode/qrlib.php");

		//Nama Folder file QR Code kita nantinya akan disimpan
		$tempdir = "assets/qrcodepeg/";
		//jika folder belum ada, buat folder 
		if (!file_exists($tempdir)) {
			mkdir($tempdir);
		}
		QRcode::png("$kode", $tempdir . "QR_Code" . $kode . ".png", "H", 5.5, 5.5);
		$this->load->view('v_profile', $data);
	}
}
