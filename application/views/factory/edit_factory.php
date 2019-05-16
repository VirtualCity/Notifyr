<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('factories') ?>"><i class="fa fa-map-marker"></i> Enterprises</a></li>
            <li class="active"><a >Edit Enterprise: (<?php echo $factoryName;?>)</a></li>
        </ol>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <form action="<?=base_url('factories/modify')?>" method="post" class="form-horizontal">
                        <input type="hidden" name="id" value="<?=$id?>"/>

                       <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Factory Name </label><span class="text-danger"> *</span>
                                <div >
                                    <input required type="text" name="factoryName" id="factoryName" placeholder="Factory Name" class="form-control" value="<?=$factoryName?>"/>

                                    <span class="text-danger"> <?php echo form_error('factoryName'); ?> </span>
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12">
                            <label>Factory Code </label><span class="text-danger"> *</span>
                                <div >
                                    <input required type="text" name="factoryCode" id="factoryCode" placeholder="Factory Code" class="form-control" value="<?=$factoryCode?>"/>

                                    <span class="text-danger"> <?php echo form_error('factoryCode'); ?> </span>
                                </div>
                            </div>
                       </div>

                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                            <label>Region </label><span class="text-danger"> *</span>
                                <div >
                                    <select name="region_id" id="region_id" class="form-control" >
                                        <option value="">---Please Select Region---</option>
                                        <?php
                                        if(!empty($regions)){
                                            foreach($regions as $row) { ?>
                                            <option value="<?=$row->id?>" <?php if ($row->id ===$region_id){echo "selected";}?>><?=$row->name?></option>
                                            <?php   }
                                        } ?>
                                    </select> 

                                    <span class="text-danger"> <?php echo form_error('region_id'); ?> </span>
                                </div>
                            </div>
                        </div>


                    
                         <hr class="field-separator">

                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                            <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                        </div>
                    </div>

                    </form>
                    <br>
                </div>
                <div class="panel-footer">Edit Factory</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->

