<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 10:12 AM
 */

class Reports_m extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

    public function get_purchase_report_details($id){
        $this->db->select('purchase_report.id AS id, purchase_report.msisdn AS msisdn, msisdn1, msisdn2, business_name, purchase_report.invoice_no AS invoice, distributor_code, mobile, distributors.name AS distributor_name,regions.name AS region, towns.name as town, purchase_report.created AS created,order_status, payment_type, received_amount,delivery_date');
        $this->db->from('purchase_report');
        $this->db->where('purchase_report.id',$id);
        $this->db->join('stockists','purchase_report.stockist_id = stockists.id');
        $this->db->join('distributors','purchase_report.distributor_code = distributors.code');
        $this->db->join('regions','stockists.region_id = regions.id');
        $this->db->join('towns','stockists.town_id = towns.id');

        $query = $this->db-> get();
        if ($query->num_rows() >0){
            return $query -> row();
        }else{
            return false;
        }

    }

    /*function get_purchase_products($id){
        $this->db->select('purchase_products.sku_code AS sku_code,item_code,description,quantity,item_um');
        $this->db->from('purchase_products');
        $this->db->where('purchase_report_id',$id);
        $this->db->join('products','purchase_products.sku_code = products.sku_code');
        $query = $this -> db -> get();
        if ($query->num_rows() === 1){
            return $query -> row();
        }else{
            return false;
        }
    }*/

    function get_received_sms($id){
        $this -> db-> select('sms_received.id AS id, name,sms_received.msisdn AS msisdn, message');
        $this -> db -> from('sms_received LEFT JOIN contacts USING (msisdn)');
        $this-> db -> where('sms_received.id',$id);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }

    function save_reply($msg_id,$msisdn,$name,$msg,$reply,$user){
        $data =  array(
            'sent_to'=>$msisdn,
            'name'=>$name,
            'msg_id'=>$msg_id,
            'message'=>$msg,
            'reply'=>$reply,
            'sent_by'=>$user);
        $this->db->insert('replies',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){

            return true;
        }
        return false;
    }

    function change_reply_status($id){
        $data = array(
            'status' => 'REPLIED'
        );
        $this->db->where('id', $id);
        $query = $this->db->update('sms_received', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    /* Below functions used to retrieve reports for mailing to TAs and Managers*/
    //Get purchase report
    function get_today_purchase_report(){
        $this->db->select('purchase_product.id AS id,purchase_product.purchase_invoice_no as invoice_no,purchase_product.sku_code as sku_code,item_code,products.description as description,quantity,item_um,purchase_report.msisdn as msisdn,business_name,distributor_code,distributors.name AS distributor_name,stockists.region_id AS region,stockists.town_id AS town,purchase_report.created AS created');
        $this->db->from('purchase_product');
        $this->db->where('DATE(purchase_product.created) >=( DATE(NOW()) - INTERVAL 7 DAY + INTERVAL 0 SECOND )');
        $this->db->where('stockists.town_id = 2');
        $this->db->join('products','purchase_product.sku_code = products.sku_code');
        $this->db->join('purchase_report','purchase_product.purchase_report_id = purchase_report.id');
        $this->db->join('stockists','purchase_report.stockist_id = stockists.id');
        $this->db->join('distributors','purchase_report.distributor_code = distributors.code');
        /*$this->db->join('regions','distributors.region_id = regions.id');
        $this->db->join('towns','stockists.town_id = towns.id');*/
        $query = $this -> db -> get();
        if ($query->num_rows() >0){
            return $query -> result();
        }else{
            return false;
        }

    }

    //Get purchase report by town id
    function get_purchase_report_by_town($town_name,$region_name){
        $this->db->select('purchase_report.id AS id,purchase_report.carton_code as carton_code,
        purchase_report.product_code as product_code,description,purchase_report.msisdn as mobile,
        purchase_report.name AS name, id_number,email, address, purchase_report.created AS date');
        $this->db->from('purchase_report');
        $this->db->where('DATE(purchase_report.created) >=( DATE(NOW()) - INTERVAL 7 DAY + INTERVAL 0 SECOND )');
        $this->db->where('purchase_report.region',$region_name);
        $this->db->where('purchase_report.town',$town_name);
        $this->db->join('products','purchase_report.product_code = products.code');
        $query = $this -> db -> get();
        if ($query->num_rows() >0){
            return $query;
        }else{
            return false;
        }

    }

    //Get purchase report by region id
    function get_purchase_report_by_region($region_name){
        $this->db->select('purchase_report.id AS id,purchase_report.carton_code as carton_code,
        purchase_report.product_code as product_code,description,purchase_report.msisdn as mobile,
        purchase_report.name AS name, id_number,email, address, town, purchase_report.created AS date');
        $this->db->from('purchase_report');
        $this->db->where('DATE(purchase_report.created) >=( DATE(NOW()) - INTERVAL 7 DAY + INTERVAL 0 SECOND )');
        $this->db->where('purchase_report.region',$region_name);
        $this->db->join('products','purchase_report.product_code = products.code');
        $query = $this -> db -> get();
        if ($query->num_rows() >0){
            return $query;
        }else{
            return false;
        }

    }

   /* //Get Managers by region id
    function get_managers_by_region($region){
        $this -> db-> select('*');
        $this -> db -> from('area_managers');
        $this-> db -> where('region_id',$region);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }
    //Get TA's by town_id and region_id
    function get_TAS_by_regionAndtown($region,$town){
        $this -> db-> select('*');
        $this -> db -> from('area_tas');
        $this-> db -> where('region_id',$region);
        $this-> db -> where('town_id',$town);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }*/

}