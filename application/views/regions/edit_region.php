<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('regions') ?>"><i class="ti-layout-column3"></i> Regions</a></li>
            <li class="active">Edit Region</li>
        </ol>
    </div>
 

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                   <div class="inner_content">
                        <div class="widgets_area">

                            <div class="well blue">
                                <div class="well-header">
                                    <h5>Edit Region</h5>
                                </div>
                                <div class="panel-body">
                                <div class="well-content no_search">

                                    <form action="<?=base_url('regions/modify')?>" method="post" class="form-horizontal">
                                        <input type="hidden" name="id" value="<?=$id?>"/>

                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <label for="region" class="field_name align_right lblBold"> Region Name</label><span class="text-danger"> *</span>
                                            <div >
                                                <input required type="text" name="region" id="region" placeholder="Region Name" class="form-control" value="<?=$region?>"/>
                                                
                                                <span class="text-danger"> <?php echo form_error('region'); ?> </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xs-12">
                                            <label for="code" class="field_name align_right lblBold"> Region Code</label><span class="text-danger"> *</span>
                                            <div >
                                                <input required type="text" name="code" id="code" placeholder="Region Code" class="form-control" value="<?=$code?>"/>
                                                
                                                <span class="text-danger"> <?php echo form_error('code'); ?> </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <label for="description" class="field_name align_right lblBold">Description</label><span class="text-danger"> </span>
                                            <div class="field">

                                            <textarea id="description" name="description" placeholder="Group Description" class="form-control" rows="4" value=""><?php echo $description ?></textarea>
                                            <span class="text-danger"> <?php echo form_error('description'); ?> </span>
                                               
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div >
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                                                <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                                            </div>
                                        </div>
                                    </div>

                                        
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="panel-footer">Edit Region</div>
            </div>
        </div>
    </div>
</div>

<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
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

