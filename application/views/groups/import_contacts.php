<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?=base_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          
            <li class="active">Group import</li>

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
                    <h4 class="panel-title">Import To Group</h4>
                </div>
                <div class="panel-body">
                    <form action="<?=base_url('groups/do_upload')?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <label >Select File To Import: </label>
                            <span class="text-danger"> *</span>
                            <input type="file" class="form-control" name="userfile" id="userfile"/>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <label >Download template to use : </label><br>
                            <a href="<?php echo base_url().'groups/download'; ?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Template</a>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-xs-12">
                        <label >SMS Group </label>
                        <span class="text-danger"> *</span>
                        <select name="group" id="group"  class="form-control">
                            <option value="">---Please Select SMS Group---</option>
                            <?php foreach($groups as $row) { ?>
                            <option value="<?=$row->id?>" ><?=$row->name?></option>
                            <?php } ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('group'); ?></span>

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
                    <strong>Existing Entries!</strong>
                    <br>
                    <span><?= $existing ?></span>
                </div>
                <?php } ?>
                <br/>
                <br/>
                <?php
                $invalid = $this->session->flashdata('invalid');
                if(!empty($invalid)){ ?>
                <div id="alertdiv" class="alert alert-danger "><a class="close" data-dismiss="alert">x</a>
                    <strong>Invalid Entries!</strong>
                    <br>
                    <span><?= $invalid ?></span>
                </div>
                <?php } ?>
                <br/>
                <?php
                $not_imported = $this->session->flashdata('notimported');
                if(!empty($not_imported)){ ?>
                <div id="alertdiv" class="alert alert-danger "><a class="close" data-dismiss="alert">x</a>
                    <strong>Failed to import!</strong>
                    <br>
                    <span><?= $not_imported ?></span>
                </div>
                <?php } ?>


                <br>
            </div>
            <div class="panel-footer">Import To Group</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->
