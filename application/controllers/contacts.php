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
        $this->load->model('towns_m');
        $this->load->model('regions_m');
        $this->load->model('factories_model');

        $this->load->model('blacklist_model');
        $this->load->database();

    }

    function index(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Contacts";

        $data['mainContent']='contacts/view_active_contacts';
        $this->load->view('templates/template',$data);

    }

    //active contacts
    function datatable(){
        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');
        if($role === "SUPER_USER"){
            $this->datatables->select('contacts.id as id,msisdn,id_number,contacts.name as name,email,address,factories.name as factory,groups.name as groupname, contacts.created as created')
            ->unset_column('id')
            ->add_column('actions', get_active_contacts_buttons('$1'), 'id')
            ->join('groups','contacts.group_id = groups.id','left')
            ->join('factories','contacts.factory_id = factories.id','left')
            ->from('contacts')
			->where('status','ACTIVE');
            echo $this->datatables->generate();
        }else{
            $this->datatables->select('contacts.id as id,msisdn,id_number,contacts.name as name,email,address,factories.name as factory,groups.name as groupname, contacts.created as created')
            ->unset_column('id')
            ->add_column('actions', get_active_contacts_buttons('$1'), 'id')
            ->join('groups','contacts.group_id = groups.id','left')
            ->join('factories','contacts.factory_id = factories.id','left')
            ->from('contacts')
            ->where('contacts.factory_id',$userfactory)
			->where('status','ACTIVE');
            echo $this->datatables->generate();
        }

    }

    // submitted contacts
    function submittedContacts(){

        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');
        if($role === "SUPER_USER"){
            $this->datatables->select('contacts.id as id,msisdn,id_number,contacts.name as name,email,address,factories.name as factory,groups.name as groupname, contacts.created as created')
            ->unset_column('id')
            ->add_column('actions', get_submitted_contacts_buttons('$1'), 'id')
            ->join('groups','contacts.group_id = groups.id','left')
            ->join('factories','contacts.factory_id = factories.id','left')
            ->from('contacts')
			->where('status','SUBMITTED');
            echo $this->datatables->generate();
        }else{
            $this->datatables->select('contacts.id as id,msisdn,id_number,contacts.name as name,email,address,factories.name as factory,groups.name as groupname, contacts.created as created')
            ->unset_column('id')
            ->add_column('actions', get_submitted_contacts_buttons('$1'), 'id')
            ->join('groups','contacts.group_id = groups.id','left')
            ->join('factories','contacts.factory_id = factories.id','left')
            ->from('contacts')
            ->where('contacts.factory_id',$userfactory)
			->where('status','SUBMITTED');
        echo $this->datatables->generate();
        }

        
    }

	function suspended(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Suspended Contacts";

        $data['mainContent']='contacts/view_suspended_contacts';
        $this->load->view('templates/template',$data);
    }

    function submitted(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Submitted Contacts";

        $data['mainContent']='contacts/view_submitted_contacts';
        $this->load->view('templates/template',$data);
    }

    function datatable2(){

        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');
        if($role === "SUPER_USER"){
            $this->datatables->select('contacts.id as id,msisdn,id_number,contacts.name as name,email,address,factories.name as factory,groups.name as groupname, contacts.created as created')
            ->unset_column('id')
            ->add_column('actions', get_active_contacts_buttons('$1'), 'id')
            ->join('groups','contacts.group_id = groups.id','left')
            ->join('factories','contacts.factory_id = factories.id','left')
            ->from('contacts')
            ->where('status','SUSPENDED');

        echo $this->datatables->generate();
        }else{
            $this->datatables->select('contacts.id as id,msisdn,id_number,contacts.name as name,email,address,factories.name as factory,groups.name as groupname, contacts.created as created')
            ->unset_column('id')
            ->add_column('actions', get_active_contacts_buttons('$1'), 'id')
            ->join('groups','contacts.group_id = groups.id','left')
            ->join('factories','contacts.factory_id = factories.id','left')
            ->from('contacts')
            ->where('contacts.factory_id',$userfactory)
            ->where('status','SUSPENDED');

        echo $this->datatables->generate();
        }

        
    }
	
    function sms($id){

        if(!empty($id)){

            //retrieve the msisdn for the recipient
            $msisdn = $this->contacts_model->get_contact($id);
            //display reply view
            $data['name']=$msisdn->name;           
            $data['msisdn']= $msisdn->msisdn;
            $data['id']= $id;

        }else{
            // No contact id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No Contact identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            redirect('contacts');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "SMS Contact";
          $data['mainContent']='contacts/sms_contact';
        $this->load->view('templates/template',$data);


       
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

    // ==========================blacklist starts===========================

    function blacklisted(){
        $this->datatables->select('id,msisdn,created')
            ->unset_column('id')
            ->add_column('actions', get_blacklist_buttons('$1'), 'id')
            ->from('blacklist');

        echo $this->datatables->generate();
    }

    function blacklistedlist(){
        if(!$this->session->userdata('logged_in')){
            redirect('login');
            //echo("You are NOT logged in");
        }


        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Blacklisted Numbers";
        $data['mainContent']='blacklist';
        $data['mainContent']='contacts/view_blacklisted_contacts';
        $this->load->view('templates/template',$data);
    }

    function remove($id){
        $result = "";
        if(!empty($id)){
            //retrieve the msisdn for the recipient
            $result = $this->blacklist_model->remove_contact($id);
            if ($result) {
                $this->session->set_flashdata('appmsg', 'Mobile Number '.$msisdn.' successfully reinstated from blacklist.!');
                $this->session->set_flashdata('alert_type', 'alert-success');
                $this->session->set_flashdata('alert_type_', 'success');
            } else {
                $this->session->set_flashdata('appmsg', 'Mobile Number '.$msisdn.' Could not be reinstated from blacklist.!');
                $this->session->set_flashdata('alert_type', 'alert-warning');
                $this->session->set_flashdata('alert_type_', 'warning');
                
            }
            redirect('contacts/blacklistedlist');          

        }
    }

    function black_list_contact($id)
    {
        if(!empty($id)){
            $contact = "";
            $exists = "";

            $contact = $this->contacts_model->get_contact($id);
            
            if ($contact !== false) {
                $exists= $this->blacklist_model->check_contact($contact->msisdn);

                if(!$exists){
                    $saved= $this->blacklist_model->blacklist($contact->msisdn);

                    if($saved){
                        // Display success message
                        $this->session->set_flashdata('appmsg', 'Mobile Number '.$msisdn.' successfully added to blacklist.!');
                        $this->session->set_flashdata('alert_type', 'alert-success');
                        $this->session->set_flashdata('alert_type_', 'success');
                        redirect('contacts');

                    }else{
                        // Display fail message
                        $this->session->set_flashdata('appmsg', 'Problem encountered while blacklisting number. Check logs');
                        $this->session->set_flashdata('alert_type', 'alert-warning');
                        $this->session->set_flashdata('alert_type_', 'warning');
                        redirect('contacts');
                    }

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'This Mobile Number: '.$msisdn.' already exists in blacklist. ');
                    $this->session->set_flashdata('alert_type', 'alert-warning');
                    $this->session->set_flashdata('alert_type_', 'warning');
                    redirect('contacts');
                }
            } else {
                // Display fail message
                $this->session->set_flashdata('appmsg', 'This Mobile Number does not exist. ');
                $this->session->set_flashdata('alert_type', 'alert-warning');
                $this->session->set_flashdata('alert_type_', 'warning');
                redirect('contacts');
            }
            

            

        }
        
    }
   // ==========================blacklist ends===========================
    function add(){

        // SET VALIDATION RULES
        $this->form_validation->set_rules('msisdn', 'Mobile Number', 'required|numeric|is_unique[contacts.msisdn]|exact_length[12]');
        $this->form_validation->set_rules('name', 'Name', 'max_length[50]');
        $this->form_validation->set_rules('idno', 'Id Number', 'max_length[30]|numeric');
        // $this->form_validation->set_rules('region_id', 'Region', 'required|numeric');
        // $this->form_validation->set_rules('town_id', 'Town', 'required|numeric');
        // $this->form_validation->set_rules('group_id', 'Group', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'max_length[50]|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'max_length[100]');

        $this->form_validation->set_rules('factory_id', 'Factory', 'required|numeric');
        $this->form_validation->set_rules('group_id', 'Group', 'required|numeric');
        $this->form_validation->set_rules('code', 'Code', 'max_length[50]');

        $this->form_validation->set_message('is_unique', 'This mobile number already exists in contacts');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $msisdn ="";
        $name="";
        $code = "";
        $email="";
        $address="";
        $idno="";
        $id_number='';
        $groups="";
        $factories="";
        $role = $this->session->userdata('role');

        $userfactory = $this->session->userdata('factory');

        // has the form been submitted
        if($this->input->post()){
            $msisdn = $this->input->post('msisdn');
            $name = $this->input->post('name');
            $idno = $this->input->post('idno');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            // $region_id = $this->input->post('region_id');
            // $town_id = $this->input->post('town_id');
            // $group_id = $this->input->post('group_id');

            $factory_id = $this->input->post('factory_id');
            $group_id = $this->input->post('group_id');
            $code = $this->input->post('code');


            // print_r($this->input->post());
            // return;

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //Check if contact exists
                $msisdn_exists= $this->contacts_model->check_contact($msisdn);

                if($msisdn_exists){
                    // Notify Contact already exists
                    $this->session->set_flashdata('appmsg', 'A contact with this mobile number "'.$msisdn.'" already Exists!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    $this->session->set_flashdata('alert_type_', 'success');
                    redirect('contacts/add');

                }else{
                    //Save new contact
                    $status = NULL;
                    if ($role === "USER") {
                        $status = "SUBMITTED";
                    }else{
                        $status = "ACTIVE";
                    }

                    $saved = $this->contacts_model->create_contact($msisdn,ucfirst($name),$idno,strtolower($email),ucwords($address),$region_id,$town_id,$status,$factory_id,$group_id);
                   // $saved = $this->contacts_model->add_group_contacts($group_id, $msisdn,ucfirst($name),$idno,strtolower($email),ucwords($address),$region_id,$town_id);

                    if($saved){
                        $this->contacts_model->add_contact_togroup_viaId($msisdn,$group_id);
                        // Display success message
                        $this->session->set_flashdata('appmsg', 'New contact added successfully!');
                        $this->session->set_flashdata('alert_type', 'alert-success');
                        $this->session->set_flashdata('alert_type_', 'success');
                        redirect('contacts/add');

                    }else{
                        // Display fail message
                        $this->session->set_flashdata('appmsg', 'Failed to add New contact. Check logs');
                        $this->session->set_flashdata('alert_type', 'alert-danger');
                        $this->session->set_flashdata('alert_type_', 'error');
                        redirect('contacts/add');
                    }
                }
            }
        }



        $data['msisdn']=$msisdn;
        $data['name']=$name;
        $data['idno']=$idno;
        $data['code']=$code;
        $data['email']=$email;
        $data['address']=$address;
        $data['id_number']=$id_number;
        $data['userfactory']=$userfactory;

        $regions = $this->regions_m->get_all_regions();
        $data['regions'] = $regions;
        $towns= $this->towns_m-> get_all_towns();
        $data['towns']=$towns;
        if ($role === "SUPER_USER") {
            $groups= $this->groups_model-> get_all_groups();
        } else {
            $groups= $this->groups_model-> get_group_by_factory($userfactory);
        }
        
        $data['groups']=$groups;

        if ($role === "SUPER_USER") {
            $factories= $this->factories_model->get_all_factories();
        } else {
            $factories= $this->factories_model->get_factory($userfactory);
        }
        
        $data['factories']=$factories;

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Add Contact";
        $data['user_role'] = $this->session->userdata('role');

        $data['mainContent']='contacts/add';
        $this->load->view('templates/template',$data);
    }

    function edit($id=null){

        if(!empty($id)){

            //retrieve contact to edit
            $to_edit = $this->contacts_model->get_contact($id);

            //display edit view
            $data['id']=$id;
            $data['msisdn']=$to_edit->msisdn;
            $data['code']=$to_edit->code;
            $data['name']=$to_edit->name;
            $data['email']=$to_edit->email;
            $data['address']=$to_edit->address;


        }else{
            // No contact id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No Contact identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            redirect('contacts');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Edit Contact";

         $data['mainContent']='contacts/edit_contact';
        $this->load->view('templates/template',$data);


        

    }

    function modify(){

        // SET VALIDATION RULES
        $this->form_validation->set_rules('id', 'Id', 'required|numeric');
        $this->form_validation->set_rules('msisdn', 'Mobile Number', 'required|numeric|exact_length[12]');
        $this->form_validation->set_rules('name', 'Name', 'max_length[50]');
        // $this->form_validation->set_rules('code', 'Code', 'max_length[50]');
        $this->form_validation->set_rules('idno', 'Id Number', 'max_length[30]|numeric');
        $this->form_validation->set_rules('email', 'Email', 'max_length[50]|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'max_length[100]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // has the form been submitted
        if($this->input->post()){

            $id = $this->input->post('id');
            $msisdn = $this->input->post('msisdn');
            $name = $this->input->post('name');
            // $code = $this->input->post('code');
            $idno = $this->input->post('idno');
            $email = $this->input->post('email');
            $address = $this->input->post('address');

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){
                //Update msisdn to group contact too
                $current = $this->contacts_model->get_contact($id);
                $_msisdn=$current->msisdn;

                $update_grp_contact=$this->groups_model->update_group_contact_msisdn($_msisdn, $msisdn);
                //Save new user
                $updated = $this->contacts_model->edit_contact($id,$msisdn,ucwords($name),$idno,strtolower($email),$address);

                if($updated && $update_grp_contact){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'Contact updated successfully');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    $this->session->set_flashdata('alert_type_', 'success');
                    redirect('contacts');
                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'Failed to update contact! Check logs.');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    $this->session->set_flashdata('alert_type_', 'error');
                    redirect('contacts');
                }

            }

            $errors = validation_errors();
            $this->session->set_flashdata('appmsg', $errors);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
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
            $this->session->set_flashdata('alert_type_', 'success');
        }else{
            $this->session->set_flashdata('appmsg', 'Failed to activate contact!');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
        }
        redirect("contacts");
    }

    function suspend($id){
        $contact = $this->contacts_model->get_contact($id);
        $deactivated = $this->contacts_model->suspend_contact($id,$contact->msisdn);
        if($deactivated){
            $this->session->set_flashdata('appmsg', 'Contact successfully suspended from all groups!');
            $this->session->set_flashdata('alert_type', 'alert-success');
            $this->session->set_flashdata('alert_type_', 'success');
        }else{
            $this->session->set_flashdata('appmsg', 'Failed to suspend contact!');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
        }
        redirect("contacts");
    }

}