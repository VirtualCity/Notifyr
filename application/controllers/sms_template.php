<?php
class Towns_ extends Admin_Controller{

function add(){
	 // SET VALIDATION RULES
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[200]|is_unique[sms_template.name]');
        $this->form_validation->set_rules('template', 'Template Name', '|max_length[50]|is_unique[sms_template.template]');
        $this->form_validation->set_rules('type', 'Type', 'required'); 
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');        
            
        }
	
	
	
	
	
	
	
	
}