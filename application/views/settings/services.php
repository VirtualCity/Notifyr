
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
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                </div>
                <h4 class="panel-title">SDP Configuration Settings</h4>
            </div>
            <div class="panel-body">
               <form action="<?=base_url('settings/services')?>" method="post" class="form-horizontal">
                        <div class="form_row">
                            <label for="qservice" class="field_name align_right lblBold">Cummulative Service URL </label>
                            <div class="field">
                                <input type="text" name="qservice" id="qservice" placeholder="Service URL" class="span6" value="<?=$qservice?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('qservice'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">


                        <div class="form_row">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" class="btn btn-large dark_green"><i class="icon-plus"></i> Save</button>
                            </div>
                        </div>

                    </form>
            </div>
        </div>
       </div>
        
   </div><!-- tab content -->
</div>

 