
<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('reports/pending') ?>"><i class="fa fa-bar-chart"></i> Group Messages Pending</a></li>
            <li class="active">Reply Message</li>
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
                    <h4 class="panel-title">Panel Title here</h4>
                </div>
                <div class="panel-body">
                  <form action="<?=base_url('reports/pending/send')?>" method="post" class="form-horizontal">
                    <input type="hidden" name="id" value="<?=$id?>"/>
                    <div class="col-md-12 col-xs-12">
                        <label >Mobile Number</label> 
                        <input type="text" name="msisdn" id="msisdn" placeholder="" class="form-control" value="<?=$msisdn?>" readonly="true"/>
                    </div>  

                    <div class="col-md-12 col-xs-12">
                        <label >Contact Number</label> 
                        <input type="text" name="from" id="from" placeholder="Contact Name" class="form-control" value="<?=$name?>" readonly="true"/>
                    </div>  

                    <div class="col-md-12 col-xs-12">
                        <label >Contact Number</label> 
                        <textarea id="received" name="received" placeholder="" class="form-control" value="" readonly="true"><?=$received_msg?></textarea>
                    </div> 

                    <div class="col-md-12 col-xs-12">
                        <label >Reply Message</label><span class="text-danger">*</span>
                        <textarea required="true" id="message" name="message" placeholder="Message" class="form-control" rows="4" value=""></textarea>
                        <span class="text-danger"><?php echo form_error('message'); ?></span>
                    </div> 

                    <hr class="field-separator">

                    <div class="col-md-12 col-xs-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i> Send</button>
                        <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                    </div>

                </form>
            </div>
            <div class="panel-footer">Panel Footer Here</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->


