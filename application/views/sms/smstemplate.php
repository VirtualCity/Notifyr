<div id="content" class="content">
<?php $tl=($is_edit) ? 'Edit SMS Template '.$title_ : 'New SMS Template';
	$endpoint=($is_edit) ? "updatetemplate" :"savetemplate"; ?>
	
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
             <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $tl?></li>
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
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                    <h4 class="panel-title"><?= $tl?></h4>
                </div>
                <div class="panel-body">
                 <form action="<?php echo base_url('sms/newsms/'.$endpoint );?>" method="post" class="form-horizontal">
					<input type="hidden" value="<?php echo $id;?>" name="id"/>
                    <div class="col-md-12 col-xs-12">
                        <label>Title</label><span class="text-danger"> *</span>

                        <input type="text" name="title_" id="title_" placeholder="Title" class="form-control" value="<?php echo $title_;?>"/>
                        <span class="text-danger">  <?php echo form_error('title_'); ?> </span>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <label>Type </label><span class="text-danger"> *</span>
                        <select class="form-control" name="type" id="type">
                        	<?php if(!empty($type)) echo '<option value="'.$type.'">'.$type.'</option>'?>
                        	  <option value="">---Please Select Type---</option>
                        	    <option value="GREETINGS">GREETINGS</option>
                        	     <option value="ORDER">ORDER</option>
                        </select>
                        <span class="text-danger"><?php echo form_error('type'); ?> </span>
                        
                    </div>
  					<div class="col-md-12 col-xs-12">
                        <label>Template </label><span class="text-danger"> *</span>
                        <textarea required="true"  id="template" name="template" placeholder="SMS template" class="form-control" rows="4" value=""><?php echo $template; ?></textarea>
                        <span class="text-danger"><?php echo form_error('template'); ?> </span>
                        
                    </div>

                    <hr class="field-separator">
                    <div class="col-md-12 col-xs-12">
                        <label class="field_name align_right"></label>
                        <div class="field">

                            <button type="submit" class="btn btn-primary"><i class=""></i> <i class="fa fa-save"></i> <?= ($is_edit) ? "Save Changes" :"Save" ?></button>
                            <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>


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


