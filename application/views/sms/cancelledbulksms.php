


<div id="content" class="content">

<div class="row">
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Cancelled SMS</li>
    </ol>
    </div>
</div>


<div class="row">

<ul class="nav nav-tabs">
    <li class=""><a href="<?=base_url('sms/pendingbulksms')?>" >Pending SMS</a></li>
    <li class=""><a href="<?=base_url('sms/pendingbulksms/approvedbulk')?>">Approved SMS</a></li>
    <li class="active"><a href="#default-tab-1" data-toggle="tab"><h4 class="panel-title">Cancelled SMS</h4></a></li>
    <li class=""><a href="<?=base_url('sms/pendingbulksms/rejectedbulk')?>">Rejected SMS</a></li>
</ul>

<div class="panel panel-primary tab-content">
    <div class="tab-pane fade active in" id="default-tab-1">
        <div class="panel panel-default">

            <div class="panel-body">
                <table id="cancelledsmsdatatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th>group</th>
                        <th>contacts</th>
                        <th>message</th>
                        <th>status</th>
                        <th>date created</th>
                        <th>date cancelled</th>
                        <th>cancelled by</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>group</th>
                            <th>contacts</th>
                            <th>message</th>
                            <th>status</th>
                            <th>date created</th>
                            <th>date cancelled</th>
                            <th>cancelled by</th>
                        </tr>
                    </tfoot>
                        
                </table>

        </div>
        <div class="panel-footer">Cancelled SMS</div>


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
        $('#cancelledsmsdatatables').DataTable({
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
                    url: '<?php echo base_url('sms/pendingbulksms/cancelled')?>',
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
                                    $(nTd).addClass('text-warning').html('<button class="btn btn-warning btn-fill btn-sm">Pending</button>');
                            }else if (sData == 1){
                                    $(nTd).addClass('text-primary').html('<button class="btn btn-primary btn-fill btn-sm">Approved</button>'); 
                            }else if (sData == 2){
                                    $(nTd).addClass('text-success').html('<button class="btn btn-success btn-fill btn-sm">Cancelled</button>'); 
                            }else if (sData == 3){
                                    $(nTd).addClass('text-danger').html('<button class="btn btn-danger btn-fill btn-sm">Rejected</button>'); 
                            }else{
                                    $(nTd).addClass('text-danger').html('<button class="btn btn-danger btn-fill btn-sm">Unknown</button>');
                            }
                        } 
                    },
                    { "data": "datecreated"},
                    { "data": "datecancelled"},
                    { "data": "cancelledby"}
                ],
                "order": [[ 4, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                }
	        });
        
    });

</script> 




