<!-- begin #content -->
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Groups</li>
    </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <table id="groupsdatatables" class="table table-responsive table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Group Name</th>
                                <th>Description</th>
                                <th>Factory</th>
                                <th>Date Created</th>
                                <?Php if($user_role==="SUPER_USER"){ ?>
                                    <th class="disabled-sorting">Actions</th>
                                <?Php  } ?>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Group Name</th>
                                <th>Description</th>
                                <th>Factory</th>
                                <th>Date Created</th>
                                <?Php if($user_role==="SUPER_USER"){ ?>
                                    <th class="disabled-sorting">Actions</th>
                                <?Php  } ?>
                            </tr>
                        </tfoot>
                            
                    </table>
                </div>
                <div class="panel-footer">View Groups</div>
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
        $('#groupsdatatables').DataTable({
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
                    url: '<?=base_url('groups/datatable')?>',
                    type:'POST'
                },
                columns: [
                    { "data": "name"},
                    { "data": "description"},
                    { "data": "factory"},
                    { "data": "created"}
                <?Php if($user_role==="SUPER_USER"){ ?>
                ,
                { "data": "actions","orderable": false,"bSearchable": false }
                <?Php  } ?>
                ],
                "order": [[ 3, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                }
	        });
        
    });

</script> 