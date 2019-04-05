<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
           <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Service </li>
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
                    <h4 class="panel-title">Add Service</h4>
                </div>
                <div class="panel-body">

                    <form action="<?=base_url('products/add')?>" method="post" class="form-horizontal">

                        <div class="col-md-12 col-xs-12">
                            <label>Service Code </label><span class="text-danger"> *</span>

                            <input required type="text" name="code" id="code" placeholder="Service Code" class="form-control" value="<?=$code?>"/>
                            <span class="text-danger">  <?<?php echo form_error('code'); ?> </span>

                        </div>

                        <hr class="field-separator">
                        <div class="col-md-12 col-xs-12">
                            <label>Service Name</label><span class="text-danger"> *</span>
                            
                            <input required type="text" name="name" id="name" placeholder="Service Name" class="form-control" value="<?=$name?>"/>
                            <span class="text-danger">  <?php echo form_error('name'); ?> </span>

                        </div>

                        <div class="col-md-12 col-xs-12">
                            <label>Description</label><span class="text-danger"> *</span>
                            
                            <input required type="text" name="description" id="description" placeholder="Description/SKU" class="form-control" value="<?=$description?>""/>
                            <span class="text-danger"><?php echo form_error('description'); ?></span>


                        </div>

                        <hr class="field-separator">

                        <div class="col-md-12 col-xs-12">
                            <button type="submit" class="btn btn-primary"><i class=""></i> <i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>

                        </div>

                    </form>

                </div>
                <div class="panel-footer">Add Service</div>
            </div>
        </div>
    </div>
</div>

<!-- end #content -->