<!-- begin #content -->
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Templates</li>
    </ol>
    </div>
 


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                         
                    </div>
                    <h4 class="panel-title">View Templates</h4>
                </div>
                <div class="panel-body">
                   
                    <table class="table table-striped table-bordered table-hover datatable"  id="example">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Last Modified</th>                            
                            <?Php if($user_role!=="USER"){ ?>
                                <th>Action</th>
                            <?Php  } ?>

                        </tr>
                        </thead>

                    </table>
                   
                </div>
                <div class="panel-footer">View Templates</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->
<!--Header Section-->
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
            "lengthMenu": [[50, 100,200,500], [50, 100,200,500]],
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>",
                "aButtons": [ "copy", "csv","xls","pdf" ]
            },
            columns: [

                { "data": "template"},
                { "data": "title"},
                { "data": "type"},
                { "data": "modified"}
                <?Php if($user_role!=="USER"){ ?>
                ,
                { "data": "actions","orderable": false,"bSearchable": false }
                <?Php  } ?>
            ],
            "oLanguage": {
                "sProcessing": "<img src='<?= base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?php echo base_url('sms/newsms/datatable')?>",
                "type": "POST"
            }
        });
    });

</script>