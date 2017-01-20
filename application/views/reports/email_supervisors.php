<body >
<!--Header Section-->
<?Php $this->load->view('templates/app_header');?>

<!--Navigation Section-->
<?Php
if( $user_role === 'ADMIN'){
    $this->load->view('templates/navigation');
}else if($user_role === 'SUPER_USER'){
    $this->load->view('templates/navigation_super_user');
}else{
    $this->load->view('templates/navigation_user');
}
?>

<div id="content" class="no-sidebar"> <!-- Content start -->
    <div class="top_bar">
        <ul class="breadcrumb">
            <li><a href="<?=base_url("dashboard")?>"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
            <li><a href="<?=base_url("reports")?>">Reports</a><span class="divider">/</span></li>
            <li class="active"><a>Email Report</a></li>
        </ul>
    </div>
    <div id="alert_placeholder">
        <?php
        $appmsg = $this->session->flashdata('appmsg');
        if(!empty($appmsg)){ ?>
            <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
        <?php } ?>
    </div>
    <div class="inner_content">

        <div class="widgets_area">


            <div class="well blue">
                <div class="well-header">
                    <h5>Email Weekly Report to Supervisors</h5>
                </div>
                <div class="well-content no_search">
                    <?php //echo $status->message; ?>
                    <form action="<?=base_url('reports/supervisors/mail')?>" method="post"  class="form-horizontal">

                        <div class="form_row">
                            <div class="well">
                                <div class="well-content no_search">
                                <span class="lblBold">Click on the button below to email Supervisors weekly report.</span>
                                </div>
                            </div>

                        </div>

                        <hr class="field-separator">
                        <div class="form_row">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" name="submit" class="btn btn-large dark_green" onclick="checkFile()"><i class="icon-plus"></i> Export & Email</button>
                            </div>
                        </div>

                    </form>

                    <br/>
                    <br/>
                    <?php
                    $mailed = $this->session->flashdata('mailed');
                    if(!empty($mailed)){ ?>
                        <div id="alertdiv" class="alert alert-info "><a class="close" data-dismiss="alert">x</a>
                            <strong>Technical Assistants in these towns have being emailed weekly report!</strong>
                            <br>
                            <span><?= $mailed ?></span>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="importModal" class="modal  fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header blue">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
        <h3 id="myModalLabel">Exporting Data to email</h3>
    </div>

    <div class="modal-body">
        <div id="loading-div-background">
            <div id="loading-div" class="ui-corner-all align_center">
                <img  src="<?php echo base_url('assets/img/import_loader.gif'); ?>" alt="Emailing.."/>
                <br>PROCESSING. PLEASE WAIT...
            </div>
        </div>
        <br/>
    </div>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?= base_url('assets/js/jquery-1.11.1.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-ui-1.10.3.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>

<script src="<?= base_url('assets/js/library/jquery.collapsible.min.js') ?>"></script>
<script src="<?= base_url('assets/js/library/jquery.mCustomScrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/js/library/jquery.mousewheel.min.js') ?>"></script>
<script src="<?= base_url('assets/js/library/jquery.uniform.min.js') ?>"></script>

<script src="<?= base_url('assets/js/library/jquery.autosize-min.js') ?>"></script>
<script src="<?= base_url('assets/js/library/jquery.easytabs.js') ?>"></script>

<script src="<?= base_url('assets/js/design_core.js') ?>"></script>
<script type="text/javascript">
    function checkFile(){
        jQuery('#importModal').modal('show');
    }
</script>


</body>
</html>