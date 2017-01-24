
<!-- begin #content -->
<div id="content" class="content">
    
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Managers</li>
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
            <div class="panel panel-no-rounded-corner panel-default">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        
                    </div>
                    <h4 class="panel-title">Managers</h4>
                </div>
                <div class="panel-body">
                      <table class="table table-striped table-bordered table-hover datatable"  id="example">
                        <thead>
                        <tr>
                            <th>Manager Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Division</th>
                            <th>Region</th>
                            <th>Last Modified</th>
                            <th>Date Created</th>
                            <?Php if($user_role!=="USER"){ ?>
                                <th>Action</th>
                            <?Php  } ?>

                        </tr>
                        </thead>

                    </table>
                </div>
                <div class="panel-footer">Managers</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->


 
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#example').dataTable({
            "processing": true,
            "serverSide": true,
            "scrollCollapse": true,
            "jQueryUI": true,
            "scrollX": true,
            "scrollY": 400,
            "sPaginationType": "full_numbers",
            "pageLength": 50,
            "lengthMenu": [[50, 100,200,500,-1], [50, 100,200,500,"All"]],
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>",
                "aButtons": [ "copy", "csv","xls","pdf" ]
            },
            aoColumns: [

                { "data": "name" },
                { "data": "mobile"},
                { "data": "email"},
                { "data": "division"},
                { "data": "region" },
                { "data": "modified"},
                { "data": "created"}
                <?Php if($user_role!=="USER"){ ?>
                ,
                { "data": "actions","orderable": false,"bSearchable": false }
                <?Php  } ?>
            ],
            "oLanguage": {
                "sProcessing": "<img src='<?= base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?php echo base_url('managers/datatables')?>",
                "type": "POST"
            }
        });


    });

</script> 