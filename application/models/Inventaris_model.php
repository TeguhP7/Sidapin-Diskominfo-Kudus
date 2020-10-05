<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Inventaris_model extends CI_Model
{

	public $nama_table = 'inven';
	public $id         = 'id';
	public $order	   = 'DESC';

	function __construct()
	{
		parent::__construct();
	}

	function search($keyword, $limit, $start)
	{
		$this->db->distinct();
		$this->db->select('b.id, t.nama_aset, p.nama_pegawai, b.ket_lain');
		$this->db->from('inven b');
		$this->db->join('pegawai p', 'b.id_peg = p.id_peg');
		$this->db->join('assets t', 'b.id_assets = t.id_assets');
		$this->db->like('t.nama_aset', $keyword);
		$this->db->or_like('p.nama_pegawai', $keyword);
		$this->db->or_like('b.ket_lain', $keyword);
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->nama_table, $limit, $start)->result();
	}

	function count_search($keyword)
	{
		$this->db->distinct();
		$this->db->select('b.id, t.nama_aset, p.nama_pegawai, b.ket_lain');
		$this->db->from('inven b');
		$this->db->join('pegawai p', 'b.id_peg = p.id_peg');
		$this->db->join('assets t', 'b.id_assets = t.id_assets');
		$this->db->like('t.nama_aset', $keyword);
		$this->db->or_like('p.nama_pegawai', $keyword);
		$this->db->or_like('b.ket_lain', $keyword);
		$this->db->order_by($this->id, $this->order);
		return count($this->db->get($this->nama_table)->result());
	}

	function pagination($limit, $start)
	{
		$this->db->distinct();
		$this->db->select('b.id, t.nama_aset, p.nama_pegawai, b.ket_lain');
		$this->db->from('inven b');
		$this->db->join('pegawai p', 'b.id_peg = p.id_peg');
		$this->db->join('assets t', 'b.id_assets = t.id_assets');
		return $this->db->get($this->nama_table, $limit, $start)->result();
	}

	function ambil_data()
	{
		$this->db->distinct();
		$this->db->select('b.id, t.nama_aset, p.nama_pegawai, b.ket_lain');
		$this->db->from('inven b');
		$this->db->join('pegawai p', 'b.id_peg = p.id_peg');
		$this->db->join('assets t', 'b.id_assets = t.id_assets');
		return $this->db->get($this->nama_table)->result();
	}

	function ambil_data2()
	{
		$this->db->distinct();
		$this->db->select('b.id, t.kode_aset, p.nama_pegawai, t.nama_aset');
		$this->db->from('inven b');
		$this->db->join('pegawai p', 'b.id_peg = p.id_peg');
		$this->db->join('assets t', 'b.id_assets = t.id_assets');
		return $this->db->get($this->nama_table)->result();
	}

	function ambil_data_scan($id)
	{
		$this->db->where('id_assets', $id);
		return $this->db->get($this->nama_table)->row();
	}

	function ambil_data_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->nama_table)->row();
	}

	//untuk insert data seluruh mahasiswa
	function tambah_data($data)
	{
		$this->db->insert($this->nama_table, $data);
		return $this->db->get($this->nama_table)->result();
	}

	//untuk hapus data seluruh mahasiswa
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
