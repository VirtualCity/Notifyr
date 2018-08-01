
<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">SDP Configuration Settings</li>
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
          <?php if ($this->session->userdata('role')!="USER"): ?>
              <?php if ($this->session->userdata('role')==="ADMIN"): ?>
                  <li class="active"><a data-toggle="tab" href="<?php echo site_url('settings/configuration') ?>" >SDP Configuration</a></li>
                  <li><a href="<?php echo site_url('settings/services') ?>" >Agrimanagr SMS</a></li>
              <?php endif ?>
              <li><a href="<?php echo site_url('users/active') ?>" >Users</a></li>
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
                <h4 class="panel-title">SDP Configuration Settings</h4>
            </div>
            <div class="panel-body">
             <form action="<?=base_url('settings/configuration')?>" method="post" class="form-horizontal">

              <div class="col-md-12 col-xs-12">
                <label > Application ID  </label><span class="text-danger"> *</span>
                <input required type="text" name="appid" id="appid" placeholder="Application ID" class="form-control" value="<?php echo $appid ?>"/>

                <span class="text-danger"> <?php echo form_error('appid'); ?> </span>
            </div>  

            <div class="col-md-12 col-xs-12">
                <label > Application Password  </label><span class="text-danger"> *</span>
                <input type="text" name="password" id="password" placeholder="Application Password" class="form-control" value="<?=$password?>"/>

                <span class="text-danger"> <?php echo form_error('password'); ?> </span>
            </div>

            <div class="col-md-12 col-xs-12">
                <label > SMS Short Code  </label><span class="text-danger"> *</span>
                <input type="text" name="shortcode" id="shortcode" placeholder="SMS Short Code" class="form-control" value="<?=$shortcode?>"/>

                <span class="text-danger"> <?php echo form_error('shortcode'); ?> </span>
            </div>

            <div class="col-md-12 col-xs-12">
                <label > SMS Keyword  </label><span class="text-danger"> *</span>
                <input type="text" name="keyword" id="keyword" placeholder="SMS Keyword" class="form-control" value="<?=$keyword?>"/>

                <span class="text-danger"> <?php echo form_error('keyword'); ?> </span>
            </div>


            <div class="col-md-12 col-xs-12">
                <label > Subscription Keyword  </label><span class="text-danger"> *</span>
                <input type="text" name="subscription" id="subscription" placeholder="Subscription Keyword" class="form-control" value="<?=$subscription?>"/>

                <span class="text-danger"> <?php echo form_error('subscription'); ?> </span>
            </div>


            <div class="col-md-12 col-xs-12">
                <label >Un-subscription Keyword  </label><span class="text-danger"> *</span>
                <input type="text" name="unsubscription" id="unsubscription" placeholder="Un-subscription Keyword" class="form-control" value="<?=$unsubscription?>"/>

                <span class="text-danger"> <?php echo form_error('unsubscription'); ?> </span>
            </div>

            <div class="col-md-12 col-xs-12">
                <label >SMS SDP Server URL  </label><span class="text-danger"> *</span>
                <input type="text" name="smsurl" id="smsurl" placeholder="SMS SDP Server URL" class="form-control" value="<?=$smsurl?>"/>

                <span class="text-danger"> <?php echo form_error('smsurl'); ?> </span>
            </div>


            <div class="col-md-12 col-xs-12">
                <label > Source Address Name  </label><span class="text-danger"> *</span>
                <input type="text" name="shortcodeName" id="shortcodeName" placeholder="Sorce address" class="form-control" value="<?=$shortcodeName?>"/>

                <span class="text-danger"> <?php echo form_error('shortcodeName'); ?> </span>
            </div>     


            <div class="col-md-12 col-xs-12">
                <label > Product linked Group  </label><span class="text-danger"> *</span>
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



