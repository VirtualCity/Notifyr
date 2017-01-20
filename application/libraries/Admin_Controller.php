<?php

class Admin_Controller extends MY_Controller {

    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('role')==='ADMIN'){
            redirect('login');
        }
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
}

