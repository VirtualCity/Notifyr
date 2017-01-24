<div id="content" class="content">
   
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
         <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Single Alerts</li>
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
                <h4 class="panel-title">Single Alerts Sent</h4>
            </div>
            <div class="panel-body">

                <table class="table table-striped table-bordered table-hover datatable" width="100%" cellspacing="0" id="example">
                    <thead>
                        <tr>
                            <th>Recipient</th>
                            <th>Message</th>
                            <th>Sent By</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                </table>
                
            </div>
            <div class="panel-footer">Single Alerts Sent</div>
        </div>
    </div>
</div>
</div>











<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "scrollCollapse": true,
                "jQueryUI": true,
                "scrollX": true,
                "scrollY": 400,
                "pagingType": "full_numbers",
                "pageLength": 50,
                "lengthMenu": [[50, 100,200,500,-1], [50, 100,200,500,"All"]],
                "dom": 'T<"clear">lfrtip',

                "tableTools": {
                    "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>",
                    "aButtons": [ "copy", "csv","xls","pdf" ]
                },
                
                
                columns: [
                { "data": "sent_to" },
                { "data": "message" },
                { "data": "name"},
                { "data": "created"}

                ],
                "order": [[ 3, "desc" ]],
                "oLanguage": {
                    "sProcessing": "<img src='<?= base_url('assets/img/loading.gif'); ?>'>"
                },
                "ajax":{
                    "url": "<?=base_url('reports/sms/datatable')?>",
                    "type": "POST"
                }
            });
        });

    </script>
