<!-- begin #content -->
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
    <ul class="nav nav-tabs nav-stacked col-md-2">
      <li ><a href="<?php echo site_url('password') ?>"> Change Password</a></li>
      <?php if ($this->session->userdata('role')!=="USER"): ?>
          <?php if ($this->session->userdata('role')==="SUPER_USER"): ?>
              <li ><a  href="<?php echo site_url('settings/configuration') ?>" >SDP Configuration</a></li>
              <li><a href="<?php echo site_url('settings/services') ?>" >Agrimanagr SMS</a></li>
          <?php endif ?>
          <li class="active"><a data-toggle="tab" href="<?php echo site_url('users/active') ?>" >Users</a></li>
      <?php endif ?>
  </ul>
  <div class="panel tab-content col-md-10">
    <div class="tab-pane active" id="tab_a">
     <ul class="nav nav-tabs">
     <?php if ($this->session->userdata('role')==="MANAGER"): ?>
        <li class=""><a href="<?=base_url('users/active')?>" >Active Users</a></li>
        <li><a href="<?=base_url('users/suspended')?>" >Suspended Users</a></li>
        <li class="active"><a href="<?=base_url('users/add')?>" data-toggle="tab"><h4 class="panel-title">Add User</h4></a></li>                    
        <?php endif ?>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade active in" id="default-tab-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>                
                    <h4>Add User</h4>
                </div>

                <div class="panel-body">

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



                        <hr class="field-separator">
                        <div class="col-md-6 col-xs-12">
                            <div >
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div><!-- tab content -->
</div>
</div>






