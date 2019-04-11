<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
       <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       <li><a href="<?php echo site_url('regions') ?>"><i class="ti-layout-column3"></i> Regions</a></li>
          
        <li class="active">Add Region</li>
    </ol>
    </div>
    <div id="alert_placeholder">
        <?php
        $appmsg = $this->session->flashdata('appmsg');
        if(!empty($appmsg)){ ?>
        <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
        <?php } ?>
    </div>

   
 

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                     <div class="well-content no_search">

                    <form action="<?php echo base_url('regions/add');?>" method="post" class="form-horizontal">

                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <label for="region" class="field_name align_right lblBold"> Region Name</label><span class="text-danger"> *</span>
                                <div >
                                    <input required type="text" name="region" id="region" placeholder="Region Name" class="form-control" value="<?=$region?>"/>
                                    
                                    <span class="text-danger"> <?php echo form_error('region'); ?> </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label for="code" class="field_name align_right lblBold"> Region Code</label><span class="text-danger"> *</span>
                                <div >
                                    <input required type="text" name="code" id="code" placeholder="Region Code" class="form-control" value="<?=$region?>"/>
                                    
                                    <span class="text-danger"> <?php echo form_error('code'); ?> </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <label for="description" class="field_name align_right lblBold">Description</label><span class="text-danger"> </span>
                                <div class="field">
                                    <textarea  id="description" name="description" placeholder="Description" class="form-control" rows="4" value=""></textarea>
                                    <span class="text-danger"> <?php echo form_error('description'); ?> </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-md-6 col-xs-12">
                                <div >
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                    <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                </div>
                <div class="panel-footer">Add a Region</div>
            </div>
        </div>
    </div>
</div>


    <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/css/sweetalert.min.css" type="text/javascript"></script>

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
                        type: "success",
                        showConfirmButton: false,
                        type: "<?php echo $this->session->flashdata('alert_type_') ?>"
                    });
        <?php endif; ?>
		
		
		

         });
</script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
