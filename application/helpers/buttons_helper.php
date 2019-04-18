<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/14/14
 * Time: 12:37 AM
 */

//Get View Products action buttons
function get_view_products_buttons($id){

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'products/edit/' . $id . '">Edit</a></li>';
    $html .= '<li><a href="' . base_url() . 'products/delete/' . $id . '">Delete</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}
function get_view_templates_buttons($id){

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'sms/newsms/edittemplate/' . $id . '">Edit</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}


function get_active_retailers_buttons($id){

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'retailers/sms/' . $id . '">SMS</a></li>';
    $html .= '<li><a href="' . base_url() . 'retailers/edit/' . $id . '">Edit</a></li>';
    $html .= '<li><a href="' . base_url() . 'retailers/suspend/' . $id . '">Suspend</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_inactive_retailers_buttons($id){

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'retailers/sms/' . $id . '">SMS</a></li>';
    $html .= '<li><a href="' . base_url() . 'retailers/edit/' . $id . '">Edit</a></li>';
    $html .= '<li><a href="' . base_url() . 'retailers/activate/' . $id . '">Activate</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_active_stockists_buttons($id){

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'stockists/deactivate/' . $id . '">Deactivate</a></li>';
    $html .= '<li><a href="' . base_url() . 'stockists/edit/' . $id . '">Edit</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_inactive_stockists_buttons($id){
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'stockists/activate/' . $id . '">Activate</a></li>';
    $html .= '<li><a href="' . base_url() . 'stockists/edit/' . $id . '">Edit</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}


/*View purchases Page*/
function get_view_purchases_buttons($id)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'reports/purchases/products/' . $id . '">View</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_blacklist_buttons($id)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'contacts/remove/' . $id . '">Reinstate</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}


/*function get_locations_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'locations/edit/' . $id . '">&nbsp; Edit</a>';
    $html .= '</span>';

    return $html;
}*/

function get_towns_supervisor_buttons($id,$town)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'towns/removesupervisor/' . $id . '">Remove</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_locations_buttons($id)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'locations/edit/' . $id . '">Edit</a></li>';
    $html .= '<li><a href="' . base_url() . 'locations/salespeople/' . $id . '">Salespeople</a></li>';
    $html .= '<li><a href="' . base_url() . 'locations/addsalesperson/' . $id . '">Add Salesperson</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_towns_buttons($id)
{

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'towns/edit/' . $id . '">Edit</a></li>';
    $html .= '<li><a href="' . base_url() . 'towns/supervisors/' . $id . '">Clerks</a></li>';
    $html .= '<li><a href="' . base_url() . 'towns/assign/' . $id . '">Add Clerk</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_factories_buttons($id)
{

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    if($ci->session->userdata('role')==="SUPER_USER"){
        $html .= '<li><a href="' . base_url() . 'factories/edit/' . $id . '">Edit</a></li>';
    }
   
    if($ci->session->userdata('role')==="SUPER_USER" || $ci->session->userdata('role')==="ADMIN"){
        $html .= '<li><a href="' . base_url() . 'factories/settings/' . $id . '">Settings</a></li>';
    }
    $html .= '<li><a href="' . base_url() . 'factories/factory_dashboard/' . $id . '">Dashboard</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_regions_buttons($id)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    if($ci->session->userdata('role')==="SUPER_USER"){
        $html .= '<li><a href="' . base_url() . 'regions/edit/' . $id . '">Edit</a></li>';
    }
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}


function get_groups_buttons($id)
{

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'groups/contacts/' . $id . '">Contacts</a></li>';
    if($ci->session->userdata('role')!=="USER"){
        $html .= '<li><a href="' . base_url() . 'groups/edit/' . $id . '">Edit</a></li>';
    }
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_area_managers_buttons($id){

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'managers/edit/' . $id . '">Edit</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

/*function get_salespeople_buttons($id){
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'salespeople/edit/' . $id . '">&nbsp; Edit</a>';
    $html .= '</span>';

    return $html;
}*/

function get_supervisors_buttons($id){

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'supervisors/edit/' . $id . '">Edit</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}


function get_active_contacts_buttons($id)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'contacts/sms/' . $id . '">SMS</a></li>';
    $html .= '<li><a href="' . base_url() . 'contacts/edit/' . $id . '">Edit</a></li>';
    $html .= '<li><a href="' . base_url() . 'contacts/suspend/' . $id . '">Suspend</a></li>';
    $html .= '<li><a href="' . base_url() . 'contacts/black_list_contact/' . $id . '">blacklist</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_submitted_contacts_buttons($id)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'contacts/activate/' . $id . '">Approve</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_pending_sms_buttons($id)
{

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'sms/pendingbulksms/approve/' . $id . '">Approve</a></li>';
    $html .= '<li><a href="' . base_url() . 'sms/pendingbulksms/cancel/' . $id . '">Cancel</a></li>';
    $html .= '<li><a href="' . base_url() . 'sms/pendingbulksms/reject/' . $id . '">Reject</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_suspended_contacts_buttons($id)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'contacts/activate/' . $id . '">Activate</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}


function get_received_messages_buttons($id)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'reports/received/reply/' . $id . '"><img src="' . base_url() . 'assets/img/reply.png"/>&nbsp; Reply</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_pending_messages_buttons($id)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'reports/pending/reply/' . $id . '"><img src="' . base_url() . 'assets/img/reply.png"/>&nbsp; Reply</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}


/* ---------------------------------------------------------------------------------------------------------------*/






function get_active_users_buttons($id)
{
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'users/active/suspend/' . $id . '"><img src="' . base_url() . 'assets/img/suspend.png"/>&nbsp; Suspend</a></li>';
    $html .= '<li><a href="#myModal2" data-toggle="modal" onclick="setUser('.$id.');"><img src="' . base_url() . 'assets/img/reset.png"/>&nbsp; Reset</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}

function get_suspended_users_buttons($id)
{

    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'users/suspended/activate/' . $id . '"><img src="' . base_url() . 'assets/img/activate.png"/>&nbsp; Activate</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}



function get_location_managers_buttons($id)
{   
    $ci = & get_instance();
    $html = '<li class="dropdown">';
    $html .= '<a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span><i class="ti-more-alt"></i></span>';
    $html .= '</a>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li><a href="' . base_url() . 'managers/edit/' . $id . '"><img src="' . base_url() . 'assets/img/edit.png"/>&nbsp; Edit</a></li>';
    $html .= '</ul>';
    $html .= '</li>';

    return $html;
}