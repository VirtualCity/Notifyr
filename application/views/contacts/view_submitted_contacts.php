<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
         <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Submitted Contacts</li>
     </ol>
 </div>

<div class="row">

    <ul class="nav nav-tabs ">
        <li class=""><a href="<?=base_url('contacts')?>" >Active Contacts</a></li>
        <li class=""><a href="<?=base_url('contacts/suspended')?>" >Suspended Contacts</a></li>
        <li class="active"><a href="#default-tab-1" data-toggle="tab"><h4 class="panel-title">Submitted Contacts</h4></a></li>
        <li class=""><a href="<?=base_url('contacts/blacklistedlist')?>" >Blacklisted Contacts</a></li>
    </ul>

    <div class="panel panel-primary tab-content">
        <div class="tab-pane fade active in" id="default-tab-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                    </div>                
                    <h4>Submitted Contacts</h4>
                </div>

                <div class="panel-body">

                <table id="submittedcontactsdatatables" class="table table-responsive table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th>Mobile Number</th>
                            <th>Contact Name</th>
                            <th>Id Number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Group</th>
                            <th>Factory</th>
                            <th>Date Created</th>
                            <?Php if($user_role==="MANAGER"){ ?>
                                <th class="disabled-sorting">Actions</th>
                            <?Php  } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mobile Number</th>
                            <th>Contact Name</th>
                            <th>Id Number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Group</th>
                            <th>Factory</th>
                            <th>Date Created</th>
                            <?Php if($user_role==="MANAGER"){ ?>
                                <th class="disabled-sorting">Actions</th>
                            <?Php  } ?>
                        </tr>
                    </tfoot>
                        
                </table>

            </div>
            <div class="panel-footer">Submitted Contacts</div>


        </div>
    </div>

</div>

</div>

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
        $('#submittedcontactsdatatables').DataTable({
                "processing": true,
                "serverSide": false,
                "scrollCollapse": false,
                "scrollX": true,
                "scrollY": 350,
                "pageLength": 10,
	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 50, 100,200,-1], [10, 50, 100,200,"All"]],
	            responsive: true,
	            language: {
	            search: "_INPUT_",
		            searchPlaceholder: "Search records",
                },
                ajax: {
                    url: '<?php echo base_url('contacts/submittedContacts')?>',
                    type:'POST'
                },
                columns: [
                    { "data": "msisdn"},
                    { "data": "name"},
                    { "data": "id_number"},
                    { "data": "email"},
                    { "data": "address"},
                    { "data": "groupname"},
                    { "data": "factory"},
                    { "data": "created"}
                <?Php if($user_role==="MANAGER"){ ?>
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




<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#example').dataTable({
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
            { "data": "msisdn"},
            { "data": "name"},
            { "data": "id_number"},
            { "data": "email"},
            { "data": "address"},
            { "data": "region"},
            { "data": "town"},
            { "data": "created"}
            <?Php if($user_role==="MANAGER"){ ?>
                ,
                { "data": "actions","orderable": false,"searchable": false }
                <?Php  } ?>
                ],
                "order": [[ 7, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                },
                "ajax":{
                    "url": "<?php echo base_url('contacts/submittedContacts')?>",
                    "type": "POST"
                }
            });
    });

</script>
