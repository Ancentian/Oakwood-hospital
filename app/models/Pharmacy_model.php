<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Pharmacy_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function fetch_medicine()
    {
        $this->db->select()->from('medicine');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_medicine($data)
    {
        $this->db->insert('medicine', $data);
        return $this->db->affected_rows();
    }

    function edit_medicine($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('medicine', $data);
        return $this->db->affected_rows();
    }

    function delete_medicine($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('medicine');
        return $this->db->affected_rows();
    }

    function fetch_byId($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('medicine');
        $query = $this->db->get();
        return $query->result_array();
    }

    function stock_medicine($id, $qty)
    {
        $purchase_data = ['medicine_id' => $id, 'purchase_qty' => $qty, 'created_by' => $this->session->userdata('user_aob')->id];
        $this->db->insert('medicine_purchase', $purchase_data);

        $this->db->set('qty', "qty+$qty", FALSE);
        $this->db->where('id', $id);
        $this->db->update('medicine');

        return $this->db->affected_rows();
    }

    function fetch_history()
    {
        $this->db->select('medicine.name as medname,medicine.id,medicine_purchase.*,users.name as username,users.phone as userphone, users.email as usermail')->from('medicine_purchase');
        $this->db->join('medicine', 'medicine.id = medicine_purchase.medicine_id');
        $this->db->order_by('medicine_purchase.id', 'DESC');
        $this->db->join('users', 'users.id = medicine_purchase.created_by');
        $query = $this->db->get();
        return $query->result_array();
    }

    function fetch_todaysReport()
    {
        $this->db->where('tickets.created_at LIKE"'.date("Y-m-d").'%"');
        $this->db->select('tickets.*, ticket_medication.ticket_id, ticket_medication.medicine_id, ticket_medication.units, ticket_medication.offered_by, patients.id as patid, patients.name as patfname, patients.lname as patlname, medicine.id as medid, medicine.name as medname, users.id as userid, users.name as staffname');
        $this->db->from('tickets');
        $this->db->join('ticket_medication', 'ticket_medication.ticket_id = tickets.id');
        $this->db->join('medicine', 'medicine.id = ticket_medication.medicine_id');
        $this->db->join('users', 'users.id = ticket_medication.offered_by');
        $this->db->join('patients', 'patients.id = tickets.patient_id');
        $this->db->group_by('ticket_medication.ticket_id');
        $this->db->order_by('tickets.id', 'DESC');
        $query = $this->db->get();
        //var_dump($query);die;
        return $query->result_array();
    }

    function delete_history($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('medicine_purchase');
        $query = $this->db->get();
        $result = $query->result_array();
        if ($result)
            $hist = $result[0];
        $medicine = $hist['medicine_id'];
        $qty = $hist['purchase_qty'];

        $this->db->set('qty', "qty-$qty", FALSE);
        $this->db->where('id', $medicine);
        $this->db->update('medicine');

        $this->db->where('id', $id);
        $this->db->delete('medicine_purchase');

        return $this->db->affected_rows();
    }
}