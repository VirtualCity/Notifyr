<div class="content">

	<div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Change Password</li>
        </ol>
    </div>
	<div class="container-fluid">
		
		<div class="row">
			
			<div class="col-lg-12 col-md-12">
				<div class="card">
					<div class="card-content">
                            <div class="panel">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <form action="<?=base_url('password')?>" method="post" class="form-horizontal">

                                        <div class="row">
                                            <div class="col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12">
                                                        <label > Old Password  </label><span class="text-danger"> *</span>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                        <input type="password" name="password" id="password" class="form-control" value=""/>
                                                        <span class="text-danger"> <?php echo form_error('password'); ?> </span>
                                                    </div>
                                                </div>
                                            </div>  

                                            <div class="col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12">
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12">
                                                        <label > New Password  </label><span class="text-danger"> *</span>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                        <input type="password" name="npassword" id="npassword"  class="form-control" value=""/>
                                                        <span class="text-danger"> <?php echo form_error('npassword'); ?> </span>
                                                    </div>
                                                </div>
                                            </div>  

                                            <div class="col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12">
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12">
                                                        <label > Confirm New Password  </label><span class="text-danger"> *</span>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                        <input type="password" name="cnpassword" id="cnpassword"  class="form-control" value=""/>
                                                        <span class="text-danger"> <?php echo form_error('cnpassword'); ?> </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12">
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="field-separator">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12">
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12">
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- end #content -->
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
    });

</script> 