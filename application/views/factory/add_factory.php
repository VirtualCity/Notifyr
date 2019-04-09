<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          
            <li class="active">Add Factory</li>
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
                    <h4 class="panel-title">Add Factory</h4>
                </div>
                <div class="panel-body">
                 <form action="<?php echo base_url('factories/add');?>" method="post" class="form-horizontal">

                    <div class="col-md-12 col-xs-12">
                        <label >Factory Name </label><span class="text-danger"> *</span>
                        <input required type="text" name="factoryName" id="factoryName" placeholder="Factory Name" class="form-control" value="<?php echo $factoryName ?>"/>
                        <span class="text-danger"> <?php echo form_error('factoryName'); ?> </span>
                    </div>   

                    <div class="col-md-12 col-xs-12">
                        <label >Factory Code </label>
                        <input type="text" name="factoryCode" id="factoryCode" placeholder="Factory Code" class="form-control" value="<?php echo $factoryCode ?>"/>
                        <span class="text-danger"> <?php echo form_error('factoryCode'); ?> </span>
                    </div>  

                    <div class="col-md-12 col-xs-12">
                        <label >Factory Sender Id </label>
                        <input type="text" name="senderid" id="senderid" placeholder="Factory Sender Id" class="form-control" value="<?php echo $senderid ?>"/>
                        <span class="text-danger"> <?php echo form_error('senderid'); ?> </span>
                    </div>  

                    <div class="col-md-12 col-xs-12">
                        <label >Factory Key </label>
                        <input type="text" name="apikey" id="apikey" placeholder="Factory Key" class="form-control" value="<?php echo $apikey ?>"/>
                        <span class="text-danger"> <?php echo form_error('apikey'); ?> </span>
                    </div>  

                    <div class="col-md-12 col-xs-12">
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

                    <hr class="field-separator">
                    <div class="col-md-12 col-xs-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
                        <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                    </div>

                </form>
            </div>
            <div class="panel-footer">Add Factory</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->


