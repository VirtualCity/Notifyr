


<div id="content" class="content">

<div class="breadcrumb-container ">
    <ol class="breadcrumb pull-left ">
       <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       <li class="active">Rejected SMS</li>
   </ol>
</div>



<div class="row">

<ul class="nav nav-tabs">
    <li class=""><a href="<?=base_url('sms/pendingbulksms')?>" >Pending SMS</a></li>
    <li class=""><a href="<?=base_url('sms/pendingbulksms/approvedbulk')?>">Approved SMS</a></li>
    <li class=""><a href="<?=base_url('sms/pendingbulksms/cancelledbulk')?>">Cancelled SMS</a></li>
    <li class="active"><a href="#default-tab-1" data-toggle="tab"><h4 class="panel-title">Rejected SMS</h4></a></li>
    
</ul>

<div class="panel panel-primary tab-content">
    <div class="tab-pane fade active in" id="default-tab-1">
        <div class="panel panel-default">

            <div class="panel-body">
                <table id="rejectedsmsdatatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                        <tr>
                        <th>group</th>
                        <th>contacts</th>
                        <th>message</th>
                        <th>status</th>
                        <th>date created</th>
                        <th>date rejected</th>
                        <th>rejected by</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>group</th>
                        <th>contacts</th>
                        <th>message</th>
                        <th>status</th>
                        <th>date created</th>
                        <th>date rejected</th>
                        <th>rejected by</th>
                        </tr>
                    </tfoot>
                        
                </table>
        </div>
        <div class="panel-footer">Rejected SMS</div>


    </div>
</div>

</div>

</div>
</div>
<!-- end col-6 -->
<script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>

 
<script type="text/javascript">
   $(document).ready(function(){
        <?php if ($this->session->flashdata('appmsg')): ?>
            <?php $appmsg = $this->session->flashdata('appmsg'); ?>
                        swal({
                            title: "Done",
                            text: "<?php echo $this->session->flashdata('appmsg'); ?>",
                            timer: 3000,
                            showConfirmButton: false,
                            type: "<?php echo $this->session->flashdata('alert_type_') ?>"
                    });
        <?php endif; ?>
        $('#rejectedsmsdatatables').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: [ 'copy', 'csv', 'excel' ],
                "processing": true,
                "serverSide": false,
                "scrollCollapse": false,
                "scrollX": true,
                "scrollY": 350,

	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 50, 100,200,-1], [10, 50, 100,200,"All"]],
	            responsive: true,
	            language: {
	            search: "_INPUT_",
		            searchPlaceholder: "Search records",
                },
                ajax: {
                    url: '<?php echo base_url('sms/pendingbulksms/rejected')?>',
                    type:'POST'
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
                "order": [[ 4, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                }
	        });
        
    });

</script> 



<script type="text/javascript">
jQuery(document).ready(function(){
    var oTable1 = jQuery('#example2').dataTable({
        "processing": true,
        "serverSide": true,
        "scrollCollapse": false,
        "jQueryUI": true,
        "scrollX": true,
        "scrollY": 350,
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
                "url": "<?php echo base_url('sms/pendingbulksms/rejected')?>",
                "type": "POST"
            }
        });

        oTable1.fnSort( [ [4,'desc'] ] );
});

</script>



