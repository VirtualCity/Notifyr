<body >
<!--Header Section-->
<?Php include "templates/app_header.php" ?>

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
            <li class="active"><a>Change Password</a></li>
        </ul>
    </div>
    <div id="alert_placeholder">
        <?php
        $appmsg = $this->session->flashdata('appmsg');
        if(!empty($appmsg)){ ?>
            <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
        <?php } ?>
    </div>
    <div class="inner_content">

        <div class="widgets_area">


            <div class="well blue">
                <div class="well-header">
                    <h5>Change Password</h5>
                </div>
                <div class="well-content no_search">

                    <form action="<?=base_url('password')?>" method="post" class="form-horizontal">

                        <div class="form_row">
                            <label for="password" class="field_name align_right lblBold">Current Password </label>
                            <div class="field">
                                <input type="password" name="password" id="password" class="span6" value=""/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('password'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="group" class="field_name align_right lblBold">New Password </label>
                            <div class="field">
                                <input type="password" name="npassword" id="npassword"  class="span6" value=""/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('npassword'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="cnpassword" class="field_name align_right lblBold">Confirm New Password</label>
                            <div class="field">
                                <input type="password" name="cnpassword" id="cnpassword"  class="span6" value=""/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('cnpassword'); ?> </font></div>
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

<script src="<?php base_url() ?>assets/js/jquery-1.11.1.js"></script>
<script src="<?php base_url() ?>assets/js/jquery-ui-1.10.3.js"></script>
<script src="<?php base_url() ?>assets/js/bootstrap.js"></script>

<script src="<?php base_url() ?>assets/js/library/jquery.collapsible.min.js"></script>
<script src="<?php base_url() ?>assets/js/library/jquery.mCustomScrollbar.min.js"></script>
<script src="<?php base_url() ?>assets/js/library/jquery.mousewheel.min.js"></script>
<script src="<?php base_url() ?>assets/js/library/jquery.uniform.min.js"></script>

<script src="<?php base_url() ?>assets/js/library/jquery.autosize-min.js"></script>

<script src="<?php base_url() ?>assets/js/design_core.js"></script>

<script>



    function showalert(message,alerttype){
        $('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
        setTimeout(function() {
            $('#alertdiv').remove();
        },6000);
    }

    function showMessage(message){
        if(message.length>0){
            showalert2(message,"alert-info");
        }
    }

    function showalert2(message,alerttype){
        $('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
        setTimeout(function() {
            $('#alertdiv').remove();
        },3000);


    }

</script>

</body>
</html>