<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Pos_model extends CI_Model
{

    public $CONS_FEE = 100;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('finance_model');

    }
    public function fetchPatients()
    {
        $this->db->select()->from('patients');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function patientDues($pids)
    {
        $due = array();
        foreach($pids as $one){
            $due = 0;
            $pid = $one['id'];
            $invPaid = 0;

            $tickets = $this->getTickets($pid);
            $invoices = $this->getInvoices($pid)['invoices'];
            $invoicesCost = $this->getInvoices($pid)['cost'];
            $invPaid = $this->invPaid($pid);

            $ticketdetails = $this->getTicketdetails($pid);
            //var_dump($ticketdetails);die;
            $consfee = $ticketdetails['cons_fee'];            
            
            $tot = 0;
            $totpaid = 0;
            $totbill = 0;
            if ($tickets) {
               $labcost = $this->getLab($tickets);
                $radcost = $this->getRad($tickets);
                $medcost = $this->getMed($tickets);
                $totmisc = $this->getMisc($tickets);
                $totrbs = $this->getRbs($tickets);

                $totbill += $labcost+$radcost+$medcost+$totmisc+$totrbs+$consfee+$invoicesCost;
                $totpaid += $this->getPayments($tickets);

                
            }
            $totbill += $invoicesCost;
            $totpaid += $invPaid;
            $due = $totbill - $totpaid;

            $dues[] = array('patient_id' => $pid, 'due' => $due);
        }
        
        // var_dump($dues);die;
        
       return $dues;
        
    }

    public function getInvoices($pid)
    {
        $this->db->where('client_id',$pid);
        $query = $this->db->get('invoices');
        $inv = [];
        $tot = 0;
        foreach($query->result_array() as $one)
        {
            $tot += $one['amount_payable'];
            $inv[] = $one['id'];
        }

        return array("cost" => $tot, "invoices" => $inv);
    }

    public function addpmt($id,$data)
    {
        $ledgerAcc = $this->finance_model->fetch_feesAcc()[0]['id'];
        $dataLedger = array("date" => date('Y-m-d'),"acc_id" => $ledgerAcc,"type" => "Debit", "amount" =>$data['amount'],"name" => " POS Sales");
        if($ledgerAcc > 0){
            $this->finance_model->add_ledger($dataLedger);
        }
        
        
        $dt = array("inv_no" => 0, "amount" => $data['amount'],"pid" => $id, "mode" => $data['mode']);

        $this->db->insert('invoice_payments',$dt);

        return $this->db->insert_id();
    }

    public function invPaid($pid)
    {
        $this->db->where('pid',$pid);
        $this->db->select_sum('amount')->from('invoice_payments');
        $query = $this->db->get();
        return $query->row_array()['amount'];
    }

    public function getTickets($pid)
    {
        $this->db->where('patient_id',$pid);
        $query = $this->db->get('tickets');
        $tickids = [];

        foreach($query->result_array() as $one){
            $tickids[] = $one['id'];
        }

        return $tickids;
    }

    public function getTicketdetails($pid)
    {
        $this->db->where('patient_id',$pid);
        $query = $this->db->get('tickets');
        return $query->result_array()[0];
    }

    public function getLab($tick)
    {
        // var_dump($tick);die;
        $this->db->where_in('ticket_id',$tick);
        $query = $this->db->get('ticket_labtests');
        $tests = $query->result_array();
        $total = 0;
        $ltests = [];
        foreach ($tests as $one) {
            foreach(json_decode($one['tests'],true) as $key){
                $ltests[] = $key;
            }
        }
        if(!empty($ltests)){
            $this->db->where_in('id',$ltests);
            $this->db->select_sum('cost')->from('lab_tests');
            $query = $this->db->get();
            $total = $query->row_array()['cost'];
        }
        
        if(!$total)
            $total=0;
        return $total;
    }

    public function getRad($tick)
    {
        // var_dump($tick);die;
        $this->db->where_in('ticket_id',$tick);
        $query = $this->db->get('ticket_radiology');
        $tests = $query->result_array();
        $total = 0;
        $ltests = [];
        foreach ($tests as $one) {
            foreach(json_decode($one['radiology_screening'],true) as $key){
                $ltests[] = $key;
            }
        }
        if(!empty($ltests)){
            $this->db->where_in('id',$ltests);
            $this->db->select_sum('cost')->from('radiology_screening');
            $query = $this->db->get();
            $total = $query->row_array()['cost'];
        }
        
        if(!$total)
            $total=0;
        return $total;
    }

    public function sell($stockData,$pmtData,$invData)
    {
        $this->db->trans_start();
        $this->db->trans_strict(TRUE);

        $this->db->insert('invoices',$invData);
        $invId = $this->db->insert_id();

        $pmtData['inv_no'] = $invId;

        if ($pmtData['amount'] > 0) {
           $this->db->insert('invoice_payments',$pmtData);
           $ledgerAcc = $this->finance_model->fetch_feesAcc()[0]['id'];
           $dataLedger = array("date" => date('Y-m-d'),"acc_id" => $ledgerAcc,"type" => "Debit", "amount" =>$pmtData['amount'],"name" => " POS Sales");
           if($ledgerAcc > 0){
                $this->finance_model->add_ledger($dataLedger);
            }
        }
        

        foreach ($stockData as $key) {
            $pid = $key['product'];
            $qty = $key['qty'];
            $this->db->set('qty', "qty-$qty", FALSE);
            $this->db->where('id', $pid);
            $this->db->update('medicine');
        }

        $this->db->trans_complete();

        if($this->db->trans_status() == FALSE){
            $this->db->trans_rollback();
            return FALSE;
        }else{
            $this->db->trans_commit();
            return $invId;
        }
    }

    public function getMed($tick)
    {
        $this->db->where_in('ticket_id',$tick);
        $this->db->select_sum('medicine.cost','total')->from('ticket_medication');
        $this->db->join('medicine','medicine.id=ticket_medication.medicine_id');
        $query = $this->db->get();
        $result = $query->row_array();
        
        $tot = $result['total'];
        if (!$tot) {
            $tot = 0;
        }
        return $tot;
    }

     public function getMisc($tick)
    {
        $this->db->where_in('ticket_id',$tick);
        $this->db->select_sum('amount','total')->from('ticket_misc_cost');
        $query = $this->db->get();
        $result = $query->row_array();
        $tot = $result['total'];
        if (!$tot) {
            $tot = 0;
        }
        
        return $tot;
    }

    public function getRbs($tick)
    {
        $this->db->where_in('ticket_id',$tick);
        $this->db->select_sum('rsb','total')->from('triage');
        $query = $this->db->get();
        $result = $query->row_array();
        $tot = $result['total'];
        if (!$tot) {
            $tot = 0;
        }
        
        return $tot;
    }
    public function getPayments($tick)
    {
        $this->db->where_in('ticket_id',$tick);
        $this->db->select_sum('amount')->from('ticket_payments');
        $query = $this->db->get();

        $result = $query->row_array();
        $tot = $result['amount'];
        if(!$tot)
            $tot = 0;

        return $tot;
    }

    public function fetchPayments()
    {
        $this->db->select('patients.name,patients.lname,invoice_payments.*')->from('invoice_payments');
        $this->db->join('invoices','invoices.id=invoice_payments.inv_no','left');
        $this->db->join('patients','patients.id=invoice_payments.pid','left');
        $this->db->order_by('invoice_payments.id','DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function fetchInvoices()
    {
        $this->db->select('patients.name,patients.lname,invoices.*')->from('invoices');
        $this->db->join('patients','patients.id=invoices.client_id');
        $this->db->order_by('invoices.id','DESC');
        $query = $this->db->get();

        return $query->result_array();
    }
    public function fetchInvoicesID($id)
    {
        $this->db->where('invoices.id',$id);
        $this->db->select('patients.name,patients.lname,invoices.*')->from('invoices');
        $this->db->join('patients','patients.id=invoices.client_id');
        $this->db->order_by('invoices.id','DESC');
        $query = $this->db->get();

        return $query->row_array();
    }

    public function deleteInvoice($id)
    {
        $inv = $this->fetchInvoicesID($id);
        foreach (json_decode($inv['particulars'],true) as $key) {
            $pid = $key['prodId'];
            $qty = $key['prodQty'];
            $this->db->set('qty', "qty+$qty", FALSE);
            $this->db->where('id', $pid);
            $this->db->update('medicine');
        }

        $this->db->where('id',$id);
        $this->db->delete('invoices');
    }

    public function deletepayments($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('invoice_payments');
    }

    public function fetchPaymentsID($id)
    {
        $this->db->where('invoice_payments.id',$id);
        $this->db->select('patients.name,patients.lname,invoice_payments.*')->from('invoice_payments');
        $this->db->join('invoices','invoices.id=invoice_payments.inv_no','left');
        $this->db->join('patients','patients.id=invoice_payments.pid','left');
        $this->db->order_by('invoice_payments.id','DESC');
        $query = $this->db->get();

        return $query->row_array();
    }

    public function updatePmt($id,$data){
        $this->db->where('id',$id);
        $this->db->update('invoice_payments',$data);
    }

    public function daily_smsReports()
    {
        $this->db->like('created_at', date("Y-m-d"));
        $this->db->select('sum(amount_payable) as tot')->from('invoices');
        $query = $this->db->get();
        $tot = $query->row_array()['tot'];
        if ($tot > 0) {
        }else{
            $tot =0;
        }
        //var_dump($tot);die;
        return $tot;
    }

    public function mpesa_summary()
    {
        $this->db->like('created_at', date("Y-m-d"));
        $this->db->like('mode', 'mpesa');
        $this->db->select('sum(amount) as totmpesa');
        $this->db->from('invoice_payments');
        $query = $this->db->get();
        $totmpesa = $query->row_array()['totmpesa'];

        if ($totmpesa > 0) {
        }else{
            $totmpesa = 0;
        }
       //var_dump($totmpesa);die;
        return $totmpesa;
    }

    public function cash_summary()
    {

        $this->db->like('created_at', date("Y-m-d"));
        $this->db->like('mode', 'cash');
        $this->db->select('sum(amount) as totcash');
        $this->db->from('invoice_payments');
        $query = $this->db->get();
        $totcash = $query->row_array()['totcash'];

        if ($totcash > 0) {
        }else{
            $totcash =0;
        }
        return $totcash;  
    }

    public function cheque_summary()
    {
        $this->db->like('created_at', date("Y-m-d"));
        $this->db->like('mode', 'Family Bank');
        $this->db->select('sum(amount) as totcheque');
        $this->db->from('invoice_payments');
        $query = $this->db->get();
        $totcheque = $query->row_array()['totcheque'];

        if ($totcheque > 0) {
        }else{
            $totcheque =0;
        }
        return $totcheque;  
    }

    public function totalPayable()
    {
        $this->db->like('created_at', date("Y-m-d"));
        $this->db->select('sum(amount_payable) as totamount_payable');
        $this->db->from('invoices');
        $query = $this->db->get();
        $totamount_payable = $query->row_array()['totamount_payable'];

        if ($totamount_payable > 0) {
        }else{
            $totamount_payable = 0;
        }
        return $totamount_payable;
    }

     public function totalPaid()
    {
        $this->db->like('created_at', date("Y-m-d"));
        $this->db->select('sum(amount) as totamount');
        $this->db->from('invoice_payments');
        $query = $this->db->get();
        $totamount = $query->row_array()['totamount'];

        if ($totamount > 0) {
        }else{
            $totamount = 0;
        }
        return $totamount;
    }
}