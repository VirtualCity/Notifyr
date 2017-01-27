<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 5:48 PM
 */

class Received extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('sms/SmsSender.php');
        $this->load->model('sendsms_model');
        $this->load->model('reports_m');

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index(){

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Messages Received";
        $data['mainContent']='reports/view_received';
        $this->load->view('templates/template',$data);
    }

    function datatable(){
        $this->datatables->select('sms_received.id AS id, sms_received.group as groupname, name,sms_received.msisdn AS msisdn, message, sms_received.status AS status, sms_received.created AS created')
        ->unset_column('id')
        ->add_column('actions', get_received_messages_buttons('$1'), 'id')
        ->from('sms_received LEFT JOIN contacts USING (msisdn)')
        ->where('message_type','GROUP');

        echo $this->datatables->generate();
    }

    function reply($id=null){

        if(!empty($id)){
            //retrieve the received sms from the recipient
            $sms = $this->reports_m->get_received_sms($id);

            //display reply view
            $data['id']=$id;
            $data['received_msg']=$sms->message;
            $data['msisdn']=$sms->msisdn;
            $data['name']=$sms->name;
            $data['base']=$this->config->item('base_url');

        }else{
            //return fail. distributor code already in use
            $this->session->set_flashdata('appmsg', 'Error encountered! No identifier specified');
            $this->session->set_flashdata('alert_type', 'alert-warning');
            redirect('reports/received');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Message Reply";
        $data['mainContent']='reports/reply_received';
        $this->load->view('templates/template',$data);
    }

    function send(){
        // SET VALIDATION RULES
        $this->load->model('sms_model');

        $this->form_validation->set_rules('msisdn', 'Mobile Number', 'required|max_length[12]');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[160]');

        // has the form been submitted
        if($this->input->post()){
            $id = trim($this->input->post('id'));
            $msisdn = trim($this->input->post('msisdn'));
            $reply = trim($this->input->post('message'));
            $send_to = "tel:".$msisdn;

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){
                if(isset($id) && $id !=0){


                    log_message('info','Preparing to send message to: '.$send_to);
                    $recipients= array($send_to);

                    //Reply message to individual
                    $msg_sent= $this->sendsms_model->send_sms($recipients,$reply);

                    log_message("info","SMS Sending status: ".$msg_sent);
                    if($msg_sent=='success'){
                        // Display success message
                        $this->session->set_flashdata('appmsg', '"Message to "'.$msisdn.'" sent successfully!');
                        $this->session->set_flashdata('alert_type', 'alert-success');

                        //get initial message from stockist
                        $msg = $this->reports_m->get_received_sms($id);

                        $fname = $this->session->userdata('fname');
                        $sname = $this->session->userdata('sname');
                        $sentby = ucfirst($fname) ." ". ucfirst($sname);

                        //save sms save_reply($msg_id,$msisdn,$msg,$reply,$user)
                        $saved = $this->reports_m->save_reply($id,$msisdn,$msg->name,$msg->message,$reply,$sentby);

                        if($saved){
                            //save record to smsout
                            $this->sms_model->log_reply($msisdn,"Individual",$reply,$this->session->userdata('id'));
                        }
                        //change status of received message to replied
                        $this->reports_m->change_reply_status($id);

                        // Display success message
                        $this->session->set_flashdata('appmsg', 'Message sent successfully!');
                        $this->session->set_flashdata('alert_type', 'alert-success');
                        redirect('reports/received');

                    }else{
                        $msg_error = var_export($msg_sent,true);
                        $this->session->set_flashdata('appmsg', "Message to ".$msisdn." failed to send. ");
                        $this->session->set_flashdata('alert_type', 'alert-danger');
                        redirect('reports/received');

                    }
                }else{
                    $this->session->set_flashdata('appmsg', "Message to ".$msisdn." not sent. Stockist Identifier not included");
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('reports/received');
                }
            }
            $errors = validation_errors();
            $this->session->set_flashdata('appmsg', $errors);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            redirect('reports/received/reply/'.$id);
        }

        redirect('reports/received');
    }
}