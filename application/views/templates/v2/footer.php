<?php $path=base_url(); ?>
<div id="footer" class="footer">
	&copy; 2017 Virtual city
</div>

<div class="modal fade" data-backdrop="static" id="importModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Processing</h4>
            </div>
            <div class="modal-body">
                <div id="loading-div-background">
                    <div id="loading-div" class="ui-corner-all align_center">
                        <img  src="<?php echo base_url('assets/img/import_loader.gif'); ?>" alt="Importing.."/>
                        <br>PROCESSING. PLEASE WAIT...
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="<?php echo $path;?>assets/v2/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?php echo $path;?>assets/v2/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?php echo $path;?>assets/v2/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo $path;?>assets/v2/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $path;?>assets/v2/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo $path;?>assets/v2/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script type="text/javascript" src="http://40.113.123.6/provisioning/assets/links/links.js"></script>

<!-- <script src="<?php echo base_url('assets/js/jquery-1.11.1.js'); ?>"></script>
 -->	<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/tabletools/js/datatables.tableTools.js'); ?>"></script>
	
<script>
	$(document).ready(function() {
		App.init();
	});
</script>

<script type="text/javascript">
    function checkFile(){
        jQuery('#importModal').modal('show');
    }

</script>

</body>

</html>
