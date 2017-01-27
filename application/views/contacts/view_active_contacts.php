


<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
           <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           <li class="active">Active Contacts</li>
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

    <ul class="nav nav-tabs">
        <li class="active"><a href="#default-tab-1" data-toggle="tab"><h4 class="panel-title">Active Contacts</h4></a></li>
        <li class=""><a href="<?=base_url('contacts/suspended')?>" >Suspended Contacts</a></li>
    </ul>

    <div class="panel panel-primary tab-content">
        <div class="tab-pane fade active in" id="default-tab-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>                
                    <h4>Active Contacts</h4>
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
                            <th>Town</th>

                            <?Php if($user_role!=="USER"){ ?>
                            <th>Action</th>
                            <?Php  } ?>

                        </tr>
                    </thead>

                </table>
            </div>
            <div class="panel-footer">Active Contactse</div>


        </div>
    </div>

</div>

</div>
</div>
<!-- end col-6 -->


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
            { "data": "town"}
            <?Php if($user_role==="ADMIN"){ ?>
                ,
                { "data": "actions","orderable": false,"searchable": false }
                <?Php  } ?>
                ],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                },
                "ajax":{
                    "url": "<?php echo base_url('contacts/datatable')?>",
                    "type": "POST"
                }
            });
    });

</script>



