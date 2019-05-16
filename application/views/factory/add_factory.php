<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('factories') ?>"><i class="fa fa-home"></i> Enterprises</a></li>
            <li class="active">Add Enterprise</li>
        </ol>
    </div>
    

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                 <form action="<?php echo base_url('factories/add');?>" method="post" class="form-horizontal">

                 <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <label >Factory Name </label><span class="text-danger"> *</span>
                        <input required type="text" name="factoryName" id="factoryName" placeholder="Factory Name" class="form-control" value="<?php echo $factoryName ?>"/>
                        <span class="text-danger"> <?php echo form_error('factoryName'); ?> </span>
                    </div>   

                    <div class="col-md-6 col-xs-6">
                        <label >Factory Code </label>
                        <input type="text" name="factoryCode" id="factoryCode" placeholder="Factory Code" class="form-control" value="<?php echo $factoryCode ?>"/>
                        <span class="text-danger"> <?php echo form_error('factoryCode'); ?> </span>
                    </div>  
                 </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <label >Region </label><span class="text-danger"> *</span>
                        <select name="region_id" id="region_id" class="form-control" >
                            <option value="">---Please Select Region---</option>
                            <?php
                            if(!empty($regions)){
                                foreach($regions as $row) { ?>
                                <option value="<?=$row->id?>"><?=$row->name?></option> <!-- <?php //if ($row->id ===$region_id){echo "selected";}?>-->
                                <?php   }
                            } ?>
                        </select>

                        <span class="text-danger"> <?php echo form_error('region_id'); ?> </span>
                    </div>
                </div>

                <div class="row">
                    <hr class="field-separator">
                    <div class="col-md-6 col-xs-6">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
                        <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                    </div>
                </div>


                </form>
            </div>
            <div class="panel-footer">Add Enterprise</div>
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

