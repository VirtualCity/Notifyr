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
									<li class="active"><a href="<?php echo site_url('settings/configuration') ?>">SDP Configuration</a></li>
									<li><a href="<?php echo site_url('settings/services') ?>">Agrimanagr SMS</a></li>
									<?php if ($user_role === 'SUPER_USER') { ?>
										<li><a href="<?php echo site_url('settings/logo') ?>">Logo</a></li>
									<?php } ?>
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
											<form id="settingsform" action="<?=base_url('settings/configuration')?>" method="post" class="form-horizontal">

												<div class="row">
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label > Application ID  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input required type="text" name="appid" id="appid" placeholder="Application ID" class="form-control" value="<?php echo $appid ?>"/>
																<span class="text-danger"> <?php echo form_error('appid'); ?> </span>
															</div>
														</div>
													</div>  

													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label > Application Password  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="password" id="password" placeholder="Application Password" class="form-control" value="<?=$password?>"/>
																<span class="text-danger"> <?php echo form_error('password'); ?> </span>
															</div>
														</div>
													</div>
												</div>
												
												<br>

												<div class="row">
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label > SMS Sender Id  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="shortcode" id="shortcode" placeholder="Sender id" class="form-control" value="<?=$shortcode?>"/>
																<span class="text-danger"> <?php echo form_error('shortcode'); ?> </span>
															</div>
														</div>
													</div>

													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label > SMS Short Code </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="shortcodeNumber" id="shortcodeNumber" placeholder="Short Code" class="form-control" value="<?=$shortcodeNumber?>"/>
																<span class="text-danger"> <?php echo form_error('shortcodeNumber'); ?> </span>
															</div>
														</div>
													</div>
												</div>

												<br>

												<div class="row">
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label > SMS Keyword  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="keyword" id="keyword" placeholder="SMS Keyword" class="form-control" value="<?=$keyword?>"/>
																<span class="text-danger"> <?php echo form_error('keyword'); ?> </span>
															</div>
														</div>
													</div>

													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label > Subscription Keyword  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="subscription" id="subscription" placeholder="Subscription Keyword" class="form-control" value="<?=$subscription?>"/>
																<span class="text-danger"> <?php echo form_error('subscription'); ?> </span>
															</div>
														</div>
													</div>
												</div>

												<br>

												<div class="row">
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label >Un-subscription Keyword  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="unsubscription" id="unsubscription" placeholder="Un-subscription Keyword" class="form-control" value="<?=$unsubscription?>"/>
																<span class="text-danger"> <?php echo form_error('unsubscription'); ?> </span>
															</div>
														</div>

														
														
													</div>

													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label >SMS SDP Server URL  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="smsurl" id="smsurl" placeholder="SMS SDP Server URL" class="form-control" value="<?=$smsurl?>"/>
																<span class="text-danger"> <?php echo form_error('smsurl'); ?> </span>
															</div>
														</div>
													</div>
												</div>

												<br>

												<div class="row">
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label >SMS SDP Balance Server URL  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="balanceurl" id="balanceurl" placeholder="SMS SDP Balance Server URL" class="form-control" value="<?=$balanceurl?>"/>
																<span class="text-danger"> <?php echo form_error('balanceurl'); ?> </span>
															</div>
														</div>
													</div>

													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label > Source Address Name  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="shortcodeName" id="shortcodeName" placeholder="Sorce address" class="form-control" value="<?=$shortcodeName?>"/>
																<span class="text-danger"> <?php echo form_error('shortcodeName'); ?> </span>
															</div>
														</div>
													</div>
												</div>

												<br>

												<div class="row">
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label title="Select whether sms created by clerks need to be approved by manager or not"> SMS Need Approval ?  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="radio" name="smsapproval" <?php if($smsapproval=='1') echo "checked='checked'"; ?> value="1"> Yes
																<input type="radio" name="smsapproval" <?php if($smsapproval=='0') echo "checked='checked'"; ?> value="0"> No
																<span class="text-danger"> <?php echo form_error('smsapproval'); ?> </span>
															</div>
														</div>
													</div>  

													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label > Product linked Group  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<select name="groups" id="groups" class="form-control" >
																	<option value="">-- Select sms group linked to products---</option>
																	<?php
																	if(!empty($groups)){
																		foreach($groups as $row) { ?>
																		<option value="<?=$row->id?>" <?php if ($row->id ===$productsgroupid){echo "selected";}?>><?=$row->name?></option>
																		<?php   }
																	} ?>
																</select>
																<span class="text-danger"> <?php echo form_error('groups'); ?> </span>
															</div>
														</div>

														
														
													</div>
												</div>

												<br>

												<div class="row">
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label > Factory  </label><span class="text-danger"></span>
															</div>
															<div class="col-md-6 col-xs-12">
																<select name="factorye" id="factorye" class="form-control" >
																	<option value="">-- Select Factory --</option>
																	<?php
																	if(!empty($factories)){
																		foreach($factories as $row) { ?>
																		<option value="<?=$row->id?>" <?php if ($row->id ===$factoryid){echo "selected";}?>><?=$row->name?></option><!---->
																		<?php   }
																	} ?>
																</select>
																<span class="text-danger"> <?php echo form_error('factorye'); ?> </span>
															</div>
														</div>
													</div>
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label > Country Telco Code  </label><span class="text-danger">*</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" required name="countrycode" id="countrycode" placeholder="Country Telco Code" class="form-control" value="<?=$countrycode?>"/>
																<span class="text-danger"> <?php echo form_error('countrycode'); ?> </span>
															</div>
														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label >Remote Database Dsn  </label>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="remoteDbDsn" id="remoteDbDsn" placeholder="e.g sqlsrv:Server=10.0.0.118;Database=devhub" class="form-control" value="<?=$remoteDbDsn?>"/>
																<span class="text-danger"> <?php echo form_error('remoteDbDsn'); ?> </span>
															</div>
														</div>

														
														
													</div>

													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label >Remote Database Username</label>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="remoteDbUser" id="remoteDbUser" placeholder="Remote Database Username" class="form-control" value="<?=$remoteDbUser?>"/>
																<span class="text-danger"> <?php echo form_error('remoteDbUser'); ?> </span>
															</div>
														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-6 col-xs-12">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label >Remote Database Password  </label>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="password" name="remoteDbPass" id="remoteDbPass" placeholder="Remote Database Password" class="form-control" value="<?=$remoteDbPass?>"/>
																<span class="text-danger"> <?php echo form_error('remoteDbPass'); ?> </span>
															</div>
														</div>

														
														
													</div>

													<div class="col-md-6 col-xs-12">
														<div class="row">
															<!-- <div class="col-md-6 col-xs-12">
																<label >SMS SDP Server URL  </label><span class="text-danger"> *</span>
															</div>
															<div class="col-md-6 col-xs-12">
																<input type="text" name="smsurl" id="smsurl" placeholder="SMS SDP Server URL" class="form-control" value="<?=$smsurl?>"/>
																<span class="text-danger"> <?php //echo form_error('smsurl'); ?> </span>
															</div> -->
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
								</p>
							</div>
							<!-- <div class="tab-pane" id="profile">
								<p>Here is your profile.</p>
							</div>
							<div class="tab-pane" id="messages">
								<p>Here are your messages.</p>
							</div> -->
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
<!-- settingsform -->
<script type="text/javascript">
        $().ready(function(){
			$('#settingsform').validate();
        });
</script>