<div class="content">

	<div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Logo Image Upload </li>
        </ol>
    </div>
	<div class="container-fluid">
		
		<div class="row">
			
			<div class="col-lg-12 col-md-12">
				<div class="card">
					<div class="card-content">
						<div class="nav-tabs-navigation">
							<div class="nav-tabs-wrapper">
								<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
									<li class=""><a href="<?php echo site_url('settings/configuration') ?>">SDP Configuration</a></li>
									<li class=""><a href="<?php echo site_url('settings/services') ?>">Agrimanagr SMS</a></li>
									<li class="active"><a href="<?php echo site_url('settings/logo') ?>">Logo</a></li>
								</ul>
							</div>
						</div>
						<div id="my-tab-content" class="tab-content text-center">
							<div class="tab-pane active" id="home">
								<p>
									<div class="panel">
										<div class="panel-heading">
										</div>
										<div class="panel-body">
                                            <?php echo form_open_multipart('settings/logo/doUpload');?>
                                            <?php echo "<label > File to Upload (png not more than 2MB, recommended dimension 230 x 55)  </label><span class='text-danger'> *</span>";?>
                                            <?php echo "<input class='form-control' type='file' required name='logo' size='20' />"; ?>
                                            <br>
                                            <?php echo "<input class='btn btn-primary' type='submit' name='submit' value='upload' /> ";?>
                                            <?php echo "</form>"?> 
										</div>
									</div>
								</p>
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