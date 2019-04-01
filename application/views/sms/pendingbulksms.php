


<div id="content" class="content">

<div class="breadcrumb-container ">
    <ol class="breadcrumb pull-left ">
       <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       <li class="active">Pending SMS</li>
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
    <li class="active"><a href="#default-tab-1" data-toggle="tab"><h4 class="panel-title">Pending SMS</h4></a></li>
    <li class=""><a href="<?=base_url('sms/pendingbulksms/approvedbulk')?>" >Approved SMS</a></li>
</ul>

<div class="panel panel-primary tab-content">
    <div class="tab-pane fade active in" id="default-tab-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                </div>                
                <h4>Pending SMS</h4>
            </div>

            <div class="panel-body">
             <table class="table table-striped table-bordered table-hover datatable"  id="example1">
                <thead>
                    <tr>
                        <th>group</th>
                        <th>contacts</th>
                        <th>message</th>
                        <th>status</th>
                        <th>date creted</th>
                        <th>creted by</th>
                        <?Php if($user_role==="MANAGER"){ ?>
                        <th>Action</th>
                        <?Php  } ?>

                    </tr>
                </thead>

            </table>
        </div>
        <div class="panel-footer">Pending SMS</div>


    </div>
</div>

</div>

</div>
</div>
<!-- end col-6 -->


<script type="text/javascript">
jQuery(document).ready(function(){
    var oTable = jQuery('#example1').dataTable({
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
        { "data": "groupname",
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

                   if (sData == null) {
                         $(nTd).addClass('text-left').html('Individual');
                   }
                }  
        },
        { "data": "contacts",
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    if (sData.length > 12) {
                        $(nTd).addClass('text-left').html('[Group Contacts]');
                    }
                } 
        },
        { "data": "message"},
        { "data": "status",
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

                   if (sData == 0) {
                         $(nTd).addClass('text-warning').html('<span class="badge badge-warning">Pending</span>');
                   }else{
                         $(nTd).addClass('text-success').html('<span class="badge badge-success">Approved</span>'); 
                   }
                }  
        },
        { "data": "datecreated"},
        { "data": "createdby"}
        <?Php if($user_role==="MANAGER"){ ?>
            ,
            { "data": "actions","orderable": false,"searchable": false }
            <?Php  } ?>
            ],
            "oLanguage": {
                "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?php echo base_url('sms/pendingbulksms/datatable')?>",
                "type": "POST"
            }
        });

        oTable.fnSort( [ [4,'desc'] ] );
});

</script>



