<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          
            <li class="active">Add Town</li>
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
                    <h4 class="panel-title">Add Town</h4>
                </div>
                <div class="panel-body">
                 <form action="<?php echo base_url('towns/add');?>" method="post" class="form-horizontal">

                    <div class="col-md-12 col-xs-12">
                        <label >Town Name </label><span class="text-danger"> *</span>
                        <input required type="text" name="town" id="town" placeholder="Town Name" class="form-control" value="<?php echo $town ?>"/>

                        <span class="text-danger"> <?php echo form_error('town'); ?> </span>
                    </div>   

                    <div class="col-md-12 col-xs-12">
                        <label >Town Code </label>
                        <input type="text" name="code" id="code" placeholder="Town Code" class="form-control" value="<?php echo $code ?>"/>

                        <span class="text-danger"> <?php echo form_error('code'); ?> </span>
                    </div>  

                    <div class="col-md-12 col-xs-12">
                        <label >Region </label><span class="text-danger"> *</span>
                        <select name="region_id" id="region_id" class="form-control" >
                            <option value="">---Please Select Region---</option>
                            <?php
                            if(!empty($regions)){
                                foreach($regions as $row) { ?>
                                <option value="<?=$row->id?>" ><?=$row->name?></option> <!--<?php// if ($row->id ===$region_id){echo "selected";}?>-->
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
            <div class="panel-footer">Add Town</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->


