<?php

class Reports_Controller extends MY_Controller {

    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('role')==='ADMIN'){
            redirect('login');
        }
    }
}

