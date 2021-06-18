<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        
    }

    public function get_coaTypes() {
       $query = $this->db->get('chart_of_accouts_types');
       return $query->result_array();
    }
    
    public function get_products()
    {
        $this->db->select('chart_of_accounts.acc_name,product_services.*')->from('product_services')->join('chart_of_accounts','chart_of_accounts.id=product_services.acc_no');
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_Assets(){
        $this->db->where('design_is.type','Assets');
        $this->db->select('design_is.*')->from('design_is');
        $query = $this->db->get();
        $coa = $query->result_array();
        $incomes = array();
        
        foreach($coa as $one){
            $grandtot = 0;
            foreach(json_decode($one['accounts'],true) as $acc){
                $this->db->where('acc_id', $acc);
                $this->db->where('type','Debit');
                $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
                $query = $this->db->get();
                $tot = $query->row_array()['tot'];
                if($tot > 0){
                    
                }else{
                    $tot = 0;
                }
                
                $this->db->where('acc_id', $acc);
                $this->db->where('type','Credit');
                $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
                $query = $this->db->get();
                $totCr = $query->row_array()['tot'];
                if($totCr > 0){
                    
                }else{
                    $totCr = 0;
                }
                
                $grandtot += $tot-$totCr;
            }
            
            $incomes[] = array('account' => $one['name'],'amount' => $grandtot);
        }
        
        return $incomes;
    }
     public function get_Liabilities(){
        $this->db->where('design_is.type','Liabilities');
        $this->db->select('design_is.*')->from('design_is');
        $query = $this->db->get();
        $coa = $query->result_array();
        $incomes = array();
        
        foreach($coa as $one){
            $grandtot = 0;
            foreach(json_decode($one['accounts'],true) as $acc){
                $this->db->where('acc_id', $acc);
                $this->db->where('type','Debit');
                $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
                $query = $this->db->get();
                $tot = $query->row_array()['tot'];
                log_message('error',json_encode($query->row_array()));
                if($tot > 0){
                }else{
                    $tot = 0;
                }
                
                $grandtot += $tot;
            }
            
            $incomes[] = array('account' => $one['name'],'amount' => $grandtot);
        }
        
        return $incomes;
    }
    
     public function get_Equity(){
        $this->db->where('design_is.type','Shareholders Equity');
        $this->db->select('design_is.*')->from('design_is');
        $query = $this->db->get();
        $coa = $query->result_array();
        $incomes = array();
       
        foreach($coa as $one){
             $grandtot = 0;
            foreach(json_decode($one['accounts'],true) as $acc){
                $this->db->where('acc_id', $acc);
                $this->db->where('type','Debit');
                $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
                $query = $this->db->get();
                $tot = $query->row_array()['tot'];
                if($tot > 0){
                    
                }else{
                    $tot = 0;
                }
                
                $this->db->where('acc_id', $acc);
                $this->db->where('type','Credit');
                $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
                $query = $this->db->get();
                $totCr = $query->row_array()['tot'];
                if($totCr > 0){
                    
                }else{
                    $totCr = 0;
                }
                
                $grandtot += $tot-$totCr;
            }
            
            $incomes[] = array('account' => $one['name'],'amount' => $grandtot);
        }
        
        return $incomes;
    }
    
    public function get_incomes($sdate,$edate){
        $edate = date('Y-m-d',(strtotime($edate)+86400));
        
        $this->db->where('design_pnl.type','Income');
        $this->db->select('design_pnl.*')->from('design_pnl');
        $query = $this->db->get();
        $coa = $query->result_array();
        $incomes = array();
        $grandtot = 0;
        foreach($coa as $one){
            foreach(json_decode($one['accounts'],true) as $acc){
                $this->db->where('date >=', $sdate);
                $this->db->where('date <', $edate);
                $this->db->where('acc_id', $acc);
                $this->db->where('type','Debit');
                $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
                $query = $this->db->get();
                $tot = $query->row_array()['tot'];
                if($tot > 0){
                    
                }else{
                    $tot = 0;
                }
                $grandtot += $tot;
            }
            
            $incomes[] = array('account' => $one['name'],'amount' => $grandtot);
        }
        
        return $incomes;
    }
    
    public function get_expenses($sdate,$edate){
        $edate = date('Y-m-d',(strtotime($edate)+86400));
        
        $this->db->where('design_pnl.type','Expense');
        $this->db->select('design_pnl.*')->from('design_pnl');
        $query = $this->db->get();
        $coa = $query->result_array();
        $incomes = array();
        $grandtot = 0;
        foreach($coa as $one){
            foreach(json_decode($one['accounts'],true) as $acc){
                $this->db->where('date >=', $sdate);
                $this->db->where('date <', $edate);
                $this->db->where('acc_id', $acc);
                $this->db->where('type','Debit');
                $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
                $query = $this->db->get();
                $tot = $query->row_array()['tot'];
                if($tot > 0){
                    
                }else{
                    $tot = 0;
                }
                $grandtot += $tot;
            }
            
            $incomes[] = array('account' => $one['name'],'amount' => $grandtot);
        }
        
        return $incomes;
    }
    
    public function get_totDebit($id)
    {
        $this->db->where('acc_id', $id);
        $this->db->where('type','Debit');
        $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
        $query = $this->db->get();
        $tot = $query->row_array()['tot'];
        if($tot > 0){
            
        }else{
            $tot = 0;
        }
        
        return $tot;
    }
    
    public function get_totCredit($id)
    {
        $this->db->where('acc_id', $id);
        $this->db->where('type','Credit');
        $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
        $query = $this->db->get();
        $tot = $query->row_array()['tot'];
        if($tot > 0){
            
        }else{
            $tot = 0;
        }
        
        return $tot;
    }
    
    public function get_totDebitP($id)
    {
        $this->db->where('parent_id',$id);
        $query = $this->db->get('chart_of_accounts');
        $accs = $query->result_array();
        $accs[] = array('id' => $id);
        
        $tot = 0;
        foreach($accs as $one){
            $this->db->where('acc_id', $one['id']);
            $this->db->where('type','Debit');
            $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
            $query = $this->db->get();
            $tot += $query->row_array()['tot'];
        }
        
        if($tot > 0){
            
        }else{
            $tot = 0;
        }
        return $tot;
    }
    
    public function get_totCreditP($id)
    {
        $this->db->where('parent_id',$id);
        $query = $this->db->get('chart_of_accounts');
        $accs = $query->result_array();
        $accs[] = array('id' => $id);
        $tot = 0;
        foreach($accs as $one){
            $this->db->where('acc_id', $one['id']);
            $this->db->where('type','Credit');
            $this->db->select('sum(amount) as tot')->from('ledger')->group_by('acc_id');
            $query = $this->db->get();
            $tot += $query->row_array()['tot'];
        }
        
        if($tot > 0){
            
        }else{
            $tot = 0;
        }
        log_message('error',$tot);
        return $tot;
    }
    
    public function get_productsID($id)
    {
        $this->db->where('product_services.id',$id);
        $this->db->select('chart_of_accounts.acc_name,product_services.*')->from('product_services')->join('chart_of_accounts','chart_of_accounts.id=product_services.acc_no');
        $query = $this->db->get();
        
        return $query->row_array();
    }
    
    public function add_product($data)
    {
        $this->db->insert('product_services',$data);
        return $this->db->affected_rows();
    }
    
    public function edit_product($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('product_services',$data);
        return $this->db->affected_rows();
    }
    
    public function delete_product($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('product_services');
        return $this->db->affected_rows();
    }
    
    public function add_bill($billdata,$itemsdata){
        $paymentDue = $this->get_paymentTermsID($billdata['payment_terms'])['due_days'];
        $duetimestamp = ($paymentDue*86400) + strtotime($billdata['date']);
        $due_date = date('Y-m-d',$duetimestamp);
        $billdata['due_date'] = $due_date;
        
        $this->db->insert('bills',$billdata);
        $bid = $this->db->insert_id();
        
        foreach($itemsdata as $one){
            $one['bill_id'] = $bid;
            $this->db->insert('bill_items',$one);
            
            $acc_id = $this->get_productsID($one['item_id'])['acc_no'];
            $particulars = json_decode($one['particulars'],true);
            $cost = $particulars['cost'];
            $qty = $particulars['qty'];
            if(!$qty){
                $qty = 1;
            }
            $amount = $qty*$cost;
            
            $data = array(
                'acc_id' => $acc_id,
                'type' => "Debit",
                'amount' => $amount,
                'name' => $billdata['description'],
                'date' => $billdata['date'],
                'bill_id' => $bid
            );
            
            $this->add_ledger($data);
            
        }
        
        return $this->db->affected_rows();
    }
    
    
    public function edit_bill($id,$billdata,$itemsdata){
        
        // var_dump($itemsdata);die;
        
        $paymentDue = $this->get_paymentTermsID($billdata['payment_terms'])['due_days'];
        $duetimestamp = ($paymentDue*86400) + strtotime($billdata['date']);
        $due_date = date('Y-m-d',$duetimestamp);
        $billdata['due_date'] = $due_date;
        
        $this->db->where('id',$id);
        $this->db->update('bills',$billdata);
        $bid = $id;
        
        $this->db->where('bill_id',$id);
        $this->db->delete('bill_items');
        
        $this->db->where('bill_id',$id);
        $this->db->delete('ledger');
        
        foreach($itemsdata as $one){
            $one['bill_id'] = $bid;
            
            $this->db->insert('bill_items',$one);
            
            $acc_id = $this->get_productsID($one['item_id'])['acc_no'];
            $particulars = json_decode($one['particulars'],true);
            $cost = $particulars['cost'];
            $qty = $particulars['qty'];
            if(!$qty){
                $qty = 1;
            }
            $amount = $qty*$cost;
            
            $data = array(
                'acc_id' => $acc_id,
                'type' => "Debit",
                'amount' => $amount,
                'name' => $billdata['description'],
                'date' => $billdata['date'],
                'bill_id' => $bid
            );
            
            
            $this->add_ledger($data);
            
        }
        
        return $this->db->affected_rows();
    }
    
    
    
    public function add_discount($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('bills',$data);
        
        return $this->db->affected_rows();
    }
    
    public function delete_bill($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('bills');
        
        $this->db->where('bill_id',$id);
        $this->db->delete('bill_items');
        
        $this->db->where('bill_id',$id);
        $this->db->delete('ledger'); 
        
        return $this->db->affected_rows();
    }
    public function get_bills()
    {
        $this->db->select('suppliers.name as suppname,payment_terms.name as terms,bills.*')->from('bills');
        $this->db->join('suppliers','suppliers.id=bills.supp_id');
        $this->db->join('payment_terms','payment_terms.id=bills.payment_terms');
        $this->db->order_by('bills.id','DESC');
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_billsID($id)
    {
        $this->db->where('bills.id',$id);
        $this->db->select('suppliers.name as suppname,payment_terms.name as terms,bills.*')->from('bills');
        $this->db->join('suppliers','suppliers.id=bills.supp_id');
        $this->db->join('payment_terms','payment_terms.id=bills.payment_terms');
        $this->db->order_by('bills.id','DESC');
        $query = $this->db->get();
        
        return $query->row_array();
    }
    
    public function get_billItems($bid)
    {
        $this->db->where('bill_id',$bid);
        $this->db->select('bill_items.*,product_services.name as prodname')->from('bill_items')->join('product_services','product_services.id=bill_items.item_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function billPaymentTot($bid){
        
        $this->db->where('bill_id',$bid);
        $this->db->select('sum(amount) as totpaid')->from('billl_payments')->group_by('bill_id');
        $query = $this->db->get();
        
        $total = $query->row_array()['totpaid'];
        
        if(!$total){
            $total = 0;
        }
        return $total;
    }
    public function get_billPayment()
    {
        $this->db->select('chart_of_accounts.acc_name,billl_payments.*')->from('billl_payments')->join('chart_of_accounts','chart_of_accounts.id=billl_payments.acc_id');
        $this->db->order_by('billl_payments.id','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_billPaymentID($id)
    {
        $this->db->where('billl_payments.id',$id);
        $this->db->select('chart_of_accounts.acc_name,billl_payments.*')->from('billl_payments')->join('chart_of_accounts','chart_of_accounts.id=billl_payments.acc_id');
        $this->db->order_by('billl_payments.id','DESC');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function delete_billPayment($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('billl_payments');
        
        $this->db->where('pmt_id',$id);
        $this->db->delete('ledger');
        
        return $this->db->affected_rows();
    }
    public function update_billPayment($id,$data,$ledger)
    {
        $this->db->where('pmt_id',$id);
        $this->db->update('ledger',$ledger);
        
        $this->db->where('id',$id);
        $this->db->update('billl_payments',$data);
        return $this->db->affected_rows();
    }
    
    public function insert_billPayment($data)
    {
        $this->db->insert('billl_payments',$data);
        return $this->db->insert_id();
    }
    public function get_suppliers()
    {
        $query = $this->db->get('suppliers');
        return $query->result_array();
    }
    
    public function get_paymentTerms()
    {
        $query = $this->db->get('payment_terms');
        return $query->result_array();
    }
    
    public function get_paymentTermsID($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('payment_terms');
        return $query->row_array();
    }
    
    public function get_suppliersID($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('suppliers');
        return $query->row_array();
    }
    
    public function add_suppliers($data)
    {
        $this->db->insert('suppliers',$data);
        return $this->db->affected_rows();
    }
    
    public function edit_suppliers($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('suppliers',$data);
        return $this->db->affected_rows();
    }
    
    public function delete_suppliers($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('suppliers');
        return $this->db->affected_rows();
    }
    
    public function get_coa() {
       $this->db->where('parent_id','0');
       $this->db->select('chart_of_accouts_types.type_name,chart_of_accounts.*')->from('chart_of_accounts');
       $this->db->join('chart_of_accouts_types','chart_of_accouts_types.id=chart_of_accounts.type');
       $query = $this->db->get();
       return $query->result_array();
    }
    
    public function fetch_feesAcc()
    {
        $this->db->where('is_fees','1');
        $query = $this->db->get('chart_of_accounts');
        
        return $query->result_array();
    }
    
     public function fetch_feesAccID($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('chart_of_accounts');
        
        return $query->row_array();
    }
    
    public function design_pnl($data)
    {
        $this->db->insert('design_pnl',$data);
        return $this->db->affected_rows();
    }
    public function fetch_pnlDesigns()
    {
        $query = $this->db->get('design_pnl');
        return $query->result_array();
    }
    public function fetch_pnlDesignsID($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('design_pnl');
        return $query->row_array();
    }
    
    public function delete_pnlDesigns($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('design_pnl');
        return $this->db->affected_rows();
    }
    
    public function edit_pnl($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('design_pnl',$data);
        return $this->db->affected_rows();
    }
    public function design_bs($data)
    {
        $this->db->insert('design_is',$data);
        return $this->db->affected_rows();
    }
    public function fetch_bsDesigns()
    {
        $query = $this->db->get('design_is');
        return $query->result_array();
    }
    public function fetch_bsDesignsID($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('design_is');
        return $query->row_array();
    }
    
    public function delete_bsDesigns($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('design_is');
        return $this->db->affected_rows();
    }
    
    public function edit_bs($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('design_is',$data);
        return $this->db->affected_rows();
    }
    
    public function all_coa() {
       $this->db->select('chart_of_accouts_types.type_name,chart_of_accounts.*')->from('chart_of_accounts');
       $this->db->join('chart_of_accouts_types','chart_of_accouts_types.id=chart_of_accounts.type');
       $query = $this->db->get();
       return $query->result_array();
    }
    
    public function get_ledger()
    {
        $this->db->select('chart_of_accounts.acc_name,ledger.*')->from('ledger')->join('chart_of_accounts','chart_of_accounts.id=ledger.acc_id');
        $this->db->order_by('ledger.id','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_ledgerID($id)
    {
        $this->db->where('ledger.id',$id);
        $this->db->select('chart_of_accounts.acc_name,ledger.*')->from('ledger')->join('chart_of_accounts','chart_of_accounts.id=ledger.acc_id');
        $query = $this->db->get();
        // var_dump($query->row_array());die;
        return $query->row_array();
    }
    
    public function add_ledger($data)
    {
        $this->db->insert('ledger',$data);
        return $this->db->affected_rows();
    }
    
    public function get_coaID($id) {
        // echo $id;die;
      $this->db->where('chart_of_accounts.id',$id);
       $this->db->select('chart_of_accouts_types.type_name,chart_of_accounts.*')->from('chart_of_accounts');
       $this->db->join('chart_of_accouts_types','chart_of_accouts_types.id=chart_of_accounts.type');
       $query = $this->db->get();
       return $query->row_array();
    }
    public function get_subaccs($pid)
    {
       $this->db->where('parent_id',$pid);
       $this->db->select('chart_of_accouts_types.type_name,chart_of_accounts.*')->from('chart_of_accounts');
       $this->db->join('chart_of_accouts_types','chart_of_accouts_types.id=chart_of_accounts.type');
       $query = $this->db->get();
       return $query->result_array();
    }
    
    public function get_coaTypesbyID($id) {
        $this->db->where('id',$id);
       $query = $this->db->get('chart_of_accouts_types');
       return $query->row_array();
    }
    
    public function add_coaType($data)
    {
        $this->db->insert('chart_of_accouts_types',$data);
        return $this->db->affected_rows();
    }
    public function add_coa($data)
    {
        $this->db->insert('chart_of_accounts',$data);
        return $this->db->affected_rows();
    }
    public function delete_coaType($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('chart_of_accouts_types');
        return $this->db->affected_rows();
    }
    public function delete_coa($id)
    {
        $this->db->where('id',$id);
        $this->db->or_where('parent_id',$id);
        $this->db->delete('chart_of_accounts');
        return $this->db->affected_rows();
    }
    
    public function delete_ledger($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('ledger');
        return $this->db->affected_rows();
    }
    
    public function edit_coaType($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('chart_of_accouts_types',$data);
        return $this->db->affected_rows();
    }
    
     public function update_ledger($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('ledger',$data);
        return $this->db->affected_rows();
    }
    
     public function edit_coa($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('chart_of_accounts',$data);
        return $this->db->affected_rows();
    }

}
