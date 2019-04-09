
<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Change Password</li>
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
     <ul class="nav nav-tabs nav-stacked col-md-2">
        <li class="active"><a href="<?php echo site_url('password') ?>" data-toggle="tab" > Change Password</a></li>
        <?php if ($this->session->userdata('role')!=="USER"): ?>
            <?php if ($this->session->userdata('role')==="SUPER_USER"): ?>
                <li ><a href="<?php echo site_url('settings/configuration') ?>" >SDP Configuration</a></li>
                <li><a href="<?php echo site_url('settings/services') ?>" >Agrimanagr SMS</a></li>
            <?php endif ?>
            <li><a href="<?php echo site_url('users/active') ?>" >Users</a></li>
        <?php endif ?>
        <?php if ($this->session->userdata('role')==="SUPER_USER"): ?>
            <li><a href="<?php echo site_url('settings/logo') ?>" >Logo</a></li>
        <?php endif ?>
    </ul>

    <div class="panel tab-content col-md-10">
        <div class="tab-pane active" id="tab_a">
           <div class="panel">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                </div>
                <h4 class="panel-title">Change Password</h4>
            </div>
            <div class="panel-body">
                <form action="<?=base_url('password')?>" method="post" class="form-horizontal">

                    <div class="col-md-12 col-xs-12">
                        <label > Name </label><span class="text-danger"> *</span>
                        <input type="password" name="password" id="password" class="form-control" value=""/>

                        <span class="text-danger"> <?php echo form_error('password'); ?> </span>
                    </div> 

                    <div class="col-md-12 col-xs-12">
                        <label > New Password </label><span class="text-danger"> *</span>
                        <input type="password" name="npassword" id="npassword"  class="form-control" value=""/>

                        <span class="text-danger"> <?php echo form_error('npassword'); ?> </span>
                    </div> 

                    <div class="col-md-12 col-xs-12">
                        <label > Confirm New Password </label><span class="text-danger"> *</span>
                        <input type="password" name="cnpassword" id="cnpassword"  class="form-control" value=""/>

                        <span class="text-danger"> <?php echo form_error('cnpassword'); ?> </span>
                    </div>  

                    <hr class="field-separator">
                    <div class="col-md-12 col-xs-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>

                    </div>

                </form>
            </div>
        </div>
    </div>
        
   </div><!-- tab content -->
</div>



 

