<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Wards_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function fetch_wards()
    {
        $this->db->select()->from('wards');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_ward($data)
    {
        $this->db->insert('wards', $data);
        return $this->db->affected_rows();
    }

    function edit_ward($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('wards', $data);
        return $this->db->affected_rows();
    }

    function delete_ward($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('wards');
        return $this->db->affected_rows();
    }

    function fetch_byId($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('wards');
        $query = $this->db->get();
        return $query->result_array();
    }

}