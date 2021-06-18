<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Lab_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function fetch_lab_tests()
    {
        $this->db->select('lab_tests.*,lab_tests_categories.id as catid, lab_tests_categories.cat_name');
        $this->db->from('lab_tests');
        $this->db->join('lab_tests_categories', 'lab_tests_categories.id = lab_tests.cat_id');
        $this->db->order_by('lab_tests.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function fetch_todaysReport()
    {
        $this->db->where('tickets.created_at LIKE "' .date("Y-m-d").'%"');
        $this->db->select('tickets.*, ticket_labtests.id as ticklabid, ticket_labtests.ticket_id, ticket_labtests.tests,ticket_labtests.results_by, users.id as userid, users.name as username, patients.name as pname, patients.lname as plname');
        $this->db->from('tickets');
        $this->db->join('ticket_labtests', 'ticket_labtests.ticket_id = tickets.id');
        $this->db->join('users', 'users.id = ticket_labtests.results_by');
        $this->db->join('patients', 'patients.id = tickets.patient_id');
        $this->db->order_by('ticket_labtests.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function fetch_labTestCategories()
    {
        $this->db->select()->from('lab_tests_categories');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_test($data)
    {
        $this->db->insert('lab_tests', $data);
        return $this->db->affected_rows();
    }

    function add_category($data)
    {
        $this->db->insert('lab_tests_categories', $data);
        return $this->db->affected_rows();
    }

    function edit_test($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('lab_tests', $data);
        return $this->db->affected_rows();
    }

    function edit_category($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('lab_tests_categories', $data);
        return $this->db->affected_rows();
    }

    function delete_test($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('lab_tests');
        return $this->db->affected_rows();
    }

    function fetch_byId($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('lab_tests');
        $query = $this->db->get();
        return $query->result_array();
    }

    function fetch_categorybyId($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('lab_tests_categories');
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    function delete_category($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('lab_tests_categories');
        return $this->db->affected_rows();
    }

}