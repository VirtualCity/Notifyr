
<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Logo Image Upload</li>
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
                  <li ><a data-toggle="tab"  href="<?php echo site_url('settings/services') ?>" >Agrimanagr SMS</a></li>
              <?php endif ?>
              <li><a href="<?php echo site_url('users/active') ?>" >Users</a></li>
          <?php endif ?>
          <?php if ($this->session->userdata('role')==="ADMIN"): ?>
            <li class="active"><a href="<?php echo site_url('settings/logo') ?>" >Logo</a></li>
          <?php endif ?>
      </ul>

     
      <div class="panel tab-content col-md-10">
        <div class="tab-pane active" id="tab_a">
         <div class="panel">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                </div>
                <h4 class="panel-title">Logo Upload</h4>
            </div>
            <div class="panel-body">

            <?php echo form_open_multipart('settings/logo/doUpload');?>
            <?php echo "<label > File to Upload (png not more than 2MB)  </label><span class='text-danger'> *</span>";?>
            <?php echo "<input class='form-control' type='file' required name='logo' size='20' />"; ?>
            <?php echo "<input class='btn btn-primary' type='submit' name='submit' value='upload' /> ";?>
            <?php echo "</form>"?> 
                
            </div>
</div>
</div>

</div><!-- tab content -->
</div>

