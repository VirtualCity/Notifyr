<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="<?=base_url('blacklist')?>"><i class="fa fa-flag"></i> View Blacklist</a></li>
            <li class="active">Blacklist Number</li>
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
                    </div>
                    <h4 class="panel-title">Blacklist Number</h4>
                </div>
                <div class="panel-body">

                    <form name="" action="<?=base_url('addblacklist')?>" method="post"  class="form-horizontal">
                        <div class="col-md-12 col-xs-12">
                            <label>Mobile Number</label><span class ="text-danger"> *</span>


                            <input required type="text" name="msisdn" id="msisdn" placeholder="254" class="form-control" value=""/>
                            <span class="text-danger"><?php echo form_error('msisdn'); ?></span>


                        </div>

                        <hr class="field-separator">
                        <div class="col-md-12 col-xs-12">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-times-circle"></i> <i class="icon-plus-sign"></i>Blacklist</button>
                                <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>



                            </div>
                        </div>

                    </form>

                </div>
                <div class="panel-footer">Blacklist Number</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->
