<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="javascript:;"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="javascript:;"><i class="fa fa-file"></i> Page Options</a></li>
            <li class="active">Blank Page</li>
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
                    <h4 class="panel-title">Edit Group : <?php echo $group ?></h4>
                </div>
                <div class="panel-body">
                    <form action="<?=base_url('groups/modify')?>" method="post" class="form-horizontal">
                        <input type="hidden" name="id" value="<?=$id?>"/>

                        <div class="col-md-12 col-xs-12">
                         <label >Group Name </label><span class="text-danger"> *</span>
                         <div >
                            <input required type="text" name="group" id="group" placeholder="Group Name" class="form-control" value="<?php echo $group ?>"/>

                            <span class="text-danger"> <?php echo form_error('group'); ?> </span>
                        </div>
                    </div> 

                    <div class="col-md-12 col-xs-12">
                    <label>Description </label><span class="text-danger"> *</span>
                        <div >

                            <textarea id="description" name="description" placeholder="Group Description" class="form-control" rows="4" value=""><?php echo $description ?></textarea>

                            <span class="text-danger"> <?php echo form_error('description'); ?> </span>
                        </div>
                    </div>

                    <hr class="field-separator">

                    <div class="col-md-12 col-xs-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                        <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                    </div>

                    </form>
                </div>
                <div class="panel-footer">Edit Group : <?php echo $group ?></div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->

 