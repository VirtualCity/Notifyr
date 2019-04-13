<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('towns') ?>"><i class="fa fa-map-marker"></i> Towns</a></li>
            <li class="active"><a >Edit Town: <?php echo $town;?></a></li>
        </ol>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                    <h4 class="panel-title">Edit Town: <?php echo $town;?></h4>
                </div>
                <div class="panel-body">
                    <form action="<?=base_url('towns/modify')?>" method="post" class="form-horizontal">
                        <input type="hidden" name="id" value="<?=$id?>"/>

                        <div class="col-md-6 col-xs-12">
                        <label>Town Name </label><span class="text-danger"> *</span>
                            <div >
                                <input required type="text" name="town" id="town" placeholder="TOwn Name" class="form-control" value="<?=$town?>"/>

                                <span class="text-danger"> <?php echo form_error('town'); ?> </span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                        <label>Town Code </label><span class="text-danger"> *</span>
                            <div >
                                <input required type="text" name="code" id="code" placeholder="TOwn Code" class="form-control" value="<?=$code?>"/>

                                <span class="text-danger"> <?php echo form_error('code'); ?> </span>
                            </div>
                        </div>  

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


                    
                         <hr class="field-separator">

                    <div class="col-md-12 col-xs-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                        <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                    </div>

                    </form>
                    <br>
                </div>
                <div class="panel-footer">Edit Town: <?php echo $town;?></div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->

