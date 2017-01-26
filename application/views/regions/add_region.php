<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
       <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          
        <li class="active">Add Region</li>
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
                    <h4 class="panel-title">Add a Region</h4>
                </div>
                <div class="panel-body">
                     <div class="well-content no_search">

                    <form action="<?php echo base_url('regions/add');?>" method="post" class="form-horizontal">

                        <div class="col-md-6 col-xs-12">
                        <label for="region" class="field_name align_right lblBold"> Region Name</label><span class="text-danger"> *</span>
                        <div >
                            <input required type="text" name="region" id="region" placeholder="Region Name" class="form-control" value="<?=$region?>"/>
                            
                            <span class="text-danger"> <?php echo form_error('region'); ?> </span>
                        </div>
                    </div>
                        <hr class="field-separator">
                        <div class="col-md-6 col-xs-12">
                        <label for="code" class="field_name align_right lblBold"> Region Code</label><span class="text-danger"> *</span>
                        <div >
                            <input required type="text" name="code" id="code" placeholder="Region Code" class="form-control" value="<?=$region?>"/>
                            
                            <span class="text-danger"> <?php echo form_error('code'); ?> </span>
                        </div>
                    </div>
                        <hr class="field-separator">
                        <div class="col-md-6 col-xs-12">
                        <label for="description" class="field_name align_right lblBold">Description</label><span class="text-danger"> *</span>
                       <div class="field">
                                <textarea  id="description" required="textarea" name="description" placeholder="Description" class="form-control" rows="4" value=""></textarea>
                                <span class="text-danger"> <?php echo form_error('description'); ?> </span>
                                </div>
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
                <div class="panel-footer">Add a Region</div>
            </div>
        </div>
    </div>
</div>





<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
