
<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="javascript:;"><i class="fa fa-comments"></i> SMS Logs</a></li>
            <li class="active">SMS Inbox Log</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <table id="inboxdatatables" class="table table-responsive table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Group</th>
                                <th>Mobile</th>
                                <th>Contact Name</th>
                                <th>Message</th>
                                <th>Message Type</th>
                                <th>Status</th>
                                <th>Received</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Group</th>
                                <th>Mobile</th>
                                <th>Contact Name</th>
                                <th>Message</th>
                                <th>Message Type</th>
                                <th>Status</th>
                                <th>Received</th>
                            </tr>
                        </tfoot>
                            
                    </table>
                </div>
                <div class="panel-footer">SMS Inbox</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->

<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
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
        $('#inboxdatatables').DataTable({
                "processing": true,
                "serverSide": false,
                "scrollCollapse": true,
                "scrollX": true,
                "scrollY": 400,
                "pageLength": 10,
	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 50, 100,200,-1], [10, 50, 100,200,"All"]],
	            responsive: true,
	            language: {
	            search: "_INPUT_",
		            searchPlaceholder: "Search records",
                },
                ajax: {
                    url: '<?=base_url('logs/inbox/datatable')?>',
                    type:'POST'
                },
                columns: [
                    { "data": "groupname" },
                    { "data": "msisdn" },
                    { "data": "name" },
                    { "data": "message" },
                    { "data": "message_type" },
                    { "data": "status" },
                    { "data": "created"}
                ],
                "order": [[ 6, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                }
	        });
        
    });

</script> 
 