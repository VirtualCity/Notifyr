<body >
<!--Header Section-->
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
            <li><a href="<?php echo base_url("dashboard");?>"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url("contacts");?>">Contacts</a><span class="divider">/</span></li>
            <li class="active"><a>Add Contact</a></li>
        </ul>
    </div>


        <div class="widgets_area">


            <div class="well blue">
                <div class="well-header">
                    <h5>Add Contact</h5>
                </div>
                <div class="well-content no_search">

                    <form id="addcontactform" action="<?php echo base_url('contacts/add');?>" method="post" class="form-horizontal">

                        <div class="form_row">
                            <label for="msisdn" class="field_name align_right lblBold">Mobile Number </label>
                            <div class="field">
                                <input type="text" name="msisdn" id="msisdn"  placeholder="" class="span6" value="<?php if($msisdn!=""){echo $msisdn;}else{echo "254";}?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('msisdn'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="name" class="field_name align_right lblBold">Name </label>
                            <div class="field">
                                <input type="text" name="name" id="name" class="span6" value="<?=$name?>"/>
                                <div><font color="red"> <?php echo form_error('name'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="email" class="field_name align_right lblBold">Email</label>
                            <div class="field">
                                <input type="text" name="email" id="email" class="span6" value="<?=$email?>"/>
                                <div><font color="red"> <?php echo form_error('email'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label for="address" class="field_name align_right lblBold">Address</label>
                            <div class="field">
                                <input type="text" name="address" id="address"  class="span6" value="<?=$address?>"/>
                                <div><font color="red"> <?php echo form_error('address'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" class="btn btn-large blue"><i class="icon-plus"></i> Add</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


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
<script type="text/javascript">
        $().ready(function(){
			$('#addcontactform').validate();
        });
</script>


</body>
</html>