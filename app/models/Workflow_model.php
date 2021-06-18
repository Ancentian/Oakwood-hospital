<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Workflow_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function fetch_workflow()
    {
        $this->db->select()->from('work_flows');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('work_flows', $data);
        return $this->db->affected_rows();
    }

    function reset()
    {
        $this->db->update('work_flows', ["is_offered" => "no", "department" => "0"]);
        return $this->db->affected_rows();
    }

}