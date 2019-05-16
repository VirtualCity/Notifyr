<!-- begin #content -->
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Enterprises Usage Report</li>
    </ol>
    </div>
 
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                
                <div class="panel-body">

                    <table id="factoryusagedatatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Factory</th>
                                <th>Factory Code</th>
                                <th>Sender Id</div>
                                <th>Sent</div>
                                <th>Received</div>
                                <th>Balance</div>
                                <th>Region</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Factory</th>
                                <th>Factory Code</th>
                                <th>Sender Id</div>
                                <th>Sent</div>
                                <th>Received</div>
                                <th>Balance</div>
                                <th>Region</th>
                                <th>Date Created</th>
                            </tr>
                        </tfoot>
                            
                    </table>
                </div>
                <div class="panel-footer">View Factories Usage Report</div>
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
        $('#factoryusagedatatables').DataTable({
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
                    url: '<?php echo base_url('factories/usageBalance_period')?>',
                    type:'POST',
                    dataSrc: ''
                },
                columns: [
                    { "data": "factoryName"},
                    { "data": "factoryCode"},
                    { "data": "senderid"},
                    { "data": "sent"},
                    { "data": "received"},
                    { "data": "balance"},
                    { "data": "region"},
                    { "data": "created"}
                ],
                "order": [[ 6, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                }
	        });
        
    });

</script> 
