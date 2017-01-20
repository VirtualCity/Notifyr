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
            <li class="active"><a href="<?=base_url("products")?>">Products</a><span class="divider">/</span></li>
            <li class="active"><a>Add Product</a></li>
        </ul>
    </div>
    <div class="inner_content">
        <div id="alert_placeholder">
            <?php
            $appmsg = $this->session->flashdata('appmsg');
            if(!empty($appmsg)){ ?>
                <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
            <?php } ?>
        </div>
        <div class="widgets_area">


            <div class="well blue">
                <div class="well-header">
                    <h5>Add Product</h5>
                </div>
                <div class="well-content no_search">

                    <form action="<?=base_url('products/add')?>" method="post" class="form-horizontal">

                        <div class="form_row">
                            <label for="code" class="field_name align_right lblBold">Product Code </label>
                            <div class="field">
                                <input type="text" name="code" id="code" placeholder="Product Code" class="span6" value="<?=$code?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('code'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label for="name" class="field_name align_right lblBold">Product Name </label>
                            <div class="field">
                                <input type="text" name="name" id="name" placeholder="Product Name" class="span6" value="<?=$name?>"/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('name'); ?> </font></div>
                            </div>
                        </div>
                        <hr class="field-separator">
                        <div class="form_row">
                            <label for="description" class="field_name align_right lblBold">Description </label>
                            <div class="field">
                                <input type="text" name="description" id="description" placeholder="Description/SKU" class="span6" value="<?=$description?>""/>
                                <font color="red"> *</font>
                                <div><font color="red"> <?php echo form_error('description'); ?> </font></div>
                            </div>

                        </div>
                        <hr class="field-separator">

                        <div class="form_row">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" class="btn btn-large dark_green"><i class="icon-plus"></i> Add</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?php echo base_url('assets/js/jquery-1.11.1.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/library/jquery.collapsible.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/library/jquery.mCustomScrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/library/jquery.mousewheel.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/library/jquery.uniform.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/library/jquery.autosize-min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/design_core.js'); ?>"></script>


</body>
</html>