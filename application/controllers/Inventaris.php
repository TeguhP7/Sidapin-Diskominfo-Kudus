<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventaris extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Inventaris_model');
		$this->load->model('Pegawai_model');
		$this->load->model('Assets_model');
		$this->load->library('pagination');

		if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
			redirect('/');
		}
	}

	function index()
	{
		$config['base_url'] = site_url('Inventaris/index'); //site url
		$config['total_rows'] = $this->db->count_all('inven'); //total row
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
		$data['data'] = $this->Inventaris_model->pagination($config["per_page"], $data['page']);
		$data['pagination'] = $this->pagination->create_links();
		$data['keyword'] =  set_value('keyword');
		//load view 
		$this->load->view('Inventaris/inventaris_list', $data);
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

		$config['base_url'] = site_url('Inventaris/search'); //site url
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
		$data['data'] = $this->Inventaris_model->search($keyword, $config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		$data['keyword'] =  set_value('keyword', $keyword);

		$this->load->view('Inventaris/inventaris_list', $data);
	}

	function unset_search()
	{
		$this->session->unset_userdata('search');
		redirect('Inventaris');
	}



	function download($id)
	{
		$p = $this->Inventaris_model->ambil_data_id($id);
		$kode = $this->Assets_model->ambil_data_id($p->id_assets);
		$t = $p->id_peg;
		$pengguna = $this->Pegawai_model->ambil_data_id($t)->nama_pegawai;
		require_once("assets/phpqrcode/qrlib.php");

		//Nama Folder file QR Code kita nantinya akan disimpan
		$tempdir = "assets/qrcodeinven/";
		//jika folder belum ada, buat folder 
		if (!file_exists($tempdir)) {
			mkdir($tempdir);
		}
		QRcode::png("$kode->kode_aset", $tempdir . "QR_Code_" . $kode->kode_aset . "_" . $pengguna . ".png", "H", 5.5, 5.5);

		force_download('assets/qrcodeinven/QR_Code_' . $kode->kode_aset . '_' . $pengguna . '.png', null);
	}

	function tambah()
	{
		$data = array(
			'nama_aset' => $this->Assets_model->ambil_data(),
			'pengguna' => $this->Pegawai_model->ambil_data(),
			'ket_lain' => set_value('ket_lain'),
			'id_assets' => set_value('id_assets'),
			'id_peg' => set_value('id_peg'),
			'id' => set_value('id'),
			'button' => 'Tambah',
			'action' => site_url('Inventaris/tambah_aksi'),
		);
		$this->load->view('Inventaris/inventaris_form', $data);
	}

	function tambah_aksi()
	{
		// $upload = $this->uploadImage();
		$data = array(
			// 'foto_aset' => $upload['file']['file_name'],
			'ket_lain' => $this->input->post('ket_lain'),
			'id_peg' => $this->input->post('id_peg'),
			'id_assets' => $this->input->post('id_assets'),
		);
		$this->Inventaris_model->tambah_data($data);
		redirect(site_url('Inventaris'));
	}

	function delete($id)
	{
		$this->Inventaris_model->hapus_data($id);
		redirect(site_url('Inventaris'));
	}

	function edit($id)
	{
		$ivs = $this->Inventaris_model->ambil_data_id($id);
		$data = array(
			'nama_aset' => $this->Assets_model->ambil_data(),
			'id_peg' => set_value('id_peg', $ivs->id_peg),
			'id_assets' => set_value('id_assets', $ivs->id_assets),
			'pengguna' => $this->Pegawai_model->ambil_data(),
			'ket_lain' => set_value('ket_lain', $ivs->ket_lain),
			'id' => set_value('id', $ivs->id),
			'button' => 'Simpan',
			'action' => site_url('Inventaris/edit_aksi'),
		);
		$this->load->view('Inventaris/inventaris_form', $data);
	}

	function edit_aksi()
	{
		//$upload = $this->uploadImage();
		$data = array(
			//'foto_aset' => $upload['file']['file_name'],
			'id_assets' => $this->input->post('id_assets'),
			'id_peg' => $this->input->post('id_peg'),
			'ket_lain' => $this->input->post('ket_lain'),
		);
		$id = $this->input->post('id');
		$this->Inventaris_model->edit_data($id, $data);
		redirect(site_url('Inventaris/unset_search'));
	}

	function inven($id)
	{
		$ivs = $this->Inventaris_model->ambil_data_id($id);
		$a = $ivs->id_peg;
		$t = $this->Pegawai_model->ambil_data_id($a)->nama_pegawai;
		$p = $this->Assets_model->ambil_data_id($ivs->id_assets);
		$data = array(
			'id' => set_value('id', $ivs->id),
			'id_peg' => set_value('id_peg', $ivs->id_peg),
			'id_assets' => set_value('id_assets', $ivs->id_assets),
			'foto' => $p->foto_aset,
			'kode_aset' => $p->kode_aset,
			'nama_aset' => $p->nama_aset,
			'tahun' => $p->tahun,
			'kondisi' => $p->kondisi,
			'pengguna' => $t,
			'ket_lain' => set_value('ket_lain', "$p->ket_lain" . ", " . "$ivs->ket_lain"),
		);
		require_once("assets/phpqrcode/qrlib.php");
		//Nama Folder file QR Code kita nantinya akan disimpan
		$tempdir = "assets/qrcodeinven/";
		//jika folder belum ada, buat folder 
		if (!file_exists($tempdir)) {
			mkdir($tempdir);
		}
		QRcode::png("$p->kode_aset", $tempdir . "QR_Code_" . $p->kode_aset . "_" . $t . ".png", "H", 5.5, 5.5);
		$this->load->view('v_inven', $data);
	}
}
