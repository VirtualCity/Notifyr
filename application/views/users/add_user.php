<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           
            <li class="active">Add New User</li>
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
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        
                    </div>
                    <h4 class="panel-title">Add New User</h4>
                </div>
                <div class="panel-body">
                    <div class="well-content no_search">

                        <form action="<?=base_url('users/add')?>" method="post" class="form-horizontal">
                            <div class="col-md-6 col-xs-12">
                                <label  > First Name</label><span class="text-danger"> *</span>
                                <input required type="text" name="fname" id="fname" placeholder="First Name" class="form-control" value="<?=$fname?>"/>
                                
                                <span class="text-danger"> <?php echo form_error('fname'); ?> </span>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                                <label  >Surname</label><span class="text-danger"> *</span>
                                <input required type="text" name="sname" id="sname" placeholder="Surname" class="form-control" value="<?=$sname?>"/>
                                
                                <span class="text-danger"> <?php echo form_error('sname'); ?> </span>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                                <label  >Other Names</label><span class="text-danger"> *</span>
                                <input required type="text" name="oname" id="oname" placeholder="Other Names" class="form-control" value="<?=$oname?>"/>
                                
                                <span class="text-danger"> <?php echo form_error('oname'); ?> </span>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                                <label  >Email</label><span class="text-danger"> *</span>
                                <input required type="text" name="email" id="email" placeholder="Other Names" class="form-control" value="<?=$email?>"/>
                                
                                <span class="text-danger"> <?php echo form_error('email'); ?> </span>
                            </div>

                            
                            
                            <div class="col-md-6 col-xs-12">
                                <label  >Mobile No</label><span class="text-danger"> *</span>
                                <input required type="text" name="mobile" id="mobile" placeholder="Mobile No" class="form-control" value="<?=$mobile?>"/>
                                
                                <span class="text-danger"> <?php echo form_error('mobile'); ?> </span>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                                <label  >Username</label><span class="text-danger"> *</span>
                                <input required type="text" name="username" id="username" placeholder="Username" class="form-control" value="<?=$username?>"/>
                                
                                <span class="text-danger"> <?php echo form_error('username'); ?> </span>
                            </div>
                            

                            <div class="col-md-6 col-xs-12">
                                <label  >Password</label><span class="text-danger"> *</span>
                                <input required type="text" name="password" id="password" placeholder="password" class="form-control" value="<?=$password?>"/>
                                
                                <span class="text-danger"> <?php echo form_error('password'); ?> </span>
                            </div>
                            

                            <div class="col-md-6 col-xs-12">
                                <label for="role" >Select Role </label>
                                <span class="text-danger"> *</span>
                                <div class="field">
                                    <select name="role" id="role" class="form-control" >
                                        <option value=""  <?php if ($role ===""){echo "selected";}?>>--- Please Select Role ---</option>
                                        <option value="USER" <?php if ($role ==="USER"){echo "selected";}?>>User</option>
                                        <option value="SUPER_USER" <?php if ($role ==="SUPER_USER"){echo "selected";}?>>Super User</option>
                                        <option value="ADMIN" <?php if ($role ==="ADMIN"){echo "selected";}?>>Administrator</option>
                                    </select> 
                                    <div><span class="text-danger"><?php echo form_error('role'); ?> </span></div>
                                </div>
                            </div>

                            

                            <hr class="field-separator">
                            <div class="col-md-6 col-xs-12">
                                <div >
                                    <button type="submit" class="btn btn-success"><i class=""></i> Save</button>
                                    <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                                </div>
                            </div>
                            

                        </form>
                    </div>
                </div>
                <div class="panel-footer">Add New User</div>
            </div>
        </div>
    </div>
</div>





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

