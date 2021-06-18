<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Departmentalreports_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function fetch_report($sdate,$edate,$dptid)
    {
        $this->db->select('users.name,tickets.patient_id,patients.name as pname,patients.lname,patients.mid_name,ticket_movements.created_at,ticket_movements.ticket_id')->from('ticket_movements');
        $this->db->join('users','users.id=ticket_movements.seen_by');
        $this->db->join('tickets','tickets.id=ticket_movements.ticket_id');
        $this->db->join('patients','patients.id=tickets.patient_id');
        $this->db->where('ticket_movements.to_dpt',$dptid);
        if($sdate != "" && $edate != ""){
            $edate = date('Y-m-d',strtotime($edate)+86400);
            $this->db->where('ticket_movements.created_at >=',$sdate);
            $this->db->where('ticket_movements.created_at <',$edate);
        }
        $this->db->order_by('ticket_movements.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function fetch_todaysConsultationReport()
    {
        $this->db->where('ticket_movements.created_at LIKE "' .date("Y-m-d"). '%"');
        $this->db->select('users.name,tickets.patient_id,patients.name as pname,patients.lname,patients.mid_name,ticket_movements.*');
        $this->db->from('ticket_movements');
        $this->db->join('users','users.id=ticket_movements.seen_by');
        $this->db->join('tickets','tickets.id=ticket_movements.ticket_id');
        $this->db->join('patients','patients.id=tickets.patient_id');
        $this->db->order_by('ticket_movements.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}