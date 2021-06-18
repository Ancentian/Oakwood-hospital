<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Queue_model extends CI_Model
{
    public $activity = "1";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('lab_model');
        $this->load->model('staff_model');
        $this->load->model('radiology_model');
        $this->load->model('wards_model');
        $this->load->model('pharmacy_model');
    }

    function search($data)
    {
        
        $this->db->like('name', $data['name']);
        $this->db->or_like('mid_name', $data['name']);
        $this->db->or_like('lname', $data['name']);
        $this->db->or_like('id_no', $data['name']);
        $this->db->or_like('id', $data['name']);
        $this->db->or_like('phone', $data['name']);
        $query = $this->db->get('patients');
        return $query->result_array();
    }

    function check_triage($tick)
    {
        $this->db->where('ticket_id',$tick);
        $this->db->select()->from('triage');
        $query = $this->db->get();
        return $query->result_array();
    }

    function check_diagnosis($tick)
    {
        $this->db->where('ticket_id',$tick);
        $this->db->select()->from('ticket_diagnosis');
        $query = $this->db->get();
        return $query->result_array();
    }

    function prematernity_save($update,$forminput,$mvtid)
    {
        $this->db->where('id',$mvtid);
        $this->db->update('ticket_movements',$update);

        $this->db->insert('ticket_maternity',$forminput);

        return $this->db->affected_rows();
    }
    function postmaternity_save($update,$forminput,$mvtid)
    {
        $this->db->where('id',$mvtid);
        $this->db->update('ticket_movements',$update);

        $this->db->insert('ticket_postmaternity',$forminput);

        return $this->db->affected_rows();
    }

    function create($tick, $mvt, $table, $table_data)
    {
        // var_dump($tick);die;
        $this->db->insert('tickets', $tick);
        $tick_id = $this->db->insert_id();

        if ($table != 'none') {
            $table_data['ticket_id'] = $tick_id;
            $this->db->insert($table, $table_data);
        }


        $mvt['ticket_id'] = $tick_id;
        $this->db->insert('ticket_movements', $mvt);
        return $this->db->affected_rows();
    }

    function delete_medication($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('ticket_medication');
        return $this->db->affected_rows();
    }
    function mcclinic($ticket,$mvt,$tickid,$mvtid)
    {
        $this->db->where('id',$tickid);
        $this->db->update('tickets',$ticket);

        $this->db->where('id',$mvtid);
        $this->db->update('ticket_movements',$mvt);

        return $this->db->affected_rows();
        
    }

    function mother_child_total($id)
    {
        $this->db->where('ticket_id', $id);
        $this->db->select()->from('ticket_misc_cost');
        $query = $this->db->get();
        return $query->result_array();
    }


    function incoming_active()
    {
        $this->db->where('ticket_movements.status', 'pending');
        $this->db->where('ticket_movements.to_dpt', $this->session->userdata('user_aob')->department);
        $this->db->select('tickets.*,patients.id as pid,patients.name as pname,patients.lname as lname,departments.name as dname,work_flows.name as wname,ticket_movements.*,users.name as uname,ticket_movements.id as mvtid')->from('ticket_movements');

        $this->db->join('users', 'users.id = ticket_movements.sent_by');
        $this->db->join('tickets', 'tickets.id = ticket_movements.ticket_id');
        $this->db->join('departments', 'departments.id = ticket_movements.from_dpt');
        $this->db->join('work_flows', 'work_flows.id = ticket_movements.activity');
        $this->db->join('patients', 'patients.id = tickets.patient_id');
        $this->db->order_by('ticket_movements.id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_triage($update, $new, $triage, $mvtid)
    {
        $this->db->where('id', $mvtid);
        $this->db->update('ticket_movements', $update);

        $this->db->insert('triage', $triage);

        $this->db->insert('ticket_movements', $new);
        return $this->db->affected_rows();
    }

    function outgoing_active()
    {
        //echo $this->session->userdata('user_aob')->id;die;
        $this->db->where('ticket_movements.status', 'pending');
        $this->db->where('ticket_movements.from_dpt', $this->session->userdata('user_aob')->department);
        $this->db->select('tickets.*,patients.id as pid,patients.name as pname,patients.lname as lname,departments.name as dname,work_flows.name as wname,ticket_movements.*,users.name as uname,ticket_movements.id as mvtid')->from('ticket_movements');
        $this->db->join('tickets', 'tickets.id = ticket_movements.ticket_id');
        $this->db->join('users', 'users.id = ticket_movements.sent_by');
        $this->db->join('departments', 'departments.id = ticket_movements.to_dpt');
        $this->db->join('work_flows', 'work_flows.id = ticket_movements.activity');
        $this->db->join('patients', 'patients.id = tickets.patient_id');
        $this->db->order_by('ticket_movements.id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function insert_tickMisc($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    function consultation_insert_ticket($new, $update, $mvtid)
    {
        $this->db->where('id', $mvtid);
        $this->db->update('ticket_movements', $update);

        $this->db->insert('ticket_movements', $new);
        return $this->db->affected_rows();
    }

    function add_prescription($data, $id)
    {
        $qty = $data['units'];
        $this->db->set('qty', "qty-$qty", FALSE);
        $this->db->where('id', $id);
        $this->db->update('medicine');

        $this->db->insert('ticket_medication', $data);

        return $this->db->affected_rows();
    }

    function incoming_seen()
    {
        $this->db->where('ticket_movements.status', 'seen');
        $this->db->where('ticket_movements.to_dpt', $this->session->userdata('user_aob')->department);
        $this->db->select('tickets.*,patients.id as pid,patients.name as pname,patients.lname as lname,departments.name as dname,work_flows.name as wname,ticket_movements.*,users.name as uname,ticket_movements.id as mvtid')->from('ticket_movements');

        $this->db->join('users', 'users.id = ticket_movements.sent_by');
        $this->db->join('tickets', 'tickets.id = ticket_movements.ticket_id');
        $this->db->join('departments', 'departments.id = ticket_movements.from_dpt');
        $this->db->join('work_flows', 'work_flows.id = ticket_movements.activity');
        $this->db->join('patients', 'patients.id = tickets.patient_id');
        $this->db->order_by('ticket_movements.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function outgoing_seen()
    {
        // echo $this->session->userdata('user_aob')->id;die;
        $this->db->where('ticket_movements.status', 'seen');
        $this->db->where('ticket_movements.from_dpt', $this->session->userdata('user_aob')->department);
        $this->db->select('tickets.*,patients.id as pid,patients.name as pname,patients.lname as lname,departments.name as dname,work_flows.name as wname,ticket_movements.*,users.name as uname,ticket_movements.id as mvtid')->from('ticket_movements');
        $this->db->join('tickets', 'tickets.id = ticket_movements.ticket_id');
        $this->db->join('users', 'users.id = ticket_movements.sent_by');
        $this->db->join('departments', 'departments.id = ticket_movements.to_dpt');
        $this->db->join('work_flows', 'work_flows.id = ticket_movements.activity');
        $this->db->join('patients', 'patients.id = tickets.patient_id');
        $this->db->order_by('ticket_movements.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function fetch_tests(int $tickid)
    {
        // echo $tickid;die;
        $this->db->where('ticket_id', $tickid);
        $this->db->where('status', 'pending');
        $this->db->order_by('id', 'DESC');
        $this->db->select()->from('ticket_labtests');
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    function fetch_radiology(int $tickid)
    {
        // echo $tickid;die;
        $this->db->where('ticket_id', $tickid);
        $this->db->where('status', 'pending');
        $this->db->order_by('id', 'DESC');
        $this->db->select()->from('ticket_radiology');
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    function fetch_treatments()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->select()->from('treatments');
        $query = $this->db->get();
        return $query->result_array();
    }

    function fetch_mvt($id)
    {
        $this->db->where('ticket_movements.id', $id);
        $this->db->select('tickets.*,patients.id as pid,patients.name as pname,patients.lname as lname,departments.name as dname,work_flows.name as wname,ticket_movements.*,users.name as uname,ticket_movements.id as mvtid')->from('ticket_movements');
        $this->db->join('tickets', 'tickets.id = ticket_movements.ticket_id');
        $this->db->join('users', 'users.id = ticket_movements.sent_by');
        $this->db->join('departments', 'departments.id = ticket_movements.to_dpt');
        $this->db->join('work_flows', 'work_flows.id = ticket_movements.activity');
        $this->db->join('patients', 'patients.id = tickets.patient_id');
        $this->db->order_by('ticket_movements.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    function add_labtest($update, $new, $lab, $mvtid, $labid)
    {
        // echo $mvtid;die;
        $this->db->where('id', $mvtid);
        $this->db->update('ticket_movements', $update);

        $this->db->where('id', $labid);
        $this->db->update('ticket_labtests', $lab);

        $this->db->insert('ticket_movements', $new);
        return $this->db->affected_rows();
    }

    function add_radiology($update, $new, $lab, $mvtid, $labid)
    {
        // echo $mvtid;die;
        $this->db->where('id', $mvtid);
        $this->db->update('ticket_movements', $update);

        $this->db->where('id', $labid);
        $this->db->update('ticket_radiology', $lab);

        $this->db->insert('ticket_movements', $new);
        return $this->db->affected_rows();
    }

    function fetch_ticket($id)
    {
        // echo $id;die;
        $this->db->where('id', $id);
        $this->db->select()->from('tickets');
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    function admit($adm_data, $tick_update, $patient_update, $patient_id, $ticket_id, $mvt_data, $mvt_id)
    {
        $this->db->insert('ticket_admissions', $adm_data);

        $this->db->where('id', $ticket_id);
        $this->db->update('tickets', $tick_update);

        $this->db->where('id', $patient_id);
        $this->db->update('patients', $patient_update);

        $qty = 1;
        $this->db->set('beds_occupancy', "beds_occupancy-$qty", FALSE);
        $this->db->where('id', $adm_data['ward_id']);
        $this->db->update('wards');

        $this->db->where('id', $mvt_id);
        $this->db->update('ticket_movements', $mvt_data);
        // var_dump($mvt_id);die;
        return $this->db->affected_rows();
    }

    function appoint($app_data, $tick_update, $ticket_id, $mvt_data, $mvt_id)
    {
        $this->db->insert('ticket_appointments', $app_data);

        $this->db->where('id', $ticket_id);
        $this->db->update('tickets', $tick_update);

        $this->db->where('id', $mvt_id);
        $this->db->update('ticket_movements', $mvt_data);

        return $this->db->affected_rows();
    }

    function discharge($tick_update, $ticket_id, $mvt_data, $mvt_id)
    {

        $this->db->where('id', $ticket_id);
        $this->db->update('tickets', $tick_update);

        $this->db->where('id', $mvt_id);
        $this->db->update('ticket_movements', $mvt_data);

        return $this->db->affected_rows();
    }
    function custom_discharge($tickid,$app,$treat)
    {
        if (sizeof($app))
            $this->db->insert('ticket_appointments',$app);

        $exists = $this->check_treatment($treat['treatment']);

        if ($exists == 0) {
           $this->db->insert('treatments',['name' => $treat['treatment']]);
        }

        $this->db->where('ticket_id',$tickid);
        $this->db->update('ticket_diagnosis',$treat);

        return $this->db->affected_rows();
    }

    function diagnose($data, $mvtid)
    {
        $this->db->insert('ticket_diagnosis', $data);

        // $exists = $this->check_treatment($data['treatment']);

        // if ($exists == 0) {
        //    $this->db->insert('treatments',['name' => $data['treatment']]);
        // }

        $this->db->where('id', $mvtid);
        $this->db->update('ticket_movements', ['diagnosis_status' => '1']);

        return $this->db->affected_rows();
    }

    function check_treatment($treatment)
    {
        $no = 0;
        $this->db->where('name',$treatment);
        $this->db->select()->from('treatments');

        $query = $this->db->get();

        $no = sizeof($query->result_array());
        return $no;
    }

    function ticket_triage($tickid)
    {
        $this->db->where('ticket_id', $tickid);
        $this->db->select()->from('triage');
        $query = $this->db->get();
        // var_dump($query->result_array()[0]);die;
        return $query->result_array()[0];
    }

    function ticket_admission($tickid)
    {
        $this->db->where('ticket_id', $tickid);
        $this->db->select()->from('ticket_admissions');
        $this->db->join('wards', 'wards.id=ticket_admissions.ward_id');
        $query = $this->db->get();
        // var_dump($query->result_array()[0]);die;
        return $query->result_array()[0];
    }


    function ticket_prescription($tickid)
    {
        $this->db->where('ticket_id', $tickid);
        $this->db->select('ticket_medication.*,users.name as uname,medicine.name as mname, medicine.qty,medicine.cost')->from('ticket_medication');
        $this->db->join('medicine', 'medicine.id=ticket_medication.medicine_id');
        $this->db->join('users', 'users.id=ticket_medication.offered_by');
        $query = $this->db->get();
        // var_dump($query->result_array()[0]);die;
        return $query->result_array();
    }

    function ticket_prescription_p($tickid)
    {
        $this->db->where('ticket_id', $tickid);
        $this->db->select('ticket_medication.*,users.name as uname,medicine.*,medicine.name as mname')->from('ticket_medication');
        $this->db->join('medicine', 'medicine.id=ticket_medication.medicine_id');
        $this->db->join('users', 'users.id=ticket_medication.offered_by');
        $query = $this->db->get();
        // var_dump($query->result_array()[0]);die;
        return $query->result_array();
    }

    function ticket_appointment($tickid)
    {
        $this->db->where('ticket_id', $tickid);
        $this->db->select('ticket_appointments.*,users.name as uname')->from('ticket_appointments');
        $this->db->join('users', 'users.id=ticket_appointments.appointed_by');
        $query = $this->db->get();
        // var_dump($query->result_array()[0]);die;
        return $query->result_array();
    }
    

    function ticket_diagnosis($tickid)
    {
        $this->db->where('ticket_id', $tickid);
        $this->db->select('ticket_diagnosis.*,users.name as uname')->from('ticket_diagnosis');
        $this->db->join('users', 'users.id=ticket_diagnosis.diagnosed_by');
        $query = $this->db->get();
        // var_dump($query->result_array()[0]);die;
        return $query->result_array()[0];
    }

    function all_diagnosis($tickid)
    {
        $this->db->where('ticket_id', $tickid);
        $this->db->select('ticket_diagnosis.*,users.name as uname')->from('ticket_diagnosis');
        $this->db->join('users', 'users.id=ticket_diagnosis.diagnosed_by');
        $query = $this->db->get();
        // var_dump($query->result_array()[0]);die;
        return $query->result_array();
    }

    function ticket_dressing_misc($tickid)
    {
        $this->db->where('ticket_id', $tickid);
        $this->db->select()->from('ticket_misc_cost');
        $query = $this->db->get();
        // var_dump($query->result_array()[0]);die;
        return $query->result_array();
    }

    function ticket_labdetails($ticket_id)
    {
        $this->db->where('ticket_id', $ticket_id);
        $this->db->select()->from('ticket_labtests');
        $query = $this->db->get();
        $result = $query->result_array();
        $tests = [];
        $results = [];

        foreach ($result as $key) {
            $test = json_decode($key['tests']);
            $testresults = json_decode($key['comments']);
            $i = 0;
            foreach ($test as $one) {
                $onetest = $this->lab_model->fetch_byId($one)[0]['name'];
                $testid = $this->lab_model->fetch_byId($one)[0]['id'];
                if (!$onetest) {
                    $onetest = 'deleted';
                }
                $onetestdetails = ['test_id' => $testid,'test_name' => $onetest, 'test_result' => $testresults[$i], 'attachment' => $key['results'], 'requested_by' => $this->staff_model->fetch_byId($key['requested_by'])[0]['name'], 'tests_by' => $this->staff_model->fetch_byId($key['results_by'])[0]['name'], 'labstatus' => $key['status']];
                $results[] = $onetestdetails;

                $i++;
            }
        }

        return $results;
    }

    function ticket_radiologydetails($ticket_id)
    {
        $this->db->where('ticket_id', $ticket_id);
        $this->db->select()->from('ticket_radiology');
        $query = $this->db->get();
        $result = $query->result_array();
        $tests = [];
        $results = [];

        foreach ($result as $key) {
            $test = json_decode($key['radiology_screening']);
            $testresults = json_decode($key['comments']);
            $i = 0;
            foreach ($test as $one) {
                $onetest = $this->radiology_model->fetch_byId($one)[0]['name'];
                if (!$onetest) {
                    $onetest = 'deleted';
                }
                $onetestdetails = ['test_name' => $onetest, 'test_result' => $testresults[$i], 'attachment' => $key['radiology_results'], 'requested_by' => $this->staff_model->fetch_byId($key['sent_by'])[0]['name'], 'tests_by' => $this->staff_model->fetch_byId($key['received_by'])[0]['name'], 'labstatus' => $key['status']];
                $results[] = $onetestdetails;

                $i++;
            }
        }

        return $results;
    }

    function ticket_labdetails_p($ticket_id)
    {
        $this->db->where('ticket_id', $ticket_id);
        $this->db->select()->from('ticket_labtests');
        $query = $this->db->get();
        $result = $query->result_array();
        $tests = [];
        $results = [];

        foreach ($result as $key) {
            $test = json_decode($key['tests']);
            $testresults = json_decode($key['comments']);
            $i = 0;
            foreach ($test as $one) {
                $onetest = $this->lab_model->fetch_byId($one)[0];
                if (!$onetest) {
                    $onetest = [];
                }
                $onetestdetails = ['test_name' => $onetest['name'], 'cost' => $onetest['cost'], 'test_result' => $testresults[$i], 'attachment' => $key['results'], 'requested_by' => $this->staff_model->fetch_byId($key['requested_by'])[0]['name'], 'tests_by' => $this->staff_model->fetch_byId($key['results_by'])[0]['name'], 'labstatus' => $key['status']];
                $results[] = $onetestdetails;

                $i++;
            }
        }

        return $results;
    }

    function ticket_radiologydetails_p($ticket_id)
    {
        $this->db->where('ticket_id', $ticket_id);
        $this->db->select()->from('ticket_radiology');
        $query = $this->db->get();
        $result = $query->result_array();
        $tests = [];
        $results = [];

        foreach ($result as $key) {
            $test = json_decode($key['radiology_screening']);
            $testresults = json_decode($key['comments']);
            $i = 0;
            foreach ($test as $one) {
                $onetest = $this->radiology_model->fetch_byId($one)[0];
                if (!$onetest) {
                    $onetest = 'deleted';
                }
                $onetestdetails = ['test_name' => $onetest['name'], 'cost' => $onetest['cost'], 'test_result' => $testresults[$i], 'attachment' => $key['radiology_results'], 'requested_by' => $this->staff_model->fetch_byId($key['sent_by'])[0]['name'], 'tests_by' => $this->staff_model->fetch_byId($key['received_by'])[0]['name'], 'labstatus' => $key['status']];
                $results[] = $onetestdetails;

                $i++;
            }
        }

        return $results;
    }

    function ticket_details($id)
    {
        $this->db->where('tickets.id',$id);
        $this->db->select('patients.dob as dob, patients.gender as gender, patients.name as pname,patients.lname as lname,patients.mid_name as mname,patients.id as pid, tickets.*')->from('tickets');
        $this->db->join('patients','patients.id=tickets.patient_id');
        $query = $this->db->get();
        return $query->result_array()[0];
    }
    function pharmacy_return($mvtid,$update, $new)
    {
        $this->db->where('id',$mvtid);
        $this->db->update('ticket_movements',$update);

        $this->db->insert('ticket_movements',$new);

        return $this->db->affected_rows();
    }

    function pharmacy_release($mvtid,$update, $tickid)
    {
        
        $this->db->where('id',$mvtid);
        $this->db->update('ticket_movements',$update);

        $this->db->where('id',$tickid);
        $this->db->update('tickets',['status' => '1']);

        return $this->db->affected_rows();
    }
    function save_firsttime_anc($data)
    {
        $this->db->insert('ticket_firtstime_anc',$data);
        return $this->db->affected_rows();
    }
    function save_subsequent_anc($data)
    {
        $this->db->insert('ticket_subsequent_anc',$data);
        return $this->db->affected_rows();
    }
    function fetch_anc_details($pid)
    {
        // echo $pid;die;
        $this->db->where('patient_id', $pid);
        $this->db->select()->from('ticket_firtstime_anc');
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    function ticket_anc_details($tickid)
    {
        // echo $pid;die;
        $this->db->where('ticket_id', $tickid);
        $this->db->select()->from('ticket_firtstime_anc');
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $query->result_array()[0];
    }
    function fetch_subsequent_anc($id)
    {
        // echo $pid;die;
        $this->db->where('anc_id', $id);
        $this->db->select()->from('ticket_subsequent_anc');
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

}