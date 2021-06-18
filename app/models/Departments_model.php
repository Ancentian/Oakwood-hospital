<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Departments_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function fetch_departments()
    {
        $this->db->select()->from('departments');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_department($data)
    {
        $this->db->insert('departments', $data);
        return $this->db->affected_rows();
    }

    function edit_department($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('departments', $data);
        return $this->db->affected_rows();
    }

    function delete_department($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('departments');
        return $this->db->affected_rows();
    }

    function fetch_byId($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('departments');
        $query = $this->db->get();
        return $query->result_array();
    }

}