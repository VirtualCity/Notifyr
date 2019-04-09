<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
           <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           <li><a href="<?php echo base_url("groups");?>"><i class="fa fa-puzzle-piece"></i> Groups</a></li>
           <li class="active">Add Group</li>

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
                <h4 class="panel-title">Add Group</h4>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('groups/add');?>" method="post" class="form-horizontal">

                   <div class="col-md-12 col-xs-12">
                       <label >Group Name </label><span class="text-danger"> *</span>
                       <input required type="text" name="group" id="group" placeholder="Group Name" class="form-control" value="<?php echo $group ?>"/>

                       <span class="text-danger"> <?php echo form_error('group'); ?> </span>
                   </div> 

                   <div class="col-md-12 col-xs-12">
                    <label>Description </label><span class="text-danger"> *</span>

                    <textarea id="description" name="description" placeholder="Group Description" class="form-control" rows="4" value=""><?php echo $description ?></textarea>

                    <span class="text-danger"> <?php echo form_error('description'); ?> </span>
                </div>

                <div class="col-md-12 col-xs-12">
                    <label > Factory  </label><span class="text-danger"></span>
                    <select name="factory_id" id="factory_id" class="form-control" >
                        <option value="">-- Select Factory --</option>
                        <?php
                        if(!empty($factories)){
                            foreach($factories as $row) { ?>
                            <option value="<?=$row->id?>"><?=$row->name?></option> <!-- <?php// if ($row->id ===$userfactory){echo "selected";}?>-->
                            <?php   }
                        } ?>
                    </select>

                    <span class="text-danger"> <?php echo form_error('factory_id'); ?> </span>
                </div>
                
                <hr class="field-separator">

                <div class="col-md-12 col-xs-12">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                </div>






            </form>
        </div>
        <div class="panel-footer">Add Group</div>
    </div>
</div>
</div>
</div>
<!-- end #content -->
