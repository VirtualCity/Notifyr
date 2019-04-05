<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('supervisors') ?>"><i class="fa fa-circle-o"></i> Clerks</a></li>
            <li class="active">Import Clerks</li>
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
                    <h4 class="panel-title">Import Clerks</h4>
                </div>
                <div class="panel-body">
                    <form action="<?=base_url('supervisors/do_upload')?>" method="post" enctype="multipart/form-data" class="form-horizontal">

                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <label >Select File To Import: </label>
                            <span class="text-danger"> *</span>
                            <input type="file" required class="form-control" name="userfile" id="userfile"/>
                            <span class="text-danger"> <?php echo form_error('town'); ?> </span>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <label >Download template to use : </label><br>
                            <a href="<?php echo base_url().'supervisors/download'; ?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Template</a>
                        </div>
                    </div>

                    


                    <div class="col-md-12 col-xs-12">
                        <br>
                        <br>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary" onclick="checkFile()"><i class="fa fa-upload"></i> Import</button>
                        <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>

                    </div>
                </form>

                <br/>
                <?php
                $existing = $this->session->flashdata('existing');
                if(!empty($existing)){ ?>
                <div id="alertdiv" class="alert alert-warning "><a class="close" data-dismiss="alert">x</a>
                    <strong>Already Assigned!</strong>
                    <br>
                    <span><?= $existing ?></span>
                </div>
                <?php } ?>
                <br/>
                <?php
                $not_imported = $this->session->flashdata('notimported');
                if(!empty($not_imported)){ ?>
                <div id="alertdiv" class="alert alert-warning "><a class="close" data-dismiss="alert">x</a>
                    <strong>Failed to import!</strong>
                    <br>
                    <span><?= $not_imported ?></span>
                </div>
                <?php } ?>
            </div>
            <div class="panel-footer">Import Clerks</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->
 