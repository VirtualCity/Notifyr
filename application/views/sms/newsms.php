<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
             <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
             <li><a href="<?=base_url('sms/pendingbulksms')?>"><i class="fa fa-dashboard"></i> SMS</a></li>
            <li class="active">New SMS</li>
        </ol>
    </div>

    

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                 <form id="singlesmsform" action="<?php echo base_url('sms/newsms');?>" method="post" class="form-horizontal">
                  <div class="col-md-10 col-md-offset-1">
                  <div class="row">
                            <div class="col-md-2 col-xs-12">
                                <label>Mobile Number </label><span class="text-danger"> *</span>
                            </div>
                            <div class="col-md-10 col-xs-12">
                                <input required number="true" type="text" name="msisdn" id="msisdn" placeholder="2547..." class="form-control" value="<?php echo $msisdn;?>"/>
                                <span class="text-danger">  <?php echo form_error('msisdn'); ?> </span>
                            </div>
                        </div>
                        <br>

                    
                        <div class="row">
                            <div class="col-md-2 col-xs-12">
                                <label>Select Template</label>
                            </div>
                            <div class="col-md-10 col-xs-12">
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
                        <br>
                                            
                        <div class="row">
                            <div class="col-md-2 col-xs-12">
                                <label>Message </label><span class="text-danger"> *</span>
                            </div>
                            <div class="col-md-10 col-xs-12">
                                <textarea required onkeyup="countChars(this);" onkeydown="countChars(this);" maxlength="480" required="true"  id="message" name="message" placeholder="Message" class="form-control" rows="4" value=""><?php echo $message; ?></textarea>
                                <span class="text-danger"><?php echo form_error('message'); ?> </span>
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <p class="pull-right" id="msgNum"> 0 Message(s)</p>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <p class="pull-left" id="chr"> 0 characters</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- ----------------------------------------------------------- -->

                    <br>
                    <script type="text/JavaScript">

                    $("#template_id").change(function(){
                        var template= $("#template_id option:selected").attr("template");
                        $("#message").val(template);
                    }); 

                    function countChars(obj){
                        var maxLength = 480;
                        var singleMessageSize = 160;
                        var strLength = obj.value.length;

                        
                        
                        if(((strLength) > -1) && ((strLength) <= 0)){
                            document.getElementById("chr").innerHTML = strLength + ' characters';
                            document.getElementById("msgNum").innerHTML = 0 +' out of '+maxLength/singleMessageSize+' Message(s)';
                        }else if(((strLength) > 0) && ((strLength) <= 160)){
                            document.getElementById("chr").innerHTML = strLength  + ' characters';
                            document.getElementById("msgNum").innerHTML = 1 +' out of '+maxLength/singleMessageSize+' Message(s)';
                        }else if(((strLength) > 160) && ((strLength) <= 320)){
                            document.getElementById("chr").innerHTML = strLength  + ' characters';
                            document.getElementById("msgNum").innerHTML = 2 +' out of '+maxLength/singleMessageSize+' Message(s)';
                        }else if(((strLength) > 320) && ((strLength) <= 480)){
                            document.getElementById("chr").innerHTML = strLength  + ' characters';
                            document.getElementById("msgNum").innerHTML = 3 +' out of '+maxLength/singleMessageSize+' Message(s)';
                        }else{
                            document.getElementById("chr").innerHTML = strLength  + ' characters';
                            document.getElementById("msgNum").innerHTML = ' Message too big (more than 3)';
                        }

                    }

                    // $(document).ready(function() {
                    //     $.ajax({
                    //         url:  <?php echo base_url('contacts/datatable')?>,
                    //         type: "GET",
                    //         dataType: "json",
                    //         success:function(data) {
                    //             $('#msisdn_').empty();
                    //             $.each(data, function(key, value) {
                    //                 $('#msisdn_').append(value.msisdn);
                    //             });
                            
                    //             $(".ms-parent").removeAttr("style");
                    //         },
                    //     });
                    // });
                    </script>

                    <!-- ------------------------------------------------------------------ -->

                    <hr class="field-separator">
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <button type="submit" class="btn btn-primary pull-right"><i class=""></i> <i class="fa fa-send"></i> Send</button>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <button type="reset" class="btn btn-default pull-left"><i class=""></i> Reset</button>
                            </div>
                        </div>
                  </div>
                </form>
            </div>
            <div class="panel-footer">New SMS</div>

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
                            timer: 3000,
                            showConfirmButton: false,
                            type: "<?php echo $this->session->flashdata('alert_type_') ?>"
                    });
        <?php endif; ?>       
    });

</script> 

<script type="text/javascript">
        $().ready(function(){
			$('#singlesmsform').validate();
        });
</script>

