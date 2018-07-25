<!-- begin #content -->
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="<?=base_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?=base_url("groups")?>"><i class="fa fa-file"></i> Groups</a></li>
        <li class="active"><?=$group_name ?> Contacts</li>
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
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                         
                    </div>
                    <h4 class="panel-title"><?=$group_name ?> Contacts</h4>
                </div>
                <div class="panel-body">
                      <table class="table table-striped table-bordered table-hover datatable"  id="example">
                        <thead>
                        <tr>
                            <th>Mobile No</th>
                            <th>Name</th>
                            <th>Id No</th>
                            <th>Email</th>
                            <th>Region</th>
                            <th>Town</th>
                            <th>Address</th>
                            <th>Subscription Date</th>

                        </tr>
                        </thead>

                    </table>
                </div>
                <div class="panel-footer"><?=$group_name ?> Contacts</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->
 

 
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#example').DataTable({
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
                { "data": "region"},
                { "data": "town"},
                { "data": "address"},
                { "data": "created"}
            ],
            "oLanguage": {
                "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?php echo base_url('groups/datatable2/'.$groupid)?>",
                "type": "POST"
            }
        });
    });

</script> 