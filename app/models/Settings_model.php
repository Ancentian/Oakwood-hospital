<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Settings_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function add_paymentMode($data)
    {
    	$this->db->insert('payment_modes', $data);
    	return $this->db->affected_rows();
    }

    function fetch_paymentModes()
    {
    	$this->db->select()->from('payment_modes');
    	$this->db->order_by('id', 'DESC');
    	$query = $this->db->get();
    	return $query->result_array();
    }

    function fetch_modeById($id)
    {
    	$this->db->where('id', $id);
    	$this->db->select()->from('payment_modes');
    	$query = $this->db->get();
    	return $query->result_array()[0];
    }

    function update_paymentMode($id, $data)
    {
    	$this->db->where('id', $id);
    	$this->db->update('payment_modes',$data);
    	return $this->db->affected_rows();
    }

    function add_deletePaymentMode($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('payment_modes');
    	return $this->db->affected_rows();
    }

    function fetch_admin()
    {
        $this->db->limit(1);
        $query = $this->db->get('sms_recipients');
        return $query->row_array();
    }

     function fetch_discounts()
    {
        $this->db->limit(1);
        $query = $this->db->get('discount_rates');
        return $query->row_array();
    }

    function fetch_specialConsultationFee()
    {
        $this->db->limit(1);
        $query = $this->db->get('special_cons_fee');
        return $query->row_array();
    }

    function update_setAdmin($data)
    {
        $this->db->where('id', 1);
        $this->db->update('sms_recipients', $data);
        //return $this->db->affected_rows();    
    }

    function update_discount($data)
    {
        $this->db->where('id', 1);
        $this->db->update('discount_rates', $data);
        //return $this->db->affected_rows();    
    }

    function update_specialConsFee($data)
    {
        //var_dump($data);die;
        $this->db->where('id', 1);
        $this->db->update('special_cons_fee', $data);
        //return $this->db->affected_rows();    
    }

}