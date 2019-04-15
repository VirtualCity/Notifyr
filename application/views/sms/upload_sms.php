<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?=base_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?=base_url('sms/pendingbulksms')?>"><i class="ti ti-comment-alt"></i> SMS</a></li>
            <li class="active">Import SMS</li>

        </ol>
    </div>

  


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <form id="excelsmsform" action="<?=base_url('sms/newbulksms/do_upload')?>" method="post" enctype="multipart/form-data" class="form-horizontal">
<!--                        <div class="col-md-12 col-xs-12">-->
<!--                            <div class="alert alert-info alert-dismissable">-->
<!--                                <ul>-->
<!--                                    <li class="list-group-item">Max File Size 2MB</li>-->
<!--                                    <li class="list-group-item">Send Max 20 SMS</li>-->
<!--                                </ul></div>-->
<!--                        </div>-->
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label >Select SMS File To Send: </label>
                                <span class="text-danger"> *</span>
                                <input type="file" required class="form-control" name="userfile" id="userfile"/>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <label >Download template to use : </label><br>
                                <a href="<?php echo base_url().'sms/newbulksms/download'; ?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Template</a>
                            </div>
                        </div>
                    <br>
                    <hr>
                   <div class="row">
                        <div class="col-md-12 col-md-offset-0 col-xs-12">
                            <button type="submit" name="submit" class="btn btn-primary"  ><i class="fa fa-upload"></i> Import</button>
                        </div>
                   </div>
                    </form>
                <br/>
                <br/>
                <?php
                $invalid = $this->session->flashdata('unregistered');
                if(!empty($invalid)){ ?>
                <div id="alertdiv" class="alert alert-danger "><a class="close" data-dismiss="alert">x</a>
                    <strong>Invalid Entries!</strong>
                    <br>
                    <span><?= $invalid ?></span>
                </div>
                <?php } ?>
                <br/>
                <?php
                $not_imported = $this->session->flashdata('notimported');
                if(!empty($not_imported)){ ?>
                <div id="alertdiv" class="alert alert-danger "><a class="close" data-dismiss="alert">x</a>
                    <strong>Failed to Send !</strong>
                    <br>
                    <span><?= $not_imported ?></span>
                </div>
                <?php } ?>


                <br>
            </div>
            <div class="panel-footer">Import SMS File To Send</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->
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
			$('#excelsmsform').validate();
        });
</script>
