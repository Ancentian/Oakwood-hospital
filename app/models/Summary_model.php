<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Summary_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }
    function total_income()
    {
    	$query = $this->db->query('select *, sum(amount) as totsum from ticket_payments');
        $info = $query->result_array();
        $totsold = $info[0]['totsum'];
        if(!$totsold){
                $totsold = 0;
        }
        return $totsold;
    }
    function todays_income()
    {
        $query = $this->db->query('select *, sum(amount) as totsum from ticket_payments WHERE(created_at LIKE "'.date("Y-m-d").'%")');
        $info = $query->result_array();
        $totsold = $info[0]['totsum'];
        if(!$totsold){
                $totsold = 0;
        }
        return $totsold;
    }
    function total_incomeP()
    {
        $query = $this->db->query('select *, sum(amount_payable) as totsum from invoices');
        $info = $query->result_array();
        $totsold = $info[0]['totsum'];
        if(!$totsold){
                $totsold = 0;
        }
        return $totsold;
    }
    function todays_incomeP()
    {
        $query = $this->db->query('select *, sum(amount_payable) as totsum from invoices WHERE(created_at LIKE "'.date("Y-m-d").'%")');
        $info = $query->result_array();
        $totsold = $info[0]['totsum'];
        if(!$totsold){
                $totsold = 0;
        }
        return $totsold;
    }
    function total_pmtsP()
    {
        $query = $this->db->query('select *, sum(amount) as totsum from invoice_payments');
        $info = $query->result_array();
        $totsold = $info[0]['totsum'];
        if(!$totsold){
                $totsold = 0;
        }
        return $totsold;
    }
    function todays_pmtsP()
    {
        $query = $this->db->query('select *, sum(amount) as totsum from invoice_payments WHERE(created_at LIKE "'.date("Y-m-d").'%")');
        $info = $query->result_array();
        $totsold = $info[0]['totsum'];
        if(!$totsold){
                $totsold = 0;
        }
        return $totsold;
    }
    function all_todays_income()
    {
        $query = $this->db->query('select * from ticket_payments WHERE(created_at LIKE "'.date("Y-m-d").'%")');
        $info = $query->result_array();  
        // var_dump($info);die;      
        return $info;
    }
    function admitted_patients()
    {
    	$type = 'ibp';
    	$query = $this->db->query('select * from patients WHERE(type="'.$type.'")');
        $info = $query->result_array();

        $no = 0;
        $no = sizeof($info);
        return $no;
    }
    function patients_today()
    {
    	$query = $this->db->query('select * from patients WHERE(created_at LIKE "'.date("Y-m-d").'%")');
        $info = $query->result_array();
        $no = 0;
        $no = sizeof($info);
        return $no;
    }

    function all_patients_today()
    {
        $query = $this->db->query('select * from patients WHERE(created_at LIKE "'.date("Y-m-d").'%")');
        $info = $query->result_array();
        return $info;
    }

    function patient_treatment($age,$gender)
    {
        $five = 1767052800;
        $now = time();
        $dob = $now-$five;

        if ($age == 'under')
            $this->db->where('patients.dob <=',$dob);
        if ($age == 'over')
            $this->db->where('patients.dob >=',$dob);

        $this->db->where('patients.gender',$gender);
        $this->db->select('ticket_diagnosis.treatment, COUNT(ticket_diagnosis.treatment) as total')->from('ticket_diagnosis');
        $this->db->join('tickets','tickets.id=ticket_diagnosis.ticket_id');
        $this->db->join('patients','tickets.patient_id=patients.id');
        $this->db->group_by('ticket_diagnosis.treatment');
        $this->db->order_by('total', 'desc'); 
        $query = $this->db->get();

        return $query->result_array();
    }

}