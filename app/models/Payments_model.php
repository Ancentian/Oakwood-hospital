<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Payments_model extends CI_Model
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
    function fetch($pid)
    {
        $this->db->where('ticket_id', $pid);
        $this->db->select()->from('ticket_payments');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    function add($data)
    {
        $this->db->insert('ticket_payments',$data);

       //$this->db->insert('invoice_payments', $data2);
        return $this->db->affected_rows();
    }

    function update_waiver($data)
    {
        $tickid = $data['ticket_id'];
        $waiver_amount = $data['waiver_amount'];
        //var_dump($tickid);die;
        $this->db->set('waiver_amount', "waiver_amount+$waiver_amount", FALSE);
        $this->db->where('id', $tickid);
        $this->db->update('tickets');

        return $this->db->affected_rows();
    }
    function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('ticket_payments');
        return $this->db->affected_rows();
    }
    function fetchbyreceipt($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('ticket_payments');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    function fetch_patientTicket($id)
    {
        $this->db->where('tickets.id', $id);
        $this->db->select('tickets.*,patients.id as pid');
        $this->db->from('tickets');
        $this->db->join('patients', 'patients.id=tickets.patient_id');
        $query = $this->db->get();
        return $query->result_array()[0];
    }
}