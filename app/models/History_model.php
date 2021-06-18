<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class History_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function fetch_tickets($pid)
    {
        $this->db->where('patient_id', $pid);
        $this->db->select()->from('tickets');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function payments()
    {
        $this->db->select('ticket_payments.*,patients.name as pname,patients.lname as lname,patients.mid_name as mname')->from('ticket_payments');
        $this->db->join('tickets','ticket_payments.ticket_id=tickets.id');
        $this->db->join('patients','tickets.patient_id=patients.id');
        $query = $this->db->get();
        return $query->result_array();
    }
}