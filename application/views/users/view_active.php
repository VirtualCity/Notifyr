<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
           <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           <li class="active">Active Users</li>
       </ol>
   </div>

<div class="row">

    
    <div class="row">
        <div class="col-md-8 pull-left">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#default-tab-1" data-toggle="tab"><h4 class="panel-title">Active Users</h4></a></li>
                <li class=""><a href="<?=base_url('users/suspended')?>" >Suspended Users</a></li>
            </ul>
        </div>
    </div>

    <div class="panel panel-primary tab-content">
        <div class="tab-pane fade active in" id="default-tab-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="activeusersdatatables" class="table table-responsive table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <div class="row">
                        <div class="col-md-12">
                            <a  href="<?=base_url('users/add')?>"><div class="btn btn-success btn-fill pull-right">Add User</div></a>
                        </div>
                    </div>
                    <br>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Mobile No</th>
                                <th>Email</th>
                                <th>Factory</th>
                                <th>Role</th>
                                <th>Date Created</th>
                                <?Php if($user_role==="SUPER_USER" || $user_role==="MANAGER" || $user_role==="ADMIN"){ ?>
                                    <th class="disabled-sorting">Actions</th>
                                <?Php  } ?>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Mobile No</th>
                                <th>Email</th>
                                <th>Factory</th>
                                <th>Role</th>
                                <th>Date Created</th>
                                <?Php if($user_role==="SUPER_USER" || $user_role==="MANAGER" || $user_role==="ADMIN"){ ?>
                                    <th class="disabled-sorting">Actions</th>
                                <?Php  } ?>
                            </tr>
                        </tfoot>
                            
                    </table>
                </div>
                <div class="panel-footer">Active Users</div>
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
        $('#activeusersdatatables').DataTable({
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
                    url: '<?php echo base_url('users/active/datatable')?>',
                    type:'POST'
                },
                columns: [
                    { "data": "username" },
                    { "data": "name"},
                    { "data": "mobile" },
                    { "data": "email" },
                    { "data": "factory"},
                    { "data": "role"},
                    { "data": "created"}
                <?Php if($user_role==="SUPER_USER" || $user_role==="MANAGER" || $user_role==="ADMIN"){ ?>
                ,
                { "data": "actions","orderable": false,"bSearchable": false }
                <?Php  } ?>
                ],
                "order": [[ 7, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                }
	        });
        
    });

    
</script> 


