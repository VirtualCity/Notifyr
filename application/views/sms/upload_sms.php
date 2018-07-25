<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?=base_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          
            <li class="active">Import SMS</li>

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
                    <h4 class="panel-title">Send SMS From Excel</h4>
                </div>
                <div class="panel-body">
                    <form action="<?=base_url('sms/newbulksms/do_upload')?>" method="post" enctype="multipart/form-data" class="form-horizontal">
<!--                        <div class="col-md-12 col-xs-12">-->
<!--                            <div class="alert alert-info alert-dismissable">-->
<!--                                <ul>-->
<!--                                    <li class="list-group-item">Max File Size 2MB</li>-->
<!--                                    <li class="list-group-item">Send Max 20 SMS</li>-->
<!--                                </ul></div>-->
<!--                        </div>-->
                       <div class="col-md-12 col-xs-12">
                        <label >Select SMS File To Send: </label>
                        <span class="text-danger"> *</span>
                        <input type="file" required="required" class="form-control" name="userfile" id="userfile"/>
                    </div>
                   <div class="col-md-12 col-xs-12">
                        <br>
                        <br>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary"  ><i class="fa fa-upload"></i> Import</button>
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
