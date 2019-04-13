
<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
           <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           <li><a><i class="fa fa-bar-chart"></i> SMS Reports</a></li>
           <li class="active">Managers Reports</li>
       </ol>
   </div>



<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                </div>
                <h4 class="panel-title">Email Weekly Report to Area Sales Managers</h4>
            </div>
            <div class="panel-body">
                <form action="<?=base_url('reports/managers/mail')?>" method="post"  class="form-horizontal">

                  <div class="col-md-12 col-xs-12">
                   <label >Click on the button below to email Area Sales Managers, a weekly purchase reports by stockists from their respective regions. </label> 
               </div> 

               <hr class="field-separator">

               <div class="col-md-12 col-xs-12">
                <button type="submit" onclick="checkFile()" class="btn btn-primary"><i class="fa fa-send"></i> Export &amp; Email</button>
            </div>

        </form>
        <br>

        <?php
        $mailed = $this->session->flashdata('mailed');
        if(!empty($mailed)){ ?>
        <div id="alertdiv" class="alert alert-info "><a class="close" data-dismiss="alert">x</a>
            <strong>Towns with last 7 days report emailed!</strong>
            <br>
            <span><?= $mailed ?></span>
        </div>
        <?php } ?>
    </div>
    <div class="panel-footer">Email Weekly Report to Area Sales Managers</div>
</div>
</div>
</div>
</div>
<!-- end #content -->


