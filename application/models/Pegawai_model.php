<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{

	public $nama_table = 'pegawai';
	public $id         = 'id_peg';
	public $order	   = 'DESC';

	function __construct()
	{
		parent::__construct();
	}


	function pagination($limit, $start)
	{
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->nama_table, $limit, $start)->result();
	}

	function ambil_data()
	{
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->nama_table)->result();
	}

	function ambil_data_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->nama_table)->row();
	}

	function ambil_data_scan($nip)
	{
		$this->db->where('nip_pegawai', $nip);
		return $this->db->get($this->nama_table)->row();
	}

	function tambah_data($data)
	{
		$this->db->insert($this->nama_table, $data);
		return $this->db->get($this->nama_table)->result();
	}

	function hapus_data($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->nama_table);
	}

	function edit_data($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->nama_table, $data);
	}
}
