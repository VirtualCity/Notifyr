<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?=base_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?=base_url("groups")?>"><i class="fa fa-file"></i> Groups</a></li>
            <li class="active"><?=$group?> Edit</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <form action="<?=base_url('groups/modify')?>" method="post" class="form-horizontal">
                        <input type="hidden" name="id" value="<?=$id?>"/>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-xs-12">
                                <label >Group Name </label><span class="text-danger"> *</span>
                                <div >
                                    <input required type="text" name="group" id="group" placeholder="Group Name" class="form-control" value="<?php echo $group ?>"/>

                                    <span class="text-danger"> <?php echo form_error('group'); ?> </span>
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-xs-12">
                                <label > Group Type </label><span class="text-danger">*</span>
                                <select class="form-control" required name="type" id="type">
                                        <option value="" <?php if (empty($type)){echo "selected";}?>>---Please Select Type---</option>
                                        <option value="0" <?php if ($type == 0){echo "selected";}?>>DAILY</option>
                                        <option value="1" <?php if ($type == 1){echo "selected";}?>>THREE DAYS</option>
                                        <option value="2" <?php if ($type == 2){echo "selected";}?>>WEEKLY</option>
                                        <option value="3" <?php if ($type == 3){echo "selected";}?>>MONTHLY</option>
                                        <option value="4" <?php if ($type == 4){echo "selected";}?>>ANNUALLY</option>
                                        <option value="5" <?php if ($type == 5){echo "selected";}?>>OTHER</option>
                                </select>

                                <span class="text-danger"> <?php echo form_error('type'); ?> </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-xs-12">
                                <label>Description </label><span class="text-danger"> *</span>
                                <div >

                                    <textarea id="description" name="description" placeholder="Group Description" class="form-control" rows="4" value=""><?php echo $description ?></textarea>

                                    <span class="text-danger"> <?php echo form_error('description'); ?> </span>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                                <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="panel-footer">Edit Group : <?php echo $group ?></div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>

 
<script type="text/javascript">
   $(document).ready(function(){
        <?php if ($this->session->flashdata('appmsg')): ?>
            <?php $appmsg = $this->session->flashdata('appmsg'); ?>
                        swal({
                            title: "Done",
                            text: "<?php echo $this->session->flashdata('appmsg'); ?>",
                            timer: 3000,
                            showConfirmButton: false,
                            type: "<?php echo $this->session->flashdata('alert_type_') ?>"
                    });
        <?php endif; ?>
    });

</script> 

 

 