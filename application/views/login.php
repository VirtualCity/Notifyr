<body class="login" style="background:url(<?php echo($base); ?>assets/img/bg.png) repeat;">
<!-- Main -->

    <!-- Page Content -->

        <div class="container">
            <div id="alert_placeholder">
                <?php
                $appmsg = $this->session->flashdata('appmsg');
                if(!empty($appmsg)){ ?>
                    <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
                <?php } ?>
            </div>
            <div class="row login">
                <!--<div class="col-md-">-->
                    <div class="logo">
                        <img alt="Logo" src="<?php echo($base); ?>assets/img/notifyr-logo.png" class="login-logo" >

                    </div>
                    <div class="logo-text">SMS Portal</div>
                    <div class="box">
                        <div class="top-line"></div>
                        <div class="login-content">

                            <form name="userForm" method="post" action="<?=base_url('login')?>"  class="form-horizontal">
                                <h3 class="form-title">Sign In to your Account</h3>
                                <div class="login-field">
                                    <label for="username">Username </label>
                                    <input type="text" name="userName" id="userName" value="" placeholder="Username">
                                    <i class="icon-user"></i>
                                    <div><font color="red"> <?php echo form_error('userName'); ?></font></div>

                                </div>
                                <div class="login-field">
                                    <label for="password">Password</label>
                                    <input type="password" name="userPassword" id="userPassword" value="" placeholder="Password">
                                    <i class="icon-lock"></i>
                                    <div> <font color="red"> <?php echo form_error('userPassword'); ?> </font></div>

                                </div>
                                <div class="login-button">
                                    <button type="submit" class="btn btn-large btn-block blue" name="login">SIGN IN <i class="icon-arrow-right"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>
               <!-- </div>-->
            </div>
        </div>
    <!-- Page Content / End -->
<!-- Main / End -->






<!-- Javascript Files
================================================== -->
<script src="<?php echo($base); ?>assets/js/jquery-1.11.1.js"></script>
<script src="<?php echo($base); ?>assets/js/jquery-ui-1.10.3.js"></script>
<script src="<?php echo($base); ?>assets/js/bootstrap.js"></script>
<script type="text/javascript">
    /*document.ready(function(){
     var m =document.getElementById('message').value;

     if(m.length>0){
     alert(m);
     // showalert2(m,"alert-warning");
     }

     });*/
   /* jQuery(document).ready(function() {
        var m =$('#message').val();
        if(m.length>0){
            showalert2(m,"alert-info");
        }
    });*/

    function showalert(message,alerttype){
        $('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
        setTimeout(function() {
            $('#alertdiv').remove();
        },6000);
    }

    function showMessage(message){
        if(message.length>0){
            showalert2(message,"alert-warning");
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
