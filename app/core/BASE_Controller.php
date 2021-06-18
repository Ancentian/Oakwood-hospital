<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @property CI_Controller $CI_Controller
 * @property CI_Session $session
 * @property CI_Input $input
 *
 *
 * This controller holds some common functionality. It needs to have the name 'BASE_' prefix for Codeigniter to load it automatically
 * as per the config file extension prefix
 * It is therefore extended by the other app controllers that want to benefit from that.
 ** */
class BASE_Controller extends CI_Controller
{    
    public $MOTHER_CHILD_COST = '1800';
    public $ANC_COST = '300';
    public $CWC_COST = '200';
    public $PNC_COST = '200';
    public $FAMILY_PLANNING_COST = '100';

    public function __construct()
    {
        parent::__construct();
        $this->data['active_act'] = $this->active_activities();
        
    }
    function active_activities()
    {
    	$this->db->where('is_offered', 'yes');
    	$this->db->select()->from('work_flows');
    	$query = $this->db->get();
    	return $query->result_array();
    }
    function dpt_byActivity($activity)
    {
    	$this->db->where('id',$activity);
        $this->db->select('department')->from('work_flows');
        $query = $this->db->get();
        return $query->result_array()[0]['department'];
    }
    function act_byId($id)
    {
    	$this->db->where('id',$id);
        $this->db->select()->from('ticket_movements');
        $query = $this->db->get();
        return $query->result_array()[0];
    }
    
}