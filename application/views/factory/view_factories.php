<!-- begin #content -->
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Factories</li>
    </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                
                <div class="panel-body">
               
                <table id="factorydatatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <?Php if($user_role==="SUPER_USER"){ ?>
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                            <a  href="<?=base_url('factories/add')?>"><div class="btn btn-success btn-fill pull-right">Add Factory</div></a>
                            </div>
                        </div>
                    <?Php  } ?>
                    <thead>
                        <tr>
                            <th>Factory</th>
                            <th>Factory Code</th>
                            <th>Region</th>
                            <th>Date Created</th>
                            <?Php if(($user_role==="SUPER_USER") || ($user_role==="MANAGER") || ($user_role==="ADMIN")){ ?>
                                <th class="disabled-sorting">Actions</th>
                            <?Php  } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Factory</th>
                            <th>Factory Code</th>
                            <th>Region</th>
                            <th>Date Created</th>
                            <?Php if(($user_role==="SUPER_USER") || ($user_role==="MANAGER") || ($user_role==="ADMIN")){ ?>
                                <th class="disabled-sorting">Actions</th>
                            <?Php  } ?>
                        </tr>
                    </tfoot>
                        
                </table>

            </div>
                <div class="panel-footer">View Factories</div>
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
        $('#factorydatatables').DataTable({
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
                    url: '<?php echo base_url('factories/datatable')?>',
                    type:'POST'
                },
                columns: [
                { "data": "factoryName"},
                { "data": "factoryCode"},
                { "data": "region"},
                { "data": "created"}
                <?Php if(($user_role==="SUPER_USER") || ($user_role==="MANAGER") || ($user_role==="ADMIN")){ ?>
                ,
                { "data": "actions","orderable": false,"bSearchable": false }
                <?Php  } ?>
                ],
                "order": [[ 4, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                }
	        });
        
    });

</script> 