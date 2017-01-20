<body >
<!--Header Section-->
<?Php $this->load->view('templates/app_header');?>

<!--Navigation Section-->
<?Php
if( $user_role === 'ADMIN'){
    $this->load->view('templates/navigation');
}else if($user_role === 'SUPER_USER'){
    $this->load->view('templates/navigation_super_user');
}else{
    $this->load->view('templates/navigation_user');
}
?>

<div id="content" class="no-sidebar"> <!-- Content start -->
    <div class="top_bar">
        <ul class="breadcrumb">
            <li><a href="<?=base_url("dashboard")?>"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
            <li><a >Settings</a><span class="divider">/</span></li>
            <li class="active"><a>SDP Configuration</a></li>
        </ul>
    </div>
    <div class="inner_content">
        <div id="alert_placeholder">
            <?php
            $appmsg = $this->session->flashdata('appmsg');
            if(!empty($appmsg)){ ?>
                <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
            <?php } ?>
        </div>
        <div class="widgets_area">


            <div class="well blue">
                <div class="well-header">
                    <h5>SDP Configuration Settings</h5>
                </div>
                <div class="well-content no_search">

                    <form action="<?=base_url('settings/configuration')?>" method="post" class="form-horizontal">
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
    </div>
</div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?php echo base_url('assets/js/jquery-1.11.1.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/library/jquery.collapsible.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/library/jquery.mCustomScrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/library/jquery.mousewheel.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/library/jquery.uniform.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/library/jquery.autosize-min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/design_core.js'); ?>"></script>


</body>
</html>