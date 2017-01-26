<!-- begin #content -->
<div id="content" class="content">
    
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('supervisors') ?>"><i class="fa fa-circle-o"></i> Supervisors</a></li>
            <li class="active">Add Supervisors</li>
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
                    <h4 class="panel-title">Add Supervisor</h4>
                </div>
                <div class="panel-body">
                    <form action="<?=base_url('supervisors/add')?>" method="post" class="form-horizontal">

                        <div class="col-md-12 col-xs-12">
                            <label > Name </label><span class="text-danger"> *</span>
                            <input required type="text" name="name" id="name" placeholder="Supervisor Name" class="form-control" value="<?php echo $name ?>"/>

                            <span class="text-danger"> <?php echo form_error('name'); ?> </span>
                        </div>   

                        <div class="col-md-12 col-xs-12">
                            <label > Phone Number </label><span class="text-danger"> *</span>
                            <input required type="number" name="mobile" id="mobile" placeholder="2547xxxxxxxx" class="form-control" value="<?php echo $mobile ?>"/>

                            <span class="text-danger"> <?php echo form_error('mobile'); ?> </span>
                        </div>  

                        <div class="col-md-12 col-xs-12">
                            <label > Email Address</label><span class="text-danger"> *</span>
                            <input required type="email" name="email" id="email" placeholder="email" class="form-control" value="<?php echo $email ?>"/>
                            <span class="text-danger"> <?php echo form_error('email'); ?> </span>
                        </div> 

                        <div class="col-md-12 col-xs-12">
                            <label > Division</label><span class="text-danger"> *</span>
                            <input required type="text" name="division" id="division" placeholder="Division" class="form-control" value="<?php echo $division ?>"/>
                            <span class="text-danger"> <?php echo form_error('division'); ?> </span>
                        </div> 


                        
                        
                        <hr class="field-separator">
                        <div class="col-md-12 col-xs-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                            <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                        </div>

                    </form>
                </div>
                <div class="panel-footer">Add Supervisor</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->
