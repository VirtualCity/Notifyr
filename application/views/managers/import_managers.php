<!-- begin #content -->
<div id="content" class="content">
    
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
             <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('managers') ?>"><i class="fa fa-circle"></i> Managers</a></li>
            <li class="active">Import Managers</li>
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
                    <h4 class="panel-title">Import Managers</h4>
                </div>
                <div class="panel-body">
                              <form action="<?=base_url('managers/do_upload')?>" method="post" enctype="multipart/form-data" class="form-horizontal">

                       <div class="col-md-12 col-xs-12">
                        <label >Select File To Import: </label>
                        <span class="text-danger"> *</span>
                        <input type="file" class="form-control" name="userfile" id="userfile"/>


                        <span class="text-danger"> <?php echo form_error('town'); ?> </span>
                    </div>

                    


                    <div class="col-md-12 col-xs-12">
                        <br>
                        <br>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary" onclick="checkFile()"><i class="fa fa-upload"></i> Import</button>
                    </div>
                </form>

                <br/>
                <?php
                $existing = $this->session->flashdata('existing');
                if(!empty($existing)){ ?>
                <div id="alertdiv" class="alert alert-warning "><a class="close" data-dismiss="alert">x</a>
                    <strong>Already Exist!</strong>
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
                <div class="panel-footer">Import Managers</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->


