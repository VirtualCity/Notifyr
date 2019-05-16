<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('factories') ?>"><i class="fa fa-map-marker"></i> Enterprises</a></li>
            <li class="active">Import Enterprises</li>
        </ol>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                
                <div class="panel-body">
                 <form action="<?=base_url('factories/do_upload')?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <label >Select File To Import: </label>
                            <span class="text-danger"> *</span>
                            <input type="file" required class="form-control" name="userfile" id="userfile"/>
                            <span class="text-danger"> <?php echo form_error('factory'); ?> </span>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <label >Download template to use : </label><br>
                            <a href="<?php echo base_url().'factories/download'; ?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Template</a>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                        <br>
                        <br>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary" onclick="checkFile()"><i class="fa fa-upload"></i> Import</button>
                        <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>

                    </div>

                </form>

                <br/>
                <?php
                $existing = $this->session->flashdata('existing');
                if(!empty($existing)){ ?>
                <div id="alertdiv" class="alert alert-info "><a class="close" data-dismiss="alert">x</a>
                    <strong>Factory already Existing!</strong>
                    <br>
                    <span><?= $existing ?></span>
                </div>
                <?php } ?>
                <br/>
                <?php
                $not_imported = $this->session->flashdata('notImported');
                if(!empty($not_imported)){ ?>
                <div id="alertdiv" class="alert alert-info "><a class="close" data-dismiss="alert">x</a>
                    <strong>Failed to import!</strong>
                    <br>
                    <span><?= $not_imported ?></span>
                </div>
                <?php } ?>
            </div>
            <div class="panel-footer">Import Factories</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->


<div id="importFactoryModal" class="modal  fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header blue">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
        <h3 id="myModalLabel">Importing Data</h3>
    </div>

    <div class="modal-body">
        <div id="loading-div-background">
            <div id="loading-div" class="ui-corner-all align_center">
                <img  src="<?php echo base_url('assets/img/import_loader.gif'); ?>" alt="Importing.."/>
                <br>PROCESSING. PLEASE WAIT...
            </div>
        </div>
        <br/>
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

<script type="text/javascript">
    function checkFile(){
            jQuery('#importFactoryModal').modal('show');
    }
</script>

