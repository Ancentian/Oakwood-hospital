<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Inpatient_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function discharge($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('tickets');
        $result = $query->result_array();

        $pid = $result[0]['patient_id'];

        //update the ticket details
        $this->db->where('id',$id);
        $this->db->update('tickets',['status' => "1",'closed_at' => date('Y-m-d H:i:s')]);

        //update the patient details
        $this->db->where('id',$pid);
        $this->db->update('patients',['type' => "obp"]);

        //update the ticket admissions details
        $this->db->where('ticket_id',$id);
        $this->db->update('ticket_admissions',['status' => "discharged"]);

        return array('status' => $this->db->affected_rows(), 'pid' => $pid);
    }

    public function fetch_nursingCadex($tickid)
    {
        $this->db->where('ticket_id',$tickid);
        $this->db->where('operation_id','1');

        $query = $this->db->get('inpatient_operations');
        return $query->result_array();
    }
    public function fetch_nursingCare($tickid)
    {
        $this->db->where('ticket_id',$tickid);
        $this->db->where('operation_id','2');

        $query = $this->db->get('inpatient_operations');
        return $query->result_array();
    }

    public function fetch_transfusions($tickid)
    {
        $this->db->where('ticket_id',$tickid);
        $this->db->where('operation_id','4');

        $query = $this->db->get('inpatient_operations');
        return $query->result_array();
    }
    public function fetch_costs($tickid)
    {
        $this->db->where('ticket_id',$tickid);
        $this->db->where('is_inpatient','1');
        $query = $this->db->get('ticket_misc_cost');
        return $query->result_array();
    }

    public function fetch_medication($tickid)
    {
        $this->db->where('ticket_id',$tickid);
        $this->db->select()->from('ticket_medication');
        $this->db->join('medicine','ticket_medication.medicine_id=medicine.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function fetch_medicine()
    {
        $query = $this->db->get('medicine');
        return $query->result_array();
    }

    public function fetch_meds($meds)
    {
        $medsdetails = [];
        foreach ($meds as $key) {
            $this->db->where('id',$key);
            $query = $this->db->get('medicine');
            $medsdetails[] = $query->result_array()[0];
        }

        return $medsdetails;
    }

    public function fetch_observations($tickid)
    {
        $this->db->where('ticket_id',$tickid);
        $this->db->where('operation_id','3');

        $query = $this->db->get('inpatient_operations');
        return $query->result_array();
    }


    public function add_cadex($data)
    {
        $data_insert = array('ticket_id' => $data['ticket_id'],'operation_id' => '1','operation_data' => json_encode($data), 'operation_cost' => '0');
        $this->db->insert('inpatient_operations',$data_insert);
        return $this->db->affected_rows();
    }
    public function add_care($data)
    {
        $data_insert = array('ticket_id' => $data['ticket_id'],'operation_id' => '2','operation_data' => json_encode($data), 'operation_cost' => '0');
        $this->db->insert('inpatient_operations',$data_insert);
        return $this->db->affected_rows();
    }

    public function save_cost($data)
    {
        $i = 0;
        foreach ($data['service'] as $one) {
            $this_cost = $data['cost'][$i];

            $data_to_insert = array('ticket_id' => $data['ticket_id'],'cost_name' => $one, 'amount' => $this_cost,'is_inpatient' => '1');

            $this->db->insert('ticket_misc_cost',$data_to_insert);

            $i++;
        }
        return $this->db->affected_rows();
    }

    public function add_observation($data)
    {
        $data_insert = array('ticket_id' => $data['ticket_id'],'operation_id' => '3','operation_data' => json_encode($data), 'operation_cost' => '0');
        $this->db->insert('inpatient_operations',$data_insert);
        return $this->db->affected_rows();
    }

    public function add_transfusion($data)
    {
        $data_insert = array('ticket_id' => $data['ticket_id'],'operation_id' => '4','operation_data' => json_encode($data), 'operation_cost' => '0');
        $this->db->insert('inpatient_operations',$data_insert);
        return $this->db->affected_rows();
    }

    public function get_pid($tickid)
    {
        $this->db->where('id',$tickid);
        $query = $this->db->get('tickets');
        return $query->result_array()[0]['patient_id'];

    }
}