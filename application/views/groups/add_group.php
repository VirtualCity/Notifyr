<!-- begin #content -->
<div id="content" class="content">

    <div class="row">
        <div class="col-md-8">
        <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
           <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           <li><a href="<?php echo base_url("groups");?>"><i class="fa fa-puzzle-piece"></i> Groups</a></li>
           <li class="active">Add Group</li>
       </ol>
   </div>
        </div>
    </div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <form id="addgroupform" action="<?php echo base_url('groups/add');?>" method="post" class="form-horizontal">

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <label >Group Name </label><span class="text-danger"> *</span>
                        <input required type="text" name="group" id="group" placeholder="Group Name" class="form-control" value="<?php echo $group ?>"/>

                        <span class="text-danger"> <?php echo form_error('group'); ?> </span>
                    </div> 
                    <div class="col-md-6 col-xs-6">
                            <label > Factory  </label><span class="text-danger">*</span>
                            <select required name="factory_id" id="factory_id" class="form-control" >
                                <option value="">-- Select Factory --</option>
                                <?php
                                if(!empty($factories)){
                                    foreach($factories as $row) { ?>
                                    <option value="<?=$row->id?>" <?php if ($row->id ===$userfactory){echo "selected";}?>><?=$row->name?></option> <!-- <?php// if ($row->id ===$userfactory){echo "selected";}?>-->
                                    <?php   }
                                } ?>
                            </select>

                            <span class="text-danger"> <?php echo form_error('factory_id'); ?> </span>
                    </div>
                </div>
                   

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <label > Group Type</label><span class="text-danger">*</span>
                        <select class="form-control" required name="type" id="type">
                                <option value="" <?php if (empty($type)){echo "selected";}?>>---Please Select Type---</option>
                                <option value="0" <?php if ($type === 0){echo "selected";}?>>DAILY</option>
                                <option value="1" <?php if ($type === 1){echo "selected";}?>>THREE DAYS</option>
                                <option value="2" <?php if ($type === 2){echo "selected";}?>>WEEKLY</option>
                                <option value="3" <?php if ($type === 3){echo "selected";}?>>MONTHLY</option>
                                <option value="4" <?php if ($type === 4){echo "selected";}?>>ANNUALLY</option>
                                <option value="5" <?php if ($type === 5){echo "selected";}?>>OTHER</option>
                        </select>

                        <span class="text-danger"> <?php echo form_error('type'); ?> </span>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <label>Description </label><span class="text-danger"> </span>

                        <textarea id="description" name="description" placeholder="Group Description" class="form-control" rows="4" value=""><?php echo $description ?></textarea>

                        <span class="text-danger"> <?php echo form_error('description'); ?> </span>
                    </div>
                </div>

                
                <br>
                <!-- <hr class="field-separator"> -->
       
                <div class="row">
                <div class="col-md-12 col-xs-12">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                </div>
                </div>

            </form>
        </div>
        <div class="panel-footer">Add Group</div>
    </div>
</div>
</div>
</div>
<!-- end #content -->

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
<script type="text/javascript">
        $().ready(function(){
			$('#addgroupform').validate();
        });
</script>
