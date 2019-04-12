
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
       <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       <li><a href="<?=base_url('Contacts')?>"><i class="fa fa-group"></i> Contacts</a></li>
              <li class="active">Edit Contact</li>
    </ol>
    </div>
 

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                <div class="well-content no_search">

                    <form action="<?=base_url('contacts/modify')?>" method="post" class="form-horizontal">
                        <input type="hidden" name="id" value="<?=$id?>"/>

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label for="msisdn" class="field_name align_right lblBold">Mobile Number </label><span class="text-danger"> *</span>
                            <div >
                                <input required type="text" name="msisdn" id="msisdn" placeholder="Mobile Number" class="form-control" value="<?=$msisdn?>"/>
                                
                                <span class="text-danger"> <?php echo form_error('msisdn'); ?> </span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <label for="name" class="field_name align_right lblBold">Name </label>
                            <div >
                                <input  type="text" name="name" id="name"  class="form-control" value="<?=$name?>"/>
                            </div>
                        </div>
                    </div>                        

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label for="email" class="field_name align_right lblBold">Email</label>
                            <div >
                                <input  type="text" name="email" id="email"  class="form-control" value="<?=$email?>"/>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <label for="address" class="field_name align_right lblBold">Address</label>
                            <div >
                                <input  type="text" name="address" id="address"  class="form-control" value="<?=$address?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" class="btn btn-large btn-primary"><i class="icon-save"></i> Update</button>
                            </div>
                        </div>
                    </div>

                    </form>
                </div>
                   
                </div>
                <div class="panel-footer">Edit Contact</div>
            </div>
        </div>
    </div>
</div>


<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
<script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>

<script>

    $(document).ready(function() {

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

