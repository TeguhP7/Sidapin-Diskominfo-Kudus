<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Scanner_model extends CI_Model
{
    function scanner($scan)
    {
        $this->db->select('nip_pegawai');
        $this->db->from('pegawai');
        $this->db->where('nip_pegawai', $scan);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row('nip_pegawai');
        } else {
            $this->db->select('kode_aset');
            $this->db->from('assets');
            $this->db->where('kode_aset', $scan);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row('kode_aset');
            } else {
                return false;
            }
        }
    }
}
