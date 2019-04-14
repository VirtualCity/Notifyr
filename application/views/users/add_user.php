<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('users/active') ?>"><i class="ti-user"></i> Users</a></li>
            <li class="active">Add User</li>
        </ol>
    </div>
    

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                 <form id="adduserform" action="<?php echo base_url('users/add');?>" method="post" class="form-horizontal">

                 <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label  > First Name</label><span class="text-danger"> *</span>
                        <input required="true" type="text" name="fname" id="fname" placeholder="First Name" class="form-control" value="<?=$fname?>"/>
                        <span class="text-danger"> <?php echo form_error('fname'); ?> </span>
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <label  >Surname</label><span class="text-danger"> *</span>
                        <input required type="text" name="sname" id="sname" placeholder="Surname" class="form-control" value="<?=$sname?>"/>
                        <span class="text-danger"> <?php echo form_error('sname'); ?> </span>
                    </div>
                 </div>

                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label  >Other Names</label><span class="text-danger"> *</span>
                        <input required type="text" name="oname" id="oname" placeholder="Other Names" class="form-control" value="<?=$oname?>"/>
                        <span class="text-danger"> <?php echo form_error('oname'); ?> </span>
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <label  >Email</label><span class="text-danger"> *</span>
                        <input email="true" required type="text" name="email" id="email" placeholder="Other Names" class="form-control" value="<?=$email?>"/>
                        <span class="text-danger"> <?php echo form_error('email'); ?> </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label  >Mobile No</label><span class="text-danger"> *</span>
                        <input required number="true" minLength="12" maxLength="12" type="text" name="mobile" id="mobile" placeholder="e.g 2547..." class="form-control" value="<?=$mobile?>"/>
                        <span class="text-danger"> <?php echo form_error('mobile'); ?> </span>
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <label  >Username</label><span class="text-danger"> *</span>
                        <input required type="text" name="username" id="username" placeholder="Username" class="form-control" value="<?=$username?>"/>
                        <span class="text-danger"> <?php echo form_error('username'); ?> </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label  >Password</label><span class="text-danger"> *</span>
                        <input required type="password" name="password" id="password" placeholder="password" class="form-control" value="<?=$password?>"/>
                        <span class="text-danger"> <?php echo form_error('password'); ?> </span>
                    </div>


                    <?php if ($this->session->userdata('role')==="SUPER_USER"): ?>
                        <div class="col-md-6 col-xs-12">
                            <label for="role" >Select Role </label>
                            <span class="text-danger"> *</span>
                            <select name="role" id="role" class="form-control" >
                                <option value=""  <?php if ($role ===""){echo "selected";}?>>--- Please Select Role ---</option>
                                <option value="USER" <?php if ($role ==="USER"){echo "selected";}?>>Merchant</option>
                                <option value="SUPER_USER" <?php if ($role ==="SUPER_USER"){echo "selected";}?>>Enabler</option>
                                <option value="ADMIN" <?php if ($role ==="ADMIN"){echo "selected";}?>>Administrator</option>
                                <option value="CONSUMER" <?php if ($role ==="CONSUMER"){echo "selected";}?>>Consumer</option>
                                <option value="MANAGER" <?php if ($role ==="MANAGER"){echo "selected";}?>>Manager</option>
                            </select> 
                            <span class="text-danger"><?php echo form_error('role'); ?> </span>
                        </div>                   
                    <?php endif ?>
                    <?php if ($this->session->userdata('role')==="MANAGER"): ?>
                        <div class="col-md-6 col-xs-12">
                            <label for="role" >Select Role </label>
                            <span class="text-danger"> *</span>
                            <select name="role" id="role" class="form-control" >
                                <option value=""  <?php if ($role ===""){echo "selected";}?>>--- Please Select Role ---</option>
                                <option value="MANAGER" <?php if ($role ==="MANAGER"){echo "selected";}?>>Manager</option>
                                <option value="USER" <?php if ($role ==="USER"){echo "selected";}?>>Merchant</option>
                                <option value="CONSUMER" <?php if ($role ==="CONSUMER"){echo "selected";}?>>Consumer</option>
                            </select> 
                            <span class="text-danger"><?php echo form_error('role'); ?> </span>
                        </div>   
                    <?php endif ?>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label > Factory  </label><span class="text-danger"></span>
                        <select name="factorys" id="factorys" class="form-control" >
                            <option value="">-- Select Factory --</option>
                            <?php
                            if(!empty($factorys)){
                                foreach($factorys as $row) { ?>
                                <option value="<?=$row->id?>" ><?=$row->name?></option>  <!--<?php// if ($row->id ===$userfactory){echo "selected";}?>-->
                                <?php   }
                            } ?>
                        </select>

                        <span class="text-danger"> <?php echo form_error('factorys'); ?> </span>
                    </div>
                </div>

                <div class="row">
                <hr class="field-separator">
                    <div class="col-md-6 col-xs-12">
                        <div >
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                        </div>
                    </div>
                </div>


                </form>
            </div>
            <div class="panel-footer">Add User</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->
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
			$('#adduserform').validate();
        });
</script>