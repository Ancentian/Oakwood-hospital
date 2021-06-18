<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Radiology_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function fetch_radiology_screening()
    {
        $this->db->select('radiology_screening.*, radiology_categories.id as radcatid, radiology_categories.cat_name');
        $this->db->from('radiology_screening');
        $this->db->join('radiology_categories', 'radiology_categories.id=radiology_screening.cat_id');
        $this->db->order_by('radiology_screening.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function fetch_radiology_categories()
    {
        $this->db->select()->from('radiology_categories');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_screening($data)
    {
        $this->db->insert('radiology_screening', $data);
        return $this->db->affected_rows();
    }

    function add_category($data)
    {
        $this->db->insert('radiology_categories', $data);
        return $this->db->affected_rows();
    }

    function edit_screening($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('radiology_screening', $data);
        return $this->db->affected_rows();
    }

    function edit_category($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('radiology_categories', $data);
        return $this->db->affected_rows();
    }

    function delete_screening($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('radiology_screening');
        return $this->db->affected_rows();
    }

    function delete_category($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('radiology_categories');
        return $this->db->affected_rows();
    }

    function fetch_byId($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('radiology_screening');
        $query = $this->db->get();
        return $query->result_array();
    }

   function fetch_catById($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('radiology_categories');
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    function fetch_todaysReport()
    {
        $this->db->where('tickets.created_at LIKE"' .date("Y-m-d"). '%"');
        $this->db->select('tickets.*, ticket_radiology.id as radid, ticket_radiology.ticket_id, ticket_radiology.sent_by, ticket_radiology.received_by, users.id as userid, users.name as userfname, patients.name as pname, patients.lname as plname');
        $this->db->from('tickets');
        $this->db->join('ticket_radiology', 'ticket_radiology.ticket_id = tickets.id');
        $this->db->join('users', 'users.id = ticket_radiology.received_by');
        $this->db->join('patients', 'patients.id = tickets.patient_id');
        $this->db->order_by('tickets.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

}