
<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Agrimanagr SMS Services Settings</li>
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
          <li ><a href="<?php echo site_url('password') ?>" > Change Password</a></li>
          <li ><a  href="<?php echo site_url('settings/configuration') ?>" >SDP Configuration</a></li>
          <li class="active"><a data-toggle="tab" href="<?php echo site_url('settings/services') ?>" >Agrimanagr SMS</a></li>
          <li><a href="<?php echo site_url('users/active') ?>" >Users</a></li>
      </ul>
      <div class="panel panel-primary tab-content col-md-10">
        <div class="tab-pane active" id="tab_a">
         <div class="panel">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                </div>
                <h4 class="panel-title">SDP Configuration Settings</h4>
            </div>
            <div class="panel-body">
             <form action="<?=base_url('settings/services')?>" method="post" class="form-horizontal">

              <div class="col-md-12 col-xs-12">
                <label > Cummulative Service URL  </label><span class="text-danger"> *</span>
                <input type="text" name="qservice" id="qservice" placeholder="Service URL" class="form-control" value="<?=$qservice?>"/>

                <span class="text-danger"> <?php echo form_error('qservice'); ?> </span>
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

