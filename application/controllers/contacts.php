<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 5/18/2015
 * Time: 12:00 PM
 */


class Contacts extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('buttons_helper');
        $this->load->model('groups_model');
        $this->load->model('contacts_model');

    }

    function index(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Contacts";

        $data['mainContent']='contacts/view_active_contacts';
        $this->load->view('templates/template',$data);

    }

    function datatable(){
        $this->datatables->select('contacts.id as id,msisdn,id_number,contacts.name as name,email,address,towns.name as town,regions.name as region')
            ->unset_column('id')
            ->add_column('actions', get_active_contacts_buttons('$1'), 'id')
            ->join('regions','contacts.region_id = regions.id','left')
            ->join('towns','contacts.town_id = towns.id','left')
            ->from('contacts')
			->where('status','ACTIVE');
        echo $this->datatables->generate();
    }

	function suspended(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Suspended Contacts";

        $data['mainContent']='contacts/view_suspended_contacts';
        $this->load->view('templates/template',$data);

    

       
    }

    function datatable2(){
        $this->datatables->select('contacts.id as id,msisdn,id_number,contacts.name as name,email,address,towns.name as town,regions.name as region,contacts.created as created')
            ->unset_column('id')
            ->add_column('actions', get_suspended_contacts_buttons('$1'), 'id')
            ->join('regions','contacts.region_id = regions.id','left')
            ->join('towns','contacts.town_id = towns.id','left')
            ->from('contacts')
            ->where('status','SUSPENDED');

        echo $this->datatables->generate();
    }
	
    function sms($id){

        if(!empty($id)){

            //retrieve the msisdn for the recipient
            $msisdn = $this->contacts_model->get_contact($id);
            //display reply view
            $data['msisdn']= $msisdn->msisdn;
            $data['id']= $id;

        }else{
            // No contact id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No Contact identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            redirect('contacts');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "SMS Contact";
        $this->load->view('templates/header', $data);
        $this->load->view('contacts/sms_contact',$data);
    }

    function sendsms(){

        // SET VALIDATION RULES
        $this->form_validation->set_rules('msisdn', 'Mobile Number', 'required|numeric|exact_length[12]|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[160]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // has the form been submitted
        if($this->input->post()){

            $id = $this->input->post('id');
            $msisdn = trim($this->input->post('msisdn'));
            $message = trim($this->input->post('message'));

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //verify group name doesnt exist except current edited group
                $contact_exists = $this->contacts_model->get_contact($id);

                if($contact_exists){
                    //compare msisdn
                    //If msisdn match proceed to send message else display message

                    if($msisdn !== $contact_exists ->msisdn){
                        $this->session->set_flashdata('appmsg', 'Mobile number recipient differs from what was initially selected');
                        $this->session->set_flashdata('alert_type', 'alert-info');
                        redirect('contacts');
                    }else{
                        //Send SMS new group
                        $this->load->library('sms/SmsSender.php');
                        $this->load->model('sms_model');
                        $this->load->model('sendsms_model');

                        $recipients= array('tel:'.$msisdn);
                        $msg_sent= $this->sendsms_model->send_sms($recipients,$message);

                        log_message("info","Sending status: ".$msg_sent);

                        if($msg_sent=='success'){
                            // Display success message
                            $this->session->set_flashdata('appmsg', 'Message to '.$msisdn.' sent successfully!');
                            $this->session->set_flashdata('alert_type', 'alert-success');

                            //save sms
                            $userid = $this->session->userdata('id');
                            $this->sms_model->save_sms($msisdn,"Individual",$message,$userid);

                            redirect('contacts');
                        }else{
                            // Display fail message
                            $this->session->set_flashdata('appmsg', 'Message to '.$msisdn.' failed.');
                            $this->session->set_flashdata('alert_type', 'alert-danger');
                            redirect('contacts');
                        }
                    }

                }else{
                    // No contact id specified
                    $this->session->set_flashdata('appmsg', 'An Error Was Encountered! Contact not found ');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('contacts');
                }

            }
            $errors = validation_errors();
            $this->session->set_flashdata('appmsg', $errors);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            redirect('contacts/sms/'.$id);
        }

        redirect('contacts');
    }

    /*function add(){

        // SET VALIDATION RULES
        $this->form_validation->set_rules('msisdn', 'Mobile Number', 'required|numeric|is_unique[contacts.msisdn]|exact_length[12]');
        $this->form_validation->set_rules('name', 'Name', 'max_length[50]');
        $this->form_validation->set_rules('idno', 'Id Number', 'max_length[30]|numeric');
        $this->form_validation->set_rules('email', 'Email', 'max_length[50]|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'max_length[100]');

        $this->form_validation->set_message('is_unique', 'This mobile number already exists in contacts');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $msisdn ="";
        $name="";
        $email="";
        $address="";
        $idno="";

        // has the form been submitted
        if($this->input->post()){
            $msisdn = $this->input->post('msisdn');
            $name = $this->input->post('name');
            $idno = $this->input->post('idno');
            $email = $this->input->post('email');
            $address = $this->input->post('address');

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //Check if contact exists
                $msisdn_exists= $this->contacts_model->check_contact($msisdn);

                if($msisdn_exists){
                    // Notify Contact already exists
                    $this->session->set_flashdata('appmsg', 'A contact with this mobile number "'.$msisdn.'" already Exists!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    redirect('contacts/add');

                }else{
                    //Save new contact
                    $saved = $this->contacts_model->create_contact($msisdn,ucfirst($name),$idno,strtolower($email),ucwords($address));

                    if($saved){
                        // Display success message
                        $this->session->set_flashdata('appmsg', 'New contact added successfully!');
                        $this->session->set_flashdata('alert_type', 'alert-success');
                        redirect('contacts/add');

                    }else{
                        // Display fail message
                        $this->session->set_flashdata('appmsg', 'Failed to add New contact. Check logs');
                        $this->session->set_flashdata('alert_type', 'alert-danger');
                        redirect('contacts/add');
                    }
                }
            }
        }



        $data['msisdn']=$msisdn;
        $data['name']=$name;
        $data['idno']=$idno;
        $data['email']=$email;
        $data['address']=$address;

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Add Contact";
        $this->load->view('templates/header', $data);
        $this->load->view('contacts/add_contact',$data);
    }*/

   

    function edit($id=null){

        if(!empty($id)){

            //retrieve contact to edit
            $to_edit = $this->contacts_model->get_contact($id);

            //display edit view
            $data['id']=$id;
            $data['msisdn']=$to_edit->msisdn;
            $data['name']=$to_edit->name;
            $data['email']=$to_edit->email;
            $data['address']=$to_edit->address;


        }else{
            // No contact id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No Contact identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            redirect('contacts');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Edit Contact";
        $this->load->view('templates/header', $data);
        $this->load->view('contacts/edit_contact',$data);

    }

    function modify(){

        // SET VALIDATION RULES
        $this->form_validation->set_rules('id', 'Id', 'required|numeric');
        $this->form_validation->set_rules('msisdn', 'Mobile Number', 'required|numeric|exact_length[12]');
        $this->form_validation->set_rules('name', 'Name', 'max_length[50]');
        $this->form_validation->set_rules('idno', 'Id Number', 'max_length[30]|numeric');
        $this->form_validation->set_rules('email', 'Email', 'max_length[50]|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'max_length[100]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // has the form been submitted
        if($this->input->post()){

            $id = $this->input->post('id');
            $msisdn = $this->input->post('msisdn');
            $name = $this->input->post('name');
            $idno = $this->input->post('idno');
            $email = $this->input->post('email');
            $address = $this->input->post('address');

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //Save new user
                $updated = $this->contacts_model->edit_contact($id,$msisdn,ucwords($name),$idno,strtolower($email),$address);

                if($updated){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'Contact updated successfully');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    redirect('contacts');
                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'Failed to update contact! Check logs.');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('contacts');
                }

            }

            $errors = validation_errors();
            $this->session->set_flashdata('appmsg', $errors);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            redirect('contacts/edit/'.$id);
        }

        redirect('contacts');
    }

    

    

function activate($id){
        $contact = $this->contacts_model->get_contact($id);
        $deactivated = $this->contacts_model->activate_contact($id,$contact->msisdn);
        if($deactivated){
            $this->session->set_flashdata('appmsg', 'Contact successfully activated!');
            $this->session->set_flashdata('alert_type', 'alert-success');
        }else{
            $this->session->set_flashdata('appmsg', 'Failed to activate contact!');
            $this->session->set_flashdata('alert_type', 'alert-danger');
        }
        redirect("contacts");
    }

    function suspend($id){
        $contact = $this->contacts_model->get_contact($id);
        $deactivated = $this->contacts_model->suspend_contact($id,$contact->msisdn);
        if($deactivated){
            $this->session->set_flashdata('appmsg', 'Contact successfully suspended from all groups!');
            $this->session->set_flashdata('alert_type', 'alert-success');
        }else{
            $this->session->set_flashdata('appmsg', 'Failed to suspend contact!');
            $this->session->set_flashdata('alert_type', 'alert-danger');
        }
        redirect("contacts");
    }

}