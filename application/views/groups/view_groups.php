<!-- begin #content -->
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Groups</li>
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
                <!-- <div class="panel-heading">
                    <div class="panel-heading-btn">
                    </div>
                    <h4 class="panel-title">View Groups</h4>
                </div> -->
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover datatable"  id="example">
                        <thead>
                        <tr>
                            <th>Group Name</th>
                            <th>Description</th>
                            <th>Factory</th>
                            <th>Date Created</th>
                            <?Php if($user_role==="MANAGER"){ ?>
                                <th>Action</th>
                            <?Php  } ?>

                        </tr>
                        </thead>

                    </table>
                </div>
                <div class="panel-footer">View Groups</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->

<script type="text/javascript">
    jQuery(document).ready(function(){
        var gTable = jQuery('#example').dataTable({
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
                { "data": "name"},
                { "data": "description"},
                { "data": "factory"},
                { "data": "created"}
                <?Php if($user_role==="MANAGER"){ ?>
                ,
                { "data": "actions","orderable": false,"searchable": false }
                <?Php  } ?>
            ],
            "oLanguage": {
                "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?php echo base_url('groups/datatable')?>",
                "type": "POST"
            }
        });

        gTable.fnSort( [ [2,'desc'] ] );
    });

</script> 