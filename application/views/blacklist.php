
<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
    <ol class="breadcrumb pull-left ">
            <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Blacklisted Numbers</li>
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
                    <h4 class="panel-title">Blacklisted Numbers</h4>
                </div>
                <div class="panel-body">

                    <table class="table table-striped  table-hover datatable"  id="example">
                        <thead>
                            <tr>

                                <th>Mobile Number</th>
                                <th>Date Blacklisted</th>
                                <?Php if($user_role==="MANAGER" || $user_role==="ADMIN" || $user_role==="SUPER_USER"){ ?>
                                <th>Action</th>
                                <?Php  } ?>

                            </tr>
                        </thead>
                    </table>

                </div>
                <div class="panel-footer">Blacklisted Numbers</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->




    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#example').dataTable({
                "processing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=base_url('contacts/blacklisted')?>",
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "iDisplayStart ": 20,
                "aLengthMenu": [[50, 100,200,500], [50, 100,200,500]],
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>"
                },
                aoColumns: [
                { "mData": "msisdn","bSearchable": true,"bSortable": true },
                { "mData": "created","bSearchable": true,"bSortable": true}
                <?Php if($user_role==="MANAGER"  || $user_role==="ADMIN" || $user_role==="SUPER_USER"){ ?>
                    ,
                    { "mData": "actions","bSearchable": false,"bSearchable": false }
                    <?Php  } ?>
                    ],
                    "order": [[ 1, "desc" ]],
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

    </script>

    

