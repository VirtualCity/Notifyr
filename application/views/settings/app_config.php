
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
          <li class="active"><a data-toggle="tab" href="<?php echo site_url('settings/configuration') ?>" >SDP Configuration</a></li>
          <li><a href="<?php echo site_url('settings/services') ?>" >Agrimanagr SMS</a></li>
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
                 <form action="<?=base_url('settings/configuration')?>" method="post" class="form-horizontal">

                      <div class="col-md-12 col-xs-12">
                            <label > Name </label><span class="text-danger"> *</span>
                            <input required type="text" name="name" id="name" placeholder="Supervisor Name" class="form-control" value="<?php echo $name ?>"/>

                            <span class="text-danger"> <?php echo form_error('name'); ?> </span>
                        </div>
                        
                        <div class="form_row">
                            <label for="appid" class="field_name align_right lblBold">Application ID </label>
                            <div class="field">
                                <input type="text" name="appid" id="appid" placeholder="APP_ID" class="span6" value="<?=$appid?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('appid'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label for="password" class="field_name align_right lblBold">Application Password </label>
                            <div class="field">
                                <input type="text" name="password" id="password" placeholder="Application Password" class="span6" value="<?=$password?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('password'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label for="shortcode" class="field_name align_right lblBold">SMS Short Code </label>
                            <div class="field">
                                <input type="text" name="shortcode" id="shortcode" placeholder="E.g 20358" class="span6" value="<?=$shortcode?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('shortcode'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label for="keyword" class="field_name align_right lblBold">SMS Keyword </label>
                            <div class="field">
                                <input type="text" name="keyword" id="keyword" placeholder="Keyword" class="span6" value="<?=$keyword?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('keyword'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label for="subscription" class="field_name align_right lblBold">Subscription Keyword </label>
                            <div class="field">
                                <input type="text" name="subscription" id="subscription" placeholder="Subscription Keyword" class="span6" value="<?=$subscription?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('subscription'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label for="unsubscription" class="field_name align_right lblBold">Un-subscription Keyword</label>
                            <div class="field">
                                <input type="text" name="unsubscription" id="unsubscription" placeholder="Un-subscription Keyword" class="span6" value="<?=$unsubscription?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('unsubscription'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label for="smsurl" class="field_name align_right lblBold">SMS SDP Server URL </label>
                            <div class="field">
                                <input type="text" name="smsurl" id="smsurl" placeholder="E.g http://40.113.123.6:7000/sms/send" class="span6" value="<?=$smsurl?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('smsurl'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label for="groups" class="field_name align_right lblBold">Product linked Group</label>
                            <div class="field">
                                <select name="groups" id="groups" class="span6" >
                                    <option value="">-- Select sms group linked to products---</option>
                                    <?php
                                    if(!empty($groups)){
                                        foreach($groups as $row) { ?>
                                            <option value="<?=$row->id?>" <?php if ($row->id ===$productsgroupid){echo "selected";}?>><?=$row->name?></option>
                                        <?php   }
                                    } ?>
                                </select> <font color="red"> *</font>
                                <div><font color="red"><?php echo form_error('groups'); ?></font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" class="btn btn-large dark_green"><i class="icon-save"></i> Save</button>
                            </div>
                        </div>

                    </form>
            </div>
        </div>
       </div>
        
   </div><!-- tab content -->
</div>



  