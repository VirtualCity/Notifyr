


<div id="content" class="content">

<div class="breadcrumb-container ">
    <ol class="breadcrumb pull-left ">
       <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       <li class="active">Approved SMS</li>
   </ol>
</div>

<div class="row">

<ul class="nav nav-tabs">
    <li class=""><a href="<?=base_url('sms/pendingbulksms')?>" >Pending SMS</a></li>
    <li class="active"><a href="#default-tab-1" data-toggle="tab"><h4 class="panel-title">Approved SMS</h4></a></li>
    <li class=""><a href="<?=base_url('sms/pendingbulksms/cancelledbulk')?>">Cancelled SMS</a></li>
    <li class=""><a href="<?=base_url('sms/pendingbulksms/rejectedbulk')?>">Rejected SMS</a></li>
</ul>

<div class="panel panel-primary tab-content">
    <div class="tab-pane fade active in" id="default-tab-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                </div>                
                <h4>Approved SMS</h4>
            </div>

            <div class="panel-body">
             <table class="table table-striped table-bordered table-hover datatable"  id="example2">
                <thead>
                    <tr>
                        <th>group</th>
                        <th>contacts</th>
                        <th>message</th>
                        <th>status</th>
                        <th>date created</th>
                        <th>date approved</th>
                        <th>approved by</th>
                    </tr>
                </thead>

            </table>
        </div>
        <div class="panel-footer">Approved SMS</div>


    </div>
</div>

</div>

</div>
</div>
<!-- end col-6 -->


<script type="text/javascript">
jQuery(document).ready(function(){
    var oTable1 = jQuery('#example2').dataTable({
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
                }else if (sData == 1){
                        $(nTd).addClass('text-primary').html('<span class="badge badge-primary">Approved</span>'); 
                }else if (sData == 2){
                        $(nTd).addClass('text-success').html('<span class="badge badge-success">Cancelled</span>'); 
                }else if (sData == 3){
                        $(nTd).addClass('text-danger').html('<span class="badge badge-danger">Rejected</span>'); 
                }else{
                        // $(nTd).addClass('text-danger').html('<span class="badge badge-danger">Unknown</span>');
                }
            } 
        },
        { "data": "datecreated"},
        { "data": "dateapproved"},
        { "data": "approvedby"}
            ],
            "oLanguage": {
                "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?php echo base_url('sms/pendingbulksms/approved')?>",
                "type": "POST"
            }
        });

        oTable1.fnSort( [ [4,'desc'] ] );
});

</script>



