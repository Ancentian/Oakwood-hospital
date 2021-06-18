<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Appointment_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function fetch_tickets($pid)
    {
        $this->db->where('tickets.patient_id', $pid);
        $this->db->select('tickets.patient_id,users.name as uname,ticket_appointments.*')->from('ticket_appointments');
        $this->db->join('tickets', 'tickets.id = ticket_appointments.ticket_id');
        // $this->db->join('patients','patients.id = tickets.patient_id');
        $this->db->join('users', 'users.id = ticket_appointments.appointed_by');
        $this->db->order_by('ticket_appointments.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}