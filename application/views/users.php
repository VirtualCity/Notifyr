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
            <li><a href="<?=base_url('dashboard')?>"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
            <li class="active"><a>User Management</a></li>
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
                    <h5>Users</h5>
                </div>
                <div class="well-content no_search no_padding">
                    <div class="navbar-inner">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#left-tab1" data-toggle="tab">Active Users</a></li>
                            <li><a href="#left-tab2" data-toggle="tab">Suspended Users</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="left-tab1">
                            <table id="example" class="table table-striped table-bordered table-hover datatable">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>First name</th>
                                    <th>Surname</th>
                                    <th>Other Names</th>
                                    <th>Mobile No</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date Created</th>
                                    <?Php if($user_role==="MANAGER"){ ?>
                                        <th>Action</th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody ></tbody>
                            </table>

                        </div>
                        <div class="tab-pane" id="left-tab2">

                            <table id="example2" class="table table-striped table-bordered table-hover datatable">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>First name</th>
                                    <th>Surname</th>
                                    <th>Other Names</th>
                                    <th>Mobile No</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date Created</th>
                                    <?Php if($user_role==="MANAGER"){ ?>
                                        <th>Action</th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody ></tbody>
                            </table>

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

<script src="<?= base_url('assets/js/jquery-1.11.1.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/tabletools/js/datatables.tableTools.js'); ?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#example').dataTable({
            "processing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=base_url('users/active')?>",
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "aLengthMenu": [[10, 50, 100], [10, 50, 100]],
            "dom": 'T<"clearfix"><"margin-b"lf<"clearfix">>trip',
            "scrollX": true,
            "tableTools": {
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>"
            },
            aoColumns: [

                { "mData": "username","bSearchable": true,"bSortable": true },
                { "mData": "fname","bSearchable": true,"bSortable": true},
                { "mData": "surname","bSearchable": true,"bSortable": true },
                { "mData": "oname","bSearchable": true,"bSortable": true},
                { "mData": "mobile","bSearchable": true,"bSortable": true },
                { "mData": "email","bSearchable": true,"bSortable": true },
                { "mData": "role","bSearchable": true,"bSortable": true},
                { "mData": "created","bSearchable": true,"bSortable": true}
                <?Php if($user_role!=="USER"){ ?>
                ,
                { "mData": "actions","bSearchable": false,"bSearchable": false }
                <?Php  } ?>
            ],
            "oLanguage": {
                "sProcessing": "<img src='<?= base_url('assets/img/loading.gif'); ?>'>"
            },
            fnInitComplete : function () {
                //oTable.fnAdjustColumnSizing();
            },
            fnServerData : function (sSource, aoData, fnCallback) {
                jQuery.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback
                });
            }
        });

        jQuery('#example2').dataTable({
            "processing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=base_url('users/suspended')?>",
            "bJQueryUI": true,
            "scrollX": true,
            "sPaginationType": "full_numbers",
            "aLengthMenu": [[10, 50, 100], [10, 50, 100]],
            "dom": 'T<"clearfix"><"margin-b"lf<"clearfix">>trip',
            "tableTools": {
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>"
            },
            aoColumns: [
                { "mData": "username","bSearchable": true,"bSortable": true },
                { "mData": "fname","bSearchable": true,"bSortable": true},
                { "mData": "surname","bSearchable": true,"bSortable": true },
                { "mData": "oname","bSearchable": true,"bSortable": true},
                { "mData": "mobile","bSearchable": true,"bSortable": true },
                { "mData": "email","bSearchable": true,"bSortable": true },
                { "mData": "role","bSearchable": true,"bSortable": true},
                { "mData": "created","bSearchable": true,"bSortable": true}
                <?Php if($user_role!=="USER"){ ?>
                ,
                { "mData": "actions","bSearchable": false,"bSearchable": false }
                <?Php  } ?>
            ],
            "oLanguage": {
                "sProcessing": "<img src='<?= base_url('assets/img/loading.gif'); ?>'>"
            },
            fnInitComplete : function () {
                //oTable.fnAdjustColumnSizing();
            },
            fnServerData : function (sSource, aoData, fnCallback) {
                jQuery.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback
                });
            }
        });
    });

    function setUser(uid){
        var id = uid;
        jQuery('#user').val(id);

    }

    function resetUser(){
        var id = jQuery("#user").val();
        var tp = jQuery("#tempPass").val();
        jQuery.ajax({
            type: "POST",
            url: "<?=base_url("users/reset");?>",
            data: {u:id, p:tp},
            success: function(data){
                showalert2(data,"alert-success");
                /*setInterval(function(){//function for reloading page
                    location.reload();
                },20000);*/
            }
        });

    }
</script>
<script src="<?php echo base_url('assets/datatables/js/responsive.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>

<script src="<?php echo  base_url('assets/js/library/jquery.collapsible.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/jquery.mCustomScrollbar.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/jquery.mousewheel.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/jquery.uniform.min.js'); ?>"></script>

<script src="<?php echo  base_url('assets/js/library/jquery.autosize-min.js'); ?>"></script>


<script src="<?php echo base_url('assets/js/design_core.js'); ?>"></script>




<script type="text/javascript">

    function showalert(message,alerttype){
        jQuery('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
        setTimeout(function() {
            jQuery('#alertdiv').remove();
        },10000);
    }

    function showMessage(message){
        if(message.length>0){
            showalert2(message,"alert-info");
        }
    }

    function showalert2(message,alerttype){
        jQuery('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
        setTimeout(function() {
            jQuery('#alertdiv').remove();
        },20000);


    }

</script>





<div id="myModal2" class="modal hide fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
        <h3>Temporary Password</h3>
    </div>
    <form action="<?php echo base_url('users/reset'); ?>" method="post">
        <div class="modal-body">
            <input id="user" type="hidden" value="" name="id">
            <label class="field_name">Password: </label>
            <input id="tempPass" type="password" value="" class="span4" name="password">
        </div>
        <div class="modal-footer">
            <button type="submit"  class="btn dark_green" >Reset</button>
            <a  data-dismiss="modal" aria-hidden="true" class="btn grey">Close</a>

        </div>
    </form>
</div>
</body>
</html>