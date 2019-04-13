<!-- begin #content -->
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
       <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Edit Service</li>
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

                    <h4 class="panel-title">Edit Service</h4>
                </div>
                <div class="panel-body">
                    <form action="<?=base_url('products/modify')?>" method="post" class="form-horizontal">
                        <input type="hidden" name="id" value="<?=$id?>"/>
                        
                        <div class="col-md-12 col-xs-12">
                        <label>Service Code </label><span class="text-danger"> *</span>
                            
                            <div class="field">
                                <input type="text" name="code" id="code" placeholder="Service Code" class="form-control" value="<?=$code?>"/>
                               <span class="text-danger"><?php echo form_error('code'); ?> </span>
                             
                            </div>
                        </div>

                        <hr class="field-separator">
                        <div class= "col-md-12 col-xs-12">
                        <label>Service Name</label><span class ="text-danger"> *</span>
                            
                            <div class="field">
                                <input type="text" name="name" id="name" placeholder="Service Name" class="form-control" value="<?=$name?>"/>
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                                
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="col-md-12 col-xs-12">
                        <label>Description</label><span class="text-danger"> *</span>
                            
                            <div class="field">
                                <input type="text" name="description" id="description" placeholder="Description" class="form-control" value="<?=$description?>""/>
                                <span class="text-danger"><?php echo form_error('description'); ?></span>
                                
                            </div>

                        </div>
                        <hr class="field-separator">

                        <div class="col-md-12 col-xs-12">
                            <label class="field_name align_right"></label>
                            <div class="field">
                            <button type="submit" class="btn btn-primary"><i class=""></i> <i class="fa fa-save"></i>  Save Changes</button>
                                <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                               
                            </div>
                        </div>

                    </form>

                    
                </div>
                <div class="panel-footer">Edit Service</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->
