<body >
<!--Header Section-->
<?Php $this->load->view('templates/app_header');?>

<!--Navigation Section-->
<?Php
if( $user_role === 'ADMIN'){
    $this->load->view('templates/navigation');
}else if($user_role === 'SUPER_USER'){
    $this->load->view('templates/navigation_super_user');
}else if($user_role === 'USER'){
    $this->load->view('templates/navigation_user');
}else if($user_role === 'MANAGER'){
    $this->load->view('templates/navigation_manager');
}else{
    $this->load->view('templates/navigation_consumer');
}
?>

<div id="content" class="no-sidebar"> <!-- Content start -->
    <div class="top_bar">
        <ul class="breadcrumb">
            <li><a href="<?=base_url("dashboard")?>"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
            <li class="active"><a>Add New User</a></li>
        </ul>
    </div>
    <div class="inner_content">

        <div class="widgets_area">


            <div class="well blue">
                <div class="well-header">
                    <h5>Add New User</h5>
                </div>
                <div class="well-content no_search">

                    <form action="<?=base_url('adduser')?>" method="post" class="form-horizontal">

                        <div class="form_row">
                            <label for="fname" class="field_name align_right lblBold">First Name </label>
                            <div class="field">
                                <input type="text" name="fname" id="fname" placeholder="First Name" class="span6" value="<?=$fname?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('fname'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="sname" class="field_name align_right lblBold">Surname </label>
                            <div class="field">
                                <input type="text" name="sname" id="sname" placeholder="Surname" class="span6" value="<?=$sname?>""/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('sname'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="oname" class="field_name align_right lblBold">Other Names </label>
                            <div class="field">
                                <input type="text" name="oname" id="oname" placeholder="Other Names" class="span6" value="<?=$oname?>""/>
                                <div><font color="red"> <?php echo form_error('oname'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="email" class="field_name align_right lblBold">Email </label>
                            <div class="field">
                                <input type="text" name="email" id="email" placeholder="Email Address" class="span6" value="<?=$email?>""/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('email'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="mobile" class="field_name align_right lblBold">Mobile No </label>
                            <div class="field">
                                <input type="text" name="mobile" id="mobile" placeholder="254" class="span6" value="<?=$mobile?>""/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('mobile'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">



                        <div class="form_row">
                            <label for="username" class="field_name align_right lblBold">Username</label>
                            <div class="field">
                                <input type="text" name="username" id="username" placeholder="Username" class="span6" value="<?=$username?>""/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('username'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="user_role" class="field_name align_right lblBold">Select Role </label>
                            <div class="field">
                                <select name="user_role" id="user_role" class="span6" rows="4" >
                                    <option value="">--- Please Select Role ---</option>
                                    <option value="USER" <?php if ($user_role ==="USER"){echo "selected";}?>>User</option>
                                    <option value="STOCKIST" <?php if ($user_role ==="STOCKIST"){echo "selected";}?>>Stockist</option>
                                    <option value="SUPER_USER" <?php if ($user_role ==="MANAGER"){echo "selected";}?>>Manager</option>
                                    <option value="ADMIN" <?php if ($user_role ==="ADMIN"){echo "selected";}?>>Administrator</option>
                                </select> <font color="red"> *</font>
                                <div><font color="red"><?php echo form_error('user_role'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="password" class="field_name align_right lblBold">Password</label>
                            <div class="field">
                                <input type="password" name="password" id="password" placeholder="Password" class="span6" value="<?=$password?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"><?php echo form_error('password'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" class="btn btn-large dark_green"><i class="icon-plus"></i> Add User</button>
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

<script src="<?php echo($base); ?>assets/js/jquery-1.11.1.js"></script>
<script src="<?php echo($base); ?>assets/js/jquery-ui-1.10.3.js"></script>
<script src="<?php echo($base); ?>assets/js/bootstrap.js"></script>

<script src="<?php echo($base); ?>assets/js/library/jquery.collapsible.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.mCustomScrollbar.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.mousewheel.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.uniform.min.js"></script>

<script src="<?php echo($base); ?>assets/js/library/jquery.autosize-min.js"></script>

<script src="<?php echo($base); ?>assets/js/design_core.js"></script>

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