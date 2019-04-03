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
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'products/edit/' . $id . '">&nbsp; Edit</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'products/delete/' . $id . '"> Delete</a>';
    $html .= '</span>';

    return $html;
}
function get_view_templates_buttons($id){
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'sms/newsms/edittemplate/' . $id . '">&nbsp; Edit</a>';
    $html .= '</span>';

    return $html;
}


function get_active_retailers_buttons($id){
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'retailers/sms/' . $id . '"> SMS</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'retailers/edit/' . $id . '"> Edit</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'retailers/suspend/' . $id . '"> Suspend</a>';

    $html .= '</span>';

    return $html;
}

function get_inactive_retailers_buttons($id){
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'retailers/sms/' . $id . '"> SMS</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'retailers/edit/' . $id . '"> Edit</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'retailers/activate/' . $id . '"> Activate</a>';
    $html .= '</span>';

    return $html;
}

function get_active_stockists_buttons($id){
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'stockists/deactivate/' . $id . '">&nbsp; Deactivate</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'stockists/edit/' . $id . '">&nbsp; Edit</a>';
    $html .= '</span>';

    return $html;
}

function get_inactive_stockists_buttons($id){
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'stockists/activate/' . $id . '">&nbsp; Activate</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'stockists/edit/' . $id . '">&nbsp; Edit</a>';
    $html .= '</span>';

    return $html;
}


/*View purchases Page*/
function get_view_purchases_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'reports/purchases/products/' . $id . '">&nbsp; View</a>';
    $html .= '</span>';

    return $html;
}

function get_blacklist_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'blacklist/remove/' . $id . '">&nbsp; Re-instate</a>';
    $html .= '</span>';

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
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'towns/removesupervisor/' . $id . '/'.$town.'">&nbsp; Remove</a>';
    $html .= '</span>';

    return $html;
}

function get_locations_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'locations/edit/' . $id . '">&nbsp; Edit</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'locations/salespeople/' . $id . '">&nbsp; Salespeople</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'locations/addsalesperson/' . $id . '">&nbsp; Add Salesperson</a>';
    $html .= '</span>';

    return $html;
}

function get_towns_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'towns/edit/' . $id . '">&nbsp; Edit</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'towns/supervisors/' . $id . '">&nbsp; Supervisors</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'towns/assign/' . $id . '">&nbsp; Add Supervisor</a>';
    $html .= '</span>';

    return $html;
}

function get_regions_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'regions/edit/' . $id . '">&nbsp; Edit</a>';
    $html .= '</span>';

    return $html;
}


function get_groups_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'groups/contacts/' . $id . '">&nbsp; Contacts</a>';
    if($ci->session->userdata('role')!=="USER"){
        $html .= '&nbsp; | &nbsp;';
        $html .= '<a href="' . base_url() . 'groups/edit/' . $id . '">&nbsp; Edit</a>';
    }
    $html .= '</span>';

    return $html;
}

function get_area_managers_buttons($id){
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'managers/edit/' . $id . '">&nbsp; Edit</a>';
    $html .= '</span>';

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
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'supervisors/edit/' . $id . '">&nbsp; Edit</a>';
    $html .= '</span>';

    return $html;
}

function get_active_contacts_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'contacts/sms/' . $id . '">SMS</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'contacts/edit/' . $id . '">Edit</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'contacts/suspend/' . $id . '">Suspend</a>';
    $html .= '</span>';

    return $html;
}

function get_pending_sms_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'sms/pendingbulksms/approve/' . $id . '">Approve</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'sms/pendingbulksms/cancel/' . $id . '">Cancel</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="' . base_url() . 'sms/pendingbulksms/reject/' . $id . '">Reject</a>';
    $html .= '</span>';

    return $html;
}

function get_suspended_contacts_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'contacts/activate/' . $id . '">Activate</a>';
    $html .= '</span>';

    return $html;
}


function get_received_messages_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'reports/received/reply/' . $id . '"><img src="' . base_url() . 'assets/img/reply.png"/>&nbsp; Reply</a>';
    $html .= '</span>';

    return $html;
}

function get_pending_messages_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'reports/pending/reply/' . $id . '"><img src="' . base_url() . 'assets/img/reply.png"/>&nbsp; Reply</a>';
    $html .= '</span>';

    return $html;
}


/* ---------------------------------------------------------------------------------------------------------------*/






function get_active_users_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'users/active/suspend/' . $id . '"><img src="' . base_url() . 'assets/img/suspend.png"/>&nbsp; Suspend</a>';
    $html .= '&nbsp; | &nbsp;';
    $html .= '<a href="#myModal2" data-toggle="modal" onclick="setUser('.$id.');"><img src="' . base_url() . 'assets/img/reset.png" />&nbsp; Reset</a>';
    $html .= '</span>';

    return $html;
}

function get_suspended_users_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'users/suspended/activate/' . $id . '"><img src="' . base_url() . 'assets/img/activate.png"/>&nbsp; Activate</a>';
    $html .= '</span>';

    return $html;
}



function get_location_managers_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'managers/edit/' . $id . '"><img src="' . base_url() . 'assets/img/edit.png"/>&nbsp; Edit</a>';
    $html .= '</span>';

    return $html;
}