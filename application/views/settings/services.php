<div class="content">

	<div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">SDP Configuration Settings </li>
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
									<li class="active"><a href="<?php echo site_url('settings/services') ?>">Agrimanagr SMS</a></li>
									<li class=""><a href="<?php echo site_url('settings/logo') ?>">Logo</a></li>
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
											<form action="<?=base_url('settings/services')?>" method="post" class="form-horizontal">

												<div class="row">
													<div class="col-md-6 col-xs-12">
															<div class="col-md-6 col-xs-12">
																<label > Cumulative Service URL  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
                                                                <input type="text" name="qservice" id="qservice" placeholder="Service URL" class="form-control" value="<?=$qservice?>"/>
                                                                <span class="text-danger"> <?php echo form_error('qservice'); ?> </span>
															</div>
													</div>  
												</div>
												

												<hr class="field-separator">
												<div class="row">
													<div class="col-md-6 col-xs-12">
															<div class="col-md-6 col-xs-12">
															</div>
															<div class="col-md-6 col-xs-12">
															<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
															</div>
													</div>
												</div>

											</form>
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