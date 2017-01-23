<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="javascript:;"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="javascript:;"><i class="fa fa-file"></i> View Products</a></li>
            <li class="active">Import Products</li>
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
                    <h4 class="panel-title">Import Products</h4>
                </div>
                <div class="panel-body">
                 <form action="<?=base_url('products/do_upload')?>" method="post" enctype="multipart/form-data" class="form-horizontal">

                    <div class="col-md-12 col-xs-12">
                        <label>Select File To Import:</label><span class= "text-danger"> *</span>

                        <div class="field">
                            <input type="file" name="userfile" id="userfile"/>
                        </div>

                    </div>

                    <hr class="field-separator">
                    <div class="col-md-12 col-xs-12">
                    <button type="submit" class="btn btn-primary"><i class=""></i> <i class="fa fa-upload"></i>  Import</button>
                            <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>

                    </div>

                </form>


            </div>
            <div class="panel-footer">Import Products</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->
