<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
             <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            
            <li class="active">New Bulk SMS</li>
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
                    <h4 class="panel-title"><?php ?></h4>
                </div>
                <div class="panel-body">
                   <form action="<?php echo base_url('sms/newbulksms');?>" method="post" class="form-horizontal">

                       <div class="col-md-12 col-xs-12">
                        <label>SMS Group </label><span class="text-danger"> *</span>
                        
                        <select name="group" id="group" class="form-control"  >
                            <option value="">---Please Select SMS Group---</option>
                            <?php foreach($groups as $row) { ?>
                            <option value="<?=$row->id?>" <?php if ($row->id ===$group_id){echo "selected";}?>><?=$row->name?></option>
                            <?php } ?>
                        </select>

                        <span class="text-danger"> <?php echo form_error('group'); ?> </span>
                        
                    </div>
                    <br>
                       <hr class="field-separator">
                     <div class="col-md-12 col-xs-12">

                          <label>Group Contacts </label><span class="text-danger"> *</span>
                         <div class="">
                          <select style="height:30px" class="form-control" multiple="multiple" name="groupcontacts[]" id="groupcontacts_">
                              <option value="">---Please Select SMS Sub-Group contacts---</option>
                          </select>

                          <span class="text-danger"> <?php echo form_error('groupcontacts'); ?> </span>

                      </div>
                      </div>

                    <div class="col-md-12 col-xs-12">
                        <label>Message </label><span class="text-danger"> *</span>
                       <div class="row">
                       	 <div class="col-md-8">
                        	<label>Type to Compose</label>
                        	 <div >
                            <textarea onkeyup="countChars(this);" onkeydown="countChars(this);" maxlength="480" required="true" id="message" name="message" placeholder="Message" class="form-control" rows="4" value=""><?php echo $message; ?></textarea>
                            
                            <span class="text-danger"> <?php echo form_error('message'); ?> </span>

                        <!-- ------------------------------------------------------------------ -->
                            <p id="bulkmsgNum">0 Message(s)</p>
                            <script type="text/JavaScript">
                            function countChars(obj){
                                var maxLength = 480;
                                var singleMessageSize = 160;
                                var strLength = obj.value.length;
                                
                                if(((strLength) > -1) && ((strLength) <= 0)){
                                    document.getElementById("bulkmsgNum").innerHTML = 0 +' out of '+maxLength/singleMessageSize+' Message(s)';
                                }else if(((strLength) > 0) && ((strLength) <= 160)){
                                    document.getElementById("bulkmsgNum").innerHTML = 1 +' out of '+maxLength/singleMessageSize+' Message(s)';
                                }else if(((strLength) > 160) && ((strLength) <= 320)){
                                    document.getElementById("bulkmsgNum").innerHTML = 2 +' out of '+maxLength/singleMessageSize+' Message(s)';
                                }else if(((strLength) > 320) && ((strLength) <= 480)){
                                    document.getElementById("bulkmsgNum").innerHTML = 3 +' out of '+maxLength/singleMessageSize+' Message(s)';
                                }else{
                                    document.getElementById("bulkmsgNum").innerHTML = ' Message too big (more than 3)';
                                }

                            }
                            </script>

                    <!-- ------------------------------------------------------------------ -->
                        </div>
                        </div> <div class="col-md-4">
                        	<label>Select Template</label>
                        	 <div >
							 <select name="template" id="template_id" class="form-control" >
                            <option value="">---Please Select Template---</option>
                            <?php
                            if(count($templates)>0){
                                foreach($templates as $row) { ?>
                                <option value="<?=$row->id?>"  template="<?=$row->template?>"  title="<?=$row->title?>"><?=$row->title?></option>
                                <?php   }
                            }else{
                            	echo "No templates found.";
                            } ?>
                        </select>                             
                        </div>
                        </div>
                       </div>
                        
                    </div>

					<br />
                    <hr class="field-separator">

                    <div class="col-md-6 col-xs-12">

                        <button type="submit" class="btn btn-primary"><i class=""></i> <i class="fa fa-send"></i> Send</button>
                        <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>

                    </div>



                </form>

                <br>
            </div>
            <div class="panel-footer">New Bulk SMS</div>
        </div>
    </div>
</div>
</div>
<!-- end #content -->
<script>
	$("#template_id").change(function(){
		var template= $("#template_id option:selected").attr("template");
		$("#message").val(template);
	}); 
    
    $(document).ready(function() {
        $('select[name="group"]').on('change', function() {
            var groupId = $(this).val();
            var base='<?php echo base_url(); ?>';
            if(groupId) {
                $.ajax({
                    url:  base + 'sms/newbulksms/subgroups/'+groupId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#groupcontacts_').empty();
                        $.each(data, function(key, value) {
                            value.selected=true;
                            $('#groupcontacts_').append('<option value="'+ value.msisdn +'" selected> '+ value.name +'</option>');
                        });
                        $('#groupcontacts_').multipleSelect({
                            filter: true,
                            selectAll: true
                        });
                        $(".ms-parent").removeAttr("style");
                    },
                });
            }else{
                $('#groupcontacts_').empty();
            }
        });

        
    });
    
</script>
