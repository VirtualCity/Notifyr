<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
             <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">New SMS</li>
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
                    <h4 class="panel-title">New SMS</h4>
                </div>
                <div class="panel-body">
                 <form action="<?php echo base_url('sms/newsms');?>" method="post" class="form-horizontal">

                    <div class="col-md-12 col-xs-12">
                        <label>Mobile Number </label><span class="text-danger"> *</span>

                        <input type="text" name="msisdn" id="msisdn" placeholder="254" class="form-control" value="<?php echo $msisdn;?>"/>
                        <span class="text-danger">  <?php echo form_error('msisdn'); ?> </span>
                        

                    </div>


                    <div class="col-md-12 col-xs-12">
                        <label>Message </label><span class="text-danger"> *</span>


                        <textarea required="true"  id="message" name="message" placeholder="Message" class="form-control" rows="4" value=""><?php echo $message; ?></textarea>
                        <span class="text-danger"><?php echo form_error('message'); ?> </span>
                        
                    </div>


                    <hr class="field-separator">
                    <div class="col-md-12 col-xs-12">
                        <label class="field_name align_right"></label>
                        <div class="field">

                            <button type="submit" class="btn btn-primary"><i class=""></i> <i class="fa fa-send"></i> Send</button>
                            <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>


                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">New SMS</div>

        </div>
    </div>
</div>
</div>
</div>
<!-- end #content -->


