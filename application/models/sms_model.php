<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/31/14
 * Time: 11:26 PM
 */

class Sms_model extends CI_Model{

    // Check if order ref exists
    function check_order_ref($order_ref){
        $this->db->select('*');
        $this->db->from('purchase_reports');
        $this->db->where('invoice_no',$order_ref);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    //Save purchase report from stockist
    function save_purchase_report($carton_code,$product_code,$msisdn,$contact){

        $data =  array(
            'msisdn'=>$msisdn,
            'carton_code'=>$carton_code,
            'product_code'=>$product_code,
            'name'=>$contact->name,
            'id_number'=>$contact->id_number,
            'email'=>$contact->email,
            'address'=>$contact->address,
            'region'=>$contact->region,
            'town'=>$contact->town
        );
        $this->db->insert('purchase_report',$data);
       // $num_insert = $this->db->affected_rows();
        if($this->db->insert_id()){
            return true;
        }
        return false;
    }

    //Save purchased products ave_purchase_products($saved_id,$invoice,$prd_sku_code,$prd_qty)
    /*function save_purchase_products($purchase_id,$invoice_no,$sku_code,$quantity){

        $data =  array(
            'purchase_report_id'=>$purchase_id,
            'purchase_invoice_no'=>$invoice_no,
            'sku_code'=>$sku_code,
            'quantity'=>$quantity);
        $this->db->insert('purchase_products',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }*/


    function save_received_sms($msisdn,$message,$message_type,$group,$status){

        $data =  array(
            'msisdn'=>$msisdn,
            'message'=>$message,
            'message_type'=>$message_type,
            'group'=>$group,
            'status'=>$status);

        $this->db->insert('sms_received',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

    function log_reply($msisdn,$recipient,$msg,$userid){
        $data =  array(
            'sent_to'=>$msisdn,
            'recipient'=>$recipient,
            'message'=>$msg,
            'message_type'=>'REPLY_SMS',
            'sent_by'=>$userid);
        $this->db->insert('smsout',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

    function log_auto_reply($msisdn,$recipient,$msg,$userid){
        $data =  array(
            'sent_to'=>$msisdn,
            'recipient'=>$recipient,
            'message'=>$msg,
            'message_type'=>'AUTO_REPLY_SMS',
            'sent_by'=>$userid);
        $this->db->insert('smsout',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

    function save_sms($msisdn,$recipient,$msg,$userid,$messageId,$status){
        $data =  array(
            'sent_to'=>$msisdn,
            'recipient'=>$recipient,
            'message'=>$msg,
            'sent_by'=>$userid,
            'message_id'=>$messageId,
            'status'=>$status
        );
        $this->db->insert('smsout',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

    function update_sms_status($msisdn,$messageId,$status){
        $data =  array(
            'status'=>$status
        );
        $this->db->where('message_id', $messageId);
        $this->db->where('sent_to', $msisdn);
        $query = $this->db->update('smsout', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    function save_bulksms($msisdn,$recipient,$msg,$userid,$messageId,$status){
        $data =  array(
            'sent_to'=>$msisdn,
            'recipient'=>$recipient,
            'message'=>$msg,
            'message_type'=>'BULK_SMS',
            'sent_by'=>$userid,
            'message_id'=>$messageId,
            'status'=>$status
        );
        $this->db->insert('smsout',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

    /*function verify_order_ref($order_ref){
        $this->db->select('*');
        $this->db->from('purchase_report');
        $this->db->where('invoice_no',$order_ref);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function verify_order_delivered($order_ref,$delivered){
        $this->db->select('*');
        $this->db->from('purchase_report');
        $this->db->where('invoice_no',$order_ref);
        $this->db->where('order_status',$delivered);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function update_purchase_report($order_ref,$status,$pay_type,$amount,$salesman_id){
        $data = array(
            'order_status' => $status,
            'payment_type'=>$pay_type,
            'received_amount' => $amount,
            'ta_id' => $salesman_id
        );
        $this->db->set('delivery_date','NOW()',false);
        $this->db->where('invoice_no', $order_ref);
        $query = $this->db->update('purchase_report', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }*/
//=================================UNUSED METHODS======================================================================================



    function get_received_sms(){
        $this -> db-> select('*');
        $this -> db -> from('sms_received');
        $this->db->order_by('id','desc');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }



    function get_bulk_sms(){
        $this -> db-> select('id,sent_to, message,fname,surname,smsout.created as created');
        $this -> db -> from('smsout');
        $this->db->join('users','smsout.sent_by = users.user_id');
        $this->db->order_by("smsout.created", "desc");
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }




}