<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 8:52 AM
 */

class Purchases extends My_Controller{
    function __construct(){
        parent::__construct();


        $this->load->helper('buttons_helper');
        $this->load->model('reports_m');
    }

    function index(){

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Purchases Report";
        $this->load->view('templates/header', $data);
        $this->load->view('reports/view_purchases',$data);
    }


    function datatable(){
        $this->datatables->select('purchase_report.id AS pr_id,product_code,carton_code,products.name as product_name,
        description,msisdn,purchase_report.name as name,town,region,purchase_report.created as created')
            ->unset_column('pr_id')
            ->from('purchase_report')
            ->join('products','purchase_report.product_code = products.code');

        echo $this->datatables->generate();
    }

    function products($id=null){
        if(!empty($id)){
            //retrieve purchase report details
            $purchase_report = $this->reports_m->get_purchase_report_details($id);


            log_message('info','purchase report'.var_export($purchase_report,true));

            //purchase report details
            $data['id']=$id;
            $data['mobile_used']=$purchase_report->msisdn;
            $data['stockist_mobile1']=$purchase_report->stockist_mobile1;
            $data['stockist_mobile2']=$purchase_report->stockist_mobile2;
            $data['stockist_town']=$purchase_report->town;
            $data['business_name']=$purchase_report->stockist_biz;
            $data['contact_name']=$purchase_report->contact_name;
            $data['invoice']=$purchase_report->invoice;
            $data['distributor_code']=$purchase_report->distributor_code;
            $data['distributor_mobile']=$purchase_report->distributor_mobile;
            $data['distributor_name']=$purchase_report->distributor_name;
            $data['distributor_region']=$purchase_report->region;
            $data['report_date']=$purchase_report->created;

        }else{
            //return fail. distributor code already in use
            $this->session->set_flashdata('appmsg', 'Error encountered! No identifier specified');
            $this->session->set_flashdata('alert_type', 'alert-warning');
            redirect('reports/purchases');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Edit Distributor";
        $this->load->view('templates/header', $data);
        $this->load->view('reports/view_products',$data);

    }


    function datatable2($id){
        if(!empty($id)) {
            $this->datatables->select('purchase_products.id as pp_id,purchase_products.sku_code as sku_code,item_code,description,quantity,item_um')
                ->unset_column('pp_id')
                ->from('purchase_products')
                ->join('products','purchase_products.sku_code = products.sku_code','LEFT')
                ->where('purchase_products.purchase_report_id',$id);

            echo $this->datatables->generate();
        }
    }


}