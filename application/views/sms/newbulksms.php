<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="javascript:;"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="javascript:;"><i class="fa fa-file"></i> Page Options</a></li>
            <li class="active">New Bulk SMS</li>
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
            <div class="panel panel-no-rounded-corner panel-default">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                    <h4 class="panel-title">New Bulk SMS</h4>
                </div>
                <div class="panel-body">
                   <form action="<?php echo base_url('sms/newbulksms');?>" method="post" class="form-horizontal">

                       <div class="col-md-12 col-xs-12">
                        <label>SMS Group </label><span class="text-danger"> *</span>
                        
                        <select name="group" id="group" class="form-control"  >
                            <option value="">---Please Select SMS Group---</option>
                            <?php foreach($groups as $row) { ?>
                            <option value="<?=$row->id?>" <?php if ($row->id ===$group_id){echo "selected";}?>><?=$row->name?></option>
                            <?php } ?>
                        </select>

                        <span class="text-danger"> <?php echo form_error('group'); ?> </span>
                        
                    </div>

                    <div class="col-md-12 col-xs-12">
                        <label>Message </label><span class="text-danger"> *</span>
                        <div >

                            <textarea required="true" id="message" name="message" placeholder="Message" class="form-control" rows="4" value=""><?php echo $message; ?></textarea>
                            
                            <span class="text-danger"> <?php echo form_error('message'); ?> </span>
                        </div>
                    </div>


                    <hr class="field-separator">

                    <div class="col-md-6 col-xs-12">

                        <button type="submit" class="btn btn-success"><i class=""></i> <i class="fa fa-envelope"></i> Send</button>
                        <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>

                    </div>



                </form>

                <br>
            </div>
            <div class="panel-footer">New Bulk SMS</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->
