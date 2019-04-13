

<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Blacklisted Contacts</li>
        </ol>
    </div>

    <div class="row">

        <ul class="nav nav-tabs ">
            <li class=""><a href="<?=base_url('contacts')?>" >Active Contacts</a></li>
            <li class=""><a href="<?=base_url('contacts/suspended')?>" data-toggle="tab"><h4 class="panel-title">Suspended Contacts</h4></a></li>
            <li class=""><a href="<?=base_url('contacts/submitted')?>" >Sumitted Contacts</a></li>
            <li class="active"><a href="#default-tab-1" >Blacklisted Contacts</a></li>
            
        </ul>

        <div class="panel panel-primary tab-content">
            <div class="tab-pane fade active in" id="default-tab-1">
                <div class="panel panel-default">

                    <div class="panel-body">

                    <table id="blacklistdatatables" class="table table-responsive table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Mobile Number</th>
                                <th>Date Blacklisted</th>
                                <?Php if($user_role==="MANAGER" || $user_role==="ADMIN" || $user_role==="SUPER_USER"){ ?>
                                <th class="disabled-sorting">Actions</th>
                                <?Php  } ?>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Mobile Number</th>
                                <th>Date Blacklisted</th>
                                <?Php if($user_role==="MANAGER" || $user_role==="ADMIN" || $user_role==="SUPER_USER"){ ?>
                                <th class="disabled-sorting">Actions</th>
                                <?Php  } ?>
                            </tr>
                        </tfoot>
                            
                    </table>

                    </div>
                    <div class="panel-footer">Blacklisted Numbers</div>
                </div>
            </div>
        </div>
    </div>
<!-- end #content -->
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
        $('#blacklistdatatables').DataTable({
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
                    url: '<?=base_url('contacts/blacklisted')?>',
                    type:'POST'
                },
                columns: [
                    { "data": "msisdn"},
                    { "data": "created"}
                <?Php if($user_role==="SUPER_USER"){ ?>
                ,
                { "data": "actions","orderable": false,"bSearchable": false }
                <?Php  } ?>
                ],
                "order": [[ 1, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                }
	        });
        
    });

    
</script> 


    
