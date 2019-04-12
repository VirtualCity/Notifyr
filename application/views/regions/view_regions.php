<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
       <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Regions</li>
    </ol>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <a  href="<?=base_url('regions/add')?>"><div class="btn btn-success btn-fill pull-right">Add Region</div></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="well-content no_search">


                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Region Name</th>
                                <th>Region Code</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <?Php if($user_role==="SUPER_USER"){ ?>
                                    <th class="disabled-sorting">Actions</th>
                                <?Php  } ?>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Region Name</th>
                                <th>Region Code</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <?Php if($user_role==="SUPER_USER"){ ?>
                                    <th class="disabled-sorting">Actions</th>
                                <?Php  } ?>
                            </tr>
                        </tfoot>
                            
                    </table>

                </div>
                </div>
                <div class="panel-footer">View Regions</div>
            </div>
        </div>
    </div>
</div>


  <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
  <script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


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

        $('#datatables').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: [ 'copy', 'csv', 'excel' ],
                "processing": true,
                "serverSide": false,
                "scrollCollapse": true,
                "scrollX": true,
                "scrollY": 400,

	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 50, 100,200,-1], [10, 50, 100,200,"All"]],
	            responsive: true,
	            language: {
	            search: "_INPUT_",
		            searchPlaceholder: "Search records",
                },
                ajax: {
                    url: '<?php echo base_url('regions/datatable')?>'
                },
                columns: [
                    { "data": "name"},
                    { "data": "code"},
                    { "data": "description"},
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
