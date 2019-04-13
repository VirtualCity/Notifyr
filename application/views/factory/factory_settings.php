
<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('factories') ?>"><i class="ti ti-home"></i> Factories</a></li>
            <li class="active">Factory Settings</li>
        </ol>
    </div>




    <div class="row">
       
      <div class="panel tab-content col-md-10">
        <div class="tab-pane active" id="tab_a">
           <div class="panel">
            <div class="panel-heading">
            </div>
            <div class="panel-body">
        <form action="<?=base_url('factories/update_settings')?>" method="post" class="form-horizontal">

              <div class="row">
                <div class="col-md-6 col-xs-12">
                    <label > Application ID  </label><span class="text-danger"> *</span>
                    <input required type="text" name="appid" id="appid" placeholder="Application ID" class="form-control" value="<?php echo $appid ?>"/>

                    <span class="text-danger"> <?php echo form_error('appid'); ?> </span>
                </div>  

                <div class="col-md-6 col-xs-12">
                    <label > Application Password  </label><span class="text-danger"> *</span>
                    <input type="text" name="password" id="password" placeholder="Application Password" class="form-control" value="<?=$password?>"/>

                    <span class="text-danger"> <?php echo form_error('password'); ?> </span>
                </div>
              </div>

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <label > SMS Sender Id  </label><span class="text-danger"> *</span>
                    <input type="text" name="shortcode" id="shortcode" placeholder="Sender id" class="form-control" value="<?=$shortcode?>"/>

                    <span class="text-danger"> <?php echo form_error('shortcode'); ?> </span>
                </div>

                <div class="col-md-6 col-xs-12">
                    <label > SMS Short Code </label><span class="text-danger"> *</span>
                    <input type="text" name="shortcodeNumber" id="shortcodeNumber" placeholder="Short Code" class="form-control" value="<?=$shortcodeNumber?>"/>

                    <span class="text-danger"> <?php echo form_error('shortcodeNumber'); ?> </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <label > SMS Keyword  </label><span class="text-danger"> *</span>
                    <input type="text" name="keyword" id="keyword" placeholder="SMS Keyword" class="form-control" value="<?=$keyword?>"/>

                    <span class="text-danger"> <?php echo form_error('keyword'); ?> </span>
                </div>


                <div class="col-md-6 col-xs-12">
                    <label > Subscription Keyword  </label><span class="text-danger"> *</span>
                    <input type="text" name="subscription" id="subscription" placeholder="Subscription Keyword" class="form-control" value="<?=$subscription?>"/>

                    <span class="text-danger"> <?php echo form_error('subscription'); ?> </span>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <label >Un-subscription Keyword  </label><span class="text-danger"> *</span>
                    <input type="text" name="unsubscription" id="unsubscription" placeholder="Un-subscription Keyword" class="form-control" value="<?=$unsubscription?>"/>

                    <span class="text-danger"> <?php echo form_error('unsubscription'); ?> </span>
                </div>

                <div class="col-md-6 col-xs-12">
                    <label >SMS SDP Server URL  </label><span class="text-danger"> *</span>
                    <input type="text" name="smsurl" id="smsurl" placeholder="SMS SDP Server URL" class="form-control" value="<?=$smsurl?>"/>

                    <span class="text-danger"> <?php echo form_error('smsurl'); ?> </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <label >SMS SDP Balance Server URL  </label><span class="text-danger"> *</span>
                    <input type="text" name="balanceurl" id="balanceurl" placeholder="SMS SDP Balance Server URL" class="form-control" value="<?=$balanceurl?>"/>

                    <span class="text-danger"> <?php echo form_error('balanceurl'); ?> </span>
                </div>


                <div class="col-md-6 col-xs-12">
                    <label > Source Address Name  </label><span class="text-danger"> *</span>
                    <input type="text" name="shortcodeName" id="shortcodeName" placeholder="Sorce address" class="form-control" value="<?=$shortcodeName?>"/>

                    <span class="text-danger"> <?php echo form_error('shortcodeName'); ?> </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <label title="Select whether sms created by clerks need to be approved by manager or not"> SMS Need Approval ?  </label><span class="text-danger"> *</span><br>
                    <!-- <input type="text" name="smsapproval" id="smsapproval" placeholder="Sorce address" class="form-control" value="<?=$smsapproval?>"/> -->
                    <input type="radio" name="smsapproval" <?php if($smsapproval=='1') echo "checked='checked'"; ?> value="1"> Yes
                    <input type="radio" name="smsapproval" <?php if($smsapproval=='0') echo "checked='checked'"; ?> value="0"> No

                    <span class="text-danger"> <?php echo form_error('smsapproval'); ?> </span>
                </div>  
            </div>


            <!-- <div class="col-md-12 col-xs-12">
                <label > Product linked Group  </label><span class="text-danger"> *</span>
                <select name="groups" id="groups" class="form-control" >
                    <option value="">-- Select sms group linked to products---</option>
                    <?php
                   // if(!empty($groups)){
                       // foreach($groups as $row) { ?>
                        <option value="<?//=$row->id?>" <?php// if ($row->id ===$productsgroupid){echo "selected";}?>><?//  =$row->name?></option>
                        <?php //  }
                   // } ?>
                </select>

                <span class="text-danger"> <?php// echo form_error('groups'); ?> </span>
            </div> -->

            <input type="hidden" name="factoryid" id="factoryid" value="<?=$factoryid?>"/>

            <hr class="field-separator">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>

                </div>
            </div>


        </form>
    </div>
</div>
</div>

</div><!-- tab content -->
</div>



