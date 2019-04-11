<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
         <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Submitted Contacts</li>
     </ol>
 </div>

 <div id="alert_placeholder">
    <?php
    $appmsg = $this->session->flashdata('appmsg');
    if(!empty($appmsg)){ ?>
    <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
    <?php } ?>
</div>
<div class="row">

    <ul class="nav nav-tabs ">
        <li class=""><a href="<?=base_url('contacts')?>" >Active Contacts</a></li>
        <li class=""><a href="<?=base_url('contacts/suspended')?>" >Suspended Contacts</a></li>
        <li class="active"><a href="#default-tab-1" data-toggle="tab"><h4 class="panel-title">Submitted Contacts</h4></a></li>
        <li class=""><a href="<?=base_url('contacts/blacklistedlist')?>" >Blacklisted Contacts</a></li>
    </ul>

    <div class="panel panel-primary tab-content">
        <div class="tab-pane fade active in" id="default-tab-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                    </div>                
                    <h4>Submitted Contacts</h4>
                </div>

                <div class="panel-body">
                   <table class="table table-striped table-bordered table-hover datatable"  id="example">
                    <thead>
                        <tr>
                            <th>Mobile Number</th>
                            <th>Contact Name</th>
                            <th>Id Number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Region</th>
                            <th>Factory</th>
                            <th>Date Created</th>
                            <?Php if($user_role==="MANAGER"){ ?>
                            <th>Action</th>
                            <?Php  } ?>

                        </tr>
                    </thead>

                </table>
            </div>
            <div class="panel-footer">Submitted Contacts</div>


        </div>
    </div>

</div>

</div>



<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#example').dataTable({
            "processing": true,
            "serverSide": true,
            "scrollCollapse": true,
            "jQueryUI": true,
            "scrollX": true,
            "scrollY": 400,
            "pagingType": "full_numbers",
            "pageLength": 50,
            "lengthMenu": [[50, 100,200,500,-1], [50, 100,200,500,"All"]],
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>",
                "aButtons": [ "copy", "csv","xls","pdf" ]
            },
            columns: [
            { "data": "msisdn"},
            { "data": "name"},
            { "data": "id_number"},
            { "data": "email"},
            { "data": "address"},
            { "data": "region"},
            { "data": "town"},
            { "data": "created"}
            <?Php if($user_role==="MANAGER"){ ?>
                ,
                { "data": "actions","orderable": false,"searchable": false }
                <?Php  } ?>
                ],
                "order": [[ 7, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                },
                "ajax":{
                    "url": "<?php echo base_url('contacts/submittedContacts')?>",
                    "type": "POST"
                }
            });
    });

</script>
