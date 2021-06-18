<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Staff_model extends CI_Model
{
    public $hash_key = 'HHZASm9pZ7h!pDpDB3_X$a_4Ash+dNbVnuYy5S%-HUPdNUA2x?';


    public function __construct()
    {
        parent::__construct();

    }

    function fetch_staff()
    {
        $this->db->select('users.*,departments.name as dptname')->from('users');
        $this->db->join('departments', 'users.department = departments.id');
        $this->db->order_by('users.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_staff($data)
    {
        $email_check = $this->check_email($data['email'], "users");

        if ($email_check) {
            return json_encode(['status' => "0", 'message' => 'Email already registered!']);
        }

        $data['password'] = $this->generate_hash('pass12345');

        $this->db->insert('users', $data);
        $inserted = $this->db->affected_rows();

        if ($inserted > 0) {
            return json_encode(['status' => "1", 'message' => 'Added successfully']);
        } else {
            return json_encode(['status' => "0", 'message' => 'Failed,try again!']);
        }
    }

    function check_email($email, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('email', $email);
        // $this->db->where('status',$this->status_active);
        $query = $this->db->get();
        $result = $query->result_array();
        $resp = sizeof($result);

        return $resp > 0 ? true : false;
    }

    function generate_hash($password)
    {
        return md5($this->hash_key . $password);
    }

    function edit_staff($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return $this->db->affected_rows();
    }

    function delete_staff($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
        return $this->db->affected_rows();
    }

    function fetch_byId($id)
    {
        $this->db->where('id', $id);
        $this->db->select()->from('users');
        $query = $this->db->get();
        return $query->result_array();
    }

}