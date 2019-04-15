<div id="content" class="content">
<?php $tl=($is_edit) ? 'Edit SMS Template '.$title_ : 'New SMS Template';
	$endpoint=($is_edit) ? "updatetemplate" :"savetemplate"; ?>
	
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
             <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
             <li><a href="<?=base_url('sms/pendingbulksms')?>"><i class="ti ti-comment-alt"></i> SMS</a></li>
            <li class="active"><?= $tl?></li>
        </ol>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                 <form id="smstemplateform" action="<?php echo base_url('sms/newsms/'.$endpoint );?>" method="post" class="form-horizontal">
					<input type="hidden" value="<?php echo $id;?>" name="id"/>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Title</label><span class="text-danger"> *</span>

                            <input required type="text" name="title_" id="title_" placeholder="Title" class="form-control" value="<?php echo $title_;?>"/>
                            <span class="text-danger">  <?php echo form_error('title_'); ?> </span>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label>Type </label><span class="text-danger"> *</span>
                            <select class="form-control" required name="type" id="type">
                                <?php if(!empty($type)) echo '<option value="'.$type.'">'.$type.'</option>'?>
                                <option value="">---Please Select Type---</option>
                                    <option value="DEFAULT">DEFAULT</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('type'); ?> </span>
                            
                        </div>
                    </div>
  					<div class="row">
                        <div class="col-md-12 col-xs-12">
                            <label>Template </label><span class="text-danger"> *</span>
                            <textarea required="true"  id="template" name="template" placeholder="SMS template" class="form-control" rows="4" value=""><?php echo $template; ?></textarea>
                            <span class="text-danger"><?php echo form_error('template'); ?> </span>
                            
                        </div>
                    </div>

                    <hr class="field-separator">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-xs-12">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" class="btn btn-primary"><i class=""></i> <i class="fa fa-save"></i> <?= ($is_edit) ? "Save Changes" :"Save" ?></button>
                                <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer"><?= $tl?></div>

        </div>
    </div>
</div>
</div>
</div>
<!-- end #content -->

<script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>

 
<script type="text/javascript">
   $(document).ready(function(){
        <?php if ($this->session->flashdata('appmsg')): ?>
            <?php $appmsg = $this->session->flashdata('appmsg'); ?>
                        swal({
                            title: "Done",
                            text: "<?php echo $this->session->flashdata('appmsg'); ?>",
                            timer: 5000,
                            showConfirmButton: false,
                            type: "<?php echo $this->session->flashdata('alert_type_') ?>"
                    });
        <?php endif; ?>       
    });

</script> 

<script type="text/javascript">
        $().ready(function(){
			$('#smstemplateform').validate();
        });
</script>


