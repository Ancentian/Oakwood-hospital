<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Patients_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function fetch_ibp()
    {
        $this->db->where('type', 'ibp');
        $this->db->select()->from('patients');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function fetch_obp()
    {
        $this->db->where('type', 'obp');
        $this->db->select()->from('patients');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_patient($data)
    {
        $this->db->insert('patients', $data);
        return $this->db->insert_id();
    }

    function edit_patient($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('patients', $data);
        return $this->db->affected_rows();
    }

    function delete_patient($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('patients');
        return $this->db->affected_rows();
    }

    function fetch_byId($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('patients');
        $query = $this->db->get();
        return $query->result_array();
    }

}