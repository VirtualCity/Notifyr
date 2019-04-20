<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="green" data-image="<?php echo base_url()?>assets/img/bg.png">   
    <!-- <div class="full-page login-page" data-color="" data-image="../../assets/img/background/background-2.jpg"> -->
          <!-- you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple"    -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <!-- <div class="col-md-8 col-md-offset-2 sms-logo"> -->
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <img style="padding-left: 25%;" src="<?php echo base_url()?>assets/img/notifyr-logo.png" alt="sms-logo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form id="loginform" method="post" action="<?=base_url('login')?>">
                            <div class="card" data-background="color" data-color="blue">
                                <div class="card-header">
                                    <h3 class="card-title">SMS Portal</h3>
                                </div>
                                <div class="card-content">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input required type="text" id="userName" name="userName" value="" placeholder="Enter Username" class="form-control input-no-border">
                                        <div><font color="red"> <?php echo form_error('userName'); ?></font></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input required type="password" id="userPassword" name="userPassword" placeholder="Password" class="form-control input-no-border">
                                        <div> <font color="red"> <?php echo form_error('userPassword'); ?> </font></div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-fill btn-wd ">Login</button>
                                    <div class="forgot">
                                        <a href="#">Forgot your password?</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end #content -->
<link href="<?php echo base_url() ?>assets/css/sweetalert.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/sweetalert.min.js" type="text/javascript"></script>
<!--  Forms Validations Plugin -->
<script src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script>

 
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
			$('#loginform').validate();
        });
</script>