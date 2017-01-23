<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?=base_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?=base_url("groups")?>"><i class="fa fa-file"></i> Groups</a></li>
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
            <div class="panel panel-no-rounded-corner panel-default">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                    <h4 class="panel-title">Import To Group</h4>
                </div>
                <div class="panel-body">
                    <form action="<?=base_url('groups/do_upload')?>" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form_row">
                            <label for="userfile" class="field_name align_right lblBold">Select File To Import:</label>
                            <div class="field">
                                <input type="file" name="userfile" id="userfile"/>
                            </div>

                        </div>

                        <hr class="field-separator">
                        <div class="form_row">
                            <label for="group" class="field_name align_right lblBold">SMS Group </label>
                            <div class="field">
                                <select name="group" id="group" placeholder="Please Select a Group" class="span6" rows="4" >
                                    <option value="">---Please Select SMS Group---</option>
                                    <?php foreach($groups as $row) { ?>
                                    <option value="<?=$row->id?>" ><?=$row->name?></option>
                                    <?php } ?>
                                </select> <font color="red"> *</font>
                                <div><font color="red"><?php echo form_error('group'); ?></font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" name="submit" class="btn btn-large dark_green" onclick="checkFile()"><i class="icon-plus"></i> Import</button>
                            </div>
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

    <div id="importModal" class="modal  fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header blue">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
            <h3 id="myModalLabel">Importing Data</h3>
        </div>

        <div class="modal-body">
            <div id="loading-div-background">
                <div id="loading-div" class="ui-corner-all align_center">
                    <img  src="<?php echo base_url('assets/img/import_loader.gif'); ?>" alt="Importing.."/>
                    <br>PROCESSING. PLEASE WAIT...
                </div>
            </div>
            <br/>
        </div>

    </div>


 
    <script type="text/javascript">
        function checkFile(){
            jQuery('#importModal').modal('show');
        }
    </script>

 