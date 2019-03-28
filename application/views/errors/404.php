<body >
<!--Header Section-->
<?Php $this->load->view('templates/app_header');?>

<!--Navigation Section-->
<?Php
if( $user_role === 'ADMIN'){
    $this->load->view('templates/navigation');
}else if($user_role === 'SUPER_USER'){
    $this->load->view('templates/navigation_super_user');
}else if($user_role === 'USER'){
    $this->load->view('templates/navigation_user');
}else if($user_role === 'MANAGER'){
    $this->load->view('templates/navigation_manager');
}else{
    $this->load->view('templates/navigation_consumer');
}
?>

<div id="content" class="no-sidebar"> <!-- Content start -->
    <div class="top_bar">
        <ul class="breadcrumb">
            <li><a href="<?=base_url("dashboard")?>"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
            <li class="active"><a>Error</a></li>
        </ul>
    </div>

    <div class="inner_content">

        <div class="widgets_area">
            <div class="row-fluid">
                <div class="span12">
                    <div class="error_page">
                        <div class="error_number">
                            404
                        </div>
                        <div class="error_description">
                            <h3>Ops! Wrong turn?</h3>
                            <p>Sorry, the page you are looking for cannot be found.<br><br>

                        </div>
                        <div class="clearfix"></div>
                        <div class="buttons">
                            <a href="<?=base_url("dashboard")?>" class="btn blue">Go back to dashboard</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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



</body>
</html>